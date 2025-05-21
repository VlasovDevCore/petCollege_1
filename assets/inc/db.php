<?php
  $host = 'localhost';  
  $user = 'root';    
  $pass = '';
  $db = 'medical';   
  $link = mysqli_connect($host, $user, $pass, $db); 

  if (!$link) {
    echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
    exit;
  }
?>