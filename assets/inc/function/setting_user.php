<?php 

// session_start();

include '../db.php';

$id_patients = $_POST['id_patients'];
$sector_card = $_POST['sector_card'];

if ($sector_card == 0) {
	$sector_card = "Не указано";
} else {
	$sector_card = $_POST['sector_card'];
}

$sql = mysqli_query($link, "UPDATE `patients` SET `sector_card` = '$sector_card' WHERE `patients`.`id` = '$id_patients'");

header('Content-Type: text/html; charset=utf-8');
header( 'Location: ../../../registrar/setting?patients='.$id_patients.'' );
?>
