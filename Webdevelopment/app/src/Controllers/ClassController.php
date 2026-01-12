<?php
namespace App\Controllers;

use App\Repositories\ClassRepository;

class ClassController {
  public function __construct(private ClassRepository $classes) {}
  public function index(): void {
    $classes = $this->classes->listAll();
    require __DIR__ . '/../views/class-booking/index.php';
  }
}
