<?php
require __DIR__ . '/../dbconfig.php';

// Minimal autoloader for App\* classes
spl_autoload_register(function($class){
  $prefix = 'App\\';
  if (str_starts_with($class, $prefix)) {
    $path = __DIR__ . '/../' . str_replace(['App\\','\\'], ['','/'], $class) . '.php';
    if (file_exists($path)) require $path;
  }
});

use App\Repositories\{ClassRepository, BookingRepository};
use App\Services\{BookingService, MailService};
use App\Controllers\{ClassController, BookingController};
use App\Api\BookingApiController;

// Wire dependencies
$classRepo   = new ClassRepository($pdo);
$bookingRepo = new BookingRepository($pdo);
$mail        = new MailService();
$bookingSvc  = new BookingService($pdo, $bookingRepo, $mail);

$classCtrl   = new ClassController($classRepo);
$bookCtrl    = new BookingController($bookingSvc);
$apiBookings = new BookingApiController($bookingSvc);

// Very small router
$path   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($path === '/' || $path === '') { header('Location: /classes'); exit; }

if ($path === '/classes'   && $method === 'GET')  { $classCtrl->index();  exit; }
if ($path === '/bookings'  && $method === 'GET')  { $bookCtrl->my();      exit; }
if ($path === '/bookings'  && $method === 'POST') { $bookCtrl->create();  exit; }

if ($path === '/api/bookings' && $method === 'GET')  { $apiBookings->mine();   exit; }
if ($path === '/api/bookings' && $method === 'POST') { $apiBookings->create(); exit; }

http_response_code(404);
echo "Not Found";
