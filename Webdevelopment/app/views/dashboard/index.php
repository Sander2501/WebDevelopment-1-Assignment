<?php
// Optional: show user name if you later add sessions
$userName = $_SESSION['user']['name'] ?? null;

// Define VIEW_PATH if not already defined
if (!defined('VIEW_PATH')) {
    define('VIEW_PATH', __DIR__ . '/..');
}
?>

<?php require VIEW_PATH . '/partials/header.php'; ?>
<?php require VIEW_PATH . '/partials/navbar.php'; ?>

<div class="container py-4">

  <!-- Hero / Header -->
  <div class="p-4 p-md-5 mb-4 rounded-3 bg-light border">
    <div class="row align-items-center g-3">
      <div class="col-md-8">
        <h1 class="display-6 fw-bold mb-2">
          Welcome<?= $userName ? ', ' . htmlspecialchars($userName) : '' ?>
        </h1>
        <p class="text-muted mb-0">
          Your personal gym dashboard. Quickly access training, bookings, memberships and profile settings.
        </p>
      </div>
      <div class="col-md-4 text-md-end">
        <a href="/classes" class="btn btn-primary me-2">Book a Class</a>
        <a href="/bookings" class="btn btn-outline-primary">My Bookings</a>
      </div>
    </div>
  </div>

  <!-- Quick stats / actions (placeholder) -->
  <div class="row g-3 mb-4">
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div>
              <div class="text-muted small">Today</div>
              <div class="h5 mb-1">Your next workout</div>
              <div class="text-muted">Check bookings & schedule</div>
            </div>
            <span class="badge text-bg-secondary">Info</span>
          </div>
          <a class="btn btn-sm btn-outline-secondary mt-3" href="/bookings">Open schedule</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div>
              <div class="text-muted small">Training</div>
              <div class="h5 mb-1">Personal Training Test</div>
              <div class="text-muted">Get a plan based on your goals</div>
            </div>
            <span class="badge text-bg-primary">New</span>
          </div>
          <a class="btn btn-sm btn-primary mt-3" href="/training-test">Start test</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div>
              <div class="text-muted small">Account</div>
              <div class="h5 mb-1">Profile & settings</div>
              <div class="text-muted">Update your info and preferences</div>
            </div>
            <span class="badge text-bg-light border">Settings</span>
          </div>
          <a class="btn btn-sm btn-outline-secondary mt-3" href="/profile">Edit profile</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Feature cards -->
  <h2 class="h4 mb-3">Features</h2>

  <div class="row g-4">

    <!-- Training Test -->
    <div class="col-md-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body d-flex flex-column">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <h5 class="card-title mb-0">Training Test</h5>
            <span class="badge text-bg-primary">Recommended</span>
          </div>
          <p class="card-text text-muted">
            Discover a training plan tailored to your goals and experience.
          </p>
          <div class="mt-auto">
            <a href="/training-test" class="btn btn-primary w-100">Start Test</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Class Booking -->
    <div class="col-md-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body d-flex flex-column">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <h5 class="card-title mb-0">Class Booking</h5>
            <span class="badge text-bg-success">Popular</span>
          </div>
          <p class="card-text text-muted">
            Book group classes led by professional trainers.
          </p>
          <div class="mt-auto">
            <a href="/classes" class="btn btn-primary w-100">View Classes</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Gym Session Booking -->
    <div class="col-md-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body d-flex flex-column">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <h5 class="card-title mb-0">Gym Session Booking</h5>
            <span class="badge text-bg-secondary">Schedule</span>
          </div>
          <p class="card-text text-muted">
            Reserve your gym sessions in advance and manage them easily.
          </p>
          <div class="mt-auto">
            <a href="/bookings" class="btn btn-primary w-100">My Bookings</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Memberships -->
    <div class="col-md-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body d-flex flex-column">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <h5 class="card-title mb-0">Memberships</h5>
            <span class="badge text-bg-light border">Coming soon</span>
          </div>
          <p class="card-text text-muted">
            View membership options and upgrade when you’re ready.
          </p>
          <div class="mt-auto">
            <a href="/memberships" class="btn btn-outline-primary w-100">Membership Options</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Day Passes -->
    <div class="col-md-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body d-flex flex-column">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <h5 class="card-title mb-0">Day Passes</h5>
            <span class="badge text-bg-light border">Coming soon</span>
          </div>
          <p class="card-text text-muted">
            Purchase single-day gym access for you or a friend.
          </p>
          <div class="mt-auto">
            <a href="/day-passes" class="btn btn-outline-primary w-100">Buy Day Pass</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Trainers & Blogs -->
    <div class="col-md-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body d-flex flex-column">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <h5 class="card-title mb-0">Trainers & Blogs</h5>
            <span class="badge text-bg-light border">Coming soon</span>
          </div>
          <p class="card-text text-muted">
            Read trainer tips, routines, nutrition advice, and updates.
          </p>
          <div class="mt-auto">
            <a href="/trainers" class="btn btn-outline-secondary w-100">Open Blogs</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Profile -->
    <div class="col-md-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body d-flex flex-column">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <h5 class="card-title mb-0">Profile Settings</h5>
            <span class="badge text-bg-light border">Account</span>
          </div>
          <p class="card-text text-muted">
            Update your details, preferences, and contact information.
          </p>
          <div class="mt-auto">
            <a href="/profile" class="btn btn-outline-secondary w-100">Edit Profile</a>
          </div>
        </div>
      </div>
    </div>

    <!-- My Bookings (extra shortcut) -->
    <div class="col-md-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body d-flex flex-column">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <h5 class="card-title mb-0">My Bookings</h5>
            <span class="badge text-bg-secondary">Overview</span>
          </div>
          <p class="card-text text-muted">
            See your confirmed bookings and manage your schedule.
          </p>
          <div class="mt-auto">
            <a href="/bookings" class="btn btn-outline-primary w-100">View My Bookings</a>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<?php require VIEW_PATH . '/partials/footer.php'; ?>
