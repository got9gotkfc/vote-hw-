<?php
include_once "../function.php";
$id=$_GET['id'];
switch ($_GET['id']) {
    case 'type':
        foreach ($_POST as $key => $value) {
            del('type',"`name`='$value'");
            to("../back.php");
        }
         
        break;
    
    default:
        # code...
        break;
}
del('subjects',"`id`='$id'");
del('options',"`subject_id`='$id'");
del('log',"`subject_id`='$id'");
to("../back.php");
?>