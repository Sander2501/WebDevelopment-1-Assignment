<?php
$pageTitle = 'Class Booking - Atlevia Sports';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/navbar.php';
?>

<div class="container my-5">
    <div class="row mb-4">
        <div class="col">
            <h1>Class Booking</h1>
            <p>Browse all classes and book your spot. </p>
        </div>
        <div class="col-auto">
            <a href="/bookings" class="btn btn-outline-primary">My Bookings</a>
            <a href="/dashboard" class="btn btn-outline-secondary">Dashboard</a>
        </div>
    </div>

    <div class="row">
        <?php if (empty($classes)): ?>
            <div class="col-12">
                <div class="alert alert-info">
                    No classes are available at the moment.  Please check back later!  
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($classes as $c): ?>
                <?php
                $hasTimes = ! empty($c->start_at) && !empty($c->end_at);
                $isFull = ($c->capacity > 0) ?  ($c->booked >= $c->capacity) : false;

                $badgeClass = 'bg-success';
                $badgeText = 'Available';
                if (!  $hasTimes) {
                    $badgeClass = 'bg-secondary';
                    $badgeText = 'No Time';
                } elseif ($isFull) {
                    $badgeClass = 'bg-danger';
                    $badgeText = 'Full';
                }
                ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title"><?= e($c->name) ?></h5>
                                <span class="badge <?= $badgeClass ?>"><?= $badgeText ?></span>
                            </div>
                            
                            <p class="card-text">
                                <strong>Trainer:</strong> <?= e($c->trainer) ?><br>
                                <strong>Location:</strong> <?= e($c->location) ?><br>
                                <strong>Time:</strong>
                                <?php if ($hasTimes): ?>
                                    <?= e(date('D, M j', strtotime($c->start_at))) ?>
                                    <?= e(date('g:i A', strtotime($c->start_at))) ?> - <?= e(date('g:i A', strtotime($c->end_at))) ?>
                                <?php else: ?>
                                    To be announced
                                <?php endif; ?>
                                <br>
                                <?php if ($c->capacity > 0): ?>
                                    <strong>Spots:</strong> <?= e($c->booked) ?> / <?= e($c->capacity) ?>
                                    <?php if ($c->capacity - $c->booked <= 3 && !  $isFull): ?>
                                        <span class="badge bg-warning text-dark">Almost Full</span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </p>

                            <?php if (! empty($c->description)): ?>
                                <p class="card-text"><?= e($c->description) ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer bg-white">
                            <?php if (! $hasTimes): ?>
                                <button class="btn btn-secondary w-100" disabled>Cannot Book (No Time)</button>
                            <?php elseif ($isFull): ?>
                                <button class="btn btn-danger w-100" disabled>Fully Booked</button>
                            <?php else: ?>
                                <form id="booking-form-<?= $c->id ?>" class="booking-form">
                                    <input type="hidden" name="class_id" value="<?= $c->id ?>">
                                    <input type="hidden" name="start_at" value="<?= e($c->start_at) ?>">
                                    <input type="hidden" name="end_at" value="<?= e($c->end_at) ?>">
                                    <button type="submit" class="btn btn-primary w-100">Book This Class</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script src="/assets/js/bookings. js"></script>

<?php require __DIR__ . '/../partials/footer.php'; ?>