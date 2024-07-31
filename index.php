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
                        <li><a href="#">Для кошек</a></li>
                        <li><a href="#">Для собак</a></li>
                        <li><a href="#">Прочее</a></li>
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
            <div class="card">
                <img src="./assets/images/prod_1.jpeg" alt="Терапия водой">
                <div class="card-content">
                    <h3>Купание</h3>
                    <p>Это одна из самых распространенных спа-процедур для животных. Купание помогает убрать грязь и запахи с шерсти животного, а также улучшить состояние его кожи и шерсти.</p>
                    <!-- <a href="#" class="btn">Узнать больше</a> -->
                </div>
            </div>

            <div class="card">
                <img src="./assets/images/prod_2.jpeg" alt="Ароматерапия">
                <div class="card-content">
                    <h3>Ароматерапия</h3>
                    <p>Использует ароматические масла для создания расслабляющей атмосферы для животного. Может быть полезна для снятия стресса и напряжения.</p>
                    <!-- <a href="#" class="btn">Узнать больше</a> -->
                </div>
            </div>

            <div class="card">
                <img src="./assets/images/prod_3.jpeg" alt="Готовые рационы">
                <div class="card-content">
                    <h3>Готовые рационы</h3>
                    <p>Наши специалисты подберут сбалансированные рационы для ваших питомцев, с учётом возраста, веса и темперамента.</p>
                    <!-- <a href="#" class="btn">Узнать больше</a> -->
                </div>
            </div>

            <div class="card">
                <!-- <img src="./assets/images/prod_5.png" alt="Готовые рационы"> -->
                <div class="card-content">
                    <h3>Терапия водой</h3>
                    <p>Может улучшить состояние кожи и шерсти животного, а также снять стресс и напряжение.</p>
                    <!-- <a href="#" class="btn">Узнать больше</a> -->
                </div>
            </div>

            <div class="card">
                <!-- <img src="./assets/images/prod_5.png" alt="Готовые рационы"> -->
                <div class="card-content">
                    <h3>Стрижка</h3>
                    <p>Позволяет поддерживать определенную длину и форму шерсти животного. Стрижка может быть полезна для пород собак, которые имеют густую и длинную шерсть.</p>
                    <!-- <a href="#" class="btn">Узнать больше</a> -->
                </div>
            </div>

            <div class="card">
                <!-- <img src="./assets/images/prod_5.png" alt="Готовые рационы"> -->
                <div class="card-content">
                    <h3>Массаж</h3>
                    <p>Может улучшить кровообращение и снять напряжение у животных. Массаж может быть особенно полезен для животных, которые страдают от боли в мышцах и суставах.</p>
                    <!-- <a href="#" class="btn">Узнать больше</a> -->
                </div>
            </div>

            <div class="card">
                <!-- <img src="./assets/images/prod_5.png" alt="Готовые рационы"> -->
                <div class="card-content">
                    <h3>Чистка зубов</h3>
                    <p>Направлена на удаление зубного налета и предотвращение развития заболеваний полости рта у животных.</p>
                    <!-- <a href="#" class="btn">Узнать больше</a> -->
                </div>
            </div>

            <div class="card">
                <!-- <img src="./assets/images/prod_5.png" alt="Готовые рационы"> -->
                <div class="card-content">
                    <h3>Груминг сушка</h3>
                    <p>Камера для сушки шерсти - это специальное устройство, которое используется для быстрой и эффективной сушки домашних питомцев после купания и груминг-процедур.</p>
                    <!-- <a href="#" class="btn">Узнать больше</a> -->
                </div>
            </div>

            <div class="card">
                <!-- <img src="./assets/images/prod_5.png" alt="Готовые рационы"> -->
                <div class="card-content">
                    <h3>Аква-терапия</h3>
                    <p>Проводится в специальном бассейне и направлена на улучшение здоровья и физической формы животного. Аква-терапия может быть особенно полезна для животных, которые страдают от боли в суставах или имеют проблемы со здоровьем кожи и шерсти.</p>
                    <!-- <a href="#" class="btn">Узнать больше</a> -->
                </div>
            </div>

        </div>


        <div class="footer">
            <div class="copyright">
                &copy;&nbsp;<a href="https://github.com/Vlad-Miroshin">Владислав Мирошин</a>, 2024. Поток PHPPRO_22 <a href="https://skillfactory.ru/">Skillfactory</a>.
            </div>
        </div>
    </main>

</body>
</html>