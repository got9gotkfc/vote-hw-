<?php
include "../function.php";

foreach ($_POST['type'] as $key => $value) {
    $type=['name'=>$value];
    $count_type=c('type',$type);
    
        save('type',$type);
        to("./back.php");
    
    
    
}

?>