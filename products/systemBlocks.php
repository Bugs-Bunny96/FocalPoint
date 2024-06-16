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

                    <p class="text">Системные блоки</p>

                <div class="break">

                    <div class="sort">
                        <div class="sortContent">

                            <p class="textFilterM">Фильтры</p>

                            <p class="line"></p>

                            <form method="POST" action='filters/filtersSystemBlocks.php'>
                                <?php
                                    $processor = !empty($_GET['processor']) ? explode(',', $_GET['processor']) : array('Intel Core', 'AMD');
                                    $type_video_card = !empty($_GET['type_video_card']) ? explode(',', $_GET['type_video_card']) : array('Встроенная', 'Дискретная');
                                    $video_card = !empty($_GET['video_card']) ? explode(',', $_GET['video_card']) : array('GeForce', 'Asus', 'MSI', 'Gigabyte', 'Intel', 'AMD');
                                    $ram = !empty($_GET['ram']) ? explode(',', $_GET['ram']) : array('64 GB','32 GB', '24 GB', '20 GB', '16 GB', '12 GB', '8 GB', '4 GB');
                                    $type_drive = !empty($_GET['type_drive']) ? explode(',', $_GET['type_drive']) : array('SSD', 'HDD');
                                    $volum_drive = !empty($_GET['volum_drive']) ? explode(',', $_GET['volum_drive']) : array('128 GB', '256 GB', '512 GB', '1 TB', '2 TB', '4 TB', '8 TB');
                                    $port_lan = !empty($_GET['port_lan']) ? explode(',', $_GET['port_lan']) : array('50 Mb', '100 Mb', '1 Gb', '10 Gb');
                                ?>

                                <div id="filter-container">
                                    <p class="textFilter" data-target="js-filter-content1" onclick="changeClass(event)">Процессор &nbsp<i id="js-filter-icon-down1" class="up"></i></p>
                                    <div class="div-close-filter">
                                        <div id="js-filter-content1">
                                            <ul class="filter-list">
                                                <?php
                                                    if (isset($_GET['processor'])) {
                                                        $processor_values = explode(',', $_GET['processor']);
                                                        //print_r($type_video_card_values);
                                                    } else {
                                                        $processor_values = array('d');
                                                        //echo "Массив type_video_card не был передан или содержит недопустимые данные";
                                                    }

                                                    $options = array(
                                                        'Intel Core' => 'processorChoice1',
                                                        'AMD' => 'processorChoice2'
                                                    );

                                                    foreach ($options as $option => $id) {
                                                        $query = "SELECT COUNT(processor) AS quant FROM `t_products` WHERE type = 'Системные блоки' AND processor = '$option'
                                                        AND type_video_card IN ('" . implode("', '", $type_video_card) . "') AND video_card IN ('" . implode("', '", $video_card) . "')
                                                        AND ram IN ('" . implode("', '", $ram) . "') AND type_drive IN ('" . implode("', '", $type_drive) . "')
                                                        AND volum_drive IN ('" . implode("', '", $volum_drive) . "') AND port_lan IN ('" . implode("', '", $port_lan) . "')";

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
                                                        <input type="checkbox" id="'.$id.'" name="processor[]" value="'.$option.'" '.(in_array($option, $processor_values) ? 'checked' : '').($quant > 0 ? '' : 'disabled').'>
                                                                <label for="'.$id.'" style="'.$label_style.'">'.$option.'</label> 
                                                                <p style="'.$p_style.'">('. $quant .')</p> 
                                                            </li>';
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <p class="textFilter" data-target="js-filter-content2" onclick="changeClass(event)">Тип видеокарты &nbsp<i id="js-filter-icon-down2" class="up"></i></p>
                                    <div class="div-close-filter">
                                        <div id="js-filter-content2">
                                            <ul class="filter-list">
                                                <?php
                                                    if (isset($_GET['type_video_card'])) {
                                                        $type_video_card_values = explode(',', $_GET['type_video_card']);
                                                        //print_r($type_video_card_values);
                                                    } else {
                                                        $type_video_card_values = array('d');
                                                        //echo "Массив type_video_card не был передан или содержит недопустимые данные";
                                                    }

                                                    $options = array(
                                                        'Встроенная' => 'typevidiocardChoice1',
                                                        'Дискретная' => 'typevidiocardChoice2'
                                                    );

                                                    foreach ($options as $option => $id) {
                                                        $query = "SELECT COUNT(type_video_card) AS quant FROM `t_products` WHERE type = 'Системные блоки' AND processor IN ('" . implode("', '", $processor) . "')
                                                        AND video_card IN ('" . implode("', '", $video_card) . "') AND ram IN ('" . implode("', '", $ram) . "')
                                                        AND type_drive IN ('" . implode("', '", $type_drive) . "') AND volum_drive IN ('" . implode("', '", $volum_drive) . "') 
                                                        AND type_video_card = '$option' AND port_lan IN ('" . implode("', '", $port_lan) . "')";
                                                        //var_dump($query);
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
                                                        <input type="checkbox" id="'.$id.'" name="typevidiocard[]" value="'.$option.'" '.(in_array($option, $type_video_card_values) ? 'checked' : '').($quant > 0 ? '' : 'disabled').'>
                                                                <label for="'.$id.'" style="'.$label_style.'">'.$option.'</label> 
                                                                <p style="'.$p_style.'">('. $quant .')</p> 
                                                            </li>';
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <p class="textFilter" data-target="js-filter-content3" onclick="changeClass(event)">Видеокарта &nbsp<i id="js-filter-icon-down3" class="up"></i></p>
                                    <div class="div-close-filter">
                                        <div id="js-filter-content3">
                                            <ul class="filter-list">
                                                <?php
                                                    if (isset($_GET['video_card'])) {
                                                        $videocard_values = explode(',', $_GET['video_card']);
                                                        //print_r($type_video_card_values);
                                                    } else {
                                                        $videocard_values = array('d');
                                                        //echo "Массив type_video_card не был передан или содержит недопустимые данные";
                                                    }

                                                    $options = array(
                                                        'GeForce' => 'vidiocardChoice1',
                                                        'Asus' => 'vidiocardChoice2',
                                                        'MSI' => 'vidiocardChoice3',
                                                        'Gigabyte' => 'vidiocardChoice4',
                                                        'Intel' => 'vidiocardChoice5',
                                                        'AMD' => 'vidiocardChoice6'
                                                    );

                                                    foreach ($options as $option => $id) {
                                                        $query = "SELECT COUNT(video_card) AS quant FROM `t_products` WHERE type = 'Системные блоки' AND processor IN ('" . implode("', '", $processor) . "')
                                                        AND type_video_card IN ('" . implode("', '", $type_video_card) . "') AND video_card = '$option' AND ram IN ('" . implode("', '", $ram) . "')
                                                        AND type_drive IN ('" . implode("', '", $type_drive) . "') AND volum_drive IN ('" . implode("', '", $volum_drive) . "') 
                                                        AND port_lan IN ('" . implode("', '", $port_lan) . "')";

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
                                                        <input type="checkbox" id="'.$id.'" name="videocard[]" value="'.$option.'" '.(in_array($option, $videocard_values) ? 'checked' : '').($quant > 0 ? '' : 'disabled').'>
                                                                <label for="'.$id.'" style="'.$label_style.'">'.$option.'</label> 
                                                                <p style="'.$p_style.'">('. $quant .')</p> 
                                                            </li>';
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <p class="textFilter" data-target="js-filter-content4" onclick="changeClass(event)">Оперативная память &nbsp<i id="js-filter-icon-down4" class="up"></i></p>
                                    <div class="div-close-filter">
                                        <div id="js-filter-content4">
                                            <ul class="filter-list">
                                                <?php
                                                    if (isset($_GET['ram'])) {
                                                        $ram_values = explode(',', $_GET['ram']);
                                                        //print_r($type_video_card_values);
                                                    } else {
                                                        $ram_values = array('d');
                                                        //echo "Массив type_video_card не был передан или содержит недопустимые данные";
                                                    }

                                                    $options = array(
                                                        '64 GB' => 'ramChoice1',
                                                        '32 GB' => 'ramChoice2',
                                                        '24 GB' => 'ramChoice3',
                                                        '20 GB' => 'ramChoice4',
                                                        '16 GB' => 'ramChoice5',
                                                        '12 GB' => 'ramChoice6',
                                                        '8 GB' => 'ramChoice7'
                                                    );

                                                    foreach ($options as $option => $id) {
                                                        $query = "SELECT COUNT(ram) AS quant FROM `t_products` WHERE type = 'Системные блоки' AND processor IN ('" . implode("', '", $processor) . "')
                                                        AND type_video_card IN ('" . implode("', '", $type_video_card) . "') AND video_card IN ('" . implode("', '", $video_card) . "')
                                                        AND ram = '$option' AND type_drive IN ('" . implode("', '", $type_drive) . "') AND volum_drive IN ('" . implode("', '", $volum_drive) . "')
                                                        AND port_lan IN ('" . implode("', '", $port_lan) . "')";

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
                                                        <input type="checkbox" id="'.$id.'" name="ram[]" value="'.$option.'" '.(in_array($option, $ram_values) ? 'checked' : '').($quant > 0 ? '' : 'disabled').'>
                                                                <label for="'.$id.'" style="'.$label_style.'">'.$option.'</label> 
                                                                <p style="'.$p_style.'">('. $quant .')</p> 
                                                            </li>';
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <p class="textFilter" data-target="js-filter-content5" onclick="changeClass(event)">Тип накопителя &nbsp<i id="js-filter-icon-down5" class="up"></i></p>
                                    <div class="div-close-filter">
                                        <div id="js-filter-content5">
                                            <ul class="filter-list">
                                            <?php
                                                    if (isset($_GET['type_drive'])) {
                                                        $drivetype_values = explode(',', $_GET['type_drive']);
                                                        //print_r($type_video_card_values);
                                                    } else {
                                                        $drivetype_values = array('d');
                                                        //echo "Массив type_video_card не был передан или содержит недопустимые данные";
                                                    }

                                                    $options = array(
                                                        'SSD' => 'drivetypeChoice1',
                                                        'HDD' => 'drivetypeChoice2'
                                                    );

                                                    foreach ($options as $option => $id) {
                                                        $query = "SELECT COUNT(type_drive) AS quant FROM `t_products` WHERE type = 'Системные блоки' AND processor IN ('" . implode("', '", $processor) . "')
                                                        AND type_video_card IN ('" . implode("', '", $type_video_card) . "') AND video_card IN ('" . implode("', '", $video_card) . "')
                                                        AND ram IN ('" . implode("', '", $ram) . "') AND type_drive = '$option' AND volum_drive IN ('" . implode("', '", $volum_drive) . "')
                                                        AND port_lan IN ('" . implode("', '", $port_lan) . "')";

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
                                                        <input type="checkbox" id="'.$id.'" name="drivetype[]" value="'.$option.'" '.(in_array($option, $drivetype_values) ? 'checked' : '').($quant > 0 ? '' : 'disabled').'>
                                                                <label for="'.$id.'" style="'.$label_style.'">'.$option.'</label> 
                                                                <p style="'.$p_style.'">('. $quant .')</p> 
                                                            </li>';
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <p class="textFilter" data-target="js-filter-content6" onclick="changeClass(event)">Объём накопителя &nbsp<i id="js-filter-icon-down6" class="up"></i></p>
                                    <div class="div-close-filter">
                                        <div id="js-filter-content6">
                                            <ul class="filter-list">
                                                <?php
                                                    if (isset($_GET['volum_drive'])) {
                                                        $volumdrive_values = explode(',', $_GET['volum_drive']);
                                                        //print_r($type_video_card_values);
                                                    } else {
                                                        $volumdrive_values = array('d');
                                                        //echo "Массив type_video_card не был передан или содержит недопустимые данные";
                                                    }

                                                    $options = array(
                                                        '128 GB' => 'volumdriveChoice1',
                                                        '256 GB' => 'volumdriveChoice2',
                                                        '512 GB' => 'volumdriveChoice3',
                                                        '1 TB' => 'volumdriveChoice4',
                                                        '2 TB' => 'volumdriveChoice5',
                                                        '4 TB' => 'volumdriveChoice6',
                                                        '8 TB' => 'volumdriveChoice7'
                                                    );

                                                    foreach ($options as $option => $id) {
                                                        $query = "SELECT COUNT(volum_drive) AS quant FROM `t_products` WHERE type = 'Системные блоки' AND processor IN ('" . implode("', '", $processor) . "') 
                                                        AND type_video_card IN ('" . implode("', '", $type_video_card) . "') AND video_card IN ('" . implode("', '", $video_card) . "') 
                                                        AND ram IN ('" . implode("', '", $ram) . "') AND type_drive IN ('" . implode("', '", $type_drive) . "') 
                                                        AND volum_drive = '$option' AND port_lan IN ('" . implode("', '", $port_lan) . "')";

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
                                                        <input type="checkbox" id="'.$id.'" name="volumdrive[]" value="'.$option.'" '.(in_array($option, $volumdrive_values) ? 'checked' : '').($quant > 0 ? '' : 'disabled').'>
                                                                <label for="'.$id.'" style="'.$label_style.'">'.$option.'</label> 
                                                                <p style="'.$p_style.'">('. $quant .')</p> 
                                                            </li>';
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <p class="textFilter" data-target="js-filter-content7" onclick="changeClass(event)">ПортLAN &nbsp<i id="js-filter-icon-down7" class="up"></i></p>
                                    <div class="div-close-filter">
                                        <div id="js-filter-content7">
                                            <ul class="filter-list">
                                                <?php
                                                    if (isset($_GET['port_lan'])) {
                                                        $port_lan_values = explode(',', $_GET['port_lan']);
                                                        //print_r($type_video_card_values);
                                                    } else {
                                                        $port_lan_values = array('d');
                                                        //echo "Массив type_video_card не был передан или содержит недопустимые данные";
                                                    }

                                                    $options = array(
                                                        '50 Mb' => 'port_lanChoice1',
                                                        '100 Mb' => 'port_lanChoice2',
                                                        '1 Gb' => 'port_lanChoice3',
                                                        '10 Gb' => 'port_lanChoice4',
                                                    );

                                                    foreach ($options as $option => $id) {
                                                        $query = "SELECT COUNT(port_lan) AS quant FROM `t_products` WHERE type = 'Системные блоки' AND processor IN ('" . implode("', '", $processor) . "') 
                                                        AND type_video_card IN ('" . implode("', '", $type_video_card) . "') AND video_card IN ('" . implode("', '", $video_card) . "') 
                                                        AND ram IN ('" . implode("', '", $ram) . "') AND type_drive IN ('" . implode("', '", $type_drive) . "') 
                                                        AND volum_drive IN ('" . implode("', '", $volum_drive) . "') AND port_lan = '$option'"; 

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
                                                        <input type="checkbox" id="'.$id.'" name="port_lan[]" value="'.$option.'" '.(in_array($option, $port_lan_values) ? 'checked' : '').($quant > 0 ? '' : 'disabled').'>
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
                                '<a href=""><button class="reset_filter" name="reset_filter_btn" value="resetSystemBlocks">Сбросить фильтр</button></a>'.
                                '</form>';
                            ?>

                        </div>
                    </div>

                    <div class="place">

                        <?php
                            session_start();
                            require_once "../bd.php";
                            $query2 = $_SESSION['selectSystemBlocks'];
                            //var_dump($query2);

                            if (empty($query2)) {
                                $query2 = 'SELECT * FROM `t_products` WHERE type = "Системные блоки"';
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
                                                <button class="div-down-button" name="deleteBtn-SB" value="' . $row['id'] . '">Удалить</button></a>'.
                                                '</form>'.
                                            '</div>'.

                                            '<div class="div-down1">'.
                                                '<a href="../updateProducts/updateSB.php?id='.$row['id'].'"><button class="div-down1-button" name="editBtn">Изменить</button></a>'.
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