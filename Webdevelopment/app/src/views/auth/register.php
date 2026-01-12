<?php
$pageTitle = 'Register - Atlevia Sports';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/navbar.php';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">Register Account</h2>
                    
                    <?php if (isset($errorMessage)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $errorMessage ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="/register">
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Full Name <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="name" 
                                name="name" 
                                required 
                                maxlength="100"
                                value="<?= e($_POST['name'] ?? '') ?>"
                                autofocus
                            >
                            <small class="text-muted">Maximum 100 characters</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                Email Address <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="email" 
                                class="form-control" 
                                id="email" 
                                name="email" 
                                required 
                                maxlength="255"
                                value="<?= e($_POST['email'] ?? '') ?>"
                            >
                            <small class="text-muted">Maximum 255 characters</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Password <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="password" 
                                class="form-control" 
                                id="password" 
                                name="password" 
                                required 
                                minlength="8" 
                                maxlength="255"
                            >
                            <small class="text-muted">Minimum 8 characters, maximum 255</small>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            Register Account
                        </button>
                    </form>
                    
                    <hr class="my-4">
                    
                    <p class="text-center mb-0">
                        Already have an account?  
                        <a href="/login">Login here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>