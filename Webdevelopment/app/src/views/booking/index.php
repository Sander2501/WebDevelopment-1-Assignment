<?php

$pageTitle = 'My Bookings - Atlevia Sports';
require __DIR__ .  '/../partials/header.php';
require __DIR__ . '/../partials/navbar.php';
?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>My Bookings</h1>
            <p class="text-muted">Here you can see all your confirmed bookings.</p>
        </div>
        <div>
            <a href="/classes" class="btn btn-primary">Book a Class</a>
        </div>
    </div>
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success! </strong> Booking <?= $_GET['success'] === '1' ? 'deleted' : 'created' ?> successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> <?= e($_GET['error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Your Bookings</h5>
        </div>
        <div class="card-body">
            <?php if (empty($bookings)): ?>
                <div class="alert alert-info mb-0">
                    <i class="bi bi-info-circle"></i>
                    You don't have any bookings yet.  Go to <a href="/classes" class="alert-link">Class Booking</a> to book one. 
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Class</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bookings as $b): ?>
                                <?php
                                $typeLabel = $b->class_id ? 'Class' : 'Gym Session';
                                
                                $badge = 'bg-success';
                                if ($b->status === 'pending')   $badge = 'bg-warning';
                                if ($b->status === 'cancelled') $badge = 'bg-danger';
                                ?>
                                <tr>
                                    <td><?= e($b->id) ?></td>
                                    <td><?= e($typeLabel) ?></td>
                                    <td><?= e($b->class_name ??  '—') ?></td>
                                    <td><?= e($b->start_at) ?></td>
                                    <td><?= e($b->end_at) ?></td>
                                    <td>
                                        <span class="badge <?= $badge ?>">
                                            <?= e(ucfirst($b->status)) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <form method="POST" action="/bookings/delete" style="display:  inline;" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                            <input type="hidden" name="booking_id" value="<?= e($b->id) ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>