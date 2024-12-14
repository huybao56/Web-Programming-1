<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet"> 
    <title>Register</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row w-100">        
        <div class="col-md-6 col-lg-4 mx-auto">
            <h1 class="text-center mb-4">Register Account</h1>
            <form action="register_query.php" method="post">
                <div class="mb-3">
                    <input type="text" name="fullname" class="form-control" placeholder="Full Name" required><br>
                    <input type="email" name="email" class="form-control" placeholder="Email" required><br>
                    <input type="text" name="username" class="form-control" placeholder="Username" required><br>    
                    <input type="password" name="password" class="form-control" placeholder="Password" required><br>    
                    <input type="submit" value="Register" name="Register" class="btn btn-primary w-100">    
                </div>
                <div class="text-center">
                    <a href="login.php">Already have account?</a><br>
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