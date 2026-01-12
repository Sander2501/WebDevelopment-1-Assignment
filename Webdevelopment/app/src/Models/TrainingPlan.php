<?php

namespace App\Models;
class TrainingPlan
{
    public int $id;
    public int $user_id;
    public string $goal;                 
    public int $age;
    public float $weight;
    public float $height;
    public int $frequency;                  
    public ? string $nutrition_preference = null;
    public string $generated_plan;        
    public string $created_at;
}