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