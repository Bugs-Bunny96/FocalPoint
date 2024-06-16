<?php
session_start();
require_once "../bd.php";

$id=$_POST['id'];
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
    $query = ("UPDATE `t_products` SET `type` = '$type',`model` = '$model',`model_series` = '$model_series', `processor` = '$processor',
    `processor_series` = '$processor_series',`type_video_card` = '$type_video_card',`video_card` = '$video_card',`video_card_series` = '$video_card_series',
    `ram` = '$ram',`type_drive` = '$type_drive',`volum_drive` = '$volum_drive',`diagonal` = '$diagonal',`resolution` = '$resolution',
    `battery` = '$battery',`video` = '$video',`color` = '$color',`frequency` = '$frequency',`screen_type` = '$screen_type',`port_lan` = '$port_lan',
    `speaker` = '$speaker',`camera` = '$camera',`material` = '$material',`price` = '$price',`quantity` = '$quantity',`warranty` = '$warranty',
    `image` = '$img' WHERE `id` = '$id'");
}else {
    $query = ("UPDATE `t_products` SET `type` = '$type',`model` = '$model',`model_series` = '$model_series', `processor` = '$processor',
    `processor_series` = '$processor_series',`type_video_card` = '$type_video_card',`video_card` = '$video_card',`video_card_series` = '$video_card_series',
    `ram` = '$ram',`type_drive` = '$type_drive',`volum_drive` = '$volum_drive',`diagonal` = '$diagonal',`resolution` = '$resolution',
    `battery` = '$battery',`video` = '$video',`color` = '$color',`frequency` = '$frequency',`screen_type` = '$screen_type',`port_lan` = '$port_lan',
    `speaker` = '$speaker',`camera` = '$camera',`material` = '$material',`price` = '$price',`quantity` = '$quantity',`warranty` = '$warranty'
     WHERE `id` = '$id'");
}

$result=mysqli_query($connection, $query); 

if ($_POST['submit-upd-L'] == 'Изменить продукт') {
    header('Location: ../products/laptop.php');
  }elseif($_POST['submit-upd-T'] == 'Изменить продукт'){
    header('Location: ../products/tablet.php');
  }elseif($_POST['submit-upd-SB'] == 'Изменить продукт'){
    header('Location: ../products/systemBlocks.php');
  }elseif($_POST['submit-upd-M'] == 'Изменить продукт'){
    header('Location: ../products/monitor.php');
  }

