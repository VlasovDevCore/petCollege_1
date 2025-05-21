<?php
session_start();
unset($_SESSION['user_registr']); // или $_SESSION = array() для очистки всех данных сессии
header('Location: login.php');
?>