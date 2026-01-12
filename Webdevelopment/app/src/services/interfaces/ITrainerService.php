<?php

namespace App\Services\Interfaces;

interface ITrainerService
{
    public function getAllTrainers(): array;
    
    public function getTrainerWithBlogs(int $trainerId): array;
    
    public function submitContactRequest(int $trainerId, string $name, string $email, string $message): void;
}