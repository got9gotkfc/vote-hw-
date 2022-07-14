<?php
include_once "connect.php";
include "../function.php";
if ($_POST['acc'] == "" || $_POST['pw'] == "" || $_POST['name'] == "" || $_POST['gender'] == "" || $_POST['birthday'] == "" || $_POST['eduction'] == "" || $_POST['addr'] == "" || $_POST['idcard'] == "" || $_POST['e-mail'] == "" || $_POST['phone'] == "" || $_POST['passnote'] == "") {
     header("location:../front/login.php?alert=請輸入完整資料");
} else {
     $acc = $_POST['acc'];
     $pw = md5($_POST['pw']);

     $user = search('users', "`acc`='$acc'");
     if (isset($user) && $user != "") {
          header("location:../front/login.php?error=此帳號已經有人使用");
     } else {
          $sql = "INSERT INTO `users`(`acc`,`pw`,`name`,`gender`,`birthday`,`eduction`,`addr`,`idcard`,`e-mail`,`phone`,`passnote`,`reg_date`)
     values('{$_POST['acc']}','$pw','{$_POST['name']}','{$_POST['gender']}','{$_POST['birthday']}','{$_POST['eduction']}','{$_POST['addr']}','{$_POST['idcard']}','{$_POST['e-mail']}','{$_POST['phone']}','{$_POST['passnote']}','{$_POST['reg_date']}')";
          $pdo->exec($sql);
          header("location:../front/login.php");
     }
}
