<?php
include_once "../function.php";
$id=$_GET['id'];

del('subjects',"`id`='$id'");
del('options',"`subject_id`='$id'");
del('log',"`subject_id`='$id'");
to("../back/vote_center.php");
?>