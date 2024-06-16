<?php
session_start();
unset($_SESSION['username']);
header('Location: main.php');
session_destroy();