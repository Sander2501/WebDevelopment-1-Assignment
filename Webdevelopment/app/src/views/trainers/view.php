<?php
$pageTitle = e($trainer['name']) . ' - Atlevia Sports';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/navbar.php';
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
            <h1><?= e($trainer['name']) ?></h1>
            
            <?php if (!empty($trainer['specialization'])): ?>
                <p class="lead text-muted"><?= e($trainer['specialization']) ?></p>
            <?php endif; ?>
            
            <?php if (!empty($trainer['bio'])): ?>
                <p><?= e($trainer['bio']) ?></p>
            <?php endif; ?>
            
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Contact Information</h5>
                    <p class="mb-1">
                        <strong>Email:</strong> <a href="mailto:<?= e($trainer['email']) ?>"><?= e($trainer['email']) ?></a>
                    </p>
                    <?php if (!empty($trainer['phone'])): ?>
                        <p class="mb-0">
                            <strong>Phone:</strong> <?= e($trainer['phone']) ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            
            <h2 class="mt-5 mb-4">Blog Posts</h2>
            
            <?php if (empty($blogs)): ?>
                <p>No blog posts yet. </p>
            <?php else:  ?>
                <?php foreach ($blogs as $blog): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= e($blog['title']) ?></h5>
                            <p class="text-muted">
                                <small>Published: <?= date('F j, Y', strtotime($blog['published_at'])) ?></small>
                            </p>
                            <p class="card-text"><?= e($blog['content']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Request Free Consultation</h5>
                </div>
                <div class="card-body">
                    <?php if (isset($_GET['success'])): ?>
                        <div class="alert alert-success">
                            Message sent!  The trainer will contact you soon.
                        </div>
                    <?php endif; ?>
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= e($error) ?></div>
                    <?php endif; ?>
                    
                    <form method="POST" action="/trainers/<?= $trainer['id'] ?>/contact">
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   required maxlength="100" value="<?= e($_POST['name'] ??  '') ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   required maxlength="255" value="<?= e($_POST['email'] ?? '') ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" 
                                      rows="4" required><?= e($_POST['message'] ?? '') ?></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <a href="/trainers" class="btn btn-secondary mt-3">Back to Trainers</a>
</div>

<?php require __DIR__ .  '/../partials/footer.php'; ?>