<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!

    session_start();
    require_once "bd.php";

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Focal Point</title>
        <link rel="shortcut icon" href="images/shortcuticon.png" type="image/png">
        <link rel="stylesheet" href="styleContact.css">
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
                            <?php 
                                
                                $id_user = $_SESSION['id'];
                                $query = "SELECT * FROM `t_users` WHERE id = '$id_user'";
                                $result = mysqli_query($connection, $query);
                                If ($result) {
                                    $num=mysqli_num_rows($result);
                                    if($num>0) {
    
                                while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
                                    $role = $row['role'];
                                    $discount = $row['discount'];
                                    $total = $row['total'];
                                        }
                                    }
                                }

                             if ( $role === "role_admin") {
                                echo '<li class="main-menu-item"><a href="orders/ordersPageExpect.php" class="main-menu-link">Заказы</a></li>';
                                }
                            ?>
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

                    <p class="text">Контакты</p>
                    <p  class="tagFP">Focal Point</p>
                    <div class="div-contact">
                        <div class="adres">
                            Адресс офиса: <br><br>
                            г.Кишинёв, <br>
                            ул.Пушкин 25 <br>
                        </div>
                        <div class="work">
                            Часы Работы: <br><br>
                            пн-пт с 9:00 до 20:00 <br>
                            сб-вс с 10:00 до 16:00 <br>
                        </div>
                    </div>

                    <div class="tel-class">
                        <img src="images/telicon.png" alt="иконка телефона" class="icon-tel"><a class="tel-num" href="tel:+37387546784"> +(373) 875-46-784 </a><br>
                        <img src="images/mailicon.png" alt="иконка E-mail" class="icon-mail"> info@FocalPoint.com
                    </div>

                    <div class="social-set">
                        <a href="https://www.instagram.com/"><img src="images/instagram.png" alt="иконка instagram" class="insta"></a>
                        <a href="https://www.facebook.com/"><img src="images/facebook.png" alt="иконка facebook" class="fb"></a>
                        <a href="https://www.twitter.com/"><img src="images/twitter.png" alt="иконка twitter" class="twit"></a>
                    </div>

            </div>
        </section>
    </body>
</html>