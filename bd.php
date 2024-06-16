<?php
// Новые параметры подключения к БД
$host="127.0.0.1:3306";
$user="root"; 
$db_password="";
$dbname="shop";

// Устанавливаем соединение с БД
$connection=mysqli_connect($host, $user, $db_password, $dbname);

// Проверяем, удалось ли установить соединение
if (!$connection) {
    die("Не удалось установить соединение с БД: " . mysqli_connect_error());
}

?>