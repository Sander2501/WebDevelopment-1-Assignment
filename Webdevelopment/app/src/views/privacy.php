<?php
$pageTitle = 'Privacy Policy - Atlevia Sports';
require __DIR__ . '/partials/header.php';
require __DIR__ . '/partials/navbar.php';
?>

<div class="container my-5">
    <h1>Privacy Policy</h1>
    <p class="text-muted">Last updated: <?= date('F j, Y') ?></p>
    
    <h2>Data We Collect</h2>
    <p>We collect the following personal information:</p>
    <ul>
        <li><strong>Email address</strong> - For account identification and communication</li>
        <li><strong>Name</strong> - For personalization</li>
        <li><strong>Phone number</strong> (optional) - For contact purposes</li>
        <li><strong>Password</strong> - Stored as a hashed value for security</li>
        <li><strong>Booking data</strong> - To manage your gym reservations</li>
    </ul>
    
    <h2>How We Use Your Data</h2>
    <p>Your data is used to:</p>
    <ul>
        <li>Manage your account and bookings</li>
        <li>Communicate about your reservations</li>
        <li>Improve our services</li>
    </ul>
    
    <h2>Data Security</h2>
    <p>We implement security measures including:</p>
    <ul>
        <li>Password hashing using bcrypt</li>
        <li>Prepared statements to prevent SQL injection</li>
        <li>XSS prevention through output sanitization</li>
        <li>Secure session management with HttpOnly cookies</li>
    </ul>
    
    <h2>Your Rights (GDPR)</h2>
    <p>You have the right to:</p>
    <ul>
        <li><strong>Access</strong> - View your personal data in your profile</li>
        <li><strong>Rectification</strong> - Update your information in settings</li>
        <li><strong>Erasure</strong> - Delete your account permanently</li>
        <li><strong>Data Portability</strong> - Contact us for a data export</li>
    </ul>
    
    <h2>Cookies</h2>
    <p>We only use essential session cookies for authentication.  No tracking or analytics cookies are used.</p>
    
    <h2>Data Retention</h2>
    <p>Your data is retained while your account is active.  Upon account deletion, all personal data is immediately removed from our database.</p>
    
    <h2>Contact</h2>
    <p>For privacy concerns, contact:  <a href="mailto:privacy@atleviasports.com">privacy@atleviasports.com</a></p>
    
    <a href="/dashboard" class="btn btn-primary mt-4">Back to Dashboard</a>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>