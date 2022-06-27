<?php
include "../login/connect.php";
include_once "../function.php";
date_default_timezone_set('Asia/Taipei');

// 在users中找出符合$_SESSION['user']的資料
$find_user = ['acc' => $_SESSION['user']];
$user = search('users', $find_user);
// chk_array($user);

// chk_array($subject);
$logid = [
    'subject_id' => $_GET['id'],
    'user_id' => $user['id']
];

$log = search('log', $logid);
chk_array($log);
// 判斷這個帳號的人有沒有投過這個主題

if ($log == "") {
    $log = [
        'user_id' => $user['id'],
        'subject_id' => $_GET['id'],
        'option_id' => $_POST['options'][0],
        'vote_time' => date("Y-m-d h:i")
    ];
    save('log', $log);

    // 數出投票人數存入$subject
    $count = c('log', 'subject_id', $_GET['id']);
    $subject=[ 
    'id'=>$_GET['id'],
    'total'=>$count 
    ];
    save('subjects', $subject);

    // 叫出選項
    $sub_id = ['subject_id' => $_GET['id']];
    $opt = All('options', $sub_id);
    // 數出這次投的選項種共有多少票，存入你投的選項
    $count = c('log', 'option_id', $_POST['options'][0]);
    $opt[$_POST['options'][0]]['total'] = $count;
    save('options', $opt[$_POST['options'][0]]);

    if($_SESSION['id']<3){
    to('./vote_center.php');
    }else{
    to('../front/vote_center.php');
    }
} else {
    echo "<h1>無法重複投票</h1>";
    if($_SESSION['id']<3){
        echo "<a href='./vote_center.php'>回投票中心</a>";
        }else{
         echo "<a href='../front/vote_center.php'>回投票中心</a>";
        }
   
}
