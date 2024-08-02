<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'boot.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'storage.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'classes.php';

$user = getCurrentUser();
if ($user === null) {
    header('Location: login.php');
}

$disc_login = new DiscountForLogin($user->loginTime);
$disc_birthday = new DiscountForBirthday($user->birthday);

$cong = getRandomCongratulation();
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
            <li><a href="index.php">Главная</a></li>
            <li><a href="do_logout.php">Выйти</a></li>
        </ul>
    </header>

    <main>

        <div class="note-container">

            <div class="note">
                <p>Вы вошли как: <?= $user->name ?> (<?= $user->login ?>).</p>
            </div>

            <?php if ($disc_login->isActive()): ?>
                <div class="note">
                    <p>
                        Для Вас персональная скидка <span class="discount">5%</span> на любую услугу салона, при заказе на сайте.
                        <br>
                        Скидка действует <?= $disc_login->durationHours(); ?> часа с момента входа на сайт. Осталось 
                        <?= sprintf("%02d:%02d:%02d", $disc_login->remainHours(), $disc_login->remainMinutes(), $disc_login->remainSeconds()); ?> 
                        до истечения предложения.
                    </p>
                </div>
            <?php endif; ?>

            <?php if ($disc_birthday->isActive()): ?>
                <div class="note">
                    <p>У Вас день рождения, поздравляем!</p>
                    <?php if ($cong !== null): ?>
                        <br>
                        <p><?= $cong->text; ?></p>
                    <?php endif; ?>
                    
                    <br>
                    <p>
                        Для Вас <span class="discount">скидка 5%</span> на все услуги салона.
                    </p>
                </div>
            <?php elseif ($disc_birthday->daysBeforeBirthday() > 0): ?>
                    <div class="note">
                        <p>Дней до вашего дня рождения осталось: <?= $disc_birthday->daysBeforeBirthday(); ?></p>
                        <br>
                        <p>
                            Мы подготовим специальную скидку, которая будет действовать ещё <?= $disc_birthday->durationDays(); ?> дней после этой даты.
                            <br>
                            Будем рады видеть Вас в нашем салоне.
                        </p>
                    </div>
            <?php endif; ?>


        </div>

        <?php include_template('footer.html'); ?>
        
    </main>

</body>
</html>