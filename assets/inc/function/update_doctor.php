<?php 

include '../db.php';

$id = $_POST['id_doctor'];
$time = $_POST['time'];
$status = $_POST['status'];

if ($time == 1) {
	$time_work = "7:30 - 14:30";
} else {
	$time_work = "15:00 - 21:30";
}

$sql = mysqli_query($link, "UPDATE `doctor_list` SET `status` = '$status', `working_hours` = '$time_work', `change_doctors` = '$time'  WHERE `doctor_list`.`id` = '$id'");

header('Content-Type: text/html; charset=utf-8');
header( 'Location: ../../../registrar/list_doctors');
?>