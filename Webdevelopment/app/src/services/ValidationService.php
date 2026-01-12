<?php

namespace App\Services;

use App\Services\Interfaces\IValidationService;


class ValidationService implements IValidationService
{
    public function validateRegistration(array $data): array
    {
        $errors = [];

        if (empty($data['email'])) {
            $errors[] = "Email is required. ";
        } elseif (! $this->isValidEmail($data['email'])) {
            $errors[] = "Email format is invalid.";
        } elseif (strlen($data['email']) > 255) {
            $errors[] = "Email is too long (max 255 characters).";
        }
        
        if (empty($data['password'])) {
            $errors[] = "Password is required.";
        } elseif (strlen($data['password']) < 8) {
            $errors[] = "Password must be at least 8 characters.";
        } elseif (strlen($data['password']) > 255) {
            $errors[] = "Password is too long (max 255 characters).";
        }
        
        if (empty($data['name'])) {
            $errors[] = "Name is required.";
        } elseif (strlen($data['name']) > 100) {
            $errors[] = "Name is too long (max 100 characters).";
        }

        if (!empty($data['phone'])) {
            if (! $this->isValidPhone($data['phone'])) {
                $errors[] = "Phone number format is invalid or too long (max 20 characters).";
            }
        }
        
        return $errors;
    }

    public function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    public function isValidPhone(? string $phone): bool
    {
        if ($phone === null || $phone === '') {
            return true;
        }
        
        if (strlen($phone) > 20) {
            return false;
        }
        
        if (!preg_match('/^[\d\s\-\(\)\+]+$/', $phone)) {
            return false;
        }
        
        return true;
    }
    
    public function sanitizeString(string $input): string
    {
        $input = trim($input);
        
        $input = str_replace("\0", '', $input);
        
        return $input;
    }

    public function validateBooking(array $data): array
    {
        $errors = [];
        
        if (empty($data['start_at'])) {
            $errors[] = "Start time is required.";
        } elseif (!$this->isValidDateTime($data['start_at'])) {
            $errors[] = "Start time format is invalid.";
        }

        if (empty($data['end_at'])) {
            $errors[] = "End time is required.";
        } elseif (!$this->isValidDateTime($data['end_at'])) {
            $errors[] = "End time format is invalid. ";
        }
        
        if (empty($errors) && strtotime($data['end_at']) <= strtotime($data['start_at'])) {
            $errors[] = "End time must be after start time.";
        }
        
        return $errors;
    }

    private function isValidDateTime(string $datetime): bool
    {
        $timestamp = strtotime($datetime);
        return $timestamp !== false;
    }
}