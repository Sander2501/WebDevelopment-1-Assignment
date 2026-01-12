<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    ini_set('session.cookie_httponly', '1');
    ini_set('session.use_strict_mode', '1');
    session_start();
}

require_once __DIR__ . '/../src/Framework/Helpers.php';
require_once __DIR__ . '/../src/Config/Database.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

require_once __DIR__ . '/../src/Framework/BaseRepository.php';

require_once __DIR__ . '/../src/Models/User.php';
require_once __DIR__ . '/../src/Models/Booking.php';
require_once __DIR__ . '/../src/Models/ClassModel.php';

require_once __DIR__ . '/../src/Repositories/Interfaces/IUserRepository.php';
require_once __DIR__ . '/../src/Repositories/Interfaces/IBookingRepository.php';
require_once __DIR__ . '/../src/Repositories/Interfaces/IClassRepository.php';

require_once __DIR__ . '/../src/Repositories/UserRepository.php';
require_once __DIR__ . '/../src/Repositories/BookingRepository.php';
require_once __DIR__ . '/../src/Repositories/ClassRepository.php';

require_once __DIR__ . '/../src/Services/Interfaces/IUserService.php';
require_once __DIR__ . '/../src/Services/Interfaces/IValidationService.php';
require_once __DIR__ . '/../src/Services/Interfaces/IBookingService.php';

require_once __DIR__ . '/../src/Services/UserService.php';
require_once __DIR__ . '/../src/Services/ValidationService.php';
require_once __DIR__ . '/../src/Services/BookingService.php';

require_once __DIR__ .  '/../src/Controllers/AuthController.php';
require_once __DIR__ . '/../src/Controllers/BookingController.php';
require_once __DIR__ . '/../src/Controllers/ClassBookingController.php';
require_once __DIR__ . '/../src/Controllers/ApiBookingsController.php';

$pdo = App\Config\Database::getConnection();

$userRepo = new App\Repositories\UserRepository();
$bookingRepo = new App\Repositories\BookingRepository();
$classRepo = new App\Repositories\ClassRepository();

$userService = new App\Services\UserService($userRepo);
$validationService = new App\Services\ValidationService();
$bookingService = new App\Services\BookingService($bookingRepo, $pdo);

$authCtrl = new App\Controllers\AuthController($userRepo, $validationService);
$bookingCtrl = new App\Controllers\BookingController($bookingService);
$classCtrl = new App\Controllers\ClassBookingController($classRepo);
$apiBookings = new App\Controllers\ApiBookingsController($bookingService);

if ($path === '/login' && $method === 'GET') { $authCtrl->showLoginForm(); exit; }
if ($path === '/login' && $method === 'POST') { $authCtrl->login(); exit; }

if ($path === '/register' && $method === 'GET') { $authCtrl->showRegisterForm(); exit; }
if ($path === '/register' && $method === 'POST') { $authCtrl->register(); exit; }

if (!  isset($_SESSION['user'])) {
    setFlash('error', 'Please login to access this page.');
    redirect('/login');
}

if ($path === '/' || $path === '/dashboard') {
    require __DIR__ . '/../src/Views/dashboard/index.php';
    exit;
}

if ($path === '/logout') {
    $authCtrl->logout();
    exit;
}

if ($path === '/classes' && $method === 'GET') {
    $classCtrl->index();
    exit;
}

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

if ($path === '/api/bookings' && $method === 'GET') {
    $apiBookings->mine();
    exit;
}

if ($path === '/api/bookings' && $method === 'POST') {
    $apiBookings->create();
    exit;
}
