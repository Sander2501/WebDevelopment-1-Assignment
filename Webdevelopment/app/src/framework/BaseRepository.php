<?php

namespace App\Framework;

use App\Config\Database;
use PDO;

abstract class BaseRepository
{
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    protected function fetchOne(string $sql, array $params, string $modelClass): ?object
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $modelClass);
        
        $result = $stmt->fetch();
        return $result ?: null;
    }
    protected function fetchAll(string $sql, array $params, string $modelClass): array
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $stmt->setFetchMode(PDO:: FETCH_CLASS, $modelClass);
        
        return $stmt->fetchAll();
    }
}