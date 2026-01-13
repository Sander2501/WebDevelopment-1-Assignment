<?php

namespace App\Services\Interfaces;

use App\Models\BlogPost;

interface IBlogService
{
    public function getBlogIndex(): array;
    public function getPost(int $id): ?BlogPost;
}