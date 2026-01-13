<?php
$pageTitle = 'Dashboard - Atlevia Sports';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/navbar.php';

function formatNiceDate($date) {
    return date('l, M j \a\t g:i A', strtotime($date));
}
?>

<div class="container my-5">
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h1 class="display-5 fw-bold text-primary">Hello, <?= e($user['name']) ?>!</h1>
            <p class="text-muted lead">Ready for your next workout?</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="/profile" class="btn btn-outline-secondary btn-sm">Edit Profile</a>
        </div>
    </div>

    <div class="row g-4 mb-5">
        
        <div class="col-md-6 col-lg-5">
            <div class="card h-100 shadow-sm border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0"><i class="bi bi-lightning-charge"></i> Quick Gym Session</h5>
                </div>
                <div class="card-body">
                    <p class="small text-muted">Book a 1-hour independent workout slot instantly.</p>
                    
                    <form action="/bookings" method="POST" class="d-grid gap-2">
                        <input type="hidden" name="booking_type" value="gym_session">
                        
                        <div class="form-floating mb-2">
                            <input type="datetime-local" 
                                   class="form-control" 
                                   id="quickDate" 
                                   name="gym_start_time" 
                                   min="<?= date('Y-m-d\TH:i') ?>" 
                                   required>
                            <label for="quickDate">Select Start Time</label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            Book Session Now
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-7">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0 text-success"><i class="bi bi-calendar-check"></i> Up Next</h5>
                </div>
                <div class="card-body d-flex flex-column justify-content-center">
                    <?php if ($nextSession): ?>
                        <?php if (is_object($nextSession)): ?>
                            <h3 class="card-text mb-1">
                                <?= !empty($nextSession->class_name) ? e($nextSession->class_name) : 'Gym Session' ?>
                            </h3>
                            <p class="text-muted fs-5 mb-3">
                                <?= formatNiceDate($nextSession->start_at) ?>
                            </p>
                            <div class="mt-auto">
                                <a href="/bookings" class="btn btn-outline-primary btn-sm">View Details</a>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-4 text-muted">
                                <i class="bi bi-calendar-x fs-1 d-block mb-2"></i>
                                <p>No upcoming sessions scheduled.</p>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-calendar-x fs-1 d-block mb-2"></i>
                            <p>No upcoming sessions scheduled.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Upcoming Schedule</h3>
                <a href="/bookings" class="text-decoration-none">View All Bookings &rarr;</a>
            </div>
            
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <?php if (empty($recentBookings)): ?>
                        <div class="p-4 text-center text-muted">
                            You have no upcoming bookings. <a href="/classes">Browse Classes</a> or use the Quick Book above!
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Activity</th>
                                        <th>Date & Time</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recentBookings as $b): ?>
                                        <tr>
                                            <td class="ps-4 fw-bold">
                                                <?= !empty($b->class_name) ? e($b->class_name) : 'Gym Session' ?>
                                            </td>
                                            <td>
                                                <?= formatNiceDate($b->start_at) ?>
                                            </td>
                                            <td>
                                                <?= !empty($b->location) ? e($b->location) : 'Main Gym Floor' ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-success bg-opacity-10 text-success border border-success">
                                                    Confirmed
                                                </span>
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
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>