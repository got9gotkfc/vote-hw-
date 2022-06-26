<?php
include_once "../function.php";
$id=$_GET['subject'];

del('subjects',"`id`='$id'");
del('options',"`subject_id`='$id'");
del('log',"`subject_id`='$id'");
to("../vote/vote_center.php");
?>