<?php
include_once "connect.php";

if ($_POST['pw']!="") {
      $pw=md5($_POST['pw']);
      $sql = "UPDATE `users` 
      SET  `pw`='$pw', 
           `name`='{$_POST['name']}',  
           `gender`='{$_POST['gender']}', 
           `birthday`='{$_POST['birthday']}',
           `eduction`='{$_POST['eduction']}', 
           `addr`='{$_POST['addr']}', 
           `idcard`='{$_POST['idcard']}', 
           `e-mail`='{$_POST['e-mail']}',
           `passnote`='{$_POST['passnote']}',
           `update_date`='{$_POST['update_date']}'
      WHERE  `id`='{$_POST['id']}'";
}else{
      $sql = "UPDATE `users`
      SET  `name`='{$_POST['name']}',  
            `gender`='{$_POST['gender']}', 
            `birthday`='{$_POST['birthday']}',
            `eduction`='{$_POST['eduction']}', 
            `addr`='{$_POST['addr']}', 
            `idcard`='{$_POST['idcard']}', 
            `e-mail`='{$_POST['e-mail']}',
            `passnote`='{$_POST['passnote']}',
            `update_date`='{$_POST['update_date']}'
      WHERE  `id`='{$_POST['id']}'";
}


$pdo->exec($sql);

header('location:member_center.php');
