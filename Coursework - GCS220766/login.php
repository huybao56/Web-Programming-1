<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet"> 
    <title>Log In</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row w-100">
            <div class="col-md-6 col-lg-4 mx-auto">
                <h1 class="text-center mb-4">Login Account</h1>
                <form action="login_query.php" method="post">
                    <div class="mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" required><br>
                        <input type="password" name="password" class="form-control" placeholder="Password" required><br>    
                        <input type="submit" value="Login" name="Login" class="btn btn-primary w-100"><br>
                    </div>
                    <div class="text-center">
                        <a href="register.php">Don't have an account?</a> <br>
                        <a href="index.php">View As Guest</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.min.js"></script>
</body>
</html>