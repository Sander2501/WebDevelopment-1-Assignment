<?php

namespace App\Controllers;

use App\Repositories\ClassRepository;

class ClassBookingController
{
    private ClassRepository $classRepo;

    public function __construct(ClassRepository $classRepo)
    {
        $this->classRepo = $classRepo;
    }
    public function index(): void
    {
        $classes = $this->classRepo->listAll();
        require __DIR__ . '/../Views/class-booking/index.php';
    }
}