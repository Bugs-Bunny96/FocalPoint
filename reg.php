<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!

    session_start();
    if (!isset($_SESSION['t_users'])) {

    }

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Focal Point</title>
        <link rel="shortcut icon" href="images/shortcuticon.png" type="image/png">
        <link rel="stylesheet" href="styleLogin.css">
        <link href="https://fonts.cdnfonts.com/css/frank-ruhl-libre" rel="stylesheet">
    </head>
    <body>
        <section class="first-screen">
            <div class="container">
                <header class="main-header">
                    <a href="main.php"><img src="images/logoimg.png" alt="Логотип компании FocalPoint" class="logo"></a>

                        <ul class="main-menu">
                            <li class="main-menu-item"><a href="main.php" class="main-menu-link">Главная</a></li>
                            <li class="main-menu-item">
                                <a class="main-menu-link">Компьютерная техника</a>
                                <ul class="sub-menu">
                                    <li class="sub-menu_item">
                                        <?php
                                            echo '<form class="reset_filter_laptop" action="products/resetFilter.php" method="POST">'.
                                            '<a href=""><button class="sub-menu_item" name="reset_filter_btn" value="resetLaptop">Ноутбуки</button></a>'.
                                            '</form>';
                                        ?>
                                    </li>
                                    <li class="sub-menu_item">
                                        <?php
                                            echo '<form class="reset_filter_tablet" action="products/resetFilter.php" method="POST">'.
                                            '<a href=""><button class="sub-menu_item" name="reset_filter_btn" value="resetTablet">Планшеты</button></a>'.
                                            '</form>';
                                        ?>
                                    </li>
                                    <li class="sub-menu_item">
                                        <?php
                                            echo '<form class="reset_filter_systemBlocks" action="products/resetFilter.php" method="POST">'.
                                            '<a href=""><button class="sub-menu_item" name="reset_filter_btn" value="resetSystemBlocks">Системные блоки</button></a>'.
                                            '</form>';
                                        ?>
                                    </li>
                                    <li class="sub-menu_item">
                                        <?php
                                            echo '<form class="reset_filter_monitor" action="products/resetFilter.php" method="POST">'.
                                            '<a href=""><button class="sub-menu_item" name="reset_filter_btn" value="resetMonitor">Мониторы</button></a>'.
                                            '</form>';
                                        ?>
                                    </li>
                                </ul>
                            </li>
                            <li class="main-menu-item"><a href="contact.php" class="main-menu-link">Контакты</a></li>
                        </ul>

                    <div class="main-header-right">
                        <ul class="main-header-right-button">
                            <li class="main-header-right-button-item"><a href="cart.php" class="main-menu-link">Корзина</a></li>
                            <li class="main-header-right-button-item"><a href="userpage.php" class="main-menu-link">Профиль</a></li>
                                <?php if(!isset($_SESSION['id'])): ?>
                                    <li class="main-header-right-button-item"><a href="aut.php" class="main-menu-link">Войти</a>
                                <?php else: ?>
                                    <li class="main-header-right-button-item"><a href="logout.php" class="main-menu-link">Выход</a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </header>

                <div class="autCont">
                    <div class= "autPage" style="padding-top: 1px; padding-bottom: 28px;">
                        <p class="textFPautpage">Focal Point</p>
                        
                        <p class="aut-reg">
                        <a class="aut-link" href='aut.php'>ВХОД</a>
                        <a class="reg-link" href='reg.php' style="color: #000000; font-size: 24px;">РЕГИСТРАЦИЯ</a>
                        </p>

                        <form action="save_user.php" method="post">
                        <!--**** save_user.php - это адрес обработчика.  То есть, после нажатия на кнопку "Зарегистрироваться", данные из полей  отправятся на страничку save_user.php методом "post" ***** -->
                        <p class="input-board">
                            <div class="fio">
                            <input class="input-first-name" name="first_name" type="text" size="20" required pattern="(?=.*[a-zа-яё])(?=.*[A-ZА-ЯЁ]).{2,}" title="Должен содержать по меньшей мере одну большую и одну маленькую буквы латинского алфавита или кириллицы, и быть в длину не менее 2 символов" minlength="2" maxlength="32" placeholder="Введите имя" style=" height: 27px;" ><br>
                            <input class="input-last-name" name="last_name" type="text" size="20" required pattern="(?=.*[a-zа-яё])(?=.*[A-ZА-ЯЁ]).{2,}" title="Должен содержать по меньшей мере одну большую и одну маленькую буквы латинского алфавита или кириллицы, и быть в длину не менее 2 символов" minlength="2" maxlength="32" placeholder="Введите фамилию" style=" height: 27px;" ><br>
                            </div>
                            <br>
                            <input class="input-log" name="username" type="text" size="20" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Должен содержать по меньшей мере одну цифру, одну большую и одну маленькую буквы латинского алфавита и быть в длину не менее 8 символов" minlength="8" maxlength="32" placeholder="Введите логин" style=" height: 27px;" ><br>
                            <input class="input-pas" name="password" type="password" size="20" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Должен содержать по меньшей мере одну цифру, одну большую и одну маленькую буквы латинского алфавита и быть в длину не менее 8 символов" minlength="6" maxlength="32" placeholder="Введите пароль" style=" height: 27px;" ><br>
                            <input class="input-pas-confirm" name="password_confirm" type="password" size="20" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Должен содержать по меньшей мере одну цифру, одну большую и одну маленькую буквы латинского алфавита и быть в длину не менее 8 символов" minlength="6" maxlength="32" placeholder="Подтверждение пароля" style=" height: 27px;" ><br>
                            <input class="input-tel" name="tel" type="text" size="20" required pattern="([6-7]{1})([0-9]{7})" title="Должен содержать только цифры, первая цифра должна быть (6 или 7) и быть в длину не менее 8 цифр" minlength="8" maxlength="8" placeholder="Введите номер телефона" style=" height: 27px;" ><br>
                        </p>
                            <p>
                                <input class="submitbtn" type="submit" name="submit" value="Войти">
                            </p>
                        </form>
                    </div>
                </div>
                        
            </div>

        </section>
    </body>
</html>