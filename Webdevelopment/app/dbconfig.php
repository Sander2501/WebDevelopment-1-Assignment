<?php
declare(strict_types=1);

$DB_HOST = getenv('DB_HOST') ?: 'mysql';
$DB_NAME = getenv('DB_NAME') ?: 'developmentdb';
$DB_USER = getenv('DB_USER') ?: 'root';
$DB_PASS = getenv('DB_PASS') ?: 'secret123';
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
    error_log("Database connection failed: " . $e->getMessage());
    http_response_code(500);
    die("Database connection failed. Please try again later.");
}

if (session_status() !== PHP_SESSION_ACTIVE) {
    ini_set('session.cookie_httponly', '1');
    ini_set('session.use_strict_mode', '1');
    session_start();
}

if (! isset($_SESSION['user'])) {
    $_SESSION['user'] = [
        'id'    => 1,
        'email' => 'test@user.com',
        'name'  => 'Test User'
    ];
}
