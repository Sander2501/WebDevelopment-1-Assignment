<?php

namespace App\Repositories;

use App\Framework\BaseRepository;
use App\Repositories\Interfaces\ITrainerRepository;

class TrainerRepository extends BaseRepository implements ITrainerRepository
{
    public function listAll(): array
    {
        $sql = "SELECT * FROM trainers ORDER BY name";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function findById(int $id): ?array
    {
        $sql = "SELECT * FROM trainers WHERE id = : id LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result ?: null;
    }
    
    public function getBlogPostsByTrainer(int $trainerId): array
    {
        $sql = "SELECT * FROM blog_posts WHERE trainer_id = :trainer_id ORDER BY published_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['trainer_id' => $trainerId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}