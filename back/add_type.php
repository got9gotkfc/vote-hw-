<?php
include "../function.php";

foreach ($_POST['type'] as $key => $value) {
    if(isset($value)&&$value!=""){
    $type=['name'=>$value];
    $count_type=c('type',$type);
    
        save('type',$type);
        to("./back.php?table=1");
    }else{
    to("./back.php?table=1");
    }
}

?>