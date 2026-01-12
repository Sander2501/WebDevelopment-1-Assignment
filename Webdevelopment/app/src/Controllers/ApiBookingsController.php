<?php

namespace App\Controllers;

use App\Services\BookingService;

class ApiBookingsController
{
    private BookingService $svc;
    
    public function __construct(BookingService $svc)
    {
        $this->svc = $svc;
    }
    
    public function mine(): void
    {
        header('Content-Type: application/json');
        echo json_encode($this->svc->getConfirmedSchedule($_SESSION['user']['id']));
    }

    public function create(): void
    {
        header('Content-Type: application/json');
        $uid  = $_SESSION['user']['id'];
        $mail = $_SESSION['user']['email'];
        $body = json_decode(file_get_contents('php://input'), true) ?? [];
        $classId = isset($body['class_id']) && $body['class_id'] !== '' 
            ? (int)$body['class_id'] 
            : null;

        try {
            $id = $this->svc->createBooking(
                $uid, 
                $classId, 
                $body['start_at'] ?? '', 
                $body['end_at'] ?? '', 
                $mail
            );
            http_response_code(201);
            echo json_encode(['id' => $id, 'status' => 'confirmed']);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}