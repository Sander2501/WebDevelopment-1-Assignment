<?php

namespace App\Services;

use App\Repositories\Interfaces\IProfileRepository;
use App\Services\Interfaces\IProfileService;
use App\Services\Interfaces\IValidationService;
use Exception;

class ProfileService implements IProfileService
{
    private IProfileRepository $profileRepo;
    private IValidationService $validator;
    
    public function __construct(IProfileRepository $profileRepo, IValidationService $validator)
    {
        $this->profileRepo = $profileRepo;
        $this->validator = $validator;
    }
    
    public function updateProfile(int $userId, string $name, ?string $phone): void
    {
        if (empty($name) || strlen($name) > 100) {
            throw new Exception("Name is required and must be max 100 characters.");
        }
        
        if ($phone && ! $this->validator->isValidPhone($phone)) {
            throw new Exception("Phone number format is invalid.");
        }
        
        $this->profileRepo->updateProfile($userId, $name, $phone);
    }
    
    public function updateEmail(int $userId, string $email): void
    {
        if (! $this->validator->isValidEmail($email)) {
            throw new Exception("Email format is invalid.");
        }
        
        if ($this->profileRepo->emailExists($email, $userId)) {
            throw new Exception("Email is already in use by another account.");
        }
        
        $this->profileRepo->updateEmail($userId, $email);
    }
    
    public function changePassword(int $userId, string $currentPassword, string $newPassword, string $currentPasswordHash): void
    {
        if (!password_verify($currentPassword, $currentPasswordHash)) {
            throw new Exception("Current password is incorrect.");
        }
        
        if (strlen($newPassword) < 8) {
            throw new Exception("New password must be at least 8 characters.");
        }
        
        $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $this->profileRepo->updatePassword($userId, $newHash);
    }
    
    public function deleteAccount(int $userId, string $password, string $passwordHash): void
    {
        if (!password_verify($password, $passwordHash)) {
            throw new Exception("Password is incorrect.");
        }
        
        $this->profileRepo->deleteUser($userId);
    }
}