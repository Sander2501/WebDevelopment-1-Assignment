<?php
$pageTitle = 'Profile Settings - Atlevia Sports';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/navbar.php';
?>

<div class="container my-5">
    <h1 class="mb-4">Profile Settings</h1>
    
    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= e($success) ?></div>
    <?php endif; ?>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= e($error) ?></div>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Personal Information</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="/profile/update">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?= isset($user) && is_object($user) ? e($user->name) : '' ?>" required maxlength="100">
                        </div>
                        
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone (Optional)</label>
                            <input type="tel" class="form-control" id="phone" name="phone" 
                                   value="<?= isset($user) && is_object($user) ? e($user->phone ?? '') : '' ?>" maxlength="20">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Email Address</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="/profile/update-email">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?= isset($user) && is_object($user) ? e($user->email) : '' ?>" required maxlength="255">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Update Email</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Change Password</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="/profile/change-password">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" 
                                   name="current_password" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" 
                                   name="new_password" required minlength="8">
                            <small class="text-muted">Minimum 8 characters</small>
                        </div>
                        
                        <button type="submit" class="btn btn-warning">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Danger Zone</h5>
                </div>
                <div class="card-body">
                    <p class="text-danger">
                        <strong>Warning:</strong> Deleting your account is permanent and cannot be undone.
                    </p>
                    <a href="/profile/delete" class="btn btn-danger">Delete Account</a>
                </div>
            </div>
        </div>
    </div>
    
    <a href="/dashboard" class="btn btn-secondary">Back to Dashboard</a>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>