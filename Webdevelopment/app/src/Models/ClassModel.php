<?php

namespace App\Models;


class ClassModel
{    
    public int $id;
    public string $name;
    public string $trainer;
    public string $location;
    public string $start_at;
    public string $end_at;
    public ? int $capacity;
    public ? int $booked;
    public ? string $description;
}