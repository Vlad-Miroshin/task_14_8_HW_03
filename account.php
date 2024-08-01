<?php
session_start();

require_once __DIR__.DIRECTORY_SEPARATOR.'boot.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'storage.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'classes.php';

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <?php include_template('head.html'); ?>
</head>
<body>
    <header class="menu__bar">
        <h1 class="logo">Pets<span>SPA.</span></h1>

        <ul>
            <li><a href="#">Главная</a></li>
            <li><a href="#">О нас</a></li>
            <li><a href="#">Выйти</a></li>
        </ul>
    </header>

    <main>

        <div class="note-container">

            <div class="note">
                <p>У Вас сегодня день рождения, поздравляем!
                    <br><br>
                    Для Вас <span class="discount">скидка 5%</span> на все услуги салона.
                </p>
            </div>

            <div class="note">
                <p>
                    Для Вас персональная скидка <span class="discount">5%</span> на любую услугу салона, при заказе на сайте.
                </p>
                <p>
                    Скидка действует 24 часа с момента входа на сайт. Осталось 15:05:17 до истечения предложения.
                </p>
            </div>

        </div>

        <?php include_template('footer.html'); ?>
        
    </main>

</body>
</html>