<?php

namespace App\Services\Interfaces;


interface IBookingService
{
    public function getConfirmedSchedule(int $userId): array;

    public function createBooking(int $userId, ?int $classId, string $start, string $end, string $userEmail): int;

    public function deleteBooking(int $id, int $userId): void;
}