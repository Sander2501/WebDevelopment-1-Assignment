<?php
namespace App\Services;

use App\Repositories\BookingRepository;
use PDO;
use Exception;

class BookingService {
    public function __construct(
        private PDO $pdo,
        private BookingRepository $bookingRepository,
        private MailService $mailService
    ) {}
    public function getConfirmedSchedule(int $userId): array {
        return $this->bookingRepository->getConfirmedBookingsForUser($userId);
    }
    public function createBooking(int $userId, ?int $classId, string $start, string $end, string $userEmail): int {
     if (!$start || !$end) {
             throw new Exception("Start and end times are required.");
        }
        if (strtotime($end) <= strtotime($start)) {
             throw new Exception("End time must be strictly after the start time.");
        }
        if ($this->bookingRepository->hasConfirmedOverlap($start, $end, $userId)) {
            // 
            throw new Exception("You already have a confirmed booking that overlaps with this time slot.");
        }

        $this->pdo->beginTransaction();
        try {

            $id = $this->bookingRepository->createBooking($userId, $classId, $start, $end);
            $this->pdo->commit();

            $createdBookingData = $this->findCreatedBookingData($id, $userId);

            $this->mailService->sendBookingConfirmation($userEmail, $createdBookingData);

            return $id;
        } catch (\PDOException $e) {
            $this->pdo->rollBack();

            if (str_contains(strtolower($e->getMessage()), 'unique')) {
                throw new Exception("That time slot is already booked for you (database conflict).");
            }
            throw $e;
        }
    }
    private function findCreatedBookingData(int $id, int $userId): array
    {
        foreach ($this->bookingRepository->getConfirmedBookingsForUser($userId) as $b) {
            if ((int)$b['id'] === $id) { 
                return $b; 
            }
        }
        return ['id' => $id, 'start_at' => 'N/A', 'end_at' => 'N/A', 'class_name' => 'Unknown'];
    }
}