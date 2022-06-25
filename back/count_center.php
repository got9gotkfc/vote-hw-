<?php
include "../login/connect.php";
include_once "../function.php";
date_default_timezone_set('Asia/Taipei');
$log=[
    'user_id'=>$_SESSION['user'],
    'subject_id'=>$_GET['subject'],
    'option_id'=>$_POST['options'][0],
    'vote_time'=>date("Y-m-d h:i")
];




?>