<?php

namespace App\Repositories;

use App\Framework\BaseRepository;
use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function findByEmail(string $email): ?User
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        return $this->fetchOne($sql, ['email' => $email], User::class);
    }
    
    public function findById(int $id): ?User
    {
        $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
        return $this->fetchOne($sql, ['id' => $id], User::class);
    }
    
    public function createUser(
        string $email, 
        string $passwordHash, 
        string $name, 
        ? string $phone = null
    ): int {
        $sql = "
            INSERT INTO users (email, password_hash, name, phone, created_at)
            VALUES (:email, :password_hash, :name, :phone, NOW())
        ";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'email' => $email,
            'password_hash' => $passwordHash,
            'name' => $name,
            'phone' => $phone
        ]);
        
        return (int)$this->pdo->lastInsertId();
    }

    public function updateProfile(
        int $id, 
        string $name, 
        ? string $phone, 
        ?string $profilePhoto
    ): void {
        $sql = "
            UPDATE users 
            SET name = :name, 
                phone = :phone, 
                profile_photo = :profile_photo,
                updated_at = NOW()
            WHERE id = :id
        ";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'name' => $name,
            'phone' => $phone,
            'profile_photo' => $profilePhoto
        ]);
    }
}