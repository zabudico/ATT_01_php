<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Page</title>
  
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Math Test</h2>
            </div>

            <form method="POST" action="/submit" class="card-body">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                <!-- Name Input -->
                <div class="mb-4">
                    <label class="form-label h5">Your Name:</label>
                    <input type="text" name="username" class="form-control form-control-lg" required>
                </div>

                <!-- Questions -->
                <?php foreach ($test['questions'] as $i => $question): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Question <?= $i + 1 ?></h5>
                            <p class="card-text lead"><?= htmlspecialchars($question['text']) ?></p>

                            <div class="ms-4">
                                <?php foreach ($question['options'] as $j => $option): ?>
                                    <div
                                        class="form-check <?= $question['type'] === 'radio' ? 'form-check-radio' : 'form-check-checkbox' ?>">
                                        <input class="form-check-input" type="<?= $question['type'] ?>"
                                            name="answers[<?= $i ?>]<?= $question['type'] === 'checkbox' ? '[]' : '' ?>"
                                            value="<?= $j ?>" <?= $question['type'] === 'radio' ? 'required' : '' ?>>
                                        <label class="form-check-label">
                                            <?= htmlspecialchars($option) ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <button type="submit" class="btn btn-success btn-lg w-100 mt-4">
                    <i class="bi bi-send-check me-2"></i>Submit Answers
                </button>
            </form>
        </div>
    </div>


</body>

</html>