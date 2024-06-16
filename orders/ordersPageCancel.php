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
                            
                        echo '</ul>

                    <div class="main-header-right">
                        <ul class="main-header-right-button">
                            <li class="main-header-right-button-item"><a href="../cart.php" class="main-menu-link">Корзина</a></li>
                            <li class="main-header-right-button-item"><a href="../userpage.php" class="main-menu-link">Профиль</a></li>'?>
                                <?php if(!isset($_SESSION['id'])): ?>
                                    <li class="main-header-right-button-item"><a href="../aut.php" class="main-menu-link">Войти</a>
                                <?php else: ?>
                                    <li class="main-header-right-button-item"><a href="../logout.php" class="main-menu-link">Выход</a>
                                <?php endif; 
                            echo '</li>
                        </ul>
                    </div>
                </header>

                    <p class="text">Заказы</p>

                    <div class="search-div">
                        <form action="searchID.php" method="post">
                            <p class="search">Поиск продукта
                            <input class="input-pole" type="number" name="id_product" required pattern="[1-9][0-9]*" min="1" max="99999" placeholder="Введите id продукта">
                            <button name="search_btn" value="searchProduct">Найти</button></p>
                        </form>'.

                        '<form action="searchID.php" method="post">
                            <p class="search">Поиск пользователя
                            <input class="input-pole" type="number" name="id_user" required pattern="[1-9][0-9]*" min="1" max="99999" placeholder="Введите id пользователя">
                            <button name="search_btn" value="searchUser">Найти</button></p>
                        </form>
                    </div>';

                    echo'<div class="div-select">
                        <div clss="select-status">
                            <a class="select-status-link" href="ordersPageExpect.php">Ожидаемый</a>
                            <a class="select-status-link" href="ordersPageConfirm.php">Подтверждён</a>
                            <a class="select-status-link" href="ordersPageDeliver.php">Доставлен</a>
                            <a class="select-status-link" href="ordersPageCancel.php" style="color: #F3EAF3; font-size: 18px">Отменён</a>
                        </div>
                    </div>'?>

                    <?php
                        require_once "../bd.php";
                        $id_user = $_SESSION['id'];
                        $query3 = "SELECT o.id as id_Order, o.id_user, o.id_product , o.quantity, o.discount, o.amount_after_discount, o.city, 
                        o.street, o.home, o.name, o.surname, o.tel, o.order_date,  o.status, p.type, p.model, p.quantity as remains
                        FROM `t_orders` as o
                        JOIN `t_products` as p 
                        ON o.id_product = p.id
                        WHERE o.status = 'Отменён'";
                        $result3 = mysqli_query($connection, $query3);
                        //print_r($result3);

                        If ($result3) {
                            $num3=mysqli_num_rows($result3);
                            if($num3>0) {
                                echo '<div class="purchases">'.
                                '<table class="table">'.

                                    '<tr>'.
                                        '<th align="center">#</th>'.
                                        '<th align="center">id_U</th>'.
                                        '<th align="center">id_P</th>'.
                                        '<th align="center">Type</th>'.
                                        '<th align="center">Model</th>'.
                                        '<th align="center">Number of<br>products ordered</th>'.
                                        '<th align="center">Remains<br>products</th>'.
                                        '<th align="center">Summa</th>'.
                                        '<th align="center">City</th>'.
                                        '<th align="center">Street</th>'.
                                        '<th align="center">Home</th>'.
                                        '<th align="center">Name</th>'.
                                        '<th align="center">Surname</th>'.
                                        '<th align="center">Phone</th>'.
                                        '<th align="center">OrderDate</th>'.
                                        '<th align="center">Status</th>'.
                                    '</tr>';
                                    $number=0;
                                while ($row3=mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                                    $number=$number+1;
                                        echo '<tr>'.
                                        '<td align="center">'.$number.'</td>'.
                                        '<td align="center">'.$row3['id_user'].'</td>'.
                                        '<td align="center">'.$row3['id_product'].'</td>'.
                                        '<td align="center">'.$row3['type'].'</td>'.
                                        '<td align="center">'.$row3['model'].'</td>'.
                                        '<td align="center">'.$row3['quantity'].'</td>'.
                                        '<td align="center">'.$row3['remains'].'</td>'.
                                        '<td align="center">'.$row3['amount_after_discount'].' lei</td>'.
                                        '<td align="center">'.$row3['city'].'</td>'.
                                        '<td align="center">'.$row3['street'].'</td>'.
                                        '<td align="center">'.$row3['home'].'</td>'.
                                        '<td align="center">'.$row3['name'].'</td>'.
                                        '<td align="center">'.$row3['surname'].'</td>'.
                                        '<td align="center">'.$row3['tel'].'</td>'.
                                        '<td align="center">'.$row3['order_date'].'</td>'.
                                        '<td align="center" style="color: red;">

                                        <form class="changeStatus" action="changeStatusCancel.php" method="POST" style="margin-right: 10px;"><br>
                                        <input type="hidden" name="id_user" value="'.$row3['id_user'].'">
                                        <input type="hidden" name="id_Order" value="'.$row3['id_Order'].'">
                                        <input type="hidden" name="id_product" value="'.$row3['id_product'].'">
                                        <input type="hidden" name="quantity" value="'.$row3['quantity'].'">
                                        <input type="hidden" name="amount_after_discount" value="'.$row3['amount_after_discount'].'">
                                        <button class="changeBtn" name="changeBtn" style="margin-top: 0px; margin-bottom: 5px; border-radius: 5px; background-color: limegreen;">Обновить статус</button>
                                        <br>
                                        <select id="change" name="status" style="background-color: gray;" required>
                                        <option selected>'.$row3['status'].'</option>
                                        <option value="Ожидаемый" style="color: yellow;">Ожидаемый</option>
                                        <option value="Подтверждён" style="color: orange;">Подтверждён</option>
                                        <option value="Доставлен" style="color: green;">Доставлен</option>
                                        <option value="Отменён" style="color: red;">Отменён</option>
                                        </select>
                                        
                                        </form>
                                        </td>'.
                                    '</tr>';
                                }
                                echo '</table>'.       
                                '</div>';
                            }else{
                                echo '<p style="margin-top: 5%; text-align: center; color: orange;">Нет данных о заказах!</p>';   
                            }
                        }
                    
            echo '</div>
        </section>
    </body>
</html>';
}
?>