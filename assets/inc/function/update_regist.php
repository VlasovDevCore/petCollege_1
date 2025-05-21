<?php 
session_start();

include '../db.php';

$sql = "SELECT * FROM `users` WHERE `id` = ".$_SESSION['user_registr']."";

$res_data = mysqli_query($link, $sql);
while($row = mysqli_fetch_array($res_data)){

$login = $row['login'];
$admin = $row['admin'];
}

if (!$admin == 0) {
	$id = $_GET['id'];
	$sql = mysqli_query($link, "UPDATE `users` SET `status` = '1' WHERE `users`.`id` = '$id'");
} else {
    $_SESSION['message_check'] = 'У вас нет прав "Глав. врача"';
}

header('Content-Type: text/html; charset=utf-8');
header( 'Location: ../../../registrar/list_registr');
?>