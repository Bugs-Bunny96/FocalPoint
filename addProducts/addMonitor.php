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
        <link rel="stylesheet" href="styleAddProduct.css">
        <link href="https://fonts.cdnfonts.com/css/frank-ruhl-libre" rel="stylesheet">
    </head>
    <body>
        <section class="first-screen">
            <div class="container">
                <header class="main-header">
                    <a href="main.php"><img src="images/logoimg.png" alt="Логотип компании FocalPoint" class="logo"></a>

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
                                $discount = $row['discount'];
                                $total = $row['total'];
                                    }
                                }
                            }

                         if ( $role === "role_admin") {
                            echo '<li class="main-menu-item"><a href="../orders/ordersPageExpect.php" class="main-menu-link">Заказы</a></li>';
                            }
                        
                    echo '
                        </ul>

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
                </header>

                    <p class="text">Добавление продукта</p>

                    <p class="text-select-type">Выберите тип добавляемого продукта</p>

                    <div class="content">

                        <div class="main-div">

                            <div clss="select-type">
                                <a class="select-type-link" href="addLaptop.php">Ноутбуки</a>
                                <a class="select-type-link" href="addTablet.php">Планшеты</a>
                                <a class="select-type-link" href="addSystemBlocks.php">Системные блоки</a>
                                <a class="select-type-link" href="addMonitor.php" style="color: #F3EAF3; font-size: 18px">Мониторы</a>
                            </div>

                            <div class="addproduct">

                                <form class="form-post" action="insertProducts.php" method="post" enctype="multipart/form-data">

                                    <p>Тип продукта:
                                    <input type="radio" id="contactChoice1" name="type" value="Мониторы" required>
                                    <label for="contactChoice1">Мониторы</label></p>

                                        <label for="model">Выберите производителя:</label>
                                        <select id="model" name="model" required>
                                            <option selected disabled hidden></option>
                                            <option value="Xiaomi">Xiaomi</option>
                                            <option value="Samsung">Samsung</option>
                                            <option value="HP">HP</option>
                                            <option value="LG">LG</option>
                                            <option value="Dell">Dell</option>
                                            <option value="Philips">Philips</option>
                                            <option value="BenQ">BenQ</option>
                                            <option value="MSI">MSI</option>  
                                        </select>

                                        <br><br>

                                        <label for="diagonal">Выберите диагональ экрана:</label>
                                        <select id="diagonal" name="diagonal" required>
                                            <option selected disabled hidden></option>
                                            <option value="21”">21”</option>
                                            <option value="22”">22”</option>
                                            <option value="24”">24”</option>
                                            <option value="27”">27”</option>
                                            <option value="29”">29”</option>
                                            <option value="31.5”">31.5”</option>
                                            <option value="32”">32”</option>
                                            <option value="34”">34”</option>
                                        </select>

                                        <br><br>

                                        <label for="resolution">Выберите разрешение экрана:</label>
                                        <select id="resolution" name="resolution" required>
                                            <option selected disabled hidden></option>
                                            <option value="FHD">FHD</option>
                                            <option value="WQHD">WQHD</option>
                                            <option value="2K QHD">2K QHD</option>
                                            <option value="3K UHD">3K UHD</option>
                                            <option value="4K UHD">4K UHD</option>
                                        </select>

                                        <br><br>

                                        <label for="type-screen">Выберите тип экрана:</label>
                                        <select id="type-screen" name="screen_type" required>
                                            <option selected disabled hidden></option>
                                            <option value="Плоский">Плоский</option>
                                            <option value="Изогнутый">Изогнутый</option>
                                        </select>

                                        <br><br>

                                        <label for="video">Выберите интерфейс:</label>
                                        <select id="video" name="video" required>
                                            <option selected disabled hidden></option>
                                            <option value="HDMI">HDMI</option>
                                        </select>

                                        <br><br>

                                        <label for="frequency">Выберите частоту экрана:</label>
                                        <select id="frequency" name="frequency" required>
                                            <option selected disabled hidden></option>
                                            <option value="60 Hz">60 Hz</option>
                                            <option value="75 Hz">75 Hz</option>
                                            <option value="90 Hz">90 Hz</option>
                                            <option value="120 Hz">120 Hz</option>
                                            <option value="144 Hz">144 Hz</option>
                                            <option value="165 Hz">165 Hz</option>
                                            <option value="240 Hz">240 Hz</option>
                                        </select>

                                        <br><br>
                                        
                                        <label for="speaker">Выберите колонки:</label>
                                        <select id="speaker" name="speaker" required>
                                            <option selected disabled hidden></option>
                                            <option value="Нет">Нет</option>
                                            <option value="Есть">Есть</option>
                                        </select>

                                        <br><br>

                                        <label for="color">Выберите цвет:</label>
                                        <select id="color" name="color" required>
                                            <option selected disabled hidden></option>
                                            <option value="Чёрный">Чёрный</option>
                                            <option value="Серый">Серый</option>
                                            <option value="Серебряный">Серебряный</option>
                                            <option value="Белый">Белый</option>
                                            <option value="Красный">Красный</option>
                                            <option value="Оранжево-красный">Оранжево-красный</option>
                                            <option value="Оранжевый">Оранжевый</option>
                                            <option value="Золотой">Золотой</option>
                                            <option value="Жёлтый">Жёлтый</option>
                                            <option value="Зелёный">Зелёный</option>
                                            <option value="Бирюзовый">Бирюзовый</option>
                                            <option value="Синий">Синий</option>
                                            <option value="Фиолетовый">Фиолетовый</option>
                                        </select>

                                        <br><br>
                                        
                                        <label for="price">Стоимость в леях пример: 15499</label>
                                        <input id="price" class="input-price" name="price" type="number" required min="1" max="999999">
                                        <br><br>

                                        <label for="quantity">Количество пример: 10</label>
                                        <input id="quantity" class="input-quantity" name="quantity" type="number" required min="1" max="99">
                                        <br><br>
                                        
                                        <label for="warranty">Введите гарантию в месяцах пример: 12</label>
                                        <input id="warranty" class="input-warranty" name="warranty" type="number" required min="1" max="30">
                                        <br><br>
                                        
                                        <label>Изображение продукта</label>
                                        <input required type="file" name="image" >
                                        <br><br>

                                        <div class="btn">
                                            <input class="submitbtn" type="submit" name="submit" value="Добавить продукт">
                                        </div>
                                        
                                </form>

                            </div>

                        </div>

                    </div>
            </div>
        </section>
    </body>
</html>';
}
?>