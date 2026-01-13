<?php

namespace App\Services;

use App\Repositories\Interfaces\IBlogRepository;
use App\Services\Interfaces\IBlogService;
use App\Models\BlogPost;

class BlogService implements IBlogService
{
    private IBlogRepository $repo;

    public function __construct(IBlogRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getBlogIndex(): array
    {
        return $this->repo->getAllWithAuthors();
    }

    public function getPost(int $id): ?BlogPost
    {
        return $this->repo->findWithAuthor($id);
    }
}