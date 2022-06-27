<?php
include "../login/connect.php";
include_once "../function.php";
date_default_timezone_set('Asia/Taipei');

// 在users中找出符合$_SESSION['user']的資料
$find_user = ['acc' => $_SESSION['user']];
$user = search('users', $find_user);
// chk_array($user);

// 在subjects中找出符合$_GET['subject']的資料
$find_subject = ['subject' => $_GET['subject']];
$subject = max_id_search('subjects', $find_subject);
// chk_array($subject);
$logid = [
    'subject_id' => $subject['id'],
    'user_id' => $user['id']
];
$log = search('log', $logid);

// 判斷這個帳號的人有沒有投過這個主題

if ($log == "") {
    $log = [
        'user_id' => $user['id'],
        'subject_id' => $subject['id'],
        'option_id' => $_POST['options'][0],
        'vote_time' => date("Y-m-d h:i")
    ];
    save('log', $log);

    // 數出投票人數存入$subject['total']
    $count = c('log', 'subject_id', $subject['id']);
    $subject['total'] = reset($count);
    save('subjects', $subject);

    // 叫出選項
    $sub_id = ['subject_id' => $subject['id']];
    $opt = All('options', $sub_id);
    // 數出這次投的選項種共有多少票，存入你投的選項
    $count = c('log', 'option_id', $_POST['options'][0]);
    $opt[$_POST['options'][0]]['total'] = reset($count);
    save('options', $opt[$_POST['options'][0]]);
    to('../vote/vote_center.php');
} else {
    echo "<h1>無法重複投票</h1>";
    echo "<a href='../vote/vote_center.php'>回投票中心</a>";
}
