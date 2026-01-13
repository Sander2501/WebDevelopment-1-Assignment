<?php
//

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
        // Fixed: changed 'Views' to 'views'
        require __DIR__ . '/../views/trainers/index.php';
    }
    
    public function view(int $id): void
    {
        try {
            $data = $this->trainerService->getTrainerWithBlogs($id);
            $trainer = $data['trainer'];
            $blogs = $data['blogs'];
            // Fixed: changed 'Views' to 'views'
            require __DIR__ . '/../views/trainers/view.php';
        } catch (\Exception $e) {
            $error = $e->getMessage();
            // Fixed: changed 'Views' to 'views' so it finds the file you just created
            require __DIR__ . '/../views/error.php';
        }
    }
    
    public function contact(int $trainerId): void
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $message = $_POST['message'] ?? '';
        
        try {
            $this->trainerService->submitContactRequest($trainerId, $name, $email, $message);
            
            header("Location: /trainers/$trainerId?success=1");
            exit;
        } catch (\Exception $e) {
            $error = $e->getMessage();
            $data = $this->trainerService->getTrainerWithBlogs($trainerId);
            $trainer = $data['trainer'];
            $blogs = $data['blogs'];
            // Fixed: changed 'Views' to 'views'
            require __DIR__ .  '/../views/trainers/view.php';
        }
    }
}