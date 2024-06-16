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
    //$HTML = "<input type="button" onclick="history.back();" value="Назад"/>";
    //print $HTML;

    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['tel'] = $tel;

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
      // проверка на существование пользователя с таким же логином
   
      $query="SELECT `id` FROM `t_users` WHERE `username` ='$username'";
      
      $result=mysqli_query($connection, $query);
      
      //$_SESSION['id'] = $result['id'];
      
    //$result = mysqli_query("SELECT `id` FROM `usertbl` WHERE `username` ='$username'",$db);
    $myrow = mysqli_fetch_array($result);
    $_SESSION['id'] = $myrow;
    echo "->" .$_SESSION['id'];
    if (!empty($myrow['id'])) {
    exit (" <br> <p class='texterror'> Извините, введённый вами логин уже зарегистрирован. Введите другой логин.</p> <br>
    <div class='btnBack2'><input type='button' value='Вернутся' onclick='history.back()'></div>");
    }

    if($password != $password_confirm){
        exit (" <p class='texterror'>Ошибка! Пароли не совпадают!</p> <br>
        <div class='btnBack2'><input type='button' value='Вернутся' onclick='history.back()'></div>");

    }elseif($password === $password_confirm) { 
    // если такого пользователя нет, то сохраняем данные 
        $password = md5($password);
        $query2="INSERT INTO `t_users` (`first_name`, `last_name`, `username`, `password`, `tel`) VALUES ('$first_name','$last_name','$username','$password','$tel')";
        $result2=mysqli_query($connection, $query2);

        $query3="SELECT * FROM `t_users` WHERE `username` ='$username'";
        $result3=mysqli_query($connection, $query3);

        if (mysqli_num_rows($result3) > 0) {
            while($rowData = mysqli_fetch_array($result3)){
                  //echo $rowData["id"].'<br>';
                  $user_id = $rowData["id"];
                  $admin_flag = $rowData["admin_flag"];
   
                  $_SESSION['admin_flag'] = $rowData["admin_flag"];
                  $_SESSION['id'] = $rowData["id"];
            }
        }
    }

    //$result2 = mysqli_query ("INSERT INTO `usertbl` (`full_name`, `email`, `username`, `password`) VALUES ('$full_name','$email','$username','$password')");
    // Проверяем, есть ли ошибки
    if ($result2=='TRUE')
    {
    echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='main.php'>Главная страница</a>";
    header('Location: userpage.php');
    }else {
        exit (" <p class='texterror'> Ошибка! Вы не зарегистрированы! </p> <br>
        <div class='btnBack2'><input type='button' value='Вернутся' onclick='history.back()'></div>");
    }
    ?>