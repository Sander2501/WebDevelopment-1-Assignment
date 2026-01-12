<?php

namespace App\Repositories;

use App\Framework\BaseRepository;
use App\Repositories\Interfaces\IContactRepository;

class ContactRepository extends BaseRepository implements IContactRepository
{
    public function saveContactRequest(int $trainerId, string $name, string $email, string $message): int
    {
        $sql = "INSERT INTO contact_requests (trainer_id, name, email, message, created_at) 
                VALUES (:trainer_id, :name, :email, :message, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'trainer_id' => $trainerId,
            'name' => $name,
            'email' => $email,
            'message' => $message
        ]);
        return (int)$this->pdo->lastInsertId();
    }
}