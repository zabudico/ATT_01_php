<?php
/**
 * Конфигурация окружения и безопасности
 */

// Отключение вывода ошибок в production
ini_set('display_errors', '0');
error_reporting(E_ALL);

// Базовые пути
define('TESTS_DIR', BASE_PATH . '/data/tests/');      // Папка с тестами
define('RESULTS_FILE', BASE_PATH . '/data/results.json'); // Файл результатов

// HTTP-заголовки безопасности
header('Content-Security-Policy: default-src \'self\'');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Strict-Transport-Security: max-age=31536000; includeSubDomains');