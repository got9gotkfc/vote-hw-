<?php
include "../login/connect.php";
include_once "../function.php";
date_default_timezone_set('Asia/Taipei');

// 在users中找出符合$_SESSION['user']的資料
$find_user=['acc'=>$_SESSION['user']];
$user=search('users',$find_user);
// chk_array($user);

// 在subjects中找出符合$_GET['subject']的資料
$find_subject=['subject'=>$_GET['subject']];
$subject=search('subjects',$find_subject);
// chk_array($subject);

// chk_array($_POST['options'][0]);
$log=[
    'user_id'=>$user['id'],
    'subject_id'=>$subject['id'],
    'option_id'=>$_POST['options'][0],
    'vote_time'=>date("Y-m-d h:i")
];

save('log',$log);
$count=c('log','subject_id',$subject['id']);
$subject['total']=reset($count);
chk_array($subject);
save('subject',$subject);


?>