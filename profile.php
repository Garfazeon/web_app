<?php
if (!isset($_COOKIE['User'])) {
    header('Location: /login.php');
    exit();
}
$username = htmlspecialchars($_COOKIE['User']);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добро пожаловать</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column justify-content-center align-items-center vh-100">
    <div class="text-center">
        <h1>Привет, <?= $username ?>!</h1>
        <form action="logout.php" method="POST" class="mt-4">
            <button class="btn btn-danger" type="submit">Выйти</button>
        </form>
    </div>
</body>
</html>
