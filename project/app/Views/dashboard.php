<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results Dashboard</title>

    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Test Results</h2>
                <div class="btn-group">
                    <a href="/export-pdf" class="btn btn-light">
                        <i class="bi bi-file-pdf me-2"></i>Export PDF
                    </a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="/" class="btn btn-outline-light">
                        <i class="bi bi-house-door me-2"></i>Home
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Score</th>
                                <th>Percentage</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($results as $result): ?>
                                <tr>
                                    <td><?= htmlspecialchars($result['username']) ?></td>
                                    <td>
                                        <span class="badge bg-primary rounded-pill">
                                            <?= $result['score'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 25px">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: <?= $result['percent'] ?>%"
                                                aria-valuenow="<?= $result['percent'] ?>" aria-valuemin="0"
                                                aria-valuemax="100">
                                                <?= round($result['percent'], 2) ?>%
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= $result['date'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</body>

</html>