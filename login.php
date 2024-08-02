<?php
session_start();

require_once __DIR__ . DIRECTORY_SEPARATOR . 'boot.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'classes.php';

if (getCurrentUser() !== null) {
    header('Location: index.php');
}

$user = new User();
$user->sessionLoad();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <?php include_html('head.html'); ?>
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
            <a href="register.php">Зарегистрироваться</a>
            <button type="submit">Войти</button>
        </form>

        <?php include_html('footer.html'); ?>
    </main>

</body>
</html>