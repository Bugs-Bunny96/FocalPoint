<?php
session_start();
echo $_POST["deleteBtn"];
$host="127.0.0.1:3306";
$user="root"; 
$db_password="";
$dbname="shop";
$connection=mysqli_connect($host, $user, $db_password, $dbname);

if ($_POST['deleteBtn-L'] !== null) {
    $query = "DELETE FROM `t_products` WHERE `id` = ".$_POST["deleteBtn-L"]."";
    $result = mysqli_query($connection, $query);
    header('Location: laptop.php');
  }elseif($_POST['deleteBtn-T'] !== null){
    $query = "DELETE FROM `t_products` WHERE `id` = ".$_POST["deleteBtn-T"]."";
    $result = mysqli_query($connection, $query);
    header('Location: tablet.php');
  }elseif($_POST['deleteBtn-SB'] !== null){
    $query = "DELETE FROM `t_products` WHERE `id` = ".$_POST["deleteBtn-SB"]."";
    $result = mysqli_query($connection, $query);
    header('Location: systemBlocks.php');
  }elseif($_POST['deleteBtn-M'] !== null){
    $query = "DELETE FROM `t_products` WHERE `id` = ".$_POST["deleteBtn-M"]."";
    $result = mysqli_query($connection, $query);
    header('Location: monitor.php');
  }else{
    header('Location: ../main.php');
  }

?>