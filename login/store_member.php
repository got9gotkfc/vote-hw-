<?php
include_once "connect.php";
$acc=$_POST['acc'];
$pw=md5($_POST['pw']);

$sql="INSERT INTO `users`(`acc`,`pw`,`name`,`gender`,`birthday`,`eduction`,`addr`,`idcard`,`e-mail`,`phone`,`passnote`,`reg_date`)
     values('{$_POST['acc']}','$pw','{$_POST['name']}','{$_POST['gender']}','{$_POST['birthday']}','{$_POST['eduction']}','{$_POST['addr']}','{$_POST['idcard']}','{$_POST['e-mail']}','{$_POST['phone']}','{$_POST['passnote']}','{$_POST['reg_date']}')";
$pdo->exec($sql);
header("location:login.php");
?>