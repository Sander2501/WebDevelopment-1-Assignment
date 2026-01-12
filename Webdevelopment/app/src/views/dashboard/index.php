<?php

$pageTitle = 'Dashboard - Atlevia Sports';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/navbar.php';
?>

<div class="container my-5">
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-primary text-white p-5 rounded">
                <h1 class="display-4">Welcome, <?= e($_SESSION['user']['name'] ??  'Guest') ?>!</h1>
                <p class="lead">Your personal gym dashboard. Quickly access training, bookings, and profile settings.</p>
                <hr class="my-4 bg-white">
                <div class="d-flex gap-3">
                    <a href="/classes" class="btn btn-light btn-lg">Book a Class</a>
                    <a href="/bookings" class="btn btn-outline-light btn-lg">My Bookings</a>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mb-4">Quick Actions</h2>
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title">Today</h5>
                        <span class="badge bg-info">Info</span>
                    </div>
                    <p class="card-text text-muted">Your next workout</p>
                    <p class="card-text">Check bookings & schedule</p>
                    <a href="/bookings" class="btn btn-primary">Open Schedule</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title">Trainers & Blogs</h5>
                        <span class="badge bg-success">New</span>
                    </div>
                    <p class="card-text text-muted">Read trainer tips, routines, nutrition advice, and updates.</p>
                    <p class="card-text">Get tips for your fitness journey</p>
                    <a href="/trainers" class="btn btn-primary">Open Blogs</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title">Account</h5>
                        <span class="badge bg-secondary">Settings</span>
                    </div>
                    <p class="card-text text-muted">Profile & settings</p>
                    <p class="card-text">Update your info and preferences</p>
                    <a href="/profile" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mb-4">All Features</h2>
    <div class="row g-3">
        <?php
        $features = [
            ['title' => 'Class Booking', 'badge' => 'Popular', 'badgeClass' => 'success', 'desc' => 'Book group classes led by professional trainers.', 'link' => '/classes', 'btnText' => 'View Classes'],
            ['title' => 'Gym Session Booking', 'badge' => 'Schedule', 'badgeClass' => 'info', 'desc' => 'Reserve your gym sessions in advance and manage them easily.', 'link' => '/bookings', 'btnText' => 'My Bookings'],
            ['title' => 'Profile Settings', 'badge' => 'Account', 'badgeClass' => 'primary', 'desc' => 'Update your details, preferences, and contact information.', 'link' => '/profile', 'btnText' => 'Edit Profile'],
            ['title' => 'My Bookings', 'badge' => 'Overview', 'badgeClass' => 'info', 'desc' => 'See your confirmed bookings and manage your schedule.', 'link' => '/bookings', 'btnText' => 'View My Bookings'],
        ];

        foreach ($features as $feature): ?>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-0"><?= e($feature['title']) ?></h5>
                            <span class="badge bg-<?= e($feature['badgeClass']) ?>"><?= e($feature['badge']) ?></span>
                        </div>
                        <p class="card-text small text-muted"><?= e($feature['desc']) ?></p>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <a href="<?= e($feature['link']) ?>" class="btn btn-sm btn-outline-primary w-100"><?= e($feature['btnText']) ?></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>