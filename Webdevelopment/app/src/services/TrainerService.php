<?php

namespace App\Services;

use App\Repositories\Interfaces\ITrainerRepository;
use App\Repositories\Interfaces\IContactRepository;
use App\Services\Interfaces\ITrainerService;
use App\Services\Interfaces\IValidationService;
use Exception;

class TrainerService implements ITrainerService
{
    private ITrainerRepository $trainerRepo;
    private IContactRepository $contactRepo;
    private IValidationService $validator;

    public function __construct(
        ITrainerRepository $trainerRepo,
        IContactRepository $contactRepo,
        IValidationService $validator
    ) {
        $this->trainerRepo = $trainerRepo;
        $this->contactRepo = $contactRepo;
        $this->validator = $validator;
    }

    public function getAllTrainers(): array
    {
        return $this->trainerRepo->listAll();
    }

    public function getTrainerWithBlogs(int $trainerId): array
    {
        $trainer = $this->trainerRepo->findById($trainerId);

        if (!$trainer) {
            throw new Exception("Trainer not found.");
        }

        $blogs = $this->trainerRepo->getBlogPostsByTrainer($trainerId);

        return ['trainer' => $trainer, 'blogs' => $blogs];
    }

    public function submitContactRequest(int $trainerId, string $name, string $email, string $message): void
    {
        if (empty($name) || strlen($name) > 100) {
            throw new Exception("Name is required and must be max 100 characters.");
        }

        if (!$this->validator->isValidEmail($email)) {
            throw new Exception("Email format is invalid.");
        }

        if (empty($message)) {
            throw new Exception("Message is required.");
        }

        $trainer = $this->trainerRepo->findById($trainerId);
        if (!$trainer) {
            throw new Exception("Trainer not found.");
        }

        $this->contactRepo->saveContactRequest($trainerId, $name, $email, $message);
    }
}