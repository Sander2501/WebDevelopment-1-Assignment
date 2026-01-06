<?php
namespace App\Controllers;

use App\Services\BookingService;

class BookingController {
  public function __construct(private BookingService $svc) {}

  public function index(): void {
    $uid = $_SESSION['user']['id'];
    $bookings = $this->svc->getConfirmedSchedule($uid);
    require __DIR__ . '/../views/booking/index.php';
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

 public function delete(): void {
    $id = isset($_POST['booking_id']) ? (int)$_POST['booking_id'] : 0;

    if ($id <= 0) {
        header('Location: /bookings?error=Invalid+booking');
        exit;
    }

    $this->svc->deleteBooking($id);
    header('Location: /bookings?success=1');
    exit;
}


  // public function updateStatus(): void {
  //   $id     = isset($_POST['booking_id']) ? (int)$_POST['booking_id'] : 0;
  //   $status = $_POST['status'] ?? '';

  //   if ($id <= 0 || $status === '') { header('Location: /bookings'); exit; }

  //   try 
  //   {
  //     $this->svc->updateBookingStatus($id, $status, $_SESSION['user']['id']);
  //     header('Location: /bookings?success=1');
  //     exit;
  //   } catch (\Exception $e) {
  //     header('Location: /bookings?error=' . urlencode($e->getMessage()));
  //     exit;
  //   }
  // }
}
