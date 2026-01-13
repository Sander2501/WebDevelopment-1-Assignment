<?php
//

namespace App\Controllers;

use App\Repositories\Interfaces\IUserRepository;
use App\Services\Interfaces\IProfileService;

class ProfileController
{
    private IProfileService $profileService;
    private IUserRepository $userRepo;
    
    public function __construct(IProfileService $profileService, IUserRepository $userRepo)
    {
        $this->profileService = $profileService;
        $this->userRepo = $userRepo;
    }
    
    public function index(): void
    {
        $user = $this->userRepo->findById($_SESSION['user']['id']);
        
        if (! $user) {
            header('Location: /logout');
            exit;
        }
        
        // FIXED: Lowercase 'views'
        require __DIR__ . '/../views/profile/index.php';
    }
    
    public function updateProfile(): void
    {
        $userId = $_SESSION['user']['id'];
        $name = trim($_POST['name'] ?? '');
        $phone = trim($_POST['phone'] ??  '');
        $phone = $phone === '' ? null : $phone;
        
        try {
            $this->profileService->updateProfile($userId, $name, $phone);
            
            $_SESSION['user']['name'] = $name;
            
            $success = "Profile updated successfully.";
            $user = $this->userRepo->findById($userId);
            // FIXED: Lowercase 'views'
            require __DIR__ . '/../views/profile/index.php';
        } catch (\Exception $e) {
            $error = $e->getMessage();
            $user = $this->userRepo->findById($userId);
            // FIXED: Lowercase 'views'
            require __DIR__ . '/../views/profile/index.php';
        }
    }
    
    public function updateEmail(): void
    {
        $userId = $_SESSION['user']['id'];
        $email = trim($_POST['email'] ?? '');
        
        try {
            $this->profileService->updateEmail($userId, $email);
            
            $_SESSION['user']['email'] = $email;
            
            $success = "Email updated successfully.";
            $user = $this->userRepo->findById($userId);
            // FIXED: Lowercase 'views'
            require __DIR__ . '/../views/profile/index.php';
        } catch (\Exception $e) {
            $error = $e->getMessage();
            $user = $this->userRepo->findById($userId);
            // FIXED: Lowercase 'views'
            require __DIR__ . '/../views/profile/index.php';
        }
    }
    
    public function changePassword(): void
    {
        $userId = $_SESSION['user']['id'];
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        
        $user = $this->userRepo->findById($userId);
        
        if (!$user) {
            header('Location: /logout');
            exit;
        }
        
        try {
            $this->profileService->changePassword($userId, $currentPassword, $newPassword, $user->password_hash);
            
            $success = "Password changed successfully.";
            // FIXED: Lowercase 'views'
            require __DIR__ . '/../views/profile/index.php';
        } catch (\Exception $e) {
            $error = $e->getMessage();
            // FIXED: Lowercase 'views'
            require __DIR__ . '/../views/profile/index.php';
        }
    }
    
    public function deleteAccount(): void
    {
        $user = $this->userRepo->findById($_SESSION['user']['id']);
        
        if (!$user) {
            header('Location:  /logout');
            exit;
        }
        
        // FIXED: Lowercase 'views'
        require __DIR__ . '/../views/profile/delete.php';
    }
    
    public function confirmDelete(): void
    {
        $userId = $_SESSION['user']['id'];
        $password = $_POST['password'] ?? '';
        
        $user = $this->userRepo->findById($userId);
        
        if (! $user) {
            header('Location: /logout');
            exit;
        }
        
        try {
            $this->profileService->deleteAccount($userId, $password, $user->password_hash);
            
            session_destroy();
            header('Location: /login?deleted=1');
            exit;
        } catch (\Exception $e) {
            $error = $e->getMessage();
            // FIXED: Lowercase 'views'
            require __DIR__ . '/../views/profile/delete.php';
        }
    }
}