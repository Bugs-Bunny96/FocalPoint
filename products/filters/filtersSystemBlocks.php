<?php
session_start();
require_once "../../bd.php";

// Получение значения processor из массива $_POST
$selectedProcessor = $_POST['processor'] ?? array('Intel Core', 'AMD');
$checkProcessor = ($selectedProcessor === array('Intel Core', 'AMD') && !isset($_POST['processor'])) ? null : $selectedProcessor;

// Получение значения type_video_card из массива $_POST
$selectedTypeVideoCard = $_POST['typevidiocard'] ?? array('Встроенная', 'Дискретная');
$checkTypeVideoCard = ($selectedTypeVideoCard === array('Встроенная', 'Дискретная') && !isset($_POST['typevidiocard'])) ? null : $selectedTypeVideoCard;

// Получение значения video_card из массива $_POST
$selectedVideoCard = $_POST['videocard'] ?? array('GeForce', 'Asus', 'MSI', 'Gigabyte', 'Intel', 'AMD');
$checkVideoCard = ($selectedVideoCard === array('GeForce', 'Asus', 'MSI', 'Gigabyte', 'Intel', 'AMD') && !isset($_POST['videocard'])) ? null : $selectedVideoCard;

// Получение значения ram из массива $_POST
$selectedRam = $_POST['ram'] ?? array('64 GB','32 GB', '24 GB', '20 GB', '16 GB', '12 GB', '8 GB');
$checkRam = ($selectedRam === array('64 GB','32 GB', '24 GB', '20 GB', '16 GB', '12 GB', '8 GB') && !isset($_POST['ram'])) ? null : $selectedRam;

// Получение значения drive_type из массива $_POST
$selectedTypeDrive = $_POST['drivetype'] ?? array('SSD', 'HDD');
$checkTypeDrive = ($selectedTypeDrive === array('SSD', 'HDD') && !isset($_POST['drivetype'])) ? null : $selectedTypeDrive;

// Получение значения volum_drive из массива $_POST
$selectedVolumDrive = $_POST['volumdrive'] ?? array('128 GB', '256 GB', '512 GB', '1 TB', '2 TB', '4 TB', '8 TB');
$checkVolumDrive = ($selectedVolumDrive === array('128 GB', '256 GB', '512 GB', '1 TB', '2 TB', '4 TB', '8 TB') && !isset($_POST['volumdrive'])) ? null : $selectedVolumDrive;

// Получение значения resolution из массива $_POST
$selectedPortLan = $_POST['port_lan'] ?? array('50 Mb', '100 Mb', '1 Gb', '10 Gb');
$checkPortLan = ($selectedPortLan === array('50 Mb', '100 Mb', '1 Gb', '10 Gb') && !isset($_POST['port_lan'])) ? null : $selectedPortLan;


$_SESSION['selectSystemBlocks'] = "SELECT * FROM `t_products` WHERE processor IN ('" . implode("', '", $selectedProcessor) . "')
AND type_video_card IN ('" . implode("', '", $selectedTypeVideoCard) . "') AND video_card IN ('" . implode("', '", $selectedVideoCard) . "')
AND ram IN ('" . implode("', '", $selectedRam) . "') AND type_drive IN ('" . implode("', '", $selectedTypeDrive) . "')
AND volum_drive IN ('" . implode("', '", $selectedVolumDrive) . "') AND port_lan IN ('" . implode("', '", $selectedPortLan) . "')";
//print_r($_SESSION['select']);

header('Location: ../systemBlocks.php?processor=' . implode(',', $checkProcessor) . '&type_video_card=' . implode(',', $checkTypeVideoCard) 
. '&video_card=' . implode(',', $checkVideoCard) . '&ram=' . implode(',', $checkRam) . '&type_drive=' . implode(',', $checkTypeDrive)
. '&volum_drive=' . implode(',', $checkVolumDrive) . '&port_lan=' . implode(',', $checkPortLan));
exit();

?>
