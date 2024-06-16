<html>
    <head>
    <title>Registration</title>
    <style>
    body {
    background:  url(images/fon.jpg); /* Цвет фона и путь к файлу */
    }
    </style>
    <link rel="stylesheet" href="styleLogin.css">
    </head>
    <body>

<?php
   session_start();
   if (isset($_POST['first_name'])) { $first_name = $_POST['first_name']; if ($first_name == '') { unset($first_name);} }
   if (isset($_POST['last_name'])) { $last_name = $_POST['last_name']; if ($last_name == '') { unset($last_name);} }
   if (isset($_POST['username'])) { $username = $_POST['username']; if ($username == '') { unset($username);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
   if (isset($_POST['password'])) { $password = $_POST['password']; if ($password == '') { unset($password);} } //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
   if (isset($_POST['password_confirm'])) { $password_confirm = $_POST['password_confirm']; if ($password_confirm == '') { unset($password_confirm);} } //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
   if (isset($_POST['tel'])) { $tel = $_POST['tel']; if ($tel == '') { unset($tel);} }
   if (empty($username) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }

    //если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $first_name = stripslashes($first_name);
    $first_name = htmlspecialchars($first_name);
    $last_name = stripslashes($last_name);
    $last_name = htmlspecialchars($last_name);
    $username = stripslashes($username);
    $username = htmlspecialchars($username);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
    $tel = stripslashes($tel);
    $tel = htmlspecialchars($tel);
      //удаляем лишние пробелы
      //echo "before = ",$full_name,$email, $username, $password, "\n";
    $tel = trim($tel);
    $username = trim($username);
    $password = trim($password);
    $password_confirm = trim($password_confirm);

    // подключаемся к базе
    include ("bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
 
    $query="SELECT * FROM `t_users` WHERE `username` ='$username'";

    $result=mysqli_query($connection, $query);

    //$result = mysqli_query("SELECT * FROM `usertbl` WHERE `username` ='$username'",$db); //извлекаем из базы все данные о пользователе с введенным логином
    $myrow = mysqli_fetch_array($result);
    if (empty($myrow['username']))
    {
    //если пользователя с введенным логином не существует
    exit (" <br> <p class='texterror'> Ошибка! Неверный логин или пароль!</p> <br>
    <div class='btnBack2'><input type='button' value='Вернутся' onclick='history.back()'></div>");
    }
    else {
    //если существует, то сверяем пароли
    $password = md5($_POST['password']); // используем md5 чтобы сравнить его с тем что в бд
    if ($myrow['password']==$password) {
    //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
    $_SESSION['id']=$myrow['id'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
    $_SESSION['first_name']=$myrow['first_name']; 
    $_SESSION['last_name']=$myrow['last_name']; 
    $_SESSION['username']=$myrow['username']; 
    $_SESSION['password']=$myrow['password']; 
    $_SESSION['tel']=$myrow['tel']; 
    echo "Вы успешно вошли на сайт! <a href='userpage.php'>Профиль</a>";
    header('Location: userpage.php');
    }
     else {
    //если пароли не сошлись
    exit (" <br> <p class='texterror'> Ошибка! Неверный логин или пароль!</p> <br>
    <div class='btnBack2'><input type='button' value='Вернутся' onclick='history.back()'></div>");
    }
    
    }
    ?>