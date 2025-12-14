<?php
namespace App\Repositories;

use PDO;
class ClassRepository extends BaseRepository{
    public function listAll(): array
    {
        return $this->pdo->query("SELECT id, name FROM classes ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
    }
}