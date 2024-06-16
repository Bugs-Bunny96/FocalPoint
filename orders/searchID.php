<?php
session_start();

$host="127.0.0.1:3306";
$user="root"; 
$db_password="";
$dbname="shop";
$connection=mysqli_connect($host, $user, $db_password, $dbname);

//$number = ($_POST['id_product']);
//$number = ltrim($number, '0'); // удаляем лидирующие нули
if($_POST['search_btn'] == 'searchProduct'){
    $id_product=htmlspecialchars($_POST['id_product']);
    header("Location: searchProduct.php?id_product=" . urlencode($id_product));
    exit;
}elseif($_POST['search_btn'] == 'searchUser'){
    $id_user=htmlspecialchars($_POST['id_user']);
    header("Location: searchUser.php?id_user=" . urlencode($id_user));
    exit;
}
exit;