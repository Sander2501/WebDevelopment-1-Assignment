<?php
namespace App\Controllers;

use App\Repositories\ClassRepository;

class ClassController {
  public function __construct(private ClassRepository $classes) {}
  public function index(): void {
    $list = $this->classes->listAll();
    require __DIR__ . '/../views/class/index.php';
  }
}
