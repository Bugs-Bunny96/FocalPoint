<?php
session_start();
require_once "../bd.php";

$type=htmlspecialchars($_POST['type']);
$model=htmlspecialchars($_POST['model']);
$model_series=htmlspecialchars($_POST['model_series']);
$processor=htmlspecialchars($_POST['processor']);
$processor_series=htmlspecialchars($_POST['processor_series']);
$type_video_card=htmlspecialchars($_POST['type_video_card']);
$video_card=htmlspecialchars($_POST['video_card']);
$video_card_series=htmlspecialchars($_POST['video_card_series']);
$ram=htmlspecialchars($_POST['ram']);
$type_drive=htmlspecialchars($_POST['type_drive']);
$volum_drive=htmlspecialchars($_POST['volum_drive']);
$diagonal=htmlspecialchars($_POST['diagonal']);
$resolution=htmlspecialchars($_POST['resolution']);
$battery=htmlspecialchars($_POST['battery']);
$video=htmlspecialchars($_POST['video']);
$color=htmlspecialchars($_POST['color']);
$frequency=htmlspecialchars($_POST['frequency']);
$screen_type=htmlspecialchars($_POST['screen_type']);
$port_lan=htmlspecialchars($_POST['port_lan']);
$speaker=htmlspecialchars($_POST['speaker']);
$camera=htmlspecialchars($_POST['camera']);
$material=htmlspecialchars($_POST['material']);
$price=htmlspecialchars($_POST['price']);
$quantity=htmlspecialchars($_POST['quantity']);
$warranty=htmlspecialchars($_POST['warranty']);


if(!empty($_FILES['image']['tmp_name'])) {$img = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $connection-> query("INSERT INTO `t_products` (`id`,`type`,`model`, `model_series`,`processor`,`processor_series`,`type_video_card`,`video_card`,`video_card_series`,`ram`,`type_drive`,`volum_drive`,`diagonal`,`resolution`,`battery`,`video`,`color`,`frequency`,`screen_type`,`port_lan`,`speaker`,`camera`,`material`,`price`,`quantity`,`warranty`,`image`)  
    VALUES ('0','$type', '$model', '$model_series', '$processor', '$processor_series', '$type_video_card', '$video_card', '$video_card_series', '$ram', '$type_drive', '$volum_drive', '$diagonal', '$resolution', '$battery', '$video', '$color', '$frequency','$screen_type','$port_lan','$speaker','$camera','$material', '$price', '$quantity', '$warranty', '$img')");
}

$result=mysqli_query($connection, $query);

header('Location: ../userpage.php');

/*
If (!$result) {   echo "Ошибка";
}

// переадресация после отправления сообщения
if ( $_SESSION['admin_flag'] == 0) {
    header('Location: ../userpage.php');
}
if ( $_SESSION['admin_flag'] == 1) {
    header('Location: userpage.php');
}*/