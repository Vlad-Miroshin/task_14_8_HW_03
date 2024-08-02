<?php
require_once __DIR__.DIRECTORY_SEPARATOR.'boot.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'menu.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'storage.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'classes.php';

$all_products = getProductsList();
shuffle($all_products);
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