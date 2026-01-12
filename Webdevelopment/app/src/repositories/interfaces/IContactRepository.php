<?php

namespace App\Repositories\Interfaces;

interface IContactRepository
{
    public function saveContactRequest(int $trainerId, string $name, string $email, string $message): int;
}