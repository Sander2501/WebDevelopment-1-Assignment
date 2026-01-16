<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface IUserRepository
{

    public function findByEmail(string $email): ?User;

    public function findById(int $id): ?User;

    public function createUser(string $email, string $passwordHash, string $name, ?string $phone = null): int;

    public function updateProfile(int $id, string $name, ?string $phone, ?string $profilePhoto): void;
}