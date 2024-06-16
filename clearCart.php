<?php
session_start();
$host="127.0.0.1:3306";
$user="root"; 
$db_password="";
$dbname="shop";
$connection=mysqli_connect($host, $user, $db_password, $dbname);

$id_user=$_POST["clearBtn"];
//echo $id_user;

$query = "DELETE FROM `t_cart` WHERE `id_user` = '$id_user'";
//var_dump ($query);
$result = mysqli_query($connection, $query);
//echo $result;
header('Location: cart.php');

?>