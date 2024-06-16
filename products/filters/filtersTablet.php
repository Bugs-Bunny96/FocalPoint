<?php
session_start();
require_once "../../bd.php";

// Получение значения model из массива $_POST
$selectedManufacturer = $_POST['manufacturer'] ?? array('Xiaomi', 'Samsung', 'Apple', 'HP', 'Lenovo', 'Honor', 'Huawei');
$checkModel = ($selectedManufacturer === array('Xiaomi', 'Samsung', 'Apple', 'HP', 'Lenovo', 'Honor', 'Huawei') && !isset($_POST['manufacturer'])) ? null : $selectedManufacturer;

// Получение значения ram из массива $_POST
$selectedRam = $_POST['ram'] ?? array('2 GB', '3 GB', '4 GB', '6 GB', '8 GB', '10 GB', '12 GB');
$checkRam = ($selectedRam === array('2 GB', '3 GB', '4 GB', '6 GB', '8 GB', '10 GB', '12 GB') && !isset($_POST['ram'])) ? null : $selectedRam;

// Получение значения volum_drive из массива $_POST
$selectedVolumDrive = $_POST['volumdrive'] ?? array('32 GB', '64 GB', '128 GB', '256 GB', '512 GB', '1 TB');
$checkVolumDrive = ($selectedVolumDrive === array('32 GB', '64 GB', '128 GB', '256 GB', '512 GB', '1 TB') && !isset($_POST['volumdrive'])) ? null : $selectedVolumDrive;

// Получение значения diagonal из массива $_POST
$selectedDiagonal = $_POST['diagonal'] ?? array('8”', '8.7”', '10.1”', '10.3”', '10.4”', '10.5”', '10.6”', '11”', '11.5”');
$checkDiagonal = ($selectedDiagonal === array('8”', '8.7”', '10.1”', '10.3”', '10.4”', '10.5”', '10.6”', '11”', '11.5”') && !isset($_POST['diagonal'])) ? null : $selectedDiagonal;

// Получение значения resolution из массива $_POST
$selectedResolution = $_POST['resolution'] ?? array('HD', 'FHD', 'WXGA', 'WUXGA', 'UHD', 'WQXGA');
$checkResolution = ($selectedResolution === array('HD', 'FHD', 'WXGA', 'WUXGA', 'UHD', 'WQXGA') && !isset($_POST['resolution'])) ? null : $selectedResolution;

// Получение значения frequency из массива $_POST
$selectedFrequency = $_POST['frequency'] ?? array('60 Hz', '90 Hz', '120 Hz', '144 Hz');
$checkFrequency = ($selectedFrequency === array('60 Hz', '90 Hz', '120 Hz', '144 Hz') && !isset($_POST['frequency'])) ? null : $selectedFrequency;


$_SESSION['selectTablet'] = "SELECT * FROM `t_products` WHERE model IN ('" . implode("', '", $selectedManufacturer) . "')
AND ram IN ('" . implode("', '", $selectedRam) . "') AND volum_drive IN ('" . implode("', '", $selectedVolumDrive) . "')
AND diagonal IN ('" . implode("', '", $selectedDiagonal) . "') AND resolution IN ('" . implode("', '", $selectedResolution) . "')
AND frequency IN ('" . implode("', '", $selectedFrequency) . "')";
//print_r($_SESSION['select']);

header('Location: ../tablet.php?manufacturer='.implode(',', $checkModel) . '&ram=' . implode(',', $checkRam)
. '&volum_drive=' . implode(',', $checkVolumDrive) . '&diagonal=' . implode(',', $checkDiagonal) 
. '&resolution=' . implode(',', $checkResolution) . '&frequency=' . implode(',', $checkFrequency));
exit();

?>
