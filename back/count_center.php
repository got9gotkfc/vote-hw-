<?php
include "../login/connect.php";
include_once "../function.php";
date_default_timezone_set('Asia/Taipei');

// 在users中找出符合$_SESSION['user']的資料
$a=['acc'=>$_SESSION['user']];
$user=search('users',$a);
// chk_array($user);

// 在subjects中找出符合$_GET['subject']的資料
$b=['subject'=>$_GET['subject']];
$subject=search('subjects',$b);
// chk_array($subject);

// chk_array($_POST['options'][0]);
$log=[
    'user_id'=>$user['id'],
    'subject_id'=>$subject['id'],
    'option_id'=>$_POST['options'][0],
    'vote_time'=>date("Y-m-d h:i")
];
$chk_log=[
    'user_id'=>$user['id'],
    'subject_id'=>$subject['id'],
];
$factor=search('log',$chk_log);


// chk_array($log);
// log的資料庫沒存進去 是因為它只能存數字
save('log',$log,$factor);



?>