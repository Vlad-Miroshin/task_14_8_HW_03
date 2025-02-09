<?php
session_start();

require_once __DIR__ . DIRECTORY_SEPARATOR . 'boot.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'menu.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'storage.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'classes.php';

$user = new User();
$user->sessionLoad();

$all_users = getUsersList();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <?php include_html('head.html'); ?>
</head>
<body>
    <header class="menu__bar">
        <?php
            create_menu([
                'page' => 'register'
            ]);
        ?>
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
            <label>Дата рождения</label>
            <input type="date" name="user_birthday">
            <br>
            <?php flash(); ?>
            <br>
            <button type="submit">Зарегистрировать</button>
        </form>

        <br>
        <h3>Существующие пользователи</h3>
        <ul>
            <?php 
                foreach ($all_users as $user): 
             ?>
            <li>
                <?= "$user->login ($user->name)" ?>
            </li>
            <?php endforeach; ?>
        </ul>

        <div class="error">

        </div>


        <?php include_html('footer.html'); ?>
    </main>

</body>
</html>