<?php 
require_once __DIR__.DIRECTORY_SEPARATOR.'storage.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'classes.php';

function create_menu($params) {

$page = $params['page'];
$products = $params['products'];
$user = getCurrentUser();

?>
        <h1 class="logo">Pets<span>SPA.</span></h1>
        <ul>
            <?php if ($page !== 'index'): ?>
                <li><a href="index.php">Главная</a></li>
            <?php endif; ?>

            <?php if ($page !== 'about'): ?>
                <li><a href="about.php">О нас</a></li>
            <?php endif; ?>

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

            <?php if ($page === 'account'): ?>

                <li><a href="do_logout.php">Выйти</a></li>

            <?php elseif ($user !== null): ?>
                <li><a href="#"><?= $user->name . ' (' . $user->login . ')'; ?><i class="fas fa-caret-down"></i></a>
                    <div class="dropdown__menu">
                        <ul>
                            <li><a href="account.php">Личный кабинет</a></li>
                            <li><a href="do_logout.php">Выйти</a></li>
                        </ul>
                    </div>
                </li>
            <?php elseif ($page !== 'login'): ?>
                <li><a href="login.php">Вход</a></li>
            <?php elseif ($page === 'login'): ?>
                <li><a href="register.php">Регистрация</a></li>
            <?php endif; ?>

        </ul>
<?php } ?>
