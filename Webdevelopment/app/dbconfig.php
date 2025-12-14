<?php
declare(strict_types=1);

/**
 * Central PDO connection + demo session user.
 * Works inside Docker where the MySQL service is named "mysql".
 */

$DB_HOST = 'mysql';          // service name from docker-compose
$DB_NAME = 'developmentdb';
$DB_USER = 'root';
$DB_PASS = 'secret123';
$DB_DSN  = "mysql:host={$DB_HOST};dbname={$DB_NAME};charset=utf8mb4";

try {
    $pdo = new PDO(
        $DB_DSN,
        $DB_USER,
        $DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    // Show a clear message in dev; in prod log it instead.
    http_response_code(500);
    echo "Database connection failed: " . htmlspecialchars($e->getMessage());
    exit;
}

# TEMP login for testing (so booking pages have a user)
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
$_SESSION['user'] = $_SESSION['user'] ?? [
    'id'    => 1,
    'email' => 'test@user.com',
    'name'  => 'Test User'
];
