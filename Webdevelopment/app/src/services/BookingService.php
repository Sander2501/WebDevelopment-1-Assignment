<?php

namespace App\Services;

use App\Repositories\Interfaces\IBookingRepository;
use App\Services\Interfaces\IBookingService;
use PDO;
use Exception;

class BookingService implements IBookingService
{
    private IBookingRepository $bookingRepository;
    private PDO $pdo;
    
    public function __construct(
        IBookingRepository $bookingRepository, 
        PDO $pdo
    ) {
        $this->bookingRepository = $bookingRepository;
        $this->pdo = $pdo;
    }
    
    public function getConfirmedSchedule(int $userId): array
    {
        return $this->bookingRepository->getConfirmedBookingsForUser($userId);
    }
    
    public function createBooking(
        int $userId, 
        ? int $classId, 
        string $start, 
        string $end, 
        string $userEmail
    ): int {
        if (!$start || !$end) {
            throw new Exception("Start and end times are required.");
        }
        
        if (strtotime($end) <= strtotime($start)) {
            throw new Exception("End time must be after start time.");
        }
        
        if ($this->bookingRepository->hasConfirmedOverlap($start, $end, $userId)) {
            throw new Exception("You already have a confirmed booking that overlaps with this time slot.");
        }

        $this->pdo->beginTransaction();
        
        try {
            $id = $this->bookingRepository->createBooking($userId, $classId, $start, $end);
        
            $this->pdo->commit();
            
            return $id;
            
        } catch (\PDOException $e) {
            $this->pdo->rollBack();

            if (str_contains(strtolower($e->getMessage()), 'unique')) {
                throw new Exception("That time slot is already booked for you (database conflict).");
            }
            
            throw $e;
        }
    }

    public function deleteBooking(int $id, int $userId): void 
    {
        $booking = $this->bookingRepository->findById($id);
        
        if (!$booking) {
            throw new Exception("Booking not found.");
        }
        
        if ($booking->user_id !== $userId) {
            throw new Exception("You do not have permission to delete this booking.");
        }
    
        $this->bookingRepository->deleteBooking($id);
    }
}