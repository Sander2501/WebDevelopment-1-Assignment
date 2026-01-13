<?php

$pageTitle = 'Class Booking - Atlevia Sports';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/navbar.php';
?>

<div class="container my-5">
    <div class="row mb-4">
        <div class="col">
            <h1>Class Booking</h1>
            <p>Book a specific class or schedule your own gym session.</p>
        </div>
        <div class="col-auto">
            <a href="/bookings" class="btn btn-outline-primary">My Bookings</a>
        </div>
    </div>

    <div class="card mb-5 border-primary">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h3 class="text-primary"><i class="bi bi-person-workspace"></i> Open Gym Session</h3>
                    <p class="mb-0">
                        Prefer to work out on your own? Schedule a 1-hour independent gym session at a time that works for you.
                    </p>
                </div>
                <div class="col-md-5">
                    <form action="/bookings" method="POST" class="d-flex flex-column gap-2">
                        <input type="hidden" name="booking_type" value="gym_session">
                        
                        <label class="form-label fw-bold">Select Date & Time:</label>
                        <div class="input-group">
                            <input type="datetime-local" 
                                   name="gym_start_time" 
                                   class="form-control" 
                                   min="<?= date('Y-m-d\TH:i') ?>"
                                   required>
                            <button type="submit" class="btn btn-primary">Book Session</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <h3 class="mb-3">Available Classes</h3>
    <div class="row">
        <?php if (empty($classes)): ?>
            <div class="col-12"><div class="alert alert-info">No classes available.</div></div>
        <?php else: ?>
            <?php foreach ($classes as $c): ?>
                <?php
                    $startTimeOnly = date('H:i:s', strtotime($c->start_at));
                    $endTimeOnly   = date('H:i:s', strtotime($c->end_at));
                    $displayTime   = date('g:i A', strtotime($c->start_at)) . ' - ' . date('g:i A', strtotime($c->end_at));
                ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title"><?= e($c->name) ?></h5>
                                <span class="badge bg-secondary">Fixed Time</span>
                            </div>
                            
                            <p class="card-text">
                                <strong>Trainer:</strong> <?= e($c->trainer) ?><br>
                                <strong>Schedule:</strong> <?= $displayTime ?>
                            </p>
                            
                            <hr>

                            <form action="/bookings" method="POST">
                                <input type="hidden" name="booking_type" value="class">
                                <input type="hidden" name="class_id" value="<?= $c->id ?>">
                                <input type="hidden" name="static_start_time" value="<?= $startTimeOnly ?>">
                                <input type="hidden" name="static_end_time" value="<?= $endTimeOnly ?>">
                                
                                <div class="mb-3">
                                    <label class="form-label">Select Date:</label>
                                    <input type="date" 
                                           name="target_date" 
                                           class="form-control" 
                                           min="<?= date('Y-m-d') ?>"
                                           required>
                                </div>
                                
                                <button type="submit" class="btn btn-success w-100">Book Class</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>