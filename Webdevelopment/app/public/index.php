<?php
//

if (session_status() !== PHP_SESSION_ACTIVE) {
    ini_set('session.cookie_httponly', '1');
    ini_set('session.use_strict_mode', '1');
    session_start();
}

require_once __DIR__ . '/../src/Framework/Helpers.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// --- 1. CONFIG & FRAMEWORK ---
require_once __DIR__ . '/../src/Config/Database.php';
require_once __DIR__ . '/../src/Framework/BaseRepository.php';

// --- 2. MODELS ---
require_once __DIR__ . '/../src/Models/User.php';
require_once __DIR__ . '/../src/Models/Booking.php';
require_once __DIR__ . '/../src/Models/ClassModel.php';
require_once __DIR__ . '/../src/Models/Trainer.php';
require_once __DIR__ . '/../src/Models/BlogPost.php';

// --- 3. REPOSITORIES ---
require_once __DIR__ . '/../src/Repositories/Interfaces/IUserRepository.php';
require_once __DIR__ . '/../src/Repositories/Interfaces/IBookingRepository.php';
require_once __DIR__ . '/../src/Repositories/Interfaces/IClassRepository.php';
require_once __DIR__ . '/../src/Repositories/Interfaces/IProfileRepository.php';
require_once __DIR__ . '/../src/Repositories/Interfaces/ITrainerRepository.php';
require_once __DIR__ . '/../src/Repositories/Interfaces/IContactRepository.php';

require_once __DIR__ . '/../src/Repositories/UserRepository.php';
require_once __DIR__ . '/../src/Repositories/BookingRepository.php';
require_once __DIR__ . '/../src/Repositories/ClassRepository.php';
require_once __DIR__ . '/../src/Repositories/ProfileRepository.php';
require_once __DIR__ . '/../src/Repositories/TrainerRepository.php';
require_once __DIR__ . '/../src/Repositories/ContactRepository.php';

// --- 4. SERVICES ---
require_once __DIR__ . '/../src/Services/Interfaces/IUserService.php';
require_once __DIR__ . '/../src/Services/Interfaces/IValidationService.php';
require_once __DIR__ . '/../src/Services/Interfaces/IBookingService.php';
require_once __DIR__ . '/../src/Services/Interfaces/IProfileService.php';
require_once __DIR__ . '/../src/Services/Interfaces/ITrainerService.php';

require_once __DIR__ . '/../src/Services/UserService.php';
require_once __DIR__ . '/../src/Services/ValidationService.php';
require_once __DIR__ . '/../src/Services/BookingService.php';
require_once __DIR__ . '/../src/Services/ProfileService.php';
require_once __DIR__ . '/../src/Services/TrainerService.php';

// --- 5. CONTROLLERS ---
require_once __DIR__ . '/../src/Controllers/AuthController.php';
require_once __DIR__ . '/../src/Controllers/BookingController.php';
require_once __DIR__ . '/../src/Controllers/ClassBookingController.php';
require_once __DIR__ . '/../src/Controllers/ApiBookingsController.php';
require_once __DIR__ . '/../src/Controllers/ProfileController.php';
require_once __DIR__ . '/../src/Controllers/TrainerController.php';
require_once __DIR__ . '/../src/Controllers/DashboardController.php'; // <--- NEW

// --- 6. INITIALIZATION ---
$pdo = App\Config\Database::getConnection();

// Repositories
$userRepo = new App\Repositories\UserRepository();
$bookingRepo = new App\Repositories\BookingRepository();
$classRepo = new App\Repositories\ClassRepository();
$profileRepo = new App\Repositories\ProfileRepository();
$trainerRepo = new App\Repositories\TrainerRepository();
$contactRepo = new App\Repositories\ContactRepository();

// Services
$userService = new App\Services\UserService($userRepo);
$validationService = new App\Services\ValidationService();
$bookingService = new App\Services\BookingService($bookingRepo, $pdo);
$profileService = new App\Services\ProfileService($profileRepo, $validationService);
$trainerService = new App\Services\TrainerService($trainerRepo, $contactRepo, $validationService);

// Controllers
$authCtrl = new App\Controllers\AuthController($userRepo, $validationService);
$bookingCtrl = new App\Controllers\BookingController($bookingService);
$classCtrl = new App\Controllers\ClassBookingController($classRepo);
$apiBookings = new App\Controllers\ApiBookingsController($bookingService);
$profileCtrl = new App\Controllers\ProfileController($profileService, $userRepo);
$trainerCtrl = new App\Controllers\TrainerController($trainerService);
$dashboardCtrl = new App\Controllers\DashboardController($bookingService); // <--- NEW

// --- 7. ROUTING ---

// Authentication Routes
if ($path === '/login' && $method === 'GET')  { $authCtrl->showLoginForm(); exit; }
if ($path === '/login' && $method === 'POST') { $authCtrl->login(); exit; }

if ($path === '/register' && $method === 'GET')  { $authCtrl->showRegisterForm(); exit; }
if ($path === '/register' && $method === 'POST') { $authCtrl->register(); exit; }

// Protected Routes check
if (! isset($_SESSION['user'])) {
    setFlash('error', 'Please login to access this page.');
    redirect('/login');
}

if ($path === '/logout') { 
    $authCtrl->logout(); 
    exit; 
}

// Dashboard Route (UPDATED)
if ($path === '/' || $path === '/dashboard') {
    $dashboardCtrl->index(); // <--- Now uses the Controller
    exit;
}

// Class Booking Routes
if ($path === '/classes' && $method === 'GET') { 
    $classCtrl->index(); 
    exit; 
}

// General Booking Routes
if ($path === '/bookings' && $method === 'GET') { 
    $bookingCtrl->index(); 
    exit; 
}

if ($path === '/bookings' && $method === 'POST') { 
    $bookingCtrl->create(); 
    exit; 
}

if ($path === '/bookings/delete' && $method === 'POST') { 
    $bookingCtrl->delete(); 
    exit; 
}

// API Routes
if ($path === '/api/bookings' && $method === 'GET') { 
    $apiBookings->mine(); 
    exit; 
}

if ($path === '/api/bookings' && $method === 'POST') { 
    $apiBookings->create(); 
    exit; 
}

if (preg_match('#^/api/bookings/(\d+)$#', $path, $matches) && $method === 'DELETE') {
    $apiBookings->delete((int)$matches[1]);
    exit;
}

// Profile Routes
if ($path === '/profile' && $method === 'GET') {
    $profileCtrl->index();
    exit;
}

if ($path === '/profile/update' && $method === 'POST') {
    $profileCtrl->updateProfile();
    exit;
}

if ($path === '/profile/update-email' && $method === 'POST') {
    $profileCtrl->updateEmail();
    exit;
}

if ($path === '/profile/change-password' && $method === 'POST') {
    $profileCtrl->changePassword();
    exit;
}

if ($path === '/profile/delete' && $method === 'GET') {
    $profileCtrl->deleteAccount();
    exit;
}

if ($path === '/profile/delete-confirm' && $method === 'POST') {
    $profileCtrl->confirmDelete();
    exit;
}

// Trainer Routes
if ($path === '/trainers' && $method === 'GET') {
    $trainerCtrl->index();
    exit;
}

if (preg_match('#^/trainers/(\d+)$#', $path, $matches) && $method === 'GET') {
    $trainerCtrl->view((int)$matches[1]);
    exit;
}

if (preg_match('#^/trainers/(\d+)/contact$#', $path, $matches) && $method === 'POST') {
    $trainerCtrl->contact((int)$matches[1]);
    exit;
}

// Privacy Policy
if ($path === '/privacy' && $method === 'GET') {
    require __DIR__ . '/../src/Views/privacy.php';
    exit;
}

// 404 Handler
http_response_code(404);
echo "404 Not Found";