<?php
namespace App\Controllers;

use App\Services\BookingService;

class BookingController {
  public function __construct(private BookingService $svc) {}

  public function my(): void {
    $uid = $_SESSION['user']['id'];
    $bookings = $this->svc->getConfirmedSchedule($uid);
    require __DIR__ . '/../views/booking/my.php';
  }

  public function create(): void {
    $uid  = $_SESSION['user']['id'];
    $mail = $_SESSION['user']['email'];
    $classId = $_POST['class_id'] !== '' ? (int)$_POST['class_id'] : null;

    try {
      $this->svc->createBooking($uid, $classId, $_POST['start_at'] ?? '', $_POST['end_at'] ?? '', $mail);
      header('Location: /bookings'); exit;
    } catch (\Exception $e) {
      $error = $e->getMessage();
      require __DIR__ . '/../views/booking/error.php';
    }
  }
}
