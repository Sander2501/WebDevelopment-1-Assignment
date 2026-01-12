<?php
$pageTitle = 'Our Trainers - Atlevia Sports';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/navbar.php';
?>

<div class="container my-5">
    <h1 class="mb-4">Meet Our Trainers</h1>
    <p class="lead">Expert trainers dedicated to helping you reach your fitness goals.</p>
    
    <div class="row">
        <?php foreach ($trainers as $trainer): ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= e($trainer['name']) ?></h5>
                        
                        <?php if (!empty($trainer['specialization'])): ?>
                            <p class="text-muted">
                                <small><?= e($trainer['specialization']) ?></small>
                            </p>
                        <?php endif; ?>
                        
                        <?php if (!empty($trainer['bio'])): ?>
                            <p class="card-text"><?= e($trainer['bio']) ?></p>
                        <?php endif; ?>
                        
                        <div class="mb-3">
                            <strong>Contact:</strong><br>
                            <a href="mailto:<?= e($trainer['email']) ?>"><?= e($trainer['email']) ?></a>
                            <?php if (!empty($trainer['phone'])): ?>
                                <br><?= e($trainer['phone']) ?>
                            <?php endif; ?>
                        </div>
                        
                        <a href="/trainers/<?= $trainer['id'] ?>" class="btn btn-primary">
                            View Blogs & Contact
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <a href="/dashboard" class="btn btn-secondary mt-3">Back to Dashboard</a>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>