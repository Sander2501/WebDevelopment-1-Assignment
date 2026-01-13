<?php

namespace App\Models;

class User
{
    public int $id;
    public string $email;
    public string $password_hash;
    public string $name;
    public ?string $phone = null;
    public ?string $profile_photo = null;
    public string $created_at;
    public ?string $updated_at = null;
}