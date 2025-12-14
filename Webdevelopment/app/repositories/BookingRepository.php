<?php
namespace App\Repositories;

use PDO;

class BookingRepository extends BaseRepository{
    public function getConfirmedBookingsForUser(int $userId): array
    {
        $sql = "SELECT b.id, b.user_id, b.class_id, b.start_at, b.end_at, b.status, COALESCE(c.name,'Gym Session') AS class_name
                FROM bookings b
                LEFT JOIN classes c ON c.id=b.class_id
                WHERE b.user_id=:u AND b.status='confirmed'
                ORDER BY b.start_at DESC";

        $st = $this->pdo->prepare($sql);
        $st->execute([':u' => $userId]);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
    public function hasConfirmedOverlap(string $start, string $end, int $userId): bool
    {
        $sql = "SELECT 1 FROM bookings WHERE user_id = :u AND status = 'confirmed'AND start_at < :new_end AND end_at > :new_start";  
        $st = $this->pdo->prepare($sql);
        $st->execute([':u' => $userId, ':new_start' => $start, ':new_end' => $end ]);

        return (bool)$st->fetchColumn();
    }

    public function createBooking(int $userId, ?int $classId, string $start, string $end): int
    {
        $st = $this->pdo->prepare( "INSERT INTO bookings (user_id, class_id, start_at, end_at)VALUES (:u, :c, :s, :e)");
        $st->execute([':u' => $userId, ':c' => $classId, ':s' => $start, ':e' => $end]);
        return (int)$this->pdo->lastInsertId();
    } 
}
