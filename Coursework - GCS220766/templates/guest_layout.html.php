<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet"> 
    <title><?=$title?></title>
</head>
<body>
    <header class="container-fluid header-nav py-3 d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Questions Web of Guest</h1>
        <nav>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="login.php">Log In</a></li>
                <li class="nav-item"><a class="nav-link" href="register.php">Sign Up</a></li>
            </ul>
        </nav>
    </header>

    <main class="container-fluid py-3 px-3">
        <?=$output_coursework?>
    </main>
    <footer>Dao Huy Bao GCS220766 - Copyright</footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.min.js"></script>
</body>
</html>