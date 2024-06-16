<?php
session_start();
require_once "../bd.php";

$id_product=$_POST['id'];
$type=htmlspecialchars($_POST['type']);
$model=htmlspecialchars($_POST['model']);
$price=htmlspecialchars($_POST['price']);
$quantity=htmlspecialchars($_POST['quantity']);
$total_quantity=htmlspecialchars($_POST['quantity']);
$amount=htmlspecialchars($_POST['price']);
$buy = $_POST['buy'];
$id_user = $_SESSION['id'];

// Подготовить запрос на выборку продукта из корзины
$query="SELECT * FROM `t_cart` WHERE `id_product` = $id_product AND `id_user` =  $id_user";
// Выполнить запрос на выборку      
$result=mysqli_query($connection, $query);
// Получить результат запроса
$row = mysqli_fetch_assoc($result);

if ($row !== null) {
    // Если продукт уже есть в корзине, увеличить его количество на 1
    $quantity = $row['quantity'] + 1;
    $total_quantity=$row['total_quantity'];

    if($quantity>$total_quantity){
        if($buy === "Купить"){
            header('Location: ../cart.php');
            exit();
        }elseif($type==="Ноутбуки"){
            header('Location: laptop.php');
            exit();
        }elseif($type==="Планшеты"){
            header('Location: tablet.php');
            exit();
        }elseif($type==="Системные блоки"){
            header('Location: systemBlocks.php');
            exit();
        }elseif($type==="Мониторы"){
            header('Location: monitor.php');
            exit();
        }else{
            header('Location: ../main.php');
            exit();
        }
    }else{
        $price = $row['price'];
        $amount = $price*$quantity;
    }
  
    // Подготовить запрос на обновление данных в корзине
    $sql = "UPDATE `t_cart` SET `quantity`= $quantity, `amount`= $amount WHERE `id_product` = $id_product AND `id_user` =  $id_user";
  
    // Выполнить запрос на обновление данных в корзине
    mysqli_query($connection, $sql);

    if($buy === "Купить"){
        header('Location: ../cart.php');
        exit();
    }elseif($type==="Ноутбуки"){
        header('Location: laptop.php');
        exit();
    }elseif($type==="Планшеты"){
        header('Location: tablet.php');
        exit();
    }elseif($type==="Системные блоки"){
        header('Location: systemBlocks.php');
        exit();
    }elseif($type==="Мониторы"){
        header('Location: monitor.php');
        exit();
    }else{
        header('Location: ../main.php');
        exit();
    }
  } else {
    // Если продукта нет в корзине, добавить его
    $sql = "INSERT INTO `t_cart` (`id_product`, `id_user`, `type`, `model`, `price`, `quantity`, `total_quantity`, `amount`) VALUES ($id_product, $id_user, '$type', '$model', $price, 1, $total_quantity, $amount)";

    // Выполнить запрос на добавление нового продукта в корзину
    mysqli_query($connection, $sql);

    if($buy === "Купить"){
        header('Location: ../cart.php');
        exit();
    }elseif($type==="Ноутбуки"){
        header('Location: laptop.php');
        exit();
    }elseif($type==="Планшеты"){
        header('Location: tablet.php');
        exit();
    }elseif($type==="Системные блоки"){
        header('Location: systemBlocks.php');
        exit();
    }elseif($type==="Мониторы"){
        header('Location: monitor.php');
        exit();
    }else{
        header('Location: ../main.php');
        exit();
    }
  }
