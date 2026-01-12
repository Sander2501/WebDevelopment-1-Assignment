<?php

namespace App\Repositories;

use App\Framework\BaseRepository;
use App\Repositories\Interfaces\IProfileRepository;

class ProfileRepository extends BaseRepository implements IProfileRepository
{
    public function updateProfile(int $id, string $name, ?string $phone): void
    {
        $sql = "UPDATE users SET name = :name, phone = :phone, updated_at = NOW() WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id, 'name' => $name, 'phone' => $phone]);
    }
    
    public function updateEmail(int $id, string $email): void
    {
        $sql = "UPDATE users SET email = :email WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id, 'email' => $email]);
    }
    
    public function updatePassword(int $id, string $passwordHash): void
    {
        $sql = "UPDATE users SET password_hash = :password_hash WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id, 'password_hash' => $passwordHash]);
    }
    
    public function deleteUser(int $id): void
    {
        $this->pdo->beginTransaction();
        
        try {
            $stmt = $this->pdo->prepare("DELETE FROM bookings WHERE user_id = :id");
            $stmt->execute(['id' => $id]);
            
            $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute(['id' => $id]);
            
            $this->pdo->commit();
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }
    
    public function emailExists(string $email, int $excludeUserId): bool
    {
        $sql = "SELECT COUNT(*) as count FROM users WHERE email = :email AND id != :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email, 'id' => $excludeUserId]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return (int)$result['count'] > 0;
    }
}