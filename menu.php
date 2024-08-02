<?php function create_menu($params) {

$page = $params['page'];
$products = $params['products'];
$ppp = $params['ppp'];

?>
        <h1 class="logo">Pets<span>SPA.</span></h1>
        <ul>

            <?php if ($page !== 'index'): ?>
                <li><a href="index.php">Главная</a></li>
            <?php endif; ?>

            <li><a href="about.php">О нас</a></li>

            <?php if (isset($products)): ?>
                <li><a href="#">Услуги <i class="fas fa-caret-down"></i></a>
                    <div class="dropdown__menu">
                        <ul>
                            <?php foreach ($products as $prod): ?>
                                <li><a href="prod.php?id=<?= $prod->id; ?>"><?= $prod->title; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>

            <li><a href="account.php">Личный кабинет</a></li>
            <li><a href="login.php">Войти</a></li>
            <li><a href="do_logout.php">Выйти</a></li>
        </ul>
<?php } ?>
