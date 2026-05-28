<?php
require_once('db.php');

if (isset($_COOKIE['User'])){
    header("Location: http://localhost/aibks/AibksWEB/profile.php");
    exit();
}

$link = mysqli_connect('127.0.0.1', 'root', '', 'first');

$error_message = "";

if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    
    if (!$login || !$email || !$pass) {
        $error_message = "input all parameters";
    } else {
        $sql = "INSERT INTO users (username, email, pass) VALUES ('$login', '$email', '$pass')";
        
        if (!mysqli_query($link, $sql)) {
            $error_message = "Error insert table users";
        } else {
            header("Location: http://localhost/aibks/AibksWEB/login.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAq046MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJ1+014" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Abbasova Elina Raufovna</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="mb-4">Registration</h1>
                
                <?php if ($error_message): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>
                
                <form action="" method="POST">
                    <input type="text" name="login" class="form-control-hacker-input" placeholder="login" required>
                    <input type="email" name="email" class="form-control-hacker-input" placeholder="email" required>
                    <input type="password" name="password" class="form-control-hacker-input" placeholder="password" required>
                    <button class="btn btn-primary" type="submit" name="submit">Register</button>
                    <p class="mt-3">Already have an account? <a href="http://localhost/aibks/AibksWEB/login.php">Login</a></p>
                </form>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>