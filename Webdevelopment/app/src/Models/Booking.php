<?php

namespace App\Models;

class Booking
{
    public int $id;
    public int $user_id;
    public ? int $class_id;
    public string $start_at;
    public string $end_at;
    public string $status;
    public ? string $created_at;
    public ?string $updated_at;
    public ?string $class_name;
    
}