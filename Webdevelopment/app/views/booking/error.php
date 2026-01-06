<?php require __DIR__ . '/../partials/header.php'; ?>
<?php require __DIR__ . '/../partials/navbar.php'; ?>

<main class="container">
    <h1>Booking Error</h1>
    <div class="alert alert-danger">
        <p><?= htmlspecialchars($error ?? 'An error occurred while processing your booking.') ?></p>
    </div>
    <a href="/classes">Back to Classes</a>
    <a href="/bookings">View My Bookings</a>
</main>

<?php require __DIR__ . '/../partials/footer.php'; ?>