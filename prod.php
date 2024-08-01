<?php
session_start();

require_once __DIR__.DIRECTORY_SEPARATOR.'boot.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'storage.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'classes.php';

$all_products = getProductsList();

$current_prod = getProd($_GET['id'], $all_products);

if ($current_prod === null) {
    header('Location: index.php');
}
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
            <li><a href="#">О нас</a></li>
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
            <li><a href="#">Личный кабинет</a></li>
            <li><a href="login.php">Войти</a></li>
            <li><a href="#">Выйти</a></li>
        </ul>
    </header>

    <main>

        <div class="note-container">

        <div class="prod">
                <div>
                    <img src="./assets/images/<?= $current_prod->image; ?>" alt="<?= $current_prod->title; ?>">
                </div>
                <div class="prod-descr">
                    <h3><?= $current_prod->title; ?></h3>
                    <br>
                    <p><?= $current_prod->description_short; ?></p>
                </div>
            </div>

        </div>


        <?php include_template('footer.html'); ?>
    </main>

</body>
</html>