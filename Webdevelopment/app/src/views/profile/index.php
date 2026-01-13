<?php

$pageTitle = 'Profile Settings - Atlevia Sports';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/navbar.php';
?>

<div class="container my-5">
    <div class="row g-4">
        
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body text-center p-4">
                    <div class="mb-3 d-flex justify-content-center">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fs-1" style="width: 100px; height: 100px;">
                            <?php if (isset($user) && is_object($user) && isset($user->name)): ?>
                                <?= strtoupper(substr($user->name, 0, 1)) ?>
                            <?php else: ?>
                                ?
                            <?php endif; ?>
                        </div>
                    </div>
                    <h4 class="card-title fw-bold mb-1"><?= e($user->name) ?></h4>
                    <p class="text-muted mb-3"><?= e($user->email) ?></p>
                    <span class="badge bg-success bg-opacity-10 text-success">Member</span>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="list-group list-group-flush" id="profileTabs" role="tablist">
                    <a class="list-group-item list-group-item-action active py-3" id="account-tab" data-bs-toggle="list" href="#account" role="tab">
                        <i class="bi bi-person-gear me-2"></i> Account Details
                    </a>
                    <a class="list-group-item list-group-item-action py-3" id="security-tab" data-bs-toggle="list" href="#security" role="tab">
                        <i class="bi bi-shield-lock me-2"></i> Security
                    </a>
                    <a class="list-group-item list-group-item-action py-3 text-danger" id="danger-tab" data-bs-toggle="list" href="#danger" role="tab">
                        <i class="bi bi-trash me-2"></i> Delete Account
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            
            <?php if (isset($success)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> <?= e($success) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= e($error) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="tab-content" id="nav-tabContent">
                
                <div class="tab-pane fade show active" id="account" role="tabpanel">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">Personal Information</h5>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="/profile/update">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control" name="name" 
                                               value="<?= e($user->name) ?>" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" name="phone" 
                                               value="<?= e($user->phone ?? '') ?>" placeholder="+31 6 12345678">
                                    </div>
                                    <div class="col-12 text-end mt-3">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">Email Address</h5>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="/profile/update-email">
                                <div class="mb-3">
                                    <label class="form-label">Current Email</label>
                                    <input type="email" class="form-control" name="email" 
                                           value="<?= e($user->email) ?>" required>
                                    <div class="form-text">Changing your email may require re-verification.</div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-secondary">Update Email</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="security" role="tabpanel">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">Change Password</h5>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="/profile/change-password">
                                <div class="mb-3">
                                    <label class="form-label">Current Password</label>
                                    <input type="password" class="form-control" name="current_password" required>
                                </div>
                                <hr class="my-4">
                                <div class="mb-3">
                                    <label class="form-label">New Password</label>
                                    <input type="password" class="form-control" name="new_password" required minlength="8">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" name="confirm_password" required minlength="8">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-warning">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="danger" role="tabpanel">
                    <div class="card border-danger shadow-sm">
                        <div class="card-header bg-danger text-white py-3">
                            <h5 class="mb-0"><i class="bi bi-exclamation-triangle"></i> Delete Account</h5>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="text-danger">Are you sure you want to do this?</h5>
                            <p>Deleting your account is <strong>permanent</strong>. All your data, including booking history and membership details, will be permanently removed.</p>
                            
                            <div class="alert alert-warning">
                                <i class="bi bi-info-circle"></i> We cannot recover your account once it is deleted.
                            </div>
                            
                            <div class="text-end">
                                <a href="/profile/delete" class="btn btn-outline-danger">
                                    I understand, delete my account
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>