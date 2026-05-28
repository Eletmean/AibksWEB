<?php
if (isset($_COOKIE['User'])){
    header("Location: http://localhost/aibks/AibksWEB/profile.php");
    exit();
}

$error_message = "";

if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $pass = $_POST['password'];
    
    if (!$login || !$pass) {
        $error_message = "input all parameters";
    } else {
        $link = mysqli_connect('127.0.0.1', 'root', '', 'first');
        

        
        // Экранируем спецсимволы
        $login = mysqli_real_escape_string($link, $login);
        $pass = mysqli_real_escape_string($link, $pass);
        
        $sql = "SELECT * FROM users WHERE username='$login' AND pass='$pass'";
        $result = mysqli_query($link, $sql);
        
        if (mysqli_num_rows($result) == 1) {
            setcookie("User", $login, time() + 7200);
            header("Location: http://localhost/aibks/AibksWEB/profile.php");
            exit();
        } else {
            $error_message = "incorrect username or password";
        }
        
        mysqli_close($link);
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/aibks/AibksWEB/css/style.css">
    <title>Login</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="mb-4">Login In!</h1>
                
                <?php if ($error_message): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>
                
                <form action="" method="POST" class="d-flex flex-column gap-3">
                    <input type="text" name="login" class="form-control-hacker-input" placeholder="login" required>
                    <input type="password" name="password" class="form-control-hacker-input" placeholder="password" required>
                    <button class="btn btn-primary" type="submit" name="submit">Login</button>
                    <p class="mt-3">Do not have an account? <a href="http://localhost/aibks/AibksWEB/registration.php">Register</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>