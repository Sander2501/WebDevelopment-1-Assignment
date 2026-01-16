<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;
use App\Services\Interfaces\IUserService;
use Exception;

class UserService implements IUserService
{
    private IUserRepository $userRepo;

    public function __construct(IUserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register(string $email, string $password, string $name, ?string $phone = null): int
    {
        if (empty($email) || empty($password) || empty($name)) {
            throw new Exception("Email, password, and name are required.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        if (strlen($password) < 8) {
            throw new Exception("Password must be at least 8 characters.");
        }

        $existing = $this->userRepo->findByEmail($email);
        if ($existing !== null) {
            throw new Exception("Email already registered.");
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        return $this->userRepo->createUser($email, $passwordHash, $name, $phone);
    }

    public function authenticate(string $email, string $password): ?User
    {
        $user = $this->userRepo->findByEmail($email);

        if ($user === null) {
            return null;
        }

        if (!password_verify($password, $user->password_hash)) {
            return null;
        }

        return $user;
    }

    public function getUserById(int $id): ?User
    {
        return $this->userRepo->findById($id);
    }
}