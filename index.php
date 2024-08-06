<?php
require_once __DIR__.DIRECTORY_SEPARATOR.'boot.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'menu.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'storage.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'classes.php';

$all_products = getProductsList();
shuffle($all_products);

$user = getCurrentUser();
if ($user !== null) {
    $disc_login = new DiscountForLogin($user->loginTime);
    $disc_birthday = new DiscountForBirthday($user->birthday);
}

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
                'page' => 'index',
                'products' => $all_products
            ]);
        ?>
    </header>

    <main>
        <div class="note-container">
            <?php 
                if (isset($disc_birthday) && $disc_birthday->isActive()): 
                    $cong = getRandomCongratulation();
            ?>
                <div class="note">
                    <p>У Вас день рождения, поздравляем!</p>
                    <?php if (isset($cong)): ?>
                        <br>
                        <p><?= $cong->text; ?></p>
                    <?php endif; ?>
                    
                    <br>
                    <p>
                        Для Вас <span class="discount">скидка 5%</span> на все услуги салона.
                    </p>
                </div>
            <?php elseif (isset($disc_login) && $disc_login->isActive()): ?>
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
        </div>

        <div class="card-container">
            <?php foreach ($all_products as $prod): ?>

            <div class="card">

                <?php if (!empty($prod->image)): ?>
                    <a href="prod.php?id=<?= $prod->id; ?>"><img src="<?= './assets/images/' . $prod->image ?>" alt="<?= $prod->title ?>"></a>
                <?php endif; ?>

                <div class="card-content">
                    <h3><?= $prod->title ?></h3>
                    <p><?= $prod->description_short ?></p>
                </div>
            </div>

            <?php endforeach; ?>
        </div>


        <?php include_html('footer.html'); ?>
        
    </main>

</body>
</html>