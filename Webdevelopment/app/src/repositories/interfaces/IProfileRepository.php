<?php

namespace App\Repositories\Interfaces;

interface IProfileRepository
{
    public function updateProfile(int $id, string $name, ? string $phone): void;
    
    public function updateEmail(int $id, string $email): void;
    
    public function updatePassword(int $id, string $passwordHash): void;
    
    public function deleteUser(int $id): void;
    
    public function emailExists(string $email, int $excludeUserId): bool;
}