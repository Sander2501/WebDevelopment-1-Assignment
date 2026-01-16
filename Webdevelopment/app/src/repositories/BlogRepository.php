<?php

namespace App\Repositories;

use App\Framework\BaseRepository;
use App\Models\BlogPost;
use App\Repositories\Interfaces\IBlogRepository;

class BlogRepository extends BaseRepository implements IBlogRepository
{
    public function getAllWithAuthors(): array
    {
        $sql = "SELECT b.*, t.name as author_name,t.photo as author_photo 
                FROM blog_posts b
                JOIN trainers t ON b.trainer_id = t.id
                ORDER BY b.published_at DESC";

        return $this->fetchAll($sql, [], BlogPost::class);
    }

    public function findWithAuthor(int $id): ?BlogPost
    {
        $sql = "SELECT b.*,t.name as author_name, t.photo as author_photo, t.specialization as author_spec
                FROM blog_posts b
                JOIN trainers t ON b.trainer_id = t.id
                WHERE b.id = :id
                LIMIT 1";

        return $this->fetchOne($sql, ['id' => $id], BlogPost::class);
    }
}