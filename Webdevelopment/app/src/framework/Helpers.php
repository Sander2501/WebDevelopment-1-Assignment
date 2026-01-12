<?php

if (!function_exists('e')) {
    function e(? string $value): string
    {
        return htmlspecialchars($value ??  '', ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('redirect')) {
    function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }
}

if (!function_exists('flash')) {
    function flash(string $key): ? string
    {
        if (!isset($_SESSION['flash'][$key])) {
            return null;
        }
        
        $message = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $message;
    }
}

if (! function_exists('setFlash')) {
    function setFlash(string $key, string $message): void
    {
        $_SESSION['flash'][$key] = $message;
    }
}