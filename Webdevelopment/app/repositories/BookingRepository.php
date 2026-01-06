<?php
namespace App\Repositories;

use PDO;

class BookingRepository extends BaseRepository {
    
    public function getConfirmedBookingsForUser(int $userId): array {
        $stmt = $this->pdo->prepare("
            SELECT 
                b.id,
                b.start_at,
                b.end_at,
                b.status,
                c.name as class_name
            FROM bookings b
            LEFT JOIN classes c ON b.class_id = c.id
            WHERE b.user_id = :user_id 
            AND b.status = 'confirmed'
            ORDER BY b.start_at DESC
        ");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function hasConfirmedOverlap(string $start, string $end, int $userId, ? int $excludeBookingId = null): bool {
        $sql = "
            SELECT COUNT(*) as count 
            FROM bookings 
            WHERE user_id = :user_id 
            AND status = 'confirmed'
            AND (
                (start_at < :end AND end_at > :start)
            )
        ";
        
        $params = ['user_id' => $userId,'start' => $start,'end' => $end];
        
        if ($excludeBookingId !== null) {
            $sql .= " AND id != :exclude_id";
            $params['exclude_id'] = $excludeBookingId;
        }
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return (int)$result['count'] > 0;
    }
    
    public function createBooking(int $userId, ? int $classId, string $start, string $end): int {
        $stmt = $this->pdo->prepare("INSERT INTO bookings (user_id, class_id, start_at, end_at, status, created_at)
            VALUES (:user_id, :class_id, :start_at, :end_at, 'confirmed', NOW())
        ");
        
        $stmt->execute([
            'user_id' => $userId,
            'class_id' => $classId,
            'start_at' => $start,
            'end_at' => $end
        ]);
        
        return (int)$this->pdo->lastInsertId();
    }
    
    public function findById(int $id): ?array {
        $stmt = $this->pdo->prepare("
            SELECT b.*,c.name as class_name
            FROM bookings b
            LEFT JOIN classes c ON b.class_id = c.id
            WHERE b.id = :id
            LIMIT 1
        ");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function deleteBooking(int $id): void {
        $stmt = $this->pdo->prepare("DELETE FROM bookings WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function updateBookingStatus(int $id, string $status): void {
        $stmt = $this->pdo->prepare("UPDATE bookings SET status = :status WHERE id = :id");
        $stmt->execute(['status' => $status, 'id' => $id]);
    }


}