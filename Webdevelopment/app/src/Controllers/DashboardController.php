<?php

namespace App\Controllers;

use App\Services\BookingService;

class DashboardController
{
    private BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index(): void
    {
        $user = $_SESSION['user'];

        $allBookings = $this->bookingService->getConfirmedSchedule($user['id']);

        $upcoming = array_filter($allBookings, function ($b) {
            return strtotime($b->start_at) > time();
        });

        usort($upcoming, function ($a, $b) {
            return strtotime($a->start_at) - strtotime($b->start_at);
        });

        $nextSession = !empty($upcoming) ? $upcoming[0] : null;

        $recentBookings = array_slice($upcoming, 0, 5);

        require __DIR__ . '/../Views/dashboard/index.php';
    }
}