<?php
echo "<table id='result$a' class='result'>";
$option_id = ['subject_id' =>$subject['id']];
$option = all('options', $option_id);
foreach ($option as $key => $value) {
    if ($subject['total']==0) {
        $subject['total']=1;
    }
    if($subject['multiple']==0){
    $point = round(($value['total']) / ($subject['total']), 2);
    echo "<tr><td class='opt'>{$value['option']}:<td class='color$key'>{$point}</td></td></tr>";
    }else{
    $point = round(($value['total']) / ($subject['total']*$subject['mulit_limit']), 2);
    echo "<tr><td class='opt'>{$value['option']}:<td class='color$key'>{$point}</td></td></tr>";
    }
}
echo "</table>";
