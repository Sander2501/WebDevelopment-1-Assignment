<?php

$pageTitle = 'Class Booking - Atlevia Sports';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/navbar.php';
?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>Class Booking</h1>
            <p class="text-muted">Browse all classes and book your spot.</p>
        </div>
        <div>
            <a href="/bookings" class="btn btn-secondary">My Bookings</a>
            <a href="/dashboard" class="btn btn-outline-secondary">Dashboard</a>
        </div>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Booking created successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> <?= e($_GET['error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (empty($classes)): ?>
        <div class="alert alert-info">
            No classes are available at the moment. Please check back later! 
        </div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($classes as $c): ?>
                <?php
                $hasTimes = !empty($c->start_at) && !empty($c->end_at);
                
                $isFull = ($c->capacity > 0) ? ($c->booked >= $c->capacity) : false;

                $badgeClass = 'bg-success';
                $badgeText = 'Available';
                if (! $hasTimes) {
                    $badgeClass = 'bg-secondary';
                    $badgeText = 'No Time';
                } elseif ($isFull) {
                    $badgeClass = 'bg-danger';
                    $badgeText = 'Full';
                }
                ?>
                
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title"><?= e($c->name) ?></h5>
                                <span class="badge <?= $badgeClass ?>"><?= $badgeText ?></span>
                            </div>
                            
                            <p class="card-text">
                                <strong>Trainer:</strong> <?= e($c->trainer) ?><br>
                                <strong>Location:</strong> <?= e($c->location) ?><br>
                                
                                <?php if ($hasTimes): ?>
                                    <strong>Time:</strong><br>
                                    <?= e(date('D, M j, Y @ g:i A', strtotime($c->start_at))) ?><br>
                                    <small class="text-muted">to <?= e(date('g:i A', strtotime($c->end_at))) ?></small>
                                <?php else: ?>
                                    <strong>Time:</strong> <span class="text-muted">To be announced</span>
                                <?php endif; ?>
                                
                                <?php if ($c->capacity > 0): ?>
                                    <br><strong>Spots: </strong> 
                                    <?= e($c->booked) ?> / <?= e($c->capacity) ?>
                                    <?php if ($c->capacity - $c->booked <= 3 && ! $isFull): ?>
                                        <span class="badge bg-warning text-dark">Almost Full</span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </p>

                            <?php if ($c->description): ?>
                                <p class="card-text small text-muted"><?= e($c->description) ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <div class="card-footer bg-transparent border-0">
                            <?php if (! $hasTimes): ?>
                                <button class="btn btn-secondary w-100" disabled>Cannot Book (No Time)</button>
                            <?php elseif ($isFull): ?>
                                <button class="btn btn-danger w-100" disabled>Fully Booked</button>
                            <?php else: ?>
                                <form method="POST" action="/bookings">
                                    <input type="hidden" name="class_id" value="<?= e($c->id) ?>">
                                    <input type="hidden" name="start_at" value="<?= e($c->start_at) ?>">
                                    <input type="hidden" name="end_at" value="<?= e($c->end_at) ?>">
                                    <button type="submit" class="btn btn-primary w-100">Book This Class</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>