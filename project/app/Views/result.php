<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Results</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow text-center">
            <div class="card-header bg-success text-white">
                <h2 class="mb-0"><i class="bi bi-check-circle me-2"></i>Test Completed</h2>
            </div>

            <div class="card-body py-4">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="alert alert-success lead">
                            <i class="bi bi-star-fill me-2"></i>
                            You answered <?= $result['score'] ?> out of <?= $totalQuestions ?> correctly!
                        </div>

                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Detailed Results</h5>
                                <div class="progress-stacked mb-3">
                                    <div class="progress-bar bg-success" style="width: <?= $result['percent'] ?>%">
                                    </div>
                                    <div class="progress-bar bg-danger" style="width: <?= 100 - $result['percent'] ?>%">
                                    </div>
                                </div>
                                <p class="display-4 text-primary">
                                    <?= round($result['percent'], 2) ?>%
                                </p>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="/dashboard" class="btn btn-primary btn-lg">
                                <i class="bi bi-bar-chart-line me-2"></i>View All Results
                            </a>
                            <br><br>
                            <a href="/" class="btn btn-outline-secondary">
                                <i class="bi bi-house-door me-2"></i>Return Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</body>

</html>