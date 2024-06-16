<?php
session_start();
require_once "../../bd.php";

// Получение значения model из массива $_POST
$selectedManufacturer = $_POST['manufacturer'] ?? array('Acer','Asus','Lenovo','MSI','HP','Apple');
$checkModel = ($selectedManufacturer === array('Acer','Asus','Lenovo','MSI','HP','Apple') && !isset($_POST['manufacturer'])) ? null : $selectedManufacturer;

// Получение значения processor из массива $_POST
$selectedProcessor = $_POST['processor'] ?? array('Intel Core', 'AMD', 'Apple');
$checkProcessor = ($selectedProcessor === array('Intel Core', 'AMD', 'Apple') && !isset($_POST['processor'])) ? null : $selectedProcessor;

// Получение значения type_video_card из массива $_POST
$selectedTypeVideoCard = $_POST['typevidiocard'] ?? array('Встроенная', 'Дискретная');
$checkTypeVideoCard = ($selectedTypeVideoCard === array('Встроенная', 'Дискретная') && !isset($_POST['typevidiocard'])) ? null : $selectedTypeVideoCard;

// Получение значения video_card из массива $_POST
$selectedVideoCard = $_POST['videocard'] ?? array('GeForce', 'Intel', 'AMD', 'Apple');
$checkVideoCard = ($selectedVideoCard === array('GeForce', 'Intel', 'AMD', 'Apple') && !isset($_POST['videocard'])) ? null : $selectedVideoCard;

// Получение значения ram из массива $_POST
$selectedRam = $_POST['ram'] ?? array('32 GB', '24 GB', '20 GB', '16 GB', '12 GB', '8 GB', '4 GB');
$checkRam = ($selectedRam === array('32 GB', '24 GB', '20 GB', '16 GB', '12 GB', '8 GB', '4 GB') && !isset($_POST['ram'])) ? null : $selectedRam;

// Получение значения drive_type из массива $_POST
$selectedTypeDrive = $_POST['drivetype'] ?? array('SSD', 'HDD');
$checkTypeDrive = ($selectedTypeDrive === array('SSD', 'HDD') && !isset($_POST['drivetype'])) ? null : $selectedTypeDrive;

// Получение значения volum_drive из массива $_POST
$selectedVolumDrive = $_POST['volumdrive'] ?? array('128 GB', '256 GB', '512 GB', '1 TB', '2 TB', '4 TB', '8 TB');
$checkVolumDrive = ($selectedVolumDrive === array('128 GB', '256 GB', '512 GB', '1 TB', '2 TB', '4 TB', '8 TB') && !isset($_POST['volumdrive'])) ? null : $selectedVolumDrive;

// Получение значения diagonal из массива $_POST
$selectedDiagonal = $_POST['diagonal'] ?? array('13”', '13.3”', '14”', '15.6”', '17”');
$checkDiagonal = ($selectedDiagonal === array('13”', '13.3”', '14”', '15.6”', '17”') && !isset($_POST['diagonal'])) ? null : $selectedDiagonal;

// Получение значения resolution из массива $_POST
$selectedResolution = $_POST['resolution'] ?? array('HD', 'FHD', 'WQHD', 'UHD');
$checkResolution = ($selectedResolution === array('HD', 'FHD', 'WQHD', 'UHD') && !isset($_POST['resolution'])) ? null : $selectedResolution;


$_SESSION['selectLaptop'] = "SELECT * FROM `t_products` WHERE model IN ('" . implode("', '", $selectedManufacturer) . "') AND 
processor IN ('" . implode("', '", $selectedProcessor) . "') AND type_video_card IN ('" . implode("', '", $selectedTypeVideoCard) . "') AND 
video_card IN ('" . implode("', '", $selectedVideoCard) . "') AND ram IN ('" . implode("', '", $selectedRam) . "') AND 
type_drive IN ('" . implode("', '", $selectedTypeDrive) . "') AND volum_drive IN ('" . implode("', '", $selectedVolumDrive) . "') AND 
diagonal IN ('" . implode("', '", $selectedDiagonal) . "') AND resolution IN ('" . implode("', '", $selectedResolution) . "')";
//print_r($_SESSION['select']);

header('Location: ../laptop.php?manufacturer='.implode(',', $checkModel) .'&processor=' . implode(',', $checkProcessor) . '&type_video_card=' . implode(',', $checkTypeVideoCard) 
. '&video_card=' . implode(',', $checkVideoCard) . '&ram=' . implode(',', $checkRam) . '&type_drive=' . implode(',', $checkTypeDrive) . '&volum_drive=' . implode(',', $checkVolumDrive)
. '&diagonal=' . implode(',', $checkDiagonal). '&resolution=' . implode(',', $checkResolution));
exit();

?>
