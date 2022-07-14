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

// 判斷這個帳號的人有沒有投過這個主題

if ($log == "") {
    // 數出投票人數存入$subject
    $id=['id'=> $_GET['id']];
    $count = search('subjects',$id);
    $subject = [
        'id' => $_GET['id'],
        'total' => $count['total']+1
    ];
    save('subjects', $subject);



    // 叫出選項 
    $sub = ['subject_id' => $_GET['id']];
    $opt = All('options', $sub);
    // chk_array($opt);
    // 數出這次投的選項種共有多少票，存入你投的選項

    // chk_array($_POST);

    // chk_array($count);
    foreach ($_POST['options'] as $key => $value) {
        $log = [
            'user_id' => $user['id'],
            'subject_id' => $_GET['id'],
            'option_id' => $value,
            'vote_time' => date("Y-m-d h:i")
        ];
        save('log', $log);

        $opti = [
            'subject_id' => $_GET['id'],
            'option_id' => $value
        ];
        $count = c('log', $opti);
        $opt[$value]['total'] = $count;
        save('options', $opt[$value]);
    }



        to('../front/vote_center.php');
    
} else {
    echo "<h1>無法重複投票</h1>";
    
    echo "<a href='../front/vote_center.php'>回投票中心</a>";
    
}
