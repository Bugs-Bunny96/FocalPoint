<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!

    session_start();
    require_once "bd.php";


    $id_user = $_SESSION['id'];
    $query2 = "SELECT `role` FROM `t_users` WHERE id = '$id_user'";
    $result2 = mysqli_query($connection, $query2);
    If ($result2) {
        $num2=mysqli_num_rows($result2);
        if($num2>0) {
        while ($row2=mysqli_fetch_array($result2, MYSQLI_ASSOC)) { 
        $role = $row2['role'];
            }
        }
    }

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Focal Point</title>
        <link rel="shortcut icon" href="images/shortcuticon.png" type="image/png">
        <link rel="stylesheet" href="styleFP.css">
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

                    <p class="text">Главная</p>
                    <div class="div-tag-new"><p class="tagnew">Новинки</p></div>
                    

                        <?php
                            require_once "bd.php";
        
                            $query = 'SELECT * FROM `t_products` WHERE type = "Ноутбуки" ORDER BY id DESC LIMIT 1';

                            $result = mysqli_query($connection, $query);
                            
                            //$query15 = 'SELECT * FROM `t_products` a JOIN usertbl b ON a.user_id = b.id';
                            
                            //$result15 = mysqli_query($connection, $query15);
                            If ($result) {
                                $num=mysqli_num_rows($result);
                                if($num>0) {

                            while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
                                $numquant = $row['quantity'];
                                if($numquant<1){
                                    $row['quantity'] = 'Нет в наличии';
                                }else{
                                    $row['quantity'] = 'Есть в наличии';
                                }

                            echo '<div class="product">'.

                                '<div class="div-img WH">'.
                                    '<img src="data://image/jpeg;base64,'.base64_encode($row['image']).'">"'.
                                '</div>'.

                                '<div class="div-info">'.
                                    'Производитель:<br>'.
                                    'Серия:<br>'.
                                    'Процессор:<br>'.
                                    'Серия процессора:<br>'.
                                    'Тип видеокарты:<br>'.
                                    'Видеокарта:<br>'.
                                    'Серия видеокарты:<br>'.
                                    'Оперативная память:<br>'.
                                    'Тип накопителя:<br>'.
                                    'Объём накопителя:<br>'.
                                    'Диагональ:<br>'.
                                    'Разрешение:<br>'.
                                    'Питание:<br>'.
                                    'Стоимость:<br>'.
                                '</div>'.

                                '<div class="div-data">'.
                                    $row['model'] .'<br>'.
                                    $row['model_series'] .'<br>'.
                                    $row['processor'] .'<br>'.
                                    $row['processor_series'] .'<br>'.
                                    $row['type_video_card'] .'<br>'.
                                    $row['video_card'] .'<br>'.
                                    $row['video_card_series'] .'<br>'.
                                    $row['ram'] .'<br>'.
                                    $row['type_drive'] .'<br>'.
                                    $row['volum_drive'] .'<br>'.
                                    $row['diagonal'] .'<br>'.
                                    $row['resolution'] .'<br>'.
                                    $row['battery'] .'<br>'.
                                    $row['price'] .'<br>'.
                                '</div>'.

                                '<div class="div-up">'.
                                    'Наличие:&nbsp '.$row['quantity'].'<br>'.
                                    'Гарантия: '.$row['warranty'].'<br>'.
                                '</div>';

                                if (!isset($_SESSION['id'])) {
                                    echo '<p class="textIfEmpty">Для совершения покупок нужно зарегистрироваться или авторизироваться!</p>';
                                }else{
                                    if ($role === "role_admin") {
                                        echo'<div class="div-down">'.
                                                "<form class='div-del' action='products/deleteProduct.php' method='POST'>".'<br>'.
                                                '<a onclick="return confirm(\'Вы действительно хотите удалить продукт?\')">
                                                <button class="div-down-button" name="deleteBtn-L" value="' . $row['id'] . '">Удалить</button></a>'.
                                                '</form>'.
                                            '</div>'.

                                            '<div class="div-down1">'.
                                                '<a href="updateProducts/updateL.php?id='.$row['id'].'"><button class="div-down1-button" name="editBtn">Изменить</button></a>'.
                                            '</div>';
                                    }else{

                                    }

                                    if($numquant<1){
                                        echo "<p>Продукта нет в наличии :(</p>";
                                    }else{
                                        echo '<div class="div-down2">'.
                                        "<form class='div-insert-product-in-cart' action='products/insertProductInCart.php' method='POST'>".'<br>'.
                                        '<a >
                                        <input type="hidden" name="type" value="'.$row['type'].'">
                                        <input type="hidden" name="model" value="'.$row['model'].'">
                                        <input type="hidden" name="price" value="'.$row['price'].'">
                                        <input type="hidden" name="quantity" value="'.$numquant.'">
                                        <button class="button" name="id" value="' . $row['id'] . ' ">В корзину</button></a>'. 
                                        '</form>'.
                                    '</div>'.

                                    '<div class="div-down3">'.
                                        "<form class='div-insert-product-in-cart' action='products/insertProductInCart.php' method='POST'>".'<br>'.
                                        '<a >
                                        <input type="hidden" name="id" value="'.$row['id'].'">
                                        <input type="hidden" name="type" value="'.$row['type'].'">
                                        <input type="hidden" name="model" value="'.$row['model'].'">
                                        <input type="hidden" name="price" value="'.$row['price'].'">
                                        <input type="hidden" name="quantity" value="'.$numquant.'">
                                        <button class="button" name="buy" value="Купить">Купить</button></a>'. 
                                        '</form>'.
                                    '</div>';
                                    }
                                }
                                echo '</div>';
                                    }
                                }
                            }
                        ?>

                        <?php
                            require_once "bd.php";
        
                            $query = 'SELECT * FROM `t_products` WHERE type = "Планшеты" ORDER BY id DESC LIMIT 1';

                            $result = mysqli_query($connection, $query);
                            
                            //$query15 = 'SELECT * FROM `t_products` a JOIN usertbl b ON a.user_id = b.id';
                            
                            //$result15 = mysqli_query($connection, $query15);
                            If ($result) {
                                $num=mysqli_num_rows($result);
                                if($num>0) {

                            while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
                                $numquant = $row['quantity'];
                                if($numquant<1){
                                    $row['quantity'] = 'Нет в наличии';
                                }else{
                                    $row['quantity'] = 'Есть в наличии';
                                }

                            echo '<div class="product">'.

                                '<div class="div-img WH">'.
                                    '<img src="data://image/jpeg;base64,'.base64_encode($row['image']).'">"'.
                                '</div>'.

                                '<div class="div-info">'.
                                    'Производитель:<br>'.
                                    'Серия:<br>'.
                                    'Процессор:<br>'.
                                    'Серия процессора:<br>'.
                                    'Камера:<br>'.
                                    'Материал корпуса:<br>'.
                                    'Оперативная память:<br>'.
                                    'Объём накопителя:<br>'.
                                    'Диагональ:<br>'.
                                    'Разрешение::<br>'.
                                    'Частота:<br>'.
                                    'Аккумулятор:<br>'.
                                    'Цвет:<br>'.
                                    'Стоимость:<br>'.
                                '</div>'.

                                '<div class="div-data">'.
                                    $row['model'] .'<br>'.
                                    $row['model_series'] .'<br>'.
                                    $row['processor'] .'<br>'.
                                    $row['processor_series'] .'<br>'.
                                    $row['camera'] .'<br>'.
                                    $row['material'] .'<br>'.
                                    $row['ram'] .'<br>'.
                                    $row['volum_drive'] .'<br>'.
                                    $row['diagonal'] .'<br>'.
                                    $row['resolution'] .'<br>'.
                                    $row['frequency'] .'<br>'.
                                    $row['battery'] .'<br>'.
                                    $row['color'] .'<br>'.
                                    $row['price'] .'<br>'.
                                '</div>'.

                                '<div class="div-up">'.
                                    'Наличие:&nbsp '.$row['quantity'].'<br>'.
                                    'Гарантия: '.$row['warranty'].'<br>'.
                                '</div>';

                                if (!isset($_SESSION['id'])) {
                                    echo '<p class="textIfEmpty">Для совершения покупок нужно зарегистрироваться или авторизироваться!</p>';
                                }else{
                                    if ($role === "role_admin") {
                                        echo'<div class="div-down">'.
                                                "<form class='div-del' action='products/deleteProduct.php' method='POST'>".'<br>'.
                                                '<a onclick="return confirm(\'Вы действительно хотите удалить продукт?\')">
                                                <button class="div-down-button" name="deleteBtn-T" value="' . $row['id'] . '">Удалить</button></a>'.
                                                '</form>'.
                                            '</div>'.

                                            '<div class="div-down1">'.
                                                '<a href="updateProducts/updateL.php?id='.$row['id'].'"><button class="div-down1-button" name="editBtn">Изменить</button></a>'.
                                            '</div>';
                                    }else{

                                    }

                                    if($numquant<1){
                                        echo "<p>Продукта нет в наличии :(</p>";
                                    }else{
                                        echo '<div class="div-down2">'.
                                        "<form class='div-insert-product-in-cart' action='products/insertProductInCart.php' method='POST'>".'<br>'.
                                        '<a >
                                        <input type="hidden" name="type" value="'.$row['type'].'">
                                        <input type="hidden" name="model" value="'.$row['model'].'">
                                        <input type="hidden" name="price" value="'.$row['price'].'">
                                        <input type="hidden" name="quantity" value="'.$numquant.'">
                                        <button class="button" name="id" value="' . $row['id'] . ' ">В корзину</button></a>'. 
                                        '</form>'.
                                    '</div>'.

                                    '<div class="div-down3">'.
                                        "<form class='div-insert-product-in-cart' action='products/insertProductInCart.php' method='POST'>".'<br>'.
                                        '<a >
                                        <input type="hidden" name="id" value="'.$row['id'].'">
                                        <input type="hidden" name="type" value="'.$row['type'].'">
                                        <input type="hidden" name="model" value="'.$row['model'].'">
                                        <input type="hidden" name="price" value="'.$row['price'].'">
                                        <input type="hidden" name="quantity" value="'.$numquant.'">
                                        <button class="button" name="buy" value="Купить">Купить</button></a>'. 
                                        '</form>'.
                                    '</div>';
                                    }
                                }
                                echo '</div>';
                                    }
                                }
                            }
                        ?>

                        <?php
                            require_once "bd.php";
        
                            $query = 'SELECT * FROM `t_products` WHERE type = "Системные блоки" ORDER BY id DESC LIMIT 1';

                            $result = mysqli_query($connection, $query);
                            
                            //$query15 = 'SELECT * FROM `t_products` a JOIN usertbl b ON a.user_id = b.id';
                            
                            //$result15 = mysqli_query($connection, $query15);
                            If ($result) {
                                $num=mysqli_num_rows($result);
                                if($num>0) {

                            while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
                                $numquant = $row['quantity'];
                                if($numquant<1){
                                    $row['quantity'] = 'Нет в наличии';
                                }else{
                                    $row['quantity'] = 'Есть в наличии';
                                }

                            echo '<div class="product">'.

                                '<div class="div-img WH">'.
                                    '<img src="data://image/jpeg;base64,'.base64_encode($row['image']).'">"'.
                                '</div>'.

                                '<div class="div-info">'.
                                    'Комплект:<br>'.
                                    'Процессор:<br>'.
                                    'Серия процессора:<br>'.
                                    'Тип видеокарты:<br>'.
                                    'Видеокарта:<br>'.
                                    'Серия видеокарты:<br>'.
                                    'Оперативная память:<br>'.
                                    'Тип накопителя:<br>'.
                                    'Объём накопителя:<br>'.
                                    'Порт LAN:<br>'.
                                    'Видео:<br>'.
                                    'Цвет корпуса:<br>'.
                                    'Мощность:<br>'.
                                    'Стоимость:<br>'.
                                '</div>'.

                                '<div class="div-data">'.
                                    $row['model'] .'<br>'.
                                    $row['processor'] .'<br>'.
                                    $row['processor_series'] .'<br>'.
                                    $row['type_video_card'] .'<br>'.
                                    $row['video_card'] .'<br>'.
                                    $row['video_card_series'] .'<br>'.
                                    $row['ram'] .'<br>'.
                                    $row['type_drive'] .'<br>'.
                                    $row['volum_drive'] .'<br>'.
                                    $row['port_lan'] .'<br>'.
                                    $row['video'] .'<br>'.
                                    $row['color'] .'<br>'.
                                    $row['battery'] .'<br>'.
                                    $row['price'] .'<br>'.
                                '</div>'.

                                '<div class="div-up">'.
                                    'Наличие:&nbsp '.$row['quantity'].'<br>'.
                                    'Гарантия: '.$row['warranty'].'<br>'.
                                '</div>';

                                if (!isset($_SESSION['id'])) {
                                    echo '<p class="textIfEmpty">Для совершения покупок нужно зарегистрироваться или авторизироваться!</p>';
                                }else{
                                    if ($role === "role_admin") {
                                        echo'<div class="div-down">'.
                                                "<form class='div-del' action='products/deleteProduct.php' method='POST'>".'<br>'.
                                                '<a onclick="return confirm(\'Вы действительно хотите удалить продукт?\')">
                                                <button class="div-down-button" name="deleteBtn-SB" value="' . $row['id'] . '">Удалить</button></a>'.
                                                '</form>'.
                                            '</div>'.

                                            '<div class="div-down1">'.
                                                '<a href="updateProducts/updateL.php?id='.$row['id'].'"><button class="div-down1-button" name="editBtn">Изменить</button></a>'.
                                            '</div>';
                                    }else{

                                    }

                                    if($numquant<1){
                                        echo "<p>Продукта нет в наличии :(</p>";
                                    }else{
                                        echo '<div class="div-down2">'.
                                        "<form class='div-insert-product-in-cart' action='products/insertProductInCart.php' method='POST'>".'<br>'.
                                        '<a >
                                        <input type="hidden" name="type" value="'.$row['type'].'">
                                        <input type="hidden" name="model" value="'.$row['model'].'">
                                        <input type="hidden" name="price" value="'.$row['price'].'">
                                        <input type="hidden" name="quantity" value="'.$numquant.'">
                                        <button class="button" name="id" value="' . $row['id'] . ' ">В корзину</button></a>'. 
                                        '</form>'.
                                    '</div>'.

                                    '<div class="div-down3">'.
                                        "<form class='div-insert-product-in-cart' action='products/insertProductInCart.php' method='POST'>".'<br>'.
                                        '<a >
                                        <input type="hidden" name="id" value="'.$row['id'].'">
                                        <input type="hidden" name="type" value="'.$row['type'].'">
                                        <input type="hidden" name="model" value="'.$row['model'].'">
                                        <input type="hidden" name="price" value="'.$row['price'].'">
                                        <input type="hidden" name="quantity" value="'.$numquant.'">
                                        <button class="button" name="buy" value="Купить">Купить</button></a>'. 
                                        '</form>'.
                                    '</div>';
                                    }
                                }
                                echo '</div>';
                                    }
                                }
                            }
                        ?>

                        <?php
                            require_once "bd.php";
        
                            $query = 'SELECT * FROM `t_products` WHERE type = "Мониторы" ORDER BY id DESC LIMIT 1';

                            $result = mysqli_query($connection, $query);
                            
                            //$query15 = 'SELECT * FROM `t_products` a JOIN usertbl b ON a.user_id = b.id';
                            
                            //$result15 = mysqli_query($connection, $query15);
                            If ($result) {
                                $num=mysqli_num_rows($result);
                                if($num>0) {

                            while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
                                $numquant = $row['quantity'];
                                if($numquant<1){
                                    $row['quantity'] = 'Нет в наличии';
                                }else{
                                    $row['quantity'] = 'Есть в наличии';
                                }

                            echo '<div class="product">'.

                                '<div class="div-img WH">'.
                                    '<img src="data://image/jpeg;base64,'.base64_encode($row['image']).'">"'.
                                '</div>'.

                                '<div class="div-info">'.
                                    'Модель:<br>'.
                                    'Диагональ:<br>'.
                                    'Разрешение:<br>'.
                                    'Тип экрана:<br>'.
                                    'Интерфейс:<br>'.
                                    'Частота обновления:<br>'.
                                    'Колонки:<br>'.
                                    'Цвет:<br>'.
                                    'Стоимость:<br>'.
                                '</div>'.

                                '<div class="div-data">'.
                                    $row['model'] .'<br>'.
                                    $row['diagonal'] .'<br>'.
                                    $row['resolution'] .'<br>'.
                                    $row['screen_type'] .'<br>'.
                                    $row['video'] .'<br>'.
                                    $row['frequency'] .'<br>'.
                                    $row['speaker'] .'<br>'.
                                    $row['color'] .'<br>'.
                                    $row['price'] .'<br>'.
                                '</div>'.

                                '<div class="div-up">'.
                                    'Наличие:&nbsp '.$row['quantity'].'<br>'.
                                    'Гарантия: '.$row['warranty'].'<br>'.
                                '</div>';

                                if (!isset($_SESSION['id'])) {
                                    echo '<p class="textIfEmpty">Для совершения покупок нужно зарегистрироваться или авторизироваться!</p>';
                                }else{
                                    if ($role === "role_admin") {
                                        echo'<div class="div-down">'.
                                                "<form class='div-del' action='products/deleteProduct.php' method='POST'>".'<br>'.
                                                '<a onclick="return confirm(\'Вы действительно хотите удалить продукт?\')">
                                                <button class="div-down-button" name="deleteBtn-M" value="' . $row['id'] . '">Удалить</button></a>'.
                                                '</form>'.
                                            '</div>'.

                                            '<div class="div-down1">'.
                                                '<a href="updateProducts/updateL.php?id='.$row['id'].'"><button class="div-down1-button" name="editBtn">Изменить</button></a>'.
                                            '</div>';
                                    }else{

                                    }

                                    if($numquant<1){
                                        echo "<p>Продукта нет в наличии :(</p>";
                                    }else{
                                        echo '<div class="div-down2">'.
                                        "<form class='div-insert-product-in-cart' action='products/insertProductInCart.php' method='POST'>".'<br>'.
                                        '<a >
                                        <input type="hidden" name="type" value="'.$row['type'].'">
                                        <input type="hidden" name="model" value="'.$row['model'].'">
                                        <input type="hidden" name="price" value="'.$row['price'].'">
                                        <input type="hidden" name="quantity" value="'.$numquant.'">
                                        <button class="button" name="id" value="' . $row['id'] . ' ">В корзину</button></a>'. 
                                        '</form>'.
                                    '</div>'.

                                    '<div class="div-down3">'.
                                        "<form class='div-insert-product-in-cart' action='products/insertProductInCart.php' method='POST'>".'<br>'.
                                        '<a >
                                        <input type="hidden" name="id" value="'.$row['id'].'">
                                        <input type="hidden" name="type" value="'.$row['type'].'">
                                        <input type="hidden" name="model" value="'.$row['model'].'">
                                        <input type="hidden" name="price" value="'.$row['price'].'">
                                        <input type="hidden" name="quantity" value="'.$numquant.'">
                                        <button class="button" name="buy" value="Купить">Купить</button></a>'. 
                                        '</form>'.
                                    '</div>';
                                    }
                                }
                                echo '</div>';
                                    }
                                }
                            }
                        ?>

            </div>

        </section>
    </body>
</html>