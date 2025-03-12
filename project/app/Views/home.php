<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Test</title>
  
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h1 class="card-title text-center mb-0">
                            <i class="bi bi-calculator me-2"></i>
                            Math Test
                        </h1>
                    </div>

                    <div class="card-body">
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <?= $_SESSION['error'] ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <?php unset($_SESSION['error']) ?>
                        <?php endif; ?>

                        <div class="d-grid gap-2 mt-4">
                            <a href="/test" class="btn btn-primary btn-lg">
                                <i class="bi bi-pencil-square me-2"></i>
                                Start Test
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
</body>

</html>