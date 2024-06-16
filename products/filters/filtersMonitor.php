<?php
session_start();
require_once "../../bd.php";

// Получение значения model из массива $_POST
$selectedManufacturer = $_POST['manufacturer'] ?? array('Xiaomi', 'Samsung', 'HP', 'LG', 'Dell', 'Philips', 'BenQ', 'MSI');
$checkModel = ($selectedManufacturer === array('Xiaomi', 'Samsung', 'HP', 'LG', 'Dell', 'Philips', 'BenQ', 'MSI') && !isset($_POST['manufacturer'])) ? null : $selectedManufacturer;

// Получение значения diagonal из массива $_POST
$selectedDiagonal = $_POST['diagonal'] ?? array('21”', '22”', '24”', '27”', '29”', '31.5”', '32”', '34”');
$checkDiagonal = ($selectedDiagonal === array('21”', '22”', '24”', '27”', '29”', '31.5”', '32”', '34”') && !isset($_POST['diagonal'])) ? null : $selectedDiagonal;

// Получение значения resolution из массива $_POST
$selectedResolution = $_POST['resolution'] ?? array('FHD', 'WQHD', '2K QHD', '3K UHD', '4K UHD');
$checkResolution = ($selectedResolution === array('FHD', 'WQHD', '2K QHD', '3K UHD', '4K UHD') && !isset($_POST['resolution'])) ? null : $selectedResolution;

// Получение значения screen_type из массива $_POST
$selectedScreenType = $_POST['screen_type'] ?? array('Плоский', 'Изогнутый');
$checkScreenType = ($selectedScreenType === array('Плоский', 'Изогнутый') && !isset($_POST['screen_type'])) ? null : $selectedScreenType;

// Получение значения frequency из массива $_POST
$selectedFrequency = $_POST['frequency'] ?? array('60 Hz', '75 Hz', '90 Hz', '120 Hz', '144 Hz', '165 Hz', '240 Hz');
$checkFrequency = ($selectedFrequency === array('60 Hz', '75 Hz', '90 Hz', '120 Hz', '144 Hz', '165 Hz', '240 Hz') && !isset($_POST['frequency'])) ? null : $selectedFrequency;

// Получение значения screen_type из массива $_POST
$selectedSpeaker = $_POST['speaker'] ?? array('Есть', 'Нет');
$checkSpeaker = ($selectedSpeaker === array('Есть', 'Нет') && !isset($_POST['speaker'])) ? null : $selectedSpeaker;

$_SESSION['selectMonitor'] = "SELECT * FROM `t_products` WHERE model IN ('" . implode("', '", $selectedManufacturer) . "')
AND diagonal IN ('" . implode("', '", $selectedDiagonal) . "') AND resolution IN ('" . implode("', '", $selectedResolution) . "')
AND screen_type IN ('" . implode("', '", $selectedScreenType) . "') AND frequency IN ('" . implode("', '", $selectedFrequency) . "')
AND speaker IN ('" . implode("', '", $selectedSpeaker) . "')"; 
//print_r($_SESSION['select']);

header('Location: ../monitor.php?manufacturer='.implode(',', $checkModel) . '&diagonal=' . implode(',', $checkDiagonal) 
. '&resolution=' . implode(',', $checkResolution) . '&screen_type=' . implode(',', $checkScreenType)
. '&frequency=' . implode(',', $checkFrequency). '&speaker=' . implode(',', $checkSpeaker));
exit();

?>
