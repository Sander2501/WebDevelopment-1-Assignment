<?php
$pageTitle = 'Delete Account - Atlevia Sports';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/navbar.php';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">Delete Account</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= e($error) ?></div>
                    <?php endif; ?>
                    
                    <div class="alert alert-warning">
                        <strong>Warning! </strong> This action cannot be undone. 
                    </div>
                    
                    <p>All your data will be permanently deleted: </p>
                    <ul>
                        <li>Profile information</li>
                        <li>Booking history</li>
                        <li>All associated data</li>
                    </ul>
                    
                    <form method="POST" action="/profile/delete-confirm">
                        <div class="mb-3">
                            <label for="password" class="form-label">Confirm with your password</label>
                            <input type="password" class="form-control" id="password" 
                                   name="password" required>
                        </div>
                        
                        <button type="submit" class="btn btn-danger">Yes, delete my account</button>
                        <a href="/profile" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>