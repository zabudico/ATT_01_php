<?php
namespace App\Controllers;

use App\Models\Test;

/**
 * Контроллер для работы с тестами
 */
class TestController
{
    /**
     * Отображает главную страницу с кнопкой начала теста
     */
    public function showHome(): void
    {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        require BASE_PATH . '/app/Views/home.php';
    }

    /**
     * Отображает страницу с вопросами теста
     * @throws \Exception Если тест не найден
     */
    public function showTest(): void
    {
        try {
            $test = Test::load('math');
            require BASE_PATH . '/app/Views/test.php';
        } catch (\Exception $e) {
            $this->handleError($e->getMessage());
        }
    }

    /**
     * Обрабатывает ошибки и перенаправляет на главную
     * @param string $message Сообщение об ошибке
     */
    private function handleError(string $message): void
    {
        $_SESSION['error'] = $message;
        header('Location: /');
        exit;
    }
}