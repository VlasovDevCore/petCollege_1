<?php
session_start();
unset($_SESSION['user_patients']); 
header('Location: login.php');
?>




