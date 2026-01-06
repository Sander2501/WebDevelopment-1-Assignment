<?php
namespace App\Repositories;

use PDO;
class ClassRepository extends BaseRepository {
    public function listAll(): array {
    $stmt = $this->pdo->query("
        SELECT id, name, trainer, location, start_at, end_at
        FROM classes
        ORDER BY start_at");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findById(int $id): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM classes WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }



}