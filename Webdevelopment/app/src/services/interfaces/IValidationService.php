<?php

namespace App\Services\Interfaces;

interface IValidationService
{
    public function validateRegistration(array $data): array;
    
    public function isValidEmail(string $email): bool;
    
    public function isValidPhone(?string $phone): bool;
    
    public function sanitizeString(string $input): string;
}