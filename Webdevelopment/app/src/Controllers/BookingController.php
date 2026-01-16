<?php

namespace App\Controllers;

use App\Services\BookingService;
use DateTime;

class BookingController
{
    private BookingService $svc;

    public function __construct(BookingService $svc)
    {
        $this->svc = $svc;
    }

    public function index(): void
    {
        $uid = $_SESSION['user']['id'];
        $bookings = $this->svc->getConfirmedSchedule($uid);
        require __DIR__ . '/../Views/booking/index.php';
    }

    public function create(): void
    {
        $uid = $_SESSION['user']['id'];
        $mail = $_SESSION['user']['email'];
        $type = $_POST['booking_type'] ?? 'class';

        try {
            $startStr = '';
            $endStr = '';
            $classId = null;

            if ($type === 'gym_session') {
                $rawStart = $_POST['gym_start_time'] ?? '';

                if (empty($rawStart)) {
                    throw new \Exception("Please select a time for your gym session.");
                }

                $startDt = new DateTime($rawStart);
                $endDt = clone $startDt;
                $endDt->modify('+1 hour');

                $startStr = $startDt->format('Y-m-d H:i:s');
                $endStr = $endDt->format('Y-m-d H:i:s');

                $classId = null;

            } else {
                $classId = isset($_POST['class_id']) ? (int) $_POST['class_id'] : null;
                $date = $_POST['target_date'] ?? '';
                $timeStart = $_POST['static_start_time'] ?? '';
                $timeEnd = $_POST['static_end_time'] ?? '';

                if (empty($date) || empty($timeStart) || empty($timeEnd)) {
                    throw new \Exception("Invalid class booking data.");
                }

                $startStr = $date . ' ' . $timeStart;
                $endStr = $date . ' ' . $timeEnd;
            }

            $now = new DateTime();
            $bookingTime = new DateTime($startStr);

            if ($bookingTime < $now) {
                throw new \Exception("You cannot book a session in the past.");
            }

            $this->svc->createBooking($uid, $classId, $startStr, $endStr, $mail);

            redirect('/bookings?success=1');

        } catch (\Exception $e) {
            $error = $e->getMessage();
            require __DIR__ . '/../Views/booking/error.php';
        }
    }

    public function delete(): void
    {
        $id = isset($_POST['booking_id']) ? (int) $_POST['booking_id'] : 0;
        $userId = $_SESSION['user']['id'];

        if ($id <= 0) {
            redirect('/bookings?error=Invalid+booking');
        }

        $this->svc->deleteBooking($id, $userId);
        redirect('/bookings?success=1');
    }
}