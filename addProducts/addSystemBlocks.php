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
                                <a class="select-type-link" href="addSystemBlocks.php" style="color: #F3EAF3; font-size: 18px">Системные блоки</a>
                                <a class="select-type-link" href="addMonitor.php">Мониторы</a>
                            </div>

                            <div class="addproduct">

                                <form class="form-post" action="insertProducts.php" method="post" enctype="multipart/form-data">

                                    <p>Тип продукта:
                                    <input type="radio" id="contactChoice1" name="type" value="Системные блоки" required>
                                    <label for="contactChoice1">Системные блоки</label></p>

                                        <input class="input-model" name="model" type="text" size="40" required minlength="1" maxlength="32"placeholder="Название комплекта пример: i5 или R3" style=" height: 18px;" ><br>
                                        <br>

                                        <label for="processor">Процессор:</label>
                                        <select id="processor" name="processor" required>
                                            <option selected disabled hidden></option>
                                            <option value="Intel Core">Intel Core</option>
                                            <option value="AMD">AMD</option>
                                        </select>

                                        <br><br>
                                        <input class="input-processor-series" name="processor_series" type="text" size="40" required minlength="1" maxlength="32"placeholder="Номер процессора пример: I5-11300" style=" height: 18px;" ><br>
                                        <br>

                                        <label for="type-video-card">Выберите тип видеокарты:</label>
                                        <select id="type-video-card" name="type_video_card" required>
                                            <option selected disabled hidden></option>
                                            <option value="Встроенная">Встроенная</option>
                                            <option value="Дискретная">Дискретная</option>
                                        </select>

                                        <br><br>

                                        <label for="video-card">Выберите видеокарту:</label>
                                        <select id="video-card" name="video_card" required>
                                            <option selected disabled hidden></option>
                                            <option value="GeForce">GeForce</option>
                                            <option value="AMD">AMD</option>
                                            <option value="Asus">Asus</option>
                                            <option value="Intel">Intel</option>
                                            <option value="MSI">MSI</option>
                                            <option value="Gigabyte">Gigabyte</option>
                                        </select>

                                        <br><br>
                                        <input class="input-video-card-series" name="video_card_series" type="text" size="40" required minlength="1" maxlength="32"placeholder="Серия видеокарты пример: RTX 2050" style=" height: 18px;" ><br>
                                        <br>

                                        <label for="ram">Выберите оперативную память:</label>
                                        <select id="ram" name="ram" required>
                                            <option selected disabled hidden></option>
                                            <option value="64 GB">64 GB</option>
                                            <option value="32 GB">32 GB</option>
                                            <option value="24 GB">24 GB</option>
                                            <option value="20 GB">20 GB</option>
                                            <option value="16 GB">16 GB</option>
                                            <option value="12 GB">12 GB</option>
                                            <option value="8 GB">8 GB</option>
                                        </select>

                                        <br><br>

                                        <label for="type-drive">Выберите тип накопителя:</label>
                                        <select id="type-drive" name="type_drive" required>
                                            <option selected disabled hidden></option>
                                            <option value="SSD">SSD</option>
                                            <option value="HDD">HDD</option>
                                        </select>

                                        <br><br>

                                        <label for="volum-drive">Выберите объём накопителя:</label>
                                        <select id="volum-drive" name="volum_drive" required>
                                            <option selected disabled hidden></option>
                                            <option value="128 GB">128 GB</option>
                                            <option value="256 GB">256 GB</option>
                                            <option value="512 GB">512 GB</option>
                                            <option value="1 TB">1 TB</option>
                                            <option value="2 TB">2 TB</option>
                                            <option value="4 TB">4 TB</option>
                                            <option value="8 TB">8 TB</option>
                                        </select>

                                        <br><br>

                                        <label for="port-lan">Выберите порт LAN:</label>
                                        <select id="port-lan" name="port_lan" required>
                                            <option selected disabled hidden></option>
                                            <option value="50 Mb">50 Mb</option>
                                            <option value="100 Mb">100 Mb</option>
                                            <option value="1 Gb">1 Gb</option>
                                            <option value="10 Gb">10 Gb</option>
                                        </select>

                                        <br><br>

                                        <label for="video">Выберите видео:</label>
                                        <select id="video" name="video" required>
                                            <option selected disabled hidden></option>
                                            <option value="HDMI">HDMI</option>
                                        </select>

                                        <br><br>

                                        <label for="color">Выберите цвет корпуса:</label>
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

                                        <label for="input-battery">Выберите мощность блока питания:</label>
                                        <select id="input-battery" name="battery" required>
                                            <option selected disabled hidden></option>
                                            <option value="400 W">400 W</option>
                                            <option value="450 W">450 W</option>
                                            <option value="500 W">500 W</option>
                                            <option value="550 W">550 W</option>
                                            <option value="600 W">600 W</option>
                                            <option value="650 W">650 W</option>
                                            <option value="700 W">700 W</option>
                                            <option value="750 W">750 W</option>
                                            <option value="800 W">800 W</option>
                                            <option value="850 W">850 W</option>
                                            <option value="900 W">900 W</option>
                                            <option value="950 W">950 W</option>
                                            <option value="1000 W">1000 W</option>
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