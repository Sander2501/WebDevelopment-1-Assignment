<?php

namespace App\Controllers;

use App\Repositories\Interfaces\IUserRepository;
use App\Services\Interfaces\IValidationService;

class AuthController
{
    private IUserRepository $userRepo;
    private IValidationService $validator;

    public function __construct(IUserRepository $userRepo, IValidationService $validator)
    {
        $this->userRepo = $userRepo;
        $this->validator = $validator;
    }

    public function showRegisterForm(): void
    {
        require __DIR__ . '/../Views/auth/register.php';
    }

    public function register(): void
    {
        $data = [
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
            'name' => $_POST['name'] ?? '',
            'phone' => $_POST['phone'] ?? null
        ];

        $data['email'] = $this->validator->sanitizeString($data['email']);
        $data['name'] = $this->validator->sanitizeString($data['name']);
        if ($data['phone']) {
            $data['phone'] = $this->validator->sanitizeString($data['phone']);
        }

        $errors = $this->validator->validateRegistration($data);

        if (!empty($errors)) {
            $errorMessage = implode('<br>', $errors);
            require __DIR__ . '/../Views/auth/register.php';
            return;
        }

        $existingUser = $this->userRepo->findByEmail($data['email']);
        if ($existingUser) {
            $errorMessage = "Email already registered. ";
            require __DIR__ . '/../Views/auth/register.php';
            return;
        }

        $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);

        try {
            $userId = $this->userRepo->createUser(
                $data['email'],
                $passwordHash,
                $data['name'],
                $data['phone']
            );

            $_SESSION['user'] = [
                'id' => $userId,
                'email' => $data['email'],
                'name' => $data['name']
            ];

            header('Location: /dashboard');
            exit;

        } catch (\Exception $e) {
            error_log("Registration error: " . $e->getMessage());
            $errorMessage = "Registration failed. Please try again.";
            require __DIR__ . '/../Views/auth/register.php';
        }
    }

    public function showLoginForm(): void
    {
        require __DIR__ . '/../Views/auth/login.php';
    }

    public function login(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $email = $this->validator->sanitizeString($email);

        if (empty($email) || empty($password)) {
            $error = "Email and password are required. ";
            require __DIR__ . '/../Views/auth/login. php';
            return;
        }

        $user = $this->userRepo->findByEmail($email);

        if (!$user || !password_verify($password, $user->password_hash)) {
            $error = "Email or password is incorrect.";
            require __DIR__ . '/../Views/auth/login.php';
            return;
        }

        $_SESSION['user'] = [
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name
        ];

        header('Location: /dashboard');
        exit;
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: /login');
        exit;
    }
}