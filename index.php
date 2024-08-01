<?php
session_start();

require_once __DIR__.DIRECTORY_SEPARATOR.'boot.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'storage.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'classes.php';

$all_products = getProductsList();
shuffle($all_products);
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
            <li><a href="about.php">О нас</a></li>
            <li><a href="#">Услуги <i class="fas fa-caret-down"></i></a>
                <div class="dropdown__menu">
                    <ul>
                        <?php
                            foreach ($all_products as $prod):
                        ?>
                            <li><a href="prod.php?id=<?= $prod->id; ?>"><?= $prod->title; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </li>
            <li><a href="account.php">Личный кабинет</a></li>
            <li><a href="login.php">Войти</a></li>
            <li><a href="#">Выйти</a></li>
        </ul>
    </header>

    <main>

        <div class="card-container">
            <?php
                foreach ($all_products as $prod):
            ?>

            <div class="card">

                <?php if (!empty($prod->image)): ?>
                    <a href="prod.php?id=<?= $prod->id; ?>"><img src="<?= './assets/images/' . $prod->image ?>" alt="<?= $prod->title ?>"></a>
                <?php endif; ?>

                <div class="card-content">
                    <h3><?= $prod->title ?></h3>
                    <p><?= $prod->description_short ?></p>
                    <!-- <a href="#" class="btn">Узнать больше</a> -->
                </div>
            </div>

            <?php endforeach; ?>
        </div>


        <?php include_template('footer.html'); ?>
        
    </main>

</body>
</html>