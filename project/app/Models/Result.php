<?php
namespace App\Models;

/**
 * Модель для работы с результатами тестов
 */
class Result
{
    /**
     * Сохраняет результат теста в JSON-файл
     * @param array $data Данные результата (username, score, percent)
     */
    public static function save(array $data): void
    {
        $results = self::getAll();
        $results[] = [
            'username' => $data['username'],
            'score' => $data['score'],
            'percent' => round($data['percent'], 2),
            'date' => date('Y-m-d H:i:s')
        ];
        file_put_contents(RESULTS_FILE, json_encode($results, JSON_PRETTY_PRINT));
    }

    /**
     * Возвращает все результаты из файла
     * @return array Массив результатов
     */
    public static function getAll(): array
    {
        if (!file_exists(RESULTS_FILE)) {
            return [];
        }
        return json_decode(file_get_contents(RESULTS_FILE), true) ?: [];
    }
}