<?php

$pageTitle = 'Booking Error - Atlevia Sports';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/navbar.php';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-danger">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-exclamation-triangle"></i>
                        Booking Error
                    </h4>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger mb-4" role="alert">
                            <strong>Error:</strong> <?= e($error) ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning mb-4" role="alert">
                            <strong>Unknown error occurred.</strong> Please try again. 
                        </div>
                    <?php endif; ?>
                    
                    <div class="d-flex gap-3">
                        <a href="/classes" class="btn btn-primary">
                            <i class="bi bi-arrow-left"></i>
                            Back to Classes
                        </a>
                        <a href="/bookings" class="btn btn-outline-secondary">
                            <i class="bi bi-calendar-check"></i>
                            View My Bookings
                        </a>
                        <a href="/dashboard" class="btn btn-outline-secondary">
                            <i class="bi bi-house"></i>
                            Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>