<?php
session_start();

require_once __DIR__.DIRECTORY_SEPARATOR.'boot.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'menu.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'storage.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'classes.php';

$all_products = getProductsList();
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
                'page' => 'about',
                'products' => $all_products
            ]);
        ?>
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

        </div>

        <?php include_html('footer.html'); ?>
        
    </main>

</body>
</html>