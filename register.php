<?php
session_start();

require_once __DIR__.DIRECTORY_SEPARATOR.'boot.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'users.php';
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

        <form class="login__form register" action="do_register.php" method="post">
            <h2>Регистрация пользователя</h2>
            <label>Учётная запись (login)</label>
            <input type="text" name="user_login" value="<?= $user->login; ?>" required>
            <br>
            <label>Пароль</label>
            <input type="password" name="user_pass" value="<?= $user->password; ?>">
            <label>Повторите пароль</label>
            <input type="password" name="user_pass_repeat" value="<?= $user->password_repeat; ?>">
            <br>
            <label>Как вас называть? (Имя)</label>
            <input type="text" name="user_name" value="<?= $user->name; ?>" required>
            <label>Электронная почта</label>
            <input type="text" name="user_email" value="<?= $user->email; ?>">
            <br>
            <?php flash(); ?>
            <br>
            <button type="submit">Зарегистрировать</button>
        </form>

        <br>
        <h3>Существующие пользователи</h3>
        <ul>
            <?php 
                $all_users = getUsersList();

                foreach ($all_users as $user): 
             ?>
            <li>
                <?= "$user->login ($user->name)" ?>
            </li>
            <?php endforeach; ?>
        </ul>

        <div class="error">

        </div>


        <div class="footer">
            <div class="copyright">
                &copy;&nbsp;<a href="https://github.com/Vlad-Miroshin">Владислав Мирошин</a>, 2024. Поток PHPPRO_22 <a href="https://skillfactory.ru/">Skillfactory</a>.
            </div>
        </div>
    </main>

</body>
</html>