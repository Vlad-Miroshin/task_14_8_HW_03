<?php
session_start();

require_once __DIR__ . DIRECTORY_SEPARATOR . 'boot.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'storage.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'classes.php';

$user = getCurrentUser();
if ($user === null) {
    header('Location: login.php');
}

$target = $user->loginTime + 24 * 60 * 60;
$now = time();
$remain = $target - $now;

if ($remain > 0) {
    $diff = seconds2times($target - $now);
}

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

            <?php if ($remain > 0): ?>
                <div class="note">
                    <p>
                        Для Вас персональная скидка <span class="discount">5%</span> на любую услугу салона, при заказе на сайте.
                        <br>
                        Скидка действует 24 часа с момента входа на сайт. Осталось <?= sprintf("%02d:%02d:%02d", $diff[2], $diff[1], $diff[0]); ?> до истечения предложения.
                    </p>
                </div>
            <?php endif; ?>

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


        </div>

        <?php include_template('footer.html'); ?>
        
    </main>

</body>
</html>