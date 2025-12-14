<?php
namespace App\Services;

class MailService {
  public function sendBookingConfirmation(string $to, array $booking): void {
    // Dev: log instead of real email. Swap later for PHPMailer/SMTP.
    error_log("CONFIRMATION to {$to}: booking #{$booking['id']} {$booking['start_at']}–{$booking['end_at']} ({$booking['class_name']})");
  }
}