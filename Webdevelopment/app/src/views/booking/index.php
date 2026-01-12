<?php
$pageTitle = 'My Bookings - Atlevia Sports';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/navbar.php';
?>

<div class="container my-5">
    <div class="row mb-4">
        <div class="col">
            <h1>My Bookings</h1>
            <p>Here you can see all your confirmed bookings.</p>
        </div>
        <div class="col-auto">
            <a href="/classes" class="btn btn-primary">Book a Class</a>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Your Bookings</h5>
        </div>
        <div class="card-body">
            <?php if (empty($bookings)): ?>
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i>
                    You don't have any bookings yet.   Go to <a href="/classes">Class Booking</a> to book one.  
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
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
                                $type = $b->class_id ?  'Class' : 'Gym Session';
                                
                                $badge = 'bg-success';
                                if ($b->status === 'pending')   $badge = 'bg-warning';
                                if ($b->status === 'cancelled') $badge = 'bg-danger';
                                ?>
                                <tr>
                                    <td><?= e($b->id) ?></td>
                                    <td><?= $type ?></td>
                                    <td><?= e($b->class_name ??   '—') ?></td>
                                    <td><?= e($b->start_at) ?></td>
                                    <td><?= e($b->end_at) ?></td>
                                    <td>
                                        <span class="badge <?= $badge ?>">
                                            <?= e(ucfirst($b->status)) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button 
                                            class="btn btn-sm btn-danger delete-booking-btn" 
                                            data-booking-id="<?= $b->id ?>">
                                            Delete
                                        </button>
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

<script src="/assets/js/bookings. js"></script>

<?php require __DIR__ . '/../partials/footer.php'; ?>