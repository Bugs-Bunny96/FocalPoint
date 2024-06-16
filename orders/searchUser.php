<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!

    session_start();
    require_once "../bd.php";
    
    $id_user = $_SESSION['id'];
    $query = "SELECT * FROM `t_users` WHERE id = '$id_user'";
    $result = mysqli_query($connection, $query);
    If ($result) {
        $num=mysqli_num_rows($result);
        if($num>0) {

    while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
        $role = $row['role'];
            }
        }
    }

    if ($role !== "role_admin") {
        echo 'Error: Http 403 Forbidden.';
    }else{
        echo '<!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="utf-8">
                <title>Focal Point</title>
                <link rel="shortcut icon" href="images/shortcuticon.png" type="image/png">
                <link rel="stylesheet" href="styleOrdersPage.css">
                <link href="https://fonts.cdnfonts.com/css/frank-ruhl-libre" rel="stylesheet">
            </head>
            <body>
                <section class="first-screen">
                    <div class="container">
                        <header class="main-header">
                            <a href="../main.php"><img src="images/logoimg.png" alt="Логотип компании Imperium" class="logo"></a>

                                <ul class="main-menu">
                                    <li class="main-menu-item"><a href="../main.php" class="main-menu-link">Главная</a></li>
                                    <li class="main-menu-item">
                                        <a class="main-menu-link">Компьютерная техника</a>
                                        <ul class="sub-menu">
                                        <li class="sub-menu_item">
                                                <form class="reset_filter_laptop" action="../products/resetFilter.php" method="POST">
                                                <a href=""><button class="sub-menu_item" name="reset_filter_btn" value="resetLaptop">Ноутбуки</button></a>
                                                </form>
                                        </li>
                                        <li class="sub-menu_item">
                                                <form class="reset_filter_tablet" action="../products/resetFilter.php" method="POST">
                                                <a href=""><button class="sub-menu_item" name="reset_filter_btn" value="resetTablet">Планшеты</button></a>
                                                </form>
                                        </li>
                                        <li class="sub-menu_item">
                                                <form class="reset_filter_systemBlocks" action="../products/resetFilter.php" method="POST">
                                                <a href=""><button class="sub-menu_item" name="reset_filter_btn" value="resetSystemBlocks">Системные блоки</button></a>
                                                </form>
                                        </li>
                                        <li class="sub-menu_item">
                                                <form class="reset_filter_monitor" action="../products/resetFilter.php" method="POST">
                                                <a href=""><button class="sub-menu_item" name="reset_filter_btn" value="resetMonitor">Мониторы</button></a>
                                                </form>
                                        </li>
                                    </ul>
                                    </li>
                                    <li class="main-menu-item"><a href="../contact.php" class="main-menu-link">Контакты</a></li>'?>
                                    <?php
                                        $id_user = $_SESSION['id'];
                                        $query = "SELECT * FROM `t_users` WHERE id = '$id_user'";
                                        $result = mysqli_query($connection, $query);
                                        If ($result) {
                                            $num=mysqli_num_rows($result);
                                            if($num>0) {
            
                                        while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
                                            $role = $row['role'];
                                                }
                                            }
                                        }
                                    
                                    if ( $role === "role_admin") {
                                        echo '<li class="main-menu-item"><a href="ordersPageExpect.php" class="main-menu-link">Заказы</a></li>';
                                        }
                                    ?>
                                    <?php
                                echo '</ul>

                            <div class="main-header-right">
                                <ul class="main-header-right-button">
                                    <li class="main-header-right-button-item"><a href="../cart.php" class="main-menu-link">Корзина</a></li>
                                    <li class="main-header-right-button-item"><a href="../userpage.php" class="main-menu-link">Профиль</a></li>'?>
                                        <?php if(!isset($_SESSION['id'])): ?>
                                            <li class="main-header-right-button-item"><a href="../aut.php" class="main-menu-link">Войти</a>
                                        <?php else: ?>
                                            <li class="main-header-right-button-item"><a href="../logout.php" class="main-menu-link">Выход</a>
                                        <?php endif; ?>
                                        <?php
                                    echo '</li>
                                </ul>
                            </div>
                        </header>';

                        echo'<p class="text">Поиск пользователя</p>
                        <form action="searchID.php" method="post">
                            <p class="search">Поиск пользователя
                            <input class="input-pole" type="number" name="id_user" required pattern="[1-9][0-9]*" min="1" max="99999" placeholder="Введите id пользователя">
                            <button name="search_btn" value="searchUser">Найти</button></p>
                        </form>';
                            ?>

                            <?php
                            session_start();
                            require_once "../bd.php";

                            if (isset($_GET["id_user"])) {
                                $id_user = $_GET["id_user"];

                                $query = "SELECT * FROM `t_users` WHERE id = '$id_user'";
                                $result = mysqli_query($connection, $query);

                                If ($result) {
                                    $num=mysqli_num_rows($result);
                                    if($num>0) {

                                while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
                                    echo'<div class="div-user">
                                        <div class="div-user-total">
                                            <div class="div-user-info">
                                                ID пользователя: <br>
                                                username: <br>
                                                Имя: <br>
                                                Фамилия: <br>
                                                Телефон: <br>
                                                Скидка: <br>
                                                Общая сумма: <br>
                                            </div>

                                            <div class="div-user-data">
                                            '.$row['id'].'<br>
                                            '.$row['username'].'<br>
                                            '.$row['first_name'].'<br>
                                            '.$row['last_name'].'<br>
                                            '.$row['tel'].'<br>
                                            '.$row['discount'].' %<br>
                                            '.$row['total'].' lei<br>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }else{
                                echo'<p class="textIDNotExist">Пользователь с данным ID не найден!</p>';
                            }
                            }
                            }
                echo'</section>
            </body>
        </html>';
    }
?>
