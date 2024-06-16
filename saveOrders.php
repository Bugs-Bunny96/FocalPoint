<?php
session_start();

require_once "bd.php";
$id_user = $_SESSION['id'];
//echo $id_user;

$query = "SELECT `id`,`id_product`,`id_user`,`type`, `model`,`price`,`quantity`,`total_quantity`,`amount` FROM `t_cart` WHERE id_user = '$id_user'";
//var_dump($query);

$result = mysqli_query($connection, $query);

$total_amount = $_POST["total_amount"];
$order_date = $_POST["order_date"];
$city = $_POST["city"];
$street = $_POST["street"];
$home = $_POST["home"];
$name = $_POST["name"];
$surname = $_POST["surname"];
$tel = $_POST["tel"];
$status = $_POST["status"];
$discount = $_POST["discount"];

$percent=(100-$discount)/100;


if($result){
    $num=mysqli_num_rows($result);
    if($num>0) {
        while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
            $rows[] = $row;
        }
    }
}


$sql = array(); 
foreach( $rows as $row ) {
    $sql[] = '(\''.$row['id_user'].'\', \''.$row['id_product'].'\', \''.$row['quantity'].'\', \''.$row['amount'].'\', \''.$_POST["discount"].'\',
    \''.$row['amount']*$percent.'\',\''.$_POST["total_amount"].'\', \''.$_POST["city"].'\', \''.$_POST["street"].'\', \''.$_POST["home"].'\', 
    \''.$_POST["name"].'\', \''.$_POST["surname"].'\', \''.$_POST["tel"].'\', \''.$_POST["order_date"].'\', 
    \''.$_POST["status"].'\') ';
}


$query2 = "INSERT INTO `t_orders` (`id_user`, `id_product`, `quantity`, `amount`, `discount`, `amount_after_discount`,`total_amount`, 
`city`, `street`, `home`, `name`,`surname`,`tel`,`order_date`,`status`) VALUES " .implode(',', $sql);
//print_r($query2);

$result1 = mysqli_query($connection, $query2);



$query3 = "DELETE FROM `t_cart` WHERE `id_user` = '$id_user'";
//var_dump ($query);
$result3 = mysqli_query($connection, $query3);

header('Location: userpage.php');

?>