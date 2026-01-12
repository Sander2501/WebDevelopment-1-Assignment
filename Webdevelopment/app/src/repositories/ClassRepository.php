<?php

namespace App\Repositories;

use App\Framework\BaseRepository;
use App\Models\ClassModel;
use App\Repositories\Interfaces\IClassRepository;


class ClassRepository extends BaseRepository implements IClassRepository
{
    public function listAll(): array
    {
        $sql = "SELECT id, name, trainer, location, start_at, end_at, capacity, booked, description
                FROM classes
                ORDER BY start_at
        ";
        
        return $this->fetchAll($sql, [], ClassModel::class);
    }

    public function findById(int $id): ?ClassModel
    {
        $sql = "SELECT * FROM classes WHERE id = :id LIMIT 1";
        return $this->fetchOne($sql, ['id' => $id], ClassModel::class);
    }
}