<?php

namespace App\Controllers;

use App\Services\Interfaces\IBlogService;

class BlogController
{
    private IBlogService $service;
    
    // Inject the Interface
    public function __construct(IBlogService $service)
    {
        $this->service = $service;
    }
    
    public function index(): void
    {
        // Use the service to get data
        $posts = $this->service->getBlogIndex();
        require __DIR__ . '/../Views/blog/index.php';
    }
    
    public function view(int $id): void
    {
        $post = $this->service->getPost($id);
        
        if (!$post) {
            http_response_code(404);
            require __DIR__ . '/../Views/404.php'; // Ensure you have a 404 view or handle error
            return;
        }
        
        require __DIR__ . '/../Views/blog/view.php';
    }
}