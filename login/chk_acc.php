<?php
//檢查帳密是否正確
if(isset($_POST['chk_acc'])&&$_POST['chk_acc']!=""){
$acc=$_POST['chk_acc'];

$sql="SELECT * FROM `users` WHERE `acc`='$acc'";

$user=$pdo->query($sql)->fetch();



if(empty($user)){
    echo "查無此帳號";
}else{
   echo "你當初提供的密碼提示為:".$user['passnote'];
}
}
?>
