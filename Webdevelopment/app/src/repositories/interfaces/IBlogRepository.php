<?php

namespace App\Repositories\Interfaces;

use App\Models\BlogPost;

interface IBlogRepository
{
    public function getAllWithAuthors(): array;
    public function findWithAuthor(int $id): ?BlogPost;
}