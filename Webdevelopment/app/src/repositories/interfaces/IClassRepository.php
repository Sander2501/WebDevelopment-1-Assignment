<?php

namespace App\Repositories\Interfaces;

use App\Models\ClassModel;

interface IClassRepository
{
    public function listAll(): array;
    
    public function findById(int $id): ?ClassModel;
}