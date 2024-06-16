<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!

    session_start();
    require_once "../bd.php";
    $id = $_GET['id'];
    $product = mysqli_query($connection, "SELECT * FROM `t_products` where `id` = '$id'");
    $product = mysqli_fetch_assoc($product);
    
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

echo'<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Focal Point</title>
        <link rel="shortcut icon" href="images/shortcuticon.png" type="image/png">
        <link rel="stylesheet" href="styleUpdateProduct.css">
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
                                <?php endif; 
                            echo'</li>
                        </ul>
                    </div>
                </header>

                <p class="text">Изменение продукта</p>

                    <div class="content">

                        <div class="main-div">

                            <div class="addproduct">

                                 <form class="form-post" action="updateProducts.php" method="post" enctype="multipart/form-data">

                                    <input type="hidden" name="id" value="'.$product['id'] .'"> 

                                    <p>Тип продукта:
                                    <input type="radio" id="contactChoice1" name="type" value="Планшеты" checked>
                                    <label for="contactChoice1">Планшеты</label></p>

                                        <label for="model">Выберите производителя:</label>
                                        <select id="model" name="model" required>
                                            <option selected >'.$product['model'] .'</option>
                                            <option value="Xiaomi">Xiaomi</option>
                                            <option value="Samsung">Samsung</option>
                                            <option value="Lenovo">Lenovo</option>
                                            <option value="Honor">Honor</option>
                                            <option value="HP">HP</option>
                                            <option value="Apple">Apple</option>
                                            <option value="Huawei">Huawei</option>
                                        </select>

                                        <br><br>

                                        <input class="input-model-series" name="model_series" type="text" value="'.$product['model_series'] .'" size="40" required minlength="1" maxlength="32"placeholder="Серия модели пример: Galaxy TAB A7" style=" height: 18px;" ><br>
                                        <br>

                                        <input class="input-processor" name="processor" type="text" value="'.$product['processor'] .'" size="40" required minlength="1" maxlength="32"placeholder="Процессор пример: Mediatek" style=" height: 18px;" ><br>
                                        <br>

                                        <input class="input-processor-series" name="processor_series" type="text" value="'.$product['processor_series'] .'" size="40" required minlength="1" maxlength="32"placeholder="Введите серию пример: Xelio P22T" style=" height: 18px;" ><br>
                                        <br>

                                        <label for="type-camera">Камера в MP пример: 10</label>
                                        <input id="type-camera" class="type-camera" name="camera" type="number" value="'.$product['camera'] .'" required min="1" max="999">

                                        <br><br>

                                        <label for="material">Выберите материал корпуса:</label>
                                        <select id="material" name="material" required>
                                            <option selected >'.$product['material'] .'</option>
                                            <option value="Алюминий">Алюминий</option>
                                            <option value="Пластик">Пластик</option>
                                            <option value="Soft Touch">Soft Touch</option>
                                        </select>

                                        <br><br>

                                        <label for="ram">Выберите оперативную память:</label>
                                        <select id="ram" name="ram" required>
                                            <option selected >'.$product['ram'] .'</option>
                                            <option value="2 GB">2 GB</option>
                                            <option value="3 GB">3 GB</option>
                                            <option value="4 GB">4 GB</option>
                                            <option value="6 GB">6 GB</option>
                                            <option value="8 GB">8 GB</option>
                                            <option value="10 GB">10 GB</option>
                                            <option value="12 GB">12 GB</option>
                                        </select>

                                        <br><br>

                                        <label for="volum-drive">Выберите объём накопителя:</label>
                                        <select id="volum-drive" name="volum_drive" required>
                                            <option selected >'.$product['volum_drive'] .'</option>
                                            <option value="32 GB">32 GB</option>
                                            <option value="64 GB">64 GB</option>
                                            <option value="128 GB">128 GB</option>
                                            <option value="256 GB">256 GB</option>
                                            <option value="512 GB">512 GB</option>
                                            <option value="1 TB">1 TB</option>
                                        </select>

                                        <br><br>

                                        <label for="diagonal">Выберите диагональ экрана:</label>
                                        <select id="diagonal" name="diagonal" required>
                                            <option selected >'.$product['diagonal'] .'</option>
                                            <option value="8”">8”</option>
                                            <option value="8.7”">8.7”</option>
                                            <option value="10.1”">10.1”</option>
                                            <option value="10.3”">10.3”</option>
                                            <option value="10.4”">10.4”</option>
                                            <option value="10.5”">10.5”</option>
                                            <option value="10.6”">10.6”</option>
                                            <option value="11”">11”</option>
                                            <option value="11.5”">11.5”</option>
                                        </select>

                                        <br><br>

                                        <label for="resolution">Выберите разрешение экрана:</label>
                                        <select id="resolution" name="resolution" required>
                                            <option selected >'.$product['resolution'] .'</option>
                                            <option value="HD">HD</option>
                                            <option value="FHD">FHD</option>
                                            <option value="WXGA">WXGA</option>
                                            <option value="WUXGA">WUXGA</option>
                                            <option value="UHD">UHD</option>
                                            <option value="WQXGA">WQXGA</option>
                                        </select>

                                        <br><br>

                                        <label for="frequency">Выберите частоту экрана:</label>
                                        <select id="frequency" name="frequency" required>
                                            <option selected >'.$product['frequency'] .'</option>
                                            <option value="60 Hz">60 Hz</option>
                                            <option value="90 Hz">90 Hz</option>
                                            <option value="120 Hz">120 Hz</option>
                                            <option value="144 Hz">144 Hz</option>
                                        </select>

                                        <br><br>
                                        <input class="input-battery" name="battery" type="text" value="'.$product['battery'] .'" size="40" required minlength="1" maxlength="32"placeholder="Питание пример: Li-Ion 3-cell 48 Wh" style=" height: 18px;" ><br>
                                        <br>

                                        <label for="color">Выберите цвет:</label>
                                        <select id="color" name="color" required>
                                            <option selected >'.$product['color'] .'</option>
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
                                        <input id="price" class="input-price" name="price" type="number" value="'.$product['price'] .'" required min="1" max="999999">
                                        <br><br>

                                        <label for="quantity">Количество пример: 10</label>
                                        <input id="quantity" class="input-quantity" name="quantity" type="number" value="'.$product['quantity'] .'" required min="1" max="99">
                                        <br><br>
                                        
                                        <label for="warranty">Введите гарантию в месяцах пример: 12</label>
                                        <input id="warranty" class="input-warranty" name="warranty" type="number" value="'.$product['warranty'] .'" required min="1" max="30">
                                        <br><br>
                                        
                                        <label>Изображение продукта</label>
                                        <input type="file" name="image" >
                                        <br><br>

                                        <div class="btn">
                                            <input class="submitbtn" type="submit" name="submit-upd-T" value="Изменить продукт">
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