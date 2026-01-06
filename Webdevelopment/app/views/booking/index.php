<?php

if (!defined('VIEW_PATH')) {
    define('VIEW_PATH', __DIR__ . '/..');
}
require VIEW_PATH . '/partials/header.php';
require VIEW_PATH . '/partials/navbar.php';

function e($v): string {
    return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
}

// Expected from controller:
$bookings = $bookings ?? [];
?>

<div class="container py-4">

  <!-- Header -->
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
    <div>
      <h1 class="mb-1">My Bookings</h1>
      <p class="text-muted mb-0">Here you can see all your confirmed bookings.</p>
    </div>
    <div class="d-flex gap-2">
      <a href="/classes" class="btn btn-primary">Book a Class</a>
    </div>
  </div>

  <!-- Optional status messages -->
  <?php if (!empty($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      Booking created successfully.
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <?php if (!empty($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?= e($_GET['error']) ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <!-- Bookings list -->
  <div class="card shadow-sm">
    <div class="card-body">

      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="card-title mb-0">Your bookings</h5>
        <span class="badge text-bg-secondary"><?= count($bookings) ?></span>
      </div>

      <?php if (empty($bookings)): ?>
        <div class="alert alert-warning mb-0">
          You don’t have any bookings yet. Go to <a href="/classes">Class Booking</a> to book one.
        </div>
      <?php else: ?>

        <div class="table-responsive">
          <table class="table table-striped align-middle mb-0">
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
                  $id       = $b['id'] ?? $b->id ?? '';
                  $classId  = $b['class_id'] ?? $b->class_id ?? null;

                  // Optional fields (if your query joins class table)
                  $className = $b['class_name'] ?? $b->class_name ?? ($b['name'] ?? $b->name ?? '—');

                  $start    = $b['start_at'] ?? $b->start_at ?? '';
                  $end      = $b['end_at'] ?? $b->end_at ?? '';
                  $status   = $b['status'] ?? $b->status ?? 'confirmed';

                  $typeLabel = $classId ? 'Class' : 'Gym session';

                  $badge = 'text-bg-success';
                  if ($status === 'pending')   $badge = 'text-bg-warning';
                  if ($status === 'cancelled') $badge = 'text-bg-danger';
                ?>
                <tr>
                  <td><?= e($id) ?></td>
                  <td><?= e($typeLabel) ?></td>
                  <td><?= e($classId ? $className : '—') ?></td>
                  <td><?= e($start) ?></td>
                  <td><?= e($end) ?></td>
                  <td><span class="badge <?= e($badge) ?>"><?= e($status) ?></span></td>

                  <td class="text-nowrap">
                    <?php if ($status !== 'cancelled'): ?>
                      <!-- Cancel booking
                      <form method="POST" action="/bookings/status" class="d-inline">
                        <input type="hidden" name="booking_id" value="<?= e($id) ?>">
                        <input type="hidden" name="status" value="cancelled">
                        <button type="submit" class="btn btn-sm btn-outline-warning">
                          Cancel
                        </button>
                      </form>
                    <?php endif; ?> -->

                    <!-- Delete booking -->
                    <form method="POST"
                          action="/bookings/delete"
                          class="d-inline"
                          onsubmit="return confirm('Delete this booking?');">
                      <input type="hidden" name="booking_id" value="<?= e($id) ?>">
                      <button type="submit" class="btn btn-sm btn-outline-danger">
                        Delete
                      </button>
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

<?php require VIEW_PATH . '/partials/footer.php'; ?>
