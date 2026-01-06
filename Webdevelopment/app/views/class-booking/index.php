<?php
if (!defined('VIEW_PATH')) {
    define('VIEW_PATH', __DIR__ . '/..');
}
require VIEW_PATH . '/partials/header.php';
require VIEW_PATH . '/partials/navbar.php';

function e($v): string {
    return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
}

$classes = $classes ?? [];
?>

<div class="container py-4">

  <!-- Header -->
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
    <div>
      <h1 class="mb-1">Class Booking</h1>
      <p class="text-muted mb-0">Browse all classes and book using the class schedule.</p>
    </div>
    <div class="d-flex gap-2">
      <a href="/bookings" class="btn btn-outline-primary">My Bookings</a>
      <a href="/dashboard" class="btn btn-outline-secondary">Dashboard</a>
    </div>
  </div>

  <!-- Optional alerts -->
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

  <?php if (empty($classes)): ?>
    <div class="alert alert-warning">
      No classes are available at the moment.
    </div>
  <?php else: ?>

    <div class="row g-4">
      <?php foreach ($classes as $c): ?>
        <?php
          // Support both array and object
          $id       = $c['id'] ?? $c->id ?? null;
          $name     = $c['name'] ?? $c->name ?? 'Class';
          $trainer  = $c['trainer'] ?? $c->trainer ?? '—';
          $location = $c['location'] ?? $c->location ?? '—';

          // These are the important ones for booking creation:
          $startAt  = $c['start_at'] ?? $c->start_at ?? '';
          $endAt    = $c['end_at'] ?? $c->end_at ?? '';

          // Optional capacity fields (if you have them)
          $capacity = (int)($c['capacity'] ?? $c->capacity ?? 0);
          $booked   = (int)($c['booked'] ?? $c->booked ?? 0);

          $hasTimes = ($startAt !== '' && $endAt !== '');
          $isFull   = ($capacity > 0) ? ($booked >= $capacity) : false;
        ?>

        <div class="col-md-6 col-lg-4">
          <div class="card h-100 shadow-sm">

            <div class="card-body d-flex flex-column">

              <!-- Title + badge -->
              <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                <h5 class="card-title mb-0"><?= e($name) ?></h5>

                <?php if (!$hasTimes): ?>
                  <span class="badge text-bg-warning">No time</span>
                <?php elseif ($isFull): ?>
                  <span class="badge text-bg-danger">Full</span>
                <?php else: ?>
                  <span class="badge text-bg-success">Available</span>
                <?php endif; ?>
              </div>

              <div class="text-muted small mb-1"><strong>Trainer:</strong> <?= e($trainer) ?></div>
              <div class="text-muted small mb-1"><strong>Location:</strong> <?= e($location) ?></div>

              <div class="text-muted small mb-3">
                <strong>Time:</strong>
                <?php if ($hasTimes): ?>
                  <?= e($startAt) ?> – <?= e($endAt) ?>
                <?php else: ?>
                  To be announced
                <?php endif; ?>
              </div>

              <?php if ($capacity > 0): ?>
                <div class="mt-auto mb-3">
                  <div class="d-flex justify-content-between small text-muted">
                    <span>Spots</span>
                    <span><?= e($booked) ?>/<?= e($capacity) ?></span>
                  </div>
                  <div class="progress" role="progressbar" aria-label="Capacity"
                       aria-valuenow="<?= e($booked) ?>" aria-valuemin="0" aria-valuemax="<?= e($capacity) ?>">
                    <div class="progress-bar" style="width: <?= e(min(100, ($capacity ? ($booked / $capacity) * 100 : 0))) ?>%"></div>
                  </div>
                </div>
              <?php else: ?>
                <div class="mt-auto"></div>
              <?php endif; ?>

              <!-- Booking form -->
              <form method="POST" action="/bookings" class="mt-3">
                <input type="hidden" name="class_id" value="<?= e($id) ?>">
                <input type="hidden" name="start_at" value="<?= e($startAt) ?>">
                <input type="hidden" name="end_at" value="<?= e($endAt) ?>">

                <button type="submit"
                        class="btn btn-primary w-100"
                        <?= (!$hasTimes || $isFull) ? 'disabled' : '' ?>>
                  <?php if (!$hasTimes): ?>
                    Cannot book (time missing)
                  <?php elseif ($isFull): ?>
                    Fully booked
                  <?php else: ?>
                    Book this class
                  <?php endif; ?>
                </button>
              </form>

            </div>
          </div>
        </div>

      <?php endforeach; ?>
    </div>

  <?php endif; ?>
</div>

<?php require VIEW_PATH . '/partials/footer.php'; ?>
