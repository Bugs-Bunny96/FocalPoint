<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!

    session_start();
    require_once "bd.php";
    if (!isset($_SESSION['t_users'])) {
        
    }
    if (empty($_SESSION['username']))
    {
    // Если пусты, то мы не выводим ссылку
    header('Location: forwarding.php');
    }

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Focal Point</title>
        <link rel="shortcut icon" href="images/shortcuticon.png" type="image/png">
        <link rel="stylesheet" href="styleUserPage.css">
        <link href="https://fonts.cdnfonts.com/css/frank-ruhl-libre" rel="stylesheet">
    </head>
    <body>
        <section class="first-screen">
            <div class="container">
                <header class="main-header">
                    <a href="main.php"><img src="images/logoimg.png" alt="Логотип компании Imperium" class="logo"></a>

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

                    <p class="text">Профиль</p>

                    <?php
                    if ( $role === "role_admin"){
                    echo '<div class="addbtn">'.
                    '<a href="addProducts/addLaptop.php"><button class="button" name="addproduct">Добавить продукты</button></a>'.
                    '</div>';
                    }
                    else{}
                    ?>

                    <div class="divuserdata">
                        <div class="userdata">
                            <p style="text-align: center;">Личные данные</p>
                            <table class="table" style=" margin: 0 auto;">
                                <tr>
                                    <th class="tableth">Имя:</th>
                                    <td class="tabletd"><?php echo $_SESSION['first_name'] ?></td>
                                </tr>
                                <tr>
                                    <th class="tableth">Фамилия:</th>
                                    <td class="tabletd"><?php echo $_SESSION['last_name'] ?></td>
                                </tr>
                                <tr>
                                    <th class="tableth">Логин:</th>
                                    <td class="tabletd"><?php echo $_SESSION['username'] ?></td>
                                </tr>
                                <tr>
                                    <th class="tableth">Телефон:</th>
                                    <td class="tabletd"><?php echo $_SESSION['tel'] ?></td>
                                </tr>
                            </table>
                        </div>

                       <div class="discount">
                            <p>Для получения скидок нужно купить на общую сумму:</p>
                            <div class="div-table">
                                <div class="table-1">
                                    <table class="t-table-1">
                                        <thead>
                                            <tr>
                                                <th class="th-1">Скидка</th>
                                                <th class="th-1">Сумма</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="td-1">1%</td>
                                                <td class="td-1"> >= 1000 lei</td>
                                            </tr>
                                            <tr>
                                                <td class="td-1">2%</td>
                                                <td class="td-1"> >= 3000 lei</td>
                                            </tr>
                                            <tr>
                                                <td class="td-1">5%</td>
                                                <td class="td-1"> >= 10000 lei</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-2">
                                    <table class="t-table-2">
                                        <thead>
                                            <tr>
                                                <th class="th-2">Скидка</th>
                                                <th class="th-2">Сумма</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="td-2">7%</td>
                                                <td class="td-2"> >= 25000 lei</td>
                                            </tr>
                                            <tr>
                                                <td class="td-2">10%</td>
                                                <td class="td-2"> >= 50000 lei</td>
                                            </tr>
                                            <tr>
                                                <td class="td-2">15%</td>
                                                <td class="td-2"> >= 100000 lei</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p class="dop-info">Общая стоимость ваших покупок: <?= $total ?> lei <br>
                                    Ваша скидка составляет = <?= $discount ?> % <br></p>
                            </div>
                            <br>
                            Статус заказов: <br>
                            <span style="color: yellow;">Ожидаемый</span> - дождитесь звонка от оператора и подтвердите заказ. <br>
                            <span style="color: orange;">Подтверждён</span> -  заказ подтверждён, ожидайте его доставк. <br>
                            <span style="color: green;">Доставлен</span> - заказ доставлен. <br>
                            <span style="color: red;">Отменён</span> - заказ отменён. (Заказ может быть отменён оператором после подтверждения покупателя об отмене или же если клиент не отвечает в течении 3 дней) <br><br>
                        </div>
                    </div>

                    <p class="text">Ваши покупки</p>

                    <?php
                        
                        $id_user = $_SESSION['id'];
                        $query3 = "SELECT o.id, o.id_user, o.id_product , o.quantity, o.amount_after_discount,  o.status, p.type, p.model
                        FROM `t_orders` as o
                        JOIN `t_products` as p 
                        ON o.id_product = p.id
                        WHERE o.id_user = '$id_user'";
                        $result3 = mysqli_query($connection, $query3);
                        //print_r($result3);

                        If ($result3) {
                            $num3=mysqli_num_rows($result3);
                            if($num3>0) {
                                echo '<div class="purchases" style="margin-bottom: 50px;">'.
                                '<table class="table">'.
                                        '<col width="50px">'.
                                        '<col width="170px">'.
                                        '<col width="170px">'.
                                        '<col width="170px">'.
                                        '<col width="170px">'.
                                        '<col width="300px">'.
                                    '<tr>'.
                                        '<th align="center">#</th>'.
                                        '<th align="center">Type</th>'.
                                        '<th align="center">Model</th>'.
                                        '<th align="center">Count</th>'.
                                        '<th align="center">Price</th>'.
                                        '<th align="center">Status</th>'.
                                    '</tr>';
                                    $number=0;
                                while ($row3=mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                                    $number=$number+1;
                                    if($row3['status'] === "Ожидаемый"){
                                        echo '<tr>'.
                                        '<td align="center">'.$number.'</td>'.
                                        '<td align="center">'.$row3['type'].'</td>'.
                                        '<td align="center">'.$row3['model'].'</td>'.
                                        '<td align="center">'.$row3['quantity'].'</td>'.
                                        '<td align="center">'.$row3['amount_after_discount'].' lei</td>'.
                                        '<td align="center" style="color: yellow;">'.$row3['status'].'</td>'.
                                    '</tr>';

                                    }elseif($row3['status'] === "Подтверждён"){
                                        echo '<tr>'.
                                        '<td align="center">'.$number.'</td>'.
                                        '<td align="center">'.$row3['type'].'</td>'.
                                        '<td align="center">'.$row3['model'].'</td>'.
                                        '<td align="center">'.$row3['quantity'].'</td>'.
                                        '<td align="center">'.$row3['amount_after_discount'].' lei</td>'.
                                        '<td align="center" style="color: orange;">'.$row3['status'].'</td>'.
                                    '</tr>';
                                    }elseif($row3['status'] === "Доставлен"){
                                        echo '<tr>'.
                                        '<td align="center">'.$number.'</td>'.
                                        '<td align="center">'.$row3['type'].'</td>'.
                                        '<td align="center">'.$row3['model'].'</td>'.
                                        '<td align="center">'.$row3['quantity'].'</td>'.
                                        '<td align="center">'.$row3['amount_after_discount'].' lei</td>'.
                                        '<td align="center" style="color: green;">'.$row3['status'].'</td>'.
                                    '</tr>';
                                    }elseif($row3['status'] === "Отменён"){
                                        echo '<tr>'.
                                        '<td align="center">'.$number.'</td>'.
                                        '<td align="center">'.$row3['type'].'</td>'.
                                        '<td align="center">'.$row3['model'].'</td>'.
                                        '<td align="center">'.$row3['quantity'].'</td>'.
                                        '<td align="center">'.$row3['amount_after_discount'].' lei</td>'.
                                        '<td align="center" style="color: red;">'.$row3['status'].'</td>'.
                                    '</tr>';
                                    }
                                    
                                }
                                echo '</table>'.       
                                '</div>';
                            }else{
                                echo '<p class="textNoPurchases">У вас нет покупок, но вы можете это исправить.</p>'.
                                '<div class="down-bar-btn-1">'.
                                    '<a href="main.php"><button class="button1" name="shopingBtn">Купить</button></a>'.
                                '</div>';
                            }
                        }
                    ?>

            </div>
        </section>
    </body>
</html>