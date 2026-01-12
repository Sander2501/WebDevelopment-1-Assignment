<?php

namespace App\Repositories\Interfaces;

interface ITrainerRepository
{
    public function listAll(): array;
    
    public function findById(int $id): ?array;
    
    public function getBlogPostsByTrainer(int $trainerId): array;
}