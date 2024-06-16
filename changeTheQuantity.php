<?php
session_start();
//echo $_POST["id_product"];
//echo $_POST["changeBtn"];
//echo $_POST["price"];
$host="127.0.0.1:3306";
$user="root"; 
$db_password="";
$dbname="shop";
$connection=mysqli_connect($host, $user, $db_password, $dbname);

$id_product = $_POST["id_product"];
$change = $_POST["changeBtn"];
$price = $_POST["price"];
$total = $change*$price;
//echo $total;

$query = ("UPDATE `t_cart` SET `quantity` = '$change', `amount` = '$total'  WHERE `id_product` = ".$id_product."");
//var_dump ($query);
$result = mysqli_query($connection, $query);
//echo $result;
header('Location: cart.php');

?>