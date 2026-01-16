<?php

namespace App\Services\Interfaces;

use App\Models\User;

interface IUserService
{
    public function register(string $email, string $password, string $name, ?string $phone = null): int;

    public function authenticate(string $email, string $password): ?User;

    public function getUserById(int $id): ?User;
}