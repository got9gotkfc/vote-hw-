<?php
include "../function.php";
include "connect.php";
// 檢查帳密是否正確
if (isset($_POST['acc_login'])||$_POST['acc_login']!="") {
    $acc = $_POST['acc_login'];
    $pw = md5($_POST['pw_login']);
    // if (帳號正確&&密碼正確 ) {
    //     登入成功->會員中心
    // } else {
    //     登入失敗->回登入頁面 跳錯誤訊息
    // }
    $sql = "SELECT count(*) FROM `users` WHERE `acc`='$acc' && `pw`='$pw'";
    //$user=$pdo->query($sql)->fetch();
    $chk = $pdo->query($sql)->fetchColumn();
    // if ($acc == $user['acc'] && $pw == $user['pw']) {
    // 如果有符合帳號密碼的資料就進入會員中心
    if ($chk) {
        $find_user = ['acc' => $acc];
        $user = search('users', $find_user);
        $_SESSION = [
            'user' => $user['acc'],
            'id' => $user['id']
        ];
        header("location:../front/member_center.php");
    } else {
        header("location:../front/login.php?error=帳號或密碼錯誤");
    }
} else {
    // 檢查登入了沒 沒登入則跳到login
    if (isset($_SESSION['user'])) {
        header("location:../front/vote_center.php");
    } else {
        header("location:../front/login.php?alert=1");
    }
}
