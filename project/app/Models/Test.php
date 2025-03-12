<?php
namespace App\Models;

/**
 * Модель для загрузки тестов из JSON-файлов
 */
class Test
{
    /**
     * Загружает тест по имени
     * @param string $name Название теста (без расширения)
     * @return array Данные теста
     * @throws \Exception Если файл не найден или некорректен
     */
    public static function load(string $name): array
    {
        $file = TESTS_DIR . $name . '.json';
        if (!file_exists($file)) {
            throw new \Exception("Test file not found");
        }

        $data = json_decode(file_get_contents($file), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("Invalid JSON format");
        }

        if (count($data['questions'] ?? []) < 5) {
            throw new \Exception("Test must contain at least 5 questions");
        }

        return $data;
    }
}