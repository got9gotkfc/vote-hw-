<?php
include_once "../function.php";


foreach ($_POST as $key => $value) {
    chk_array($key);
switch ($key) {
    case 'types':
        foreach ($value  as $val) {
            del('type',"`id`='$val'");
        }  
        to("./back.php?table=1");
        
        break;
    case 'user':
        foreach ($value  as $val) {
            del('users',"`id`='$val'");
            
        }
        to("./back.php?table=2");
        break;
    case 'subject':
        foreach ($value  as $val) {
            del('subjects',"`id`='$val'");
        
        }
        to("./back.php?table=3");
        break;
    }
}
// to("./back.php");


?>