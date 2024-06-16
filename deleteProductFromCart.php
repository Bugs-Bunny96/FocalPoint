<?php
session_start();
echo $_POST["deleteBtn"];
$host="127.0.0.1:3306";
$user="root"; 
$db_password="";
$dbname="shop";
$connection=mysqli_connect($host, $user, $db_password, $dbname);

$query = "DELETE FROM `t_cart` WHERE `id` = ".$_POST["deleteBtn"]."";
//var_dump ($query);
$result = mysqli_query($connection, $query);
echo $result;
header('Location: cart.php');

?>