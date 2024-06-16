<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!

    session_start();
    require_once "bd.php";
    if (!isset($_SESSION['t_users'])) {

    }
    $_SESSION['id'];

    if (empty($_SESSION['username']))
    {
    // Если пусты, то мы не выводим ссылку
    header('Location: forwardingCart.php');
    }
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Focal Point</title>
        <link rel="shortcut icon" href="images/shortcuticon.png" type="image/png">
        <link rel="stylesheet" href="styleCart.css">
        <link href="https://fonts.cdnfonts.com/css/frank-ruhl-libre" rel="stylesheet">
        <script> 
        function changeClass() {
    const element = document.getElementById("divDataOrder");
    if (element.className == "divDataOrder") {
    element.className = "divDataOrder-hidden";
  } else {
    element.className = "divDataOrder";
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

                    <p class="text">Корзина</p>
                    <p class="textBuy">Ваши покупки</p>

                    <?php

                    require_once "bd.php";
                                            
                    $id_user = $_SESSION['id'];

                    $query2 = "SELECT * FROM `t_users` WHERE id = '$id_user'";
                    $result2 = mysqli_query($connection, $query2);
                    If ($result2) {
                        $num2=mysqli_num_rows($result2);
                        if($num2>0) {

                    while ($row2=mysqli_fetch_array($result2, MYSQLI_ASSOC)) { 
                        $discount = $row2['discount'];
                            }
                        }
                    }
                    //echo $id_user;

                    $query = "SELECT  `id`,`id_product`,`id_user`,`type`, `model`,`price`,`quantity`,`total_quantity`,`amount` FROM `t_cart` WHERE id_user = '$id_user'";
                    //var_dump($query);

                    $result = mysqli_query($connection, $query);

                    if($result){
                        $num=mysqli_num_rows($result);
                        
                        if(!$num){
                            echo '<p class="emptyCart">Ваша корзина пуста</p>'.
                                    '<div class="div-back-to-shopping">'.
                                        '<a href="main.php"><button class="button1" name="shopingBtn"> Вернуться к покупкам</button></a>'.
                                    '</div>';

                        }else{
                            echo '<div class="down-bar">'.
                            '<div class="down-bar-btn-1">'.
                                '<a href="main.php"><button class="button1" name="shopingBtn"> Продолжить покупки</button></a>'.
                            '</div>'.
                            '<div class="down-bar-btn-2">'.
                                "<form class='div-del' action='clearCart.php' method='POST'>".'<br>'.
                                '<a href=""><button class="button2" name="clearBtn" value="' . $_SESSION['id'] . '">X Очистить корзину</button></a>'.
                                '</form>'.
                            '</div>'. 
                            '<div class="down-bar-btn-3">'.
                                '<button class="button3" name="orderBtn" onclick="changeClass()">Оформить заказ</button>'.
                            '</div>'.
                        '</div>';
                        }   
                    }
                        
                        If ($result) {
                            $num=mysqli_num_rows($result);
                            if($num>0) {
                                echo '<div class="totalTable">'.
                                        '<div class="buytable">'.
                                            '<table class="table">'.
                                                    '<col width="50px">'.
                                                    '<col width="150px">'.
                                                    '<col width="100px">'.
                                                    '<col width="150px">'.
                                                    '<col width="100px">'.
                                                    '<col width="120px">'.
                                                    '<col width="50px">'.
                                                    '<col width="120px">'.
                                                    '<col width="150px">'.
                                                '<tr>'.
                                                    '<th align="center">#</th>'.
                                                    '<th align="center">Type</th>'.
                                                    '<th align="center">Model</th>'.
                                                    '<th align="center">Цена за еденицу</th>'.
                                                    '<th align="center">Количество</th>'.
                                                    '<th align="center">Сумма</th>'.
                                                    '<th align="center">Скидка</th>'.
                                                    '<th align="center">Итого</th>'.
                                                    '<th align="center">Убрать из корзины</th>'.
                                                '</tr>';
                                                $number=0;
                                                $percent=(100-$discount)/100;
                                            while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
                                                $number=$number+1;
                                                //$upshot = $row['price']*$row['quantity'];
                                                if($row['quantity'] <=1){
                                                    $changeLess = $row['quantity'] ;
                                                    $changeMore = $row['quantity'] +1;
                                                }elseif($row['quantity']==$row['total_quantity']){
                                                    $changeMore = $row['quantity'];
                                                    $changeLess = $row['quantity'] -1;  
                                                }else{
                                                    $changeMore = $row['quantity'] +1;
                                                    $changeLess = $row['quantity'] -1;
                                                }

                                                //echo $changeMore;
                                                //echo $changeLess; 

                                                echo '<tr>'.
                                                        '<td align="center">'.$number.'</td>'.
                                                        '<td align="center">'.$row['type'].'</td>'.
                                                        '<td align="center">'.$row['model'].'</td>'.
                                                        '<td align="center">'.$row['price'].' lei</td>'.
                                                        '<td align="center" style="display: flex; justify-content: center;">

                                                        <form class="changeTheQuantityForm" action="changeTheQuantity.php" method="POST" style="margin-right: 10px;"><br>
                                                        <input type="hidden" name="id_product" value="'.$row['id_product'].'">
                                                        <input type="hidden" name="price" value="'.$row['price'].'">
                                                        <button class="changeBtn" name="changeBtn" value="' . $changeLess . '">-</button>
                                                        </form>

                                                        '.$row['quantity'].'

                                                        <form class="changeTheQuantityForm" action="changeTheQuantity.php" method="POST" style="margin-left: 10px;"><br>
                                                        <input type="hidden" name="id_product" value="'.$row['id_product'].'">
                                                        <input type="hidden" name="price" value="'.$row['price'].'">
                                                        <button class="changeBtn" name="changeBtn" value="' . $changeMore . '">+</button>
                                                        </form>
                                                        </td>'.

                                                        '<td align="center">'.$row['amount'].' lei</td>'.
                                                        '<td align="center">'.$discount.' %</td>'.
                                                        '<td align="center">'.$row['amount']*$percent.' lei</td>'.
                                                        
                                                        '<td align="center">
                                                        <form class="deleteForm" action="deleteProductFromCart.php" method="POST"><br>
                                                        <button class="deleteBtn" name="deleteBtn" value="' . $row['id'] . '">X</button>
                                                        </form>
                                                        </td>'.
                                                    '</tr>';
                                                    $amount=$amount+$row['amount']*$percent;
                                                     //echo $amount;
                                                    $total_amount=$amount;
                                            }
                                            echo '</table>'.
                                        '</div>'.

                                        '<div class="line"></div>'.

                                        '<div class="total-cost">'.
                                            '<table class="table-cost">'.
                                                '<col width="800px">'.
                                                '<col width="150px">'.
                                                '<tr>'.
                                                    '<th class="tableth">Итоговая Стоимость</th>'.
                                                    '<td class="tabletd">'. $total_amount.' lei</td>'.
                                                '</tr>'.
                                            '</table>'.
                                        '</div>'.    
                                    '</div>';
                        }
                    }
                    ?>

                    <div id="divDataOrder" class="divDataOrder" >
                        <form action="saveOrders.php" method="post">

                            <input type="hidden" name="discount" value="<?=$discount ?>">
                            <input type="hidden" name="total_amount" value="<?=$total_amount ?>"> 
                            <input type="hidden" name="order_date" value="<?= date('Y-m-d H:i:s') ?>">
                            <input type="hidden" name="status" value="Ожидаемый"> 

                            <p class="input-board">
                            <p  class="tagOrder">Доставка товара после его подтверждения, в г. Кишинёв осуществляется в день заказа или на следующий день.<br>
                                    В другие регионы Молдовы, доставка осуществляется в течении  4-5 рабочих дней.</p>

                                <div class="input-board-row1">
                                    <input class="input-city" name="city" type="text" size="40" required minlength="1" maxlength="50"placeholder="Город" style=" height: 27px;" ><br>
                                    <input class="input-street" name="street" type="text" size="40" required minlength="1" maxlength="50"placeholder="Улица" style=" height: 27px;" ><br>
                                    <input class="input-home" name="home" type="text" size="40" required minlength="1" maxlength="30"placeholder="Дом" style=" height: 27px;" ><br>
                                    </div>
                                    <div class="input-board-row2">
                                <input class="input-name" name="name" type="text" size="40" required minlength="1" maxlength="50"placeholder="Имя" style=" height: 27px;" ><br>
                                <input class="input-surname" name="surname" type="text" size="40" required minlength="1" maxlength="50"placeholder="Фамилия" style=" height: 27px;" ><br>
                                <input class="input-tel" name="tel" type="text" size="40" minlength="8" maxlength="8"placeholder="Телефон: ХХХХХХХХ" style=" height: 27px;"  pattern="[0-9]{8}" ><br>
                                </div>
                            </p>
                            <p class="btnSO">
                                <button class="btnSubmitOrder" name="orderBtn"><img src="images/check.png" alt="check icon"> Оформить заказ</button>
                                
                            </p>
                        </form>
                    </div>

            </div>
        </section>
    </body>
</html>