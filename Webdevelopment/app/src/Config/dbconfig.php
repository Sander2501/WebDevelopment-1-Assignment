<?php

namespace App\Config;

use PDO;
use PDOException;

class Database
{
    private const DB_HOST = 'mysql';
    private const DB_NAME = 'developmentdb';
    private const DB_USER = 'developer';
    private const DB_PASS = 'secret123';
    private const DB_CHARSET = 'utf8mb4';

    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            try {
                $dsn = sprintf(
                    'mysql:host=%s;dbname=%s;charset=%s',
                    self::DB_HOST,
                    self::DB_NAME,
                    self::DB_CHARSET
                );

                self::$connection = new PDO($dsn, self::DB_USER, self::DB_PASS, [
                    PDO:: ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);

            } catch (PDOException $e) {
                error_log("Database connection failed: " . $e->getMessage());
                http_response_code(500);
                die("Database connection failed. Please try again later.");
            }
        }

        return self::$connection;
    }
}