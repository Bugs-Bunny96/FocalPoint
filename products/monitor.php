<?php
    session_start();
    require_once "../bd.php";

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
        <link rel="stylesheet" href="styleCompEquip.css">
        <link href="https://fonts.cdnfonts.com/css/frank-ruhl-libre" rel="stylesheet">
        <script> 
            function changeClass(event) {
                const targetId = event.target.dataset.target;
                const icon = event.target.querySelector("i");
                const content = document.getElementById(targetId);

                if (icon && content) {
                    if (content.classList.contains("js-filter-content-hidden")) {
                    content.classList.remove("js-filter-content-hidden");
                    icon.classList.replace("down", "up");
                    } else {
                    content.classList.add("js-filter-content-hidden");
                    icon.classList.replace("up", "down");
                    }
                }
            }
        </script>
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
                                        <?php
                                            echo '<form class="reset_filter_laptop" action="resetFilter.php" method="POST">'.
                                            '<a href=""><button class="sub-menu_item" name="reset_filter_btn" value="resetLaptop">Ноутбуки</button></a>'.
                                            '</form>';
                                        ?>
                                    </li>
                                    <li class="sub-menu_item">
                                        <?php
                                            echo '<form class="reset_filter_tablet" action="resetFilter.php" method="POST">'.
                                            '<a href=""><button class="sub-menu_item" name="reset_filter_btn" value="resetTablet">Планшеты</button></a>'.
                                            '</form>';
                                        ?>
                                    </li>
                                    <li class="sub-menu_item">
                                        <?php
                                            echo '<form class="reset_filter_systemBlocks" action="resetFilter.php" method="POST">'.
                                            '<a href=""><button class="sub-menu_item" name="reset_filter_btn" value="resetSystemBlocks">Системные блоки</button></a>'.
                                            '</form>';
                                        ?>
                                    </li>
                                    <li class="sub-menu_item">
                                        <?php
                                            echo '<form class="reset_filter_monitor" action="resetFilter.php" method="POST">'.
                                            '<a href=""><button class="sub-menu_item" name="reset_filter_btn" value="resetMonitor">Мониторы</button></a>'.
                                            '</form>';
                                        ?>
                                    </li>
                                </ul>
                            </li>
                            <li class="main-menu-item"><a href="../contact.php" class="main-menu-link">Контакты</a></li>
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
                            ?>
                        </ul>

                    <div class="main-header-right">
                        <ul class="main-header-right-button">
                            <li class="main-header-right-button-item"><a href="../cart.php" class="main-menu-link">Корзина</a></li>
                            <li class="main-header-right-button-item"><a href="../userpage.php" class="main-menu-link">Профиль</a></li>
                                <?php if(!isset($_SESSION['id'])): ?>
                                    <li class="main-header-right-button-item"><a href="../aut.php" class="main-menu-link">Войти</a>
                                <?php else: ?>
                                    <li class="main-header-right-button-item"><a href="../logout.php" class="main-menu-link">Выход</a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </header>

                    <p class="text">Мониторы</p>

                <div class="break">

                    <div class="sort">
                        <div class="sortContent">

                            <p class="textFilterM">Фильтры</p>

                            <p class="line"></p>

                            <form method="POST" action='filters/filtersMonitor.php'>
                                <?php
                                // нужно для подсчёта остатка продукта по выбраным критериям 
                                    $model = !empty($_GET['manufacturer']) ? explode(',', $_GET['manufacturer']) : array('Xiaomi', 'Samsung', 'HP', 'LG', 'Dell', 'Philips', 'BenQ', 'MSI');
                                    $diagonal = !empty($_GET['diagonal']) ? explode(',', $_GET['diagonal']) : array('21”', '22”', '24”', '27”', '29”', '31.5”', '32”', '34”');
                                    $resolution = !empty($_GET['resolution']) ? explode(',', $_GET['resolution']) : array('FHD', 'WQHD', '2K QHD', '3K UHD', '4K UHD');
                                    $screen_type = !empty($_GET['screen_type']) ? explode(',', $_GET['screen_type']) : array('Плоский', 'Изогнутый');
                                    $frequency = !empty($_GET['frequency']) ? explode(',', $_GET['frequency']) : array('60 Hz', '75 Hz', '90 Hz', '120 Hz', '144 Hz', '165 Hz', '240 Hz');
                                    $speaker = !empty($_GET['speaker']) ? explode(',', $_GET['speaker']) : array('Есть', 'Нет');
                                ?>

                                <div id="filter-container">
                                    <p class="textFilter" data-target="js-filter-content1" onclick="changeClass(event)">Производитель &nbsp<i id="js-filter-icon-down1" class="up"></i></p>
                                    <div class="div-close-filter">
                                        <div id="js-filter-content1">
                                            <ul class="filter-list">
                                                <?php
                                                    if (isset($_GET['manufacturer'])) {
                                                        $manufacturer_values = explode(',', $_GET['manufacturer']);
                                                        //print_r($type_video_card_values);
                                                    } else {
                                                        $manufacturer_values = array('d');
                                                        //echo "Массив type_video_card не был передан или содержит недопустимые данные";
                                                    }

                                                    $options = array(
                                                        'Xiaomi' => 'manufacturerChoice1',
                                                        'Samsung' => 'manufacturerChoice2',
                                                        'HP' => 'manufacturerChoice3',
                                                        'LG' => 'manufacturerChoice4',
                                                        'Dell' => 'manufacturerChoice5',
                                                        'Philips' => 'manufacturerChoice6',
                                                        'BenQ' => 'manufacturerChoice7',
                                                        'MSI' => 'manufacturerChoice8'
                                                    );

                                                    foreach ($options as $option => $id) {
                                                        $query = "SELECT COUNT(model) AS quant FROM `t_products` WHERE type = 'Мониторы' AND model = '$option' 
                                                        AND diagonal IN ('" . implode("', '", $diagonal) . "') AND resolution IN ('" . implode("', '", $resolution) . "')
                                                        AND screen_type IN ('" . implode("', '", $screen_type) . "') AND frequency IN ('" . implode("', '", $frequency) . "')
                                                        AND speaker IN ('" . implode("', '", $speaker) . "')";

                                                        $result = mysqli_query($connection, $query);

                                                        if ($result && mysqli_num_rows($result) > 0) {
                                                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                                            $quant = $row['quant'];
                                                        } else {
                                                            $quant = 0;
                                                        }

                                                        $class = ($quant > 0) ? "" : "disabled";
                                                        $label_style = "color: palegreen;";
                                                        $p_style = "margin: 0px 5px; color: palegreen;";

                                                        if ($quant == 0) {
                                                            $label_style .= " opacity: 0.5;";
                                                            $p_style .= " opacity: 0.5;";
                                                        }

                                                        echo '<li class="filter-item '.$class.'">
                                                        <input type="checkbox" id="'.$id.'" name="manufacturer[]" value="'.$option.'" '.(in_array($option, $manufacturer_values) ? 'checked' : '').($quant > 0 ? '' : 'disabled').'>
                                                                <label for="'.$id.'" style="'.$label_style.'">'.$option.'</label> 
                                                                <p style="'.$p_style.'">('. $quant .')</p> 
                                                            </li>';
                                                    }

                                                    echo '<script>
                                                    document.querySelectorAll(\'input[type=checkbox]\').forEach(function(input) {
                                                    input.addEventListener(\'click\', function() {
                                                        if (!this.checked) {
                                                        this.removeAttribute(\'checked\');
                                                        } else if (!this.hasAttribute(\'checked\')) {
                                                            this.setAttribute(\'checked\', \'\');
                                                        }
                                                    });
                                                    });
                                                    </script>'; 
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <p class="textFilter" data-target="js-filter-content2" onclick="changeClass(event)">Диагональ &nbsp<i id="js-filter-icon-down2" class="up"></i></p>
                                    <div class="div-close-filter">
                                        <div id="js-filter-content2">
                                            <ul class="filter-list">
                                                <?php
                                                    if (isset($_GET['diagonal'])) {
                                                        $diagonal_values = explode(',', $_GET['diagonal']);
                                                        //print_r($type_video_card_values);
                                                    } else {
                                                        $diagonal_values = array('d');
                                                        //echo "Массив type_video_card не был передан или содержит недопустимые данные";
                                                    }

                                                    $options = array(
                                                        '21”' => 'diagonalChoice1',
                                                        '22”' => 'diagonalChoice2',
                                                        '24”' => 'diagonalChoice3',
                                                        '27”' => 'diagonalChoice4',
                                                        '29”' => 'diagonalChoice5',
                                                        '31.5”' => 'diagonalChoice6',
                                                        '32”' => 'diagonalChoice7',
                                                        '34”' => 'diagonalChoice8'
                                                    );

                                                    foreach ($options as $option => $id) {
                                                        $query = "SELECT COUNT(diagonal) AS quant FROM `t_products` WHERE type = 'Мониторы' AND model IN ('" . implode("', '", $model) . "')
                                                        AND diagonal = '$option' AND resolution IN ('" . implode("', '", $resolution) . "') AND screen_type IN ('" . implode("', '", $screen_type) . "')
                                                        AND frequency IN ('" . implode("', '", $frequency) . "') AND speaker IN ('" . implode("', '", $speaker) . "')";

                                                        $result = mysqli_query($connection, $query);

                                                        if ($result && mysqli_num_rows($result) > 0) {
                                                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                                            $quant = $row['quant'];
                                                        } else {
                                                            $quant = 0;
                                                        }

                                                        $class = ($quant > 0) ? "" : "disabled";
                                                        $label_style = "color: palegreen;";
                                                        $p_style = "margin: 0px 5px; color: palegreen;";

                                                        if ($quant == 0) {
                                                            $label_style .= " opacity: 0.5;";
                                                            $p_style .= " opacity: 0.5;";
                                                        }

                                                        echo '<li class="filter-item '.$class.'">
                                                        <input type="checkbox" id="'.$id.'" name="diagonal[]" value="'.$option.'" '.(in_array($option, $diagonal_values) ? 'checked' : '').($quant > 0 ? '' : 'disabled').'>
                                                                <label for="'.$id.'" style="'.$label_style.'">'.$option.'</label> 
                                                                <p style="'.$p_style.'">('. $quant .')</p> 
                                                            </li>';
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <p class="textFilter" data-target="js-filter-content3" onclick="changeClass(event)">Разрешение &nbsp<i id="js-filter-icon-down3" class="up"></i></p>
                                    <div class="div-close-filter">
                                        <div id="js-filter-content3"> 
                                            <ul class="filter-list">
                                                <?php
                                                    if (isset($_GET['resolution'])) {
                                                        $resolution_values = explode(',', $_GET['resolution']);
                                                        //print_r($type_video_card_values);
                                                    } else {
                                                        $resolution_values = array('d');
                                                        //echo "Массив type_video_card не был передан или содержит недопустимые данные";
                                                    }

                                                    $options = array(
                                                        'FHD' => 'resolutionlChoice1',
                                                        'WQHD' => 'resolutionlChoice2',
                                                        '2K QHD' => 'resolutionlChoice3',
                                                        '3K UHD' => 'resolutionlChoice4',
                                                        '4K UHD' => 'resolutionlChoice5'
                                                    );

                                                    foreach ($options as $option => $id) {
                                                        $query = "SELECT COUNT(resolution) AS quant FROM `t_products` WHERE type = 'Мониторы' AND model IN ('" . implode("', '", $model) . "')
                                                        AND diagonal IN ('" . implode("', '", $diagonal) . "') AND resolution = '$option' AND screen_type IN ('" . implode("', '", $screen_type) . "')
                                                        AND frequency IN ('" . implode("', '", $frequency) . "') AND speaker IN ('" . implode("', '", $speaker) . "')";

                                                        $result = mysqli_query($connection, $query);

                                                        if ($result && mysqli_num_rows($result) > 0) {
                                                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                                            $quant = $row['quant'];
                                                        } else {
                                                            $quant = 0;
                                                        }

                                                        $class = ($quant > 0) ? "" : "disabled";
                                                        $label_style = "color: palegreen;";
                                                        $p_style = "margin: 0px 5px; color: palegreen;";

                                                        if ($quant == 0) {
                                                            $label_style .= " opacity: 0.5;";
                                                            $p_style .= " opacity: 0.5;";
                                                        }

                                                        echo '<li class="filter-item '.$class.'">
                                                        <input type="checkbox" id="'.$id.'" name="resolution[]" value="'.$option.'" '.(in_array($option, $resolution_values) ? 'checked' : '').($quant > 0 ? '' : 'disabled').'>
                                                                <label for="'.$id.'" style="'.$label_style.'">'.$option.'</label> 
                                                                <p style="'.$p_style.'">('. $quant .')</p> 
                                                            </li>';
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <p class="textFilter" data-target="js-filter-content4" onclick="changeClass(event)">Тип экрана &nbsp<i id="js-filter-icon-down4" class="up"></i></p>
                                    <div class="div-close-filter">
                                        <div id="js-filter-content4"> 
                                            <ul class="filter-list">
                                                <?php
                                                    if (isset($_GET['screen_type'])) {
                                                        $screen_type_values = explode(',', $_GET['screen_type']);
                                                        //print_r($type_video_card_values);
                                                    } else {
                                                        $screen_type_values = array('d');
                                                        //echo "Массив type_video_card не был передан или содержит недопустимые данные";
                                                    }

                                                    $options = array(
                                                        'Плоский' => 'screen_typeChoice1',
                                                        'Изогнутый' => 'screen_typeChoice2'
                                                    );

                                                    foreach ($options as $option => $id) {
                                                        $query = "SELECT COUNT(screen_type) AS quant FROM `t_products` WHERE type = 'Мониторы' AND model IN ('" . implode("', '", $model) . "')
                                                        AND diagonal IN ('" . implode("', '", $diagonal) . "') AND resolution IN ('" . implode("', '", $resolution) . "') AND screen_type = '$option'
                                                        AND frequency IN ('" . implode("', '", $frequency) . "') AND speaker IN ('" . implode("', '", $speaker) . "')";

                                                        $result = mysqli_query($connection, $query);

                                                        if ($result && mysqli_num_rows($result) > 0) {
                                                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                                            $quant = $row['quant'];
                                                        } else {
                                                            $quant = 0;
                                                        }

                                                        $class = ($quant > 0) ? "" : "disabled";
                                                        $label_style = "color: palegreen;";
                                                        $p_style = "margin: 0px 5px; color: palegreen;";

                                                        if ($quant == 0) {
                                                            $label_style .= " opacity: 0.5;";
                                                            $p_style .= " opacity: 0.5;";
                                                        }

                                                        echo '<li class="filter-item '.$class.'">
                                                        <input type="checkbox" id="'.$id.'" name="screen_type[]" value="'.$option.'" '.(in_array($option, $screen_type_values) ? 'checked' : '').($quant > 0 ? '' : 'disabled').'>
                                                                <label for="'.$id.'" style="'.$label_style.'">'.$option.'</label> 
                                                                <p style="'.$p_style.'">('. $quant .')</p> 
                                                            </li>';
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <p class="textFilter" data-target="js-filter-content5" onclick="changeClass(event)">Частота &nbsp<i id="js-filter-icon-down5" class="up"></i></p>
                                    <div class="div-close-filter">
                                        <div id="js-filter-content5"> 
                                            <ul class="filter-list">
                                                <?php
                                                    if (isset($_GET['frequency'])) {
                                                        $frequency_values = explode(',', $_GET['frequency']);
                                                        //print_r($type_video_card_values);
                                                    } else {
                                                        $frequency_values = array('d');
                                                        //echo "Массив type_video_card не был передан или содержит недопустимые данные";
                                                    }

                                                    $options = array(
                                                        '60 Hz' => 'frequencyChoice1',
                                                        '75 Hz' => 'frequencyChoice2',
                                                        '90 Hz' => 'frequencyChoice3',
                                                        '120 Hz' => 'frequencyChoice4',
                                                        '144 Hz' => 'frequencyChoice5',
                                                        '165 Hz' => 'frequencyChoice6',
                                                        '240 Hz' => 'frequencyChoice7'
                                                    );

                                                    foreach ($options as $option => $id) {
                                                        $query = "SELECT COUNT(frequency) AS quant FROM `t_products` WHERE type = 'Мониторы' AND model IN ('" . implode("', '", $model) . "')
                                                        AND diagonal IN ('" . implode("', '", $diagonal) . "') AND resolution IN ('" . implode("', '", $resolution) . "') AND frequency = '$option'
                                                        AND screen_type IN ('" . implode("', '", $screen_type) . "') AND speaker IN ('" . implode("', '", $speaker) . "')";

                                                        $result = mysqli_query($connection, $query);

                                                        if ($result && mysqli_num_rows($result) > 0) {
                                                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                                            $quant = $row['quant'];
                                                        } else {
                                                            $quant = 0;
                                                        }

                                                        $class = ($quant > 0) ? "" : "disabled";
                                                        $label_style = "color: palegreen;";
                                                        $p_style = "margin: 0px 5px; color: palegreen;";

                                                        if ($quant == 0) {
                                                            $label_style .= " opacity: 0.5;";
                                                            $p_style .= " opacity: 0.5;";
                                                        }

                                                        echo '<li class="filter-item '.$class.'">
                                                        <input type="checkbox" id="'.$id.'" name="frequency[]" value="'.$option.'" '.(in_array($option, $frequency_values) ? 'checked' : '').($quant > 0 ? '' : 'disabled').'>
                                                                <label for="'.$id.'" style="'.$label_style.'">'.$option.'</label> 
                                                                <p style="'.$p_style.'">('. $quant .')</p> 
                                                            </li>';
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <p class="textFilter" data-target="js-filter-content6" onclick="changeClass(event)">Колонки &nbsp<i id="js-filter-icon-down6" class="up"></i></p>
                                    <div class="div-close-filter">
                                        <div id="js-filter-content6"> 
                                            <ul class="filter-list">
                                            <?php
                                                    if (isset($_GET['speaker'])) {
                                                        $speaker_values = explode(',', $_GET['speaker']);
                                                        //print_r($type_video_card_values);
                                                    } else {
                                                        $speaker_values = array('d');
                                                        //echo "Массив type_video_card не был передан или содержит недопустимые данные";
                                                    }

                                                    $options = array(
                                                        'Есть' => 'speakerChoice1',
                                                        'Нет' => 'speakerChoice2'
                                                    );

                                                    foreach ($options as $option => $id) {
                                                        $query = "SELECT COUNT(speaker) AS quant FROM `t_products` WHERE type = 'Мониторы' AND model IN ('" . implode("', '", $model) . "')
                                                        AND diagonal IN ('" . implode("', '", $diagonal) . "') AND resolution IN ('" . implode("', '", $resolution) . "')
                                                        AND screen_type IN ('" . implode("', '", $screen_type) . "') AND frequency IN ('" . implode("', '", $frequency) . "') AND speaker = '$option'";
                                                        
                                                        $result = mysqli_query($connection, $query);

                                                        if ($result && mysqli_num_rows($result) > 0) {
                                                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                                            $quant = $row['quant'];
                                                        } else {
                                                            $quant = 0;
                                                        }

                                                        $class = ($quant > 0) ? "" : "disabled";
                                                        $label_style = "color: palegreen;";
                                                        $p_style = "margin: 0px 5px; color: palegreen;";

                                                        if ($quant == 0) {
                                                            $label_style .= " opacity: 0.5;";
                                                            $p_style .= " opacity: 0.5;";
                                                        }

                                                        echo '<li class="filter-item '.$class.'">
                                                        <input type="checkbox" id="'.$id.'" name="speaker[]" value="'.$option.'" '.(in_array($option, $speaker_values) ? 'checked' : '').($quant > 0 ? '' : 'disabled').'>
                                                                <label for="'.$id.'" style="'.$label_style.'">'.$option.'</label> 
                                                                <p style="'.$p_style.'">('. $quant .')</p> 
                                                            </li>';
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <button class="filter-btn" type="submit">Фильтровать</button>
                            </form>

                            <?php
                                echo '<form class="form_reset_filter" action="resetFilter.php" method="POST"><br>'.
                                '<a href=""><button class="reset_filter" name="reset_filter_btn" value="resetMonitor">Сбросить фильтр</button></a>'.
                                '</form>';
                            ?>

                        </div>
                    </div>

                    <div class="place">

                        <?php
                            session_start();
                            require_once "../bd.php";
                            $query2 = $_SESSION['selectMonitor'];
                            //var_dump($query2);

                            if (empty($query2)) {
                                $query2 = 'SELECT * FROM `t_products` WHERE type = "Мониторы"';
                              }
                              
                              $result = mysqli_query($connection, $query2);

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
                                    $row['price'] .' lei<br>'.
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
                                                "<form class='div-del' action='deleteProduct.php' method='POST'>".'<br>'.
                                                '<a onclick="return confirm(\'Вы действительно хотите удалить продукт?\')">
                                                <button class="div-down-button" name="deleteBtn-M" value="' . $row['id'] . '">Удалить</button></a>'.
                                                '</form>'.
                                            '</div>'.

                                            '<div class="div-down1">'.
                                                '<a href="../updateProducts/updateM.php?id='.$row['id'].'"><button class="div-down1-button" name="editBtn">Изменить</button></a>'.
                                            '</div>';
                                    }else{
                                        
                                    }

                                    if($numquant<1){
                                        echo "<p>Продукта нет в наличии :(</p>";
                                    }else{
                                        echo '<div class="div-down2">'.
                                        "<form class='div-insert-product-in-cart' action='insertProductInCart.php' method='POST'>".'<br>'.
                                        '<a >
                                        <input type="hidden" name="type" value="'.$row['type'].'">
                                        <input type="hidden" name="model" value="'.$row['model'].'">
                                        <input type="hidden" name="price" value="'.$row['price'].'">
                                        <input type="hidden" name="quantity" value="'.$numquant.'">
                                        <button class="button" name="id" value="' . $row['id'] . ' ">В корзину</button></a>'. 
                                        '</form>'.
                                    '</div>'.

                                    '<div class="div-down3">'.
                                        "<form class='div-insert-product-in-cart' action='insertProductInCart.php' method='POST'>".'<br>'.
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
                                }else{
                                    echo'<p style="display: flex; margin-left: 17%; color: orange;">По данному фильтру ничего не найдено, рекомендуем сбросить фильтр!</p>';
                                }
                            }
                        ?>

                    </div>

                </div>

            </div>
        </section>
    </body>
</html>