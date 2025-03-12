<?php
/**
 * Точка входа в приложение
 */

// Блокировка прямого доступа к файлам
if (PHP_SAPI === 'cli-server') {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (is_file(__DIR__ . $path)) {
        return false;
    }
}

require __DIR__ . '/../app/bootstrap.php';


// chmod -R 755 data/
///*chmod -R 755 public/assets/*/
//chmod -R 755 project/app/Libraries/TCPDF/fonts/