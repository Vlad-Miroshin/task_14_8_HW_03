<?php
session_start();

require_once __DIR__.DIRECTORY_SEPARATOR.'boot.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'classes.php';

$user = new UserNew();
$user->sessionLoad();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <title>Учебное задание 14.8. Практика - Демо-сайт салона (HW-03)</title>
</head>
<body>
    <header class="menu__bar">
        <h1 class="logo">Pets<span>SPA.</span></h1>
    </header>

    <main>

        <form class="login__form" action="do_login.php" method="post">
            <h2>Вход</h2>
            <label>Учётная запись (login)</label>
            <input type="text" name="user_login" value="<?= $user->login; ?>" required>
            <br>
            <label>Пароль</label>
            <input type="password" name="user_pass" value="<?= $user->password; ?>">
            <br>
            <?php flash(); ?>
            <br>
            <button type="submit">Войти</button>
        </form>

        <div class="footer">
            <div class="copyright">
                &copy;&nbsp;<a href="https://github.com/Vlad-Miroshin">Владислав Мирошин</a>, 2024. Поток PHPPRO_22 <a href="https://skillfactory.ru/">Skillfactory</a>.
            </div>
        </div>
    </main>

</body>
</html>