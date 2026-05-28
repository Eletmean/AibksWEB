<?php
$link = mysqli_connect('127.0.0.1', 'root', '', 'first');

if (!$link) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

$id = $_GET['id'];

if (!$id) {
    die("ID поста не указан");
}

$sql = "SELECT * FROM posts WHERE id=$id";
$res = mysqli_query($link, $sql);

if (mysqli_num_rows($res) == 0) {
    die("Пост с ID $id не найден");
}

$rows = mysqli_fetch_array($res);
$title = $rows['title'];
$main_text = $rows['main_text'];
$image = $rows['image'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/aibks/AibksWEB/css/style.css">
</head>
<body>
    <div class="navbar navbar-dark bg-dark p-3">
        <div class="container-fluid">
            <a href="http://localhost/aibks/AibksWEB/profile.php" class="navbar-brand d-flex align-items-center">
                <img src="http://localhost/aibks/AibksWEB/logo.webp" alt="логотип-сайта" class="me-2">
                <span class="text-light">History</span>
            </a>
        </div>
    </div>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row">
            <div class="col-12 text-center">
                <?php if ($image): ?>
                    <img src="http://localhost/aibks/AibksWEB/upload/<?php echo $image; ?>" class="img-fluid mb-3" style="max-width: 400px;">
                <?php endif; ?>
                <h1><?php echo $title; ?></h1>
                <p><?php echo $main_text; ?></p>
                <a href="http://localhost/aibks/AibksWEB/profile.php" class="btn btn-primary mt-3">Back to Profile</a>
            </div>
        </div>
    </div>
</body>
</html>