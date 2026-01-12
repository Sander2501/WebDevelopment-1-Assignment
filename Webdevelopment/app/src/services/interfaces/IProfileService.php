<?php

namespace App\Services\Interfaces;

interface IProfileService
{
    public function updateProfile(int $userId, string $name, ?string $phone): void;
    
    public function updateEmail(int $userId, string $email): void;
    
    public function changePassword(int $userId, string $currentPassword, string $newPassword, string $currentPasswordHash): void;
    
    public function deleteAccount(int $userId, string $password, string $passwordHash): void;
}