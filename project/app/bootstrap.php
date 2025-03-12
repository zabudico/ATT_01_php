<?php
/**
 * Инициализация приложения и маршрутизация
 */

session_start();

// Базовые настройки
define('BASE_PATH', realpath(__DIR__ . '/..'));
require BASE_PATH . '/config/env.php';

// Автозагрузка классов
spl_autoload_register(function ($className) {
    $file = str_replace('\\', '/', $className) . '.php';
    $fullPath = BASE_PATH . '/' . $file;

    if (file_exists($fullPath)) {
        require $fullPath;
    }
});

// Обработка запроса
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

try {
    switch ($request) {
        case '/':
            (new App\Controllers\TestController)->showHome();
            break;
        case '/test':
            (new App\Controllers\TestController)->showTest();
            break;
        case '/submit':
            (new App\Controllers\ResultController)->processTest();
            break;
        case '/dashboard':
            (new App\Controllers\ResultController)->showDashboard();
            break;
        case '/export-pdf':
            (new App\Controllers\ResultController)->exportToPDF();
            break;
        default:
            throw new \Exception("Page not found", 404);
    }
} catch (\Exception $e) {
    http_response_code($e->getCode() ?: 500);
    die("Error: " . htmlspecialchars($e->getMessage()));
}