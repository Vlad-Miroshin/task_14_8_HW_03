<?php
session_start();

require_once __DIR__.DIRECTORY_SEPARATOR.'boot.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'storage.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'classes.php';

$all_products = getProductsList();
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
            <li><a href="#">Главная</a></li>
            <li><a href="#">О нас</a></li>
            <li><a href="#">Услуги <i class="fas fa-caret-down"></i></a>
                <div class="dropdown__menu">
                    <ul>
                        <?php
                            foreach ($all_products as $prod):
                        ?>
                            <li><a href="#"><?= $prod->title; ?></a></li>
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

            <div class="note">
                <div class="gallery">
                    <img src="./assets/images/spa_1.jpg" alt="Фото салона">
                    <img src="./assets/images/spa_2.jpg" alt="Интерьер салона">
                    <img src="./assets/images/spa_3.jpg" alt="Сушильная камера">
                </div>
                <p>Спа-процедуры для животных могут включать в себя различные услуги, которые направлены на улучшение здоровья, благополучия и красоты.
                <br><br>
                Важно помнить, что выбор спа-процедур должен основываться на потребностях и индивидуальных особенностях каждого животного.
                <br><br>
                Cпа-процедуры могут помочь улучшить здоровье и благополучие, а также создать более гармоничную связь между животным и его хозяином. Процедуры могут быть полезны для снятия стресса и напряжения у животных.
                Однако, не все животные могут переносить процедуры из-за своего здоровья или характера. Использование некоторых продуктов и материалов может вызвать аллергические реакции.</p>
                <br>
                <p>Зарегистрируйтесь и выполните <a href="login.php">вход</a>, чтобы получить персональные скидки и предложения.</p> 
            </div>

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


        <div class="card-container">
            <?php
                foreach ($all_products as $prod):
            ?>

            <div class="card">

                <?php if (!empty($prod->image)): ?>
                    <img src="<?= './assets/images/' . $prod->image ?>" alt="<?= $prod->title ?>">
                <?php endif; ?>

                <div class="card-content">
                    <h3><?= $prod->title ?></h3>
                    <p><?= $prod->description_short ?></p>
                    <!-- <a href="#" class="btn">Узнать больше</a> -->
                </div>
            </div>

            <?php endforeach; ?>
        </div>


        <div class="footer">
            <div class="copyright">
                &copy;&nbsp;<a href="https://github.com/Vlad-Miroshin">Владислав Мирошин</a>, 2024. Поток PHPPRO_22 <a href="https://skillfactory.ru/">Skillfactory</a>.
            </div>
        </div>
    </main>

</body>
</html>