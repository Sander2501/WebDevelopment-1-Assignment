<?php

namespace App\Controllers;

use App\Services\BookingService;


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
        $uid  = $_SESSION['user']['id'];
        $mail = $_SESSION['user']['email'];
        $classId = isset($_POST['class_id']) && $_POST['class_id'] !== '' 
            ? (int)$_POST['class_id'] 
            : null;

        try {
            $this->svc->createBooking(
                $uid, 
                $classId, 
                $_POST['start_at'] ?? '', 
                $_POST['end_at'] ?? '', 
                $mail
            );
            redirect('/bookings? success=1');
        } catch (\Exception $e) {
            $error = $e->getMessage();
            require __DIR__ . '/../Views/booking/error.php';
        }
    }
    
    public function delete(): void
    {
        $id = isset($_POST['booking_id']) ? (int)$_POST['booking_id'] : 0;
        $userId = $_SESSION['user']['id'];

        if ($id <= 0) {
            redirect('/bookings?error=Invalid+booking');
        }

        $this->svc->deleteBooking($id, $userId);
        redirect('/bookings?success=1');
    }
}