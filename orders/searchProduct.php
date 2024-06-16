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

                        echo'<p class="text">Поиск продукта</p>
                        <form action="searchID.php" method="post">
                        <p class="search">Поиск продукта
                        <input class="input-pole" type="number" name="id_product" required pattern="[1-9][0-9]*" min="1" max="99999" placeholder="Введите id продукта">
                        <button name="search_btn" value="searchProduct">Найти</button></p>
                        </form>';
                            ?>

                            <?php
                            session_start();
                            require_once "../bd.php";

                            if (isset($_GET["id_product"])) {
                                $id_product = $_GET["id_product"];

                                $query = "SELECT * FROM `t_products` WHERE id = '$id_product'";
                                $result = mysqli_query($connection, $query);

                                If ($result) {
                                    $num=mysqli_num_rows($result);
                                    if($num>0) {

                                while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) { 

                                    echo '<div class="product">'.

                                        '<div class="div-img WH">'.
                                            '<img src="data://image/jpeg;base64,'.base64_encode($row['image']).'">"'.
                                        '</div>'.
                                        
                                        '<div class="div-total-info">';
                                            if (!empty($row['id'])) {
                                                echo '<div class="div-container"> <p class="div-info">ID: </p> <p class="div-data">'.$row['id'] .'</p></div>';
                                            }
                                            if (!empty($row['type'])) {
                                                echo '<div class="div-container"> <p class="div-info">Тип продукта: </p> <p class="div-data">'.$row['type'] .'</p></div>';
                                            }
                                            if (!empty($row['model'])) {
                                                echo '<div class="div-container"> <p class="div-info">Производитель: </p> <p class="div-data">'.$row['model'] .'</p></div>';
                                            }
                                            if (!empty($row['model_series'])) {
                                                echo '<div class="div-container"> <p class="div-info">Серия: </p> <p class="div-data">'.$row['model_series'] .'</p></div>';
                                            }
                                            if (!empty($row['processor'])) {
                                                echo '<div class="div-container"> <p class="div-info">Процессор: </p> <p class="div-data">'.$row['processor'] .'</p></div>';
                                            }
                                            if (!empty($row['processor_series'])) {
                                                echo '<div class="div-container"> <p class="div-info">Серия процессора: </p> <p class="div-data">'.$row['processor_series'] .'</p></div>';
                                            }
                                            if (!empty($row['type_video_card'])) {
                                                echo '<div class="div-container"> <p class="div-info">Тип видеокарты: </p> <p class="div-data">'.$row['type_video_card'] .'</p></div>';
                                            }
                                            if (!empty($row['video_card'])) {
                                                echo '<div class="div-container"> <p class="div-info">Видеокарта: </p> <p class="div-data">'.$row['video_card'] .'</p></div>';
                                            }
                                            if (!empty($row['video_card_series'])) {
                                                echo '<div class="div-container"> <p class="div-info">Серия видеокарты: </p> <p class="div-data">'.$row['video_card_series'] .'</p></div>';
                                            }
                                            if (!empty($row['ram'])) {
                                                echo '<div class="div-container"> <p class="div-info">Оперативная память: </p> <p class="div-data">'.$row['ram'] .'</p></div>';
                                            }
                                            if (!empty($row['type_drive'])) {
                                                echo '<div class="div-container"> <p class="div-info">Тип накопителя: </p> <p class="div-data">'.$row['type_drive'] .'</p></div>';
                                            }
                                            if (!empty($row['volum_drive'])) {
                                                echo '<div class="div-container"> <p class="div-info">Объём накопителя: </p> <p class="div-data">'.$row['volum_drive'] .'</p></div>';
                                            }
                                            if (!empty($row['diagonal'])) {
                                                echo '<div class="div-container"> <p class="div-info">Диагональ: </p> <p class="div-data">'.$row['diagonal'] .'</p></div>';
                                            }
                                            if (!empty($row['resolution'])) {
                                                echo '<div class="div-container"> <p class="div-info">Разрешение: </p> <p class="div-data">'.$row['resolution'] .'</p></div>';
                                            }
                                            if (!empty($row['frequency'])) {
                                                echo '<div class="div-container"> <p class="div-info">Частота: </p> <p class="div-data">'.$row['frequency'] .'</p></div>';
                                            }
                                            if (!empty($row['battery'])) {
                                                echo '<div class="div-container"> <p class="div-info">Батарея: </p> <p class="div-data">'.$row['battery'] .'</p></div>';
                                            }
                                            if (!empty($row['video'])) {
                                                echo '<div class="div-container"> <p class="div-info">Видео: </p> <p class="div-data">'.$row['video'] .'</p></div>';
                                            }
                                            if (!empty($row['color'])) {
                                                echo '<div class="div-container"> <p class="div-info">Цвет: </p> <p class="div-data">'.$row['color'] .'</p></div>';
                                            }
                                            if (!empty($row['screen_type'])) {
                                                echo '<div class="div-container"> <p class="div-info">Тип экрана: </p> <p class="div-data">'.$row['screen_type'] .'</p></div>';
                                            }
                                            if (!empty($row['port_lan'])) {
                                                echo '<div class="div-container"> <p class="div-info">Порт LAN: </p> <p class="div-data">'.$row['port_lan'] .'</p></div>';
                                            }
                                            if (!empty($row['speaker'])) {
                                                echo '<div class="div-container"> <p class="div-info">Колонки: </p> <p class="div-data">'.$row['speaker'] .'</p></div>';
                                            }
                                            if (!empty($row['camera'])) {
                                                echo '<div class="div-container"> <p class="div-info">Камера: </p> <p class="div-data">'.$row['camera'] .'</p></div>';
                                            }
                                            if (!empty($row['material'])) {
                                                echo '<div class="div-container"> <p class="div-info">Материал: </p> <p class="div-data">'.$row['material'] .'</p></div>';
                                            }
                                            if (!empty($row['price'])) {
                                                echo '<div class="div-container"> <p class="div-info">Цена: </p> <p class="div-data">'.$row['price'] .' lei</p></div>';
                                            }
                                        '</div>';
                                    echo'</div>';    
                                    echo '<div class="div-up">'.
                                    'Наличие:&nbsp '.$row['quantity'].'<br>'.
                                    'Гарантия: '.$row['warranty'].'<br>'.
                                    '</div>';

                                }
                            }else{
                                echo'<p class="textIDNotExist">Продукта с данным ID не существует!</p>';
                            }
                        }

                            } else {
                                echo "Данные не передавались";
                            }
                            ?>

                        <?php
                    echo '</div>
                </section>
            </body>
        </html>';
    }
?>