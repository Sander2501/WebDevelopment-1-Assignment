<?php
$pageTitle = 'Error - Atlevia Sports';
require __DIR__ . '/partials/header.php';
require __DIR__ . '/partials/navbar.php';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-danger">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-exclamation-triangle"></i> Error
                    </h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger mb-4" role="alert">
                        <strong>Something went wrong:</strong> 
                        <?= isset($error) ? e($error) : 'An unexpected error occurred.' ?>
                    </div>
                    
                    <div class="d-flex gap-3">
                        <a href="/" class="btn btn-primary">Go Home</a>
                        <a href="javascript:history.back()" class="btn btn-outline-secondary">Go Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>