<?php
session_start();

require_once __DIR__.DIRECTORY_SEPARATOR.'boot.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'menu.php';
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
    <?php include_html('head.html'); ?>
</head>
<body>
    <header class="menu__bar">
        <?php
            create_menu([
                'page' => 'prod',
                'products' => $all_products
            ]);
        ?>
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


        <?php include_html('footer.html'); ?>
    </main>

</body>
</html>