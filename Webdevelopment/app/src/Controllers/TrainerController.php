<?php

namespace App\Controllers;

use App\Services\Interfaces\ITrainerService;

class TrainerController
{
    private ITrainerService $trainerService;
    
    public function __construct(ITrainerService $trainerService)
    {
        $this->trainerService = $trainerService;
    }
    
    public function index(): void
    {
        $trainers = $this->trainerService->getAllTrainers();
        require __DIR__ . '/../Views/trainers/index.php';
    }
    
    public function view(int $id): void
    {
        try {
            $data = $this->trainerService->getTrainerWithBlogs($id);
            $trainer = $data['trainer'];
            $blogs = $data['blogs'];
            require __DIR__ . '/../Views/trainers/view.php';
        } catch (\Exception $e) {
            $error = $e->getMessage();
            require __DIR__ . '/../Views/error.php';
        }
    }
    
    public function contact(int $trainerId): void
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $message = $_POST['message'] ?? '';
        
        try {
            $this->trainerService->submitContactRequest($trainerId, $name, $email, $message);
            
            header("Location: /trainers/$trainerId? success=1");
            exit;
        } catch (\Exception $e) {
            $error = $e->getMessage();
            $data = $this->trainerService->getTrainerWithBlogs($trainerId);
            $trainer = $data['trainer'];
            $blogs = $data['blogs'];
            require __DIR__ .  '/../Views/trainers/view.php';
        }
    }
}