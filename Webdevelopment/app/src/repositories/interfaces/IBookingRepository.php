<?php

namespace App\Repositories\Interfaces;

use App\Models\Booking;

interface IBookingRepository
{
    public function getConfirmedBookingsForUser(int $userId): array;

    public function hasConfirmedOverlap(string $start, string $end, int $userId, ?int $excludeBookingId = null): bool;

    public function createBooking(int $userId, ?int $classId, string $start, string $end): int;

    public function findById(int $id): ?Booking;

    public function deleteBooking(int $id): void;

    public function updateBookingStatus(int $id, string $status): void;
}