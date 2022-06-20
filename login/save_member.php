<?php
include_once "connect.php";

$sql = "UPDATE `users` 
      SET  `pw`='{$_POST['pw']}', 
           `name`='{$_POST['name']}',  
           `gender`='{$_POST['gender']}', 
           `birthday`='{$_POST['birthday']}',
           `eduction`='{$_POST['eduction']}', 
           `addr`='{$_POST['addr']}', 
           `idcard`='{$_POST['idcard']}', 
           `email`='{$_POST['email']}' 
           `passnote`='{$_POST['passnote']}',
           `update_date`='{$_POST['update_date']}', 
      WHERE  `id`='{$_POST['id']}'";

$pdo->exec($sql);

header('location:member_center.php');
