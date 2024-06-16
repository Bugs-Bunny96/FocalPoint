<?php
session_start();
if ($_POST['reset_filter_btn'] == 'resetLaptop') {
    $_SESSION['selectLaptop'] = '';
    header('Location: laptop.php');
  }elseif($_POST['reset_filter_btn'] == 'resetTablet'){
    $_SESSION['selectTablet'] = '';
    header('Location: tablet.php');
  }elseif($_POST['reset_filter_btn'] == 'resetSystemBlocks'){
    $_SESSION['selectSystemBlocks'] = '';
    header('Location: systemBlocks.php');
  }elseif($_POST['reset_filter_btn'] == 'resetMonitor'){
    $_SESSION['selectMonitor'] = '';
    header('Location: monitor.php');
  }
//header('Location: laptop.php')
?>