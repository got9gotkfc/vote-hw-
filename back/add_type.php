<?php
include "../function.php";

foreach ($_POST['type'] as $key => $value) {
    $type=['name'=>$value];
    $count_type=c('type',$type);
    if ($count_type<1) {
        save('type',$type);
        to("./vote_center.php");
    }else{
        echo "<h1>此種類已存在於資料庫</h1>";
        echo "<a href='./tpye.php'>回上一頁</a>";

    }
}

?>