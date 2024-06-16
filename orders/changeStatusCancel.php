<html>
<style>
        body {
    background:  url(images/fon.jpg); /* Цвет фона и путь к файлу */
    }
    </style>
</style>
<?php
session_start();

$host="127.0.0.1:3306";
$user="root"; 
$db_password="";
$dbname="shop";
$connection=mysqli_connect($host, $user, $db_password, $dbname);

$id_user = $_POST["id_user"];
$amount_after_discount = $_POST["amount_after_discount"];
$id_Order = $_POST["id_Order"];
$id_product = $_POST["id_product"];
$status = $_POST["status"];
$quantity = $_POST["quantity"];

// Выбираем продукт по id и вытаскиваем его колличество
$query3 = ("SELECT `quantity` FROM `t_products` WHERE `id` = '$id_product'");
$result3 = mysqli_query($connection, $query3);
If ($result3) {
    $num3=mysqli_num_rows($result3);
    if($num3>0) {
        while ($row3=mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
            $remains=$row3['quantity'];
        }
    }
}

if($status === "Доставлен"){
    $upshot = $remains - $quantity;
    if($upshot<0){
        echo '<p style="display: flex; justify-content: center; margin-top: 50px; color: red;">Ошибка! Продуктов на складе меньше чем заказаных продуктов!</p>';
        echo '<div class = "btnBack2" style="display: flex; justify-content: center; margin-top: 30px;">'.
        '<input type="button" value="Вернуться" onclick="history.back()">'.
        '</div>';
    }else{
        // Меняем колличество продуктво на складе
        $query2 = ("UPDATE `t_products` SET `quantity` = '$upshot'  WHERE `id` = ".$id_product."");
        $result2 = mysqli_query($connection, $query2);
        // Меняем статус заказа
        $query = ("UPDATE `t_orders` SET `status` = '$status'  WHERE `id` = ".$id_Order."");
        $result = mysqli_query($connection, $query);
        // Выбираем пользователя, устанавливаем ему скидку и общий счёт его покупок
        $query4 = ("SELECT `total` FROM  `t_users` WHERE `id` = '$id_user'");
        $result4 = mysqli_query($connection, $query4);
        If ($result4) {
            $num4=mysqli_num_rows($result4);
            if($num4>0) {
                while ($row4=mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
                    $total = $row4['total'];
                }
            }
        }
        
        $total = $total+$amount_after_discount;
        
        $query5 = ("UPDATE `t_users` SET `total` = '$total' WHERE `id` ='$id_user'");
        $result5 = mysqli_query($connection, $query5);
        
        $query6 = ("SELECT `discount`,`total` FROM `t_users` WHERE `id` = '$id_user'");
        $result6 = mysqli_query($connection, $query6);
        If ($result6) {
            $num6=mysqli_num_rows($result6);
            if($num6>0) {
                while ($row6=mysqli_fetch_array($result6, MYSQLI_ASSOC)) {
                    $discount=$row6['discount'];
                    $total=$row6['total'];
                }
            }
        }
        
        if($total>= 100000){
            $discount = 15;
        }elseif($total>= 50000){
            $discount = 10;
        }elseif($total>= 25000){
            $discount = 7;
        }elseif($total>= 10000){
            $discount = 5;
        }elseif($total>= 3000){
            $discount = 2;
        }elseif($total>= 1000){
            $discount = 1;
        }else{
            $discount = 0;
        }
        
        $query7 = ("UPDATE `t_users` SET `discount` = '$discount' WHERE `id` = '$id_user'");
        $result7 = mysqli_query($connection, $query7);

        header('Location: ordersPageCancel.php');
    }
}elseif($status === "Подтверждён"){
    $upshot = $remains - $quantity;
    if($upshot<0){
        echo '<p style="display: flex; justify-content: center; margin-top: 50px; color: red;">Ошибка! Продуктов на складе меньше чем заказаных продуктов!</p>';
        echo '<div class = "btnBack2" style="display: flex; justify-content: center; margin-top: 30px;">'.
        '<input type="button" value="Вернуться" onclick="history.back()">'.
        '</div>';
    }else{
        $query2 = ("UPDATE `t_products` SET `quantity` = '$upshot'  WHERE `id` = ".$id_product."");
        $result2 = mysqli_query($connection, $query2);
    
        $query = ("UPDATE `t_orders` SET `status` = '$status'  WHERE `id` = ".$id_Order."");
        $result = mysqli_query($connection, $query);
        header('Location: ordersPageCancel.php');
    }
}else{
    $query = ("UPDATE `t_orders` SET `status` = '$status'  WHERE `id` = ".$id_Order."");
    $result = mysqli_query($connection, $query);
    header('Location: ordersPageCancel.php');
}

?>