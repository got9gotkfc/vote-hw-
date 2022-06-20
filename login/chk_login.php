<?php
// 檢查帳密是否正確
include "connect.php";
$acc=$_POST['acc'];
$pw=md5($_POST['pw']);


// if (帳號正確&&密碼正確 ) {
//     登入成功->會員中心
// } else {
//     登入失敗->回登入頁面 跳錯誤訊息
// }
$sql="SELECT count(*) FROM `users` WHERE `acc`='$acc' && `pw`='$pw'";

 //$user=$pdo->query($sql)->fetch();
$chk=$pdo->query($sql)->fetchColumn();

//if($acc==$user['acc'] && $pw==$user['pw']){
if($chk){
    $_SESSION['user']=$acc;
    header("location:member_center.php");
}else{
    header("location:login.php?error=帳號或密碼錯誤");
}
?>