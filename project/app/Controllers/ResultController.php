<?php
namespace App\Controllers;

use App\Models\{Test, Result};
require_once BASE_PATH . '/app/Libraries/FPDF/fpdf.php';

/**
 * Контроллер для обработки результатов тестирования и экспорта в PDF
 */
class ResultController
{
    /**
     * Обрабатывает отправленные ответы теста, сохраняет результат и отображает страницу с результатами
     * @throws \Exception Если входные данные невалидны
     */
    public function processTest(): void
    {
        try {
            $this->validateInput();
            $test = Test::load('math');
            $result = $this->calculateResult($test);
            Result::save($result);

            $totalQuestions = count($test['questions']);
            require BASE_PATH . '/app/Views/result.php';

        } catch (\Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: /test');
            exit;
        }
    }

    /**
     * Отображает панель управления с таблицей результатов
     */
    public function showDashboard(): void
    {
        $results = Result::getAll();
        require BASE_PATH . '/app/Views/dashboard.php';
    }

    /**
     * Генерирует PDF-отчет с результатами тестов
     * @throws \Exception Если PDF не удалось создать
     */
    public function exportToPDF(): void
    {
        $results = Result::getAll();

        try {
            $pdf = new \FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);

            // Заголовок отчета
            $pdf->Cell(0, 10, 'Test Results Report', 0, 1, 'C');
            $pdf->Ln(10);

            // Заголовки таблицы
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(50, 10, 'Name', 1);
            $pdf->Cell(30, 10, 'Score', 1);
            $pdf->Cell(40, 10, 'Percentage', 1);
            $pdf->Cell(60, 10, 'Date', 1);
            $pdf->Ln();

            // Заполнение данными
            $pdf->SetFont('Arial', '', 12);
            foreach ($results as $result) {
                $pdf->Cell(50, 10, $result['username'], 1);
                $pdf->Cell(30, 10, $result['score'], 1);
                $pdf->Cell(40, 10, round($result['percent'], 2) . '%', 1);
                $pdf->Cell(60, 10, $result['date'], 1);
                $pdf->Ln();
            }

            // Отправка файла пользователю
            $pdf->Output('D', 'results.pdf');
        } catch (\Exception $e) {
            die("PDF generation error: " . $e->getMessage());
        }
    }

    /**
     * Валидирует входные данные формы
     * @throws \Exception Если данные не прошли проверку
     */
    private function validateInput(): void
    {
        if (empty($_POST['username'])) {
            throw new \Exception("Username is required");
        }

        if (!isset($_POST['answers']) || !is_array($_POST['answers'])) {
            throw new \Exception("Invalid answers format");
        }

        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
            throw new \Exception("CSRF token validation failed");
        }
    }

    /**
     * Вычисляет результат теста
     * @param array $test Данные теста из JSON-файла
     * @return array Массив с результатом пользователя
     */
    private function calculateResult(array $test): array
    {
        $score = 0;
        foreach ($test['questions'] as $i => $question) {
            $userAnswers = (array) ($_POST['answers'][$i] ?? []);
            $userAnswers = array_map('intval', $userAnswers);
            $correctAnswers = array_map('intval', $question['correct']);

            // Сравнение ответов после сортировки
            sort($userAnswers);
            sort($correctAnswers);

            if ($userAnswers === $correctAnswers) {
                $score++;
            }
        }

        return [
            'username' => htmlspecialchars($_POST['username']),
            'score' => $score,
            'percent' => ($score / count($test['questions'])) * 100
        ];
    }
}