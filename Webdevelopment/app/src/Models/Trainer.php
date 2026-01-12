<?php

namespace App\Models;

class Trainer
{
    public int $id;
    public string $name;
    public string $email;
    public ?string $phone;
    public ?string $specialization;
    public ?string $bio;
    public ? string $photo;
    public string $created_at;
}