<?php
date_default_timezone_set('Asia/Taipei');
include_once "../function.php";
// 抓從表單傳來的值
$subject = $_POST['subject'];
// 如果沒輸入結束時間則以start+7天代替
if ($_POST['end'] == "") {
    $end = date("Y-m-d", strtotime("+7 days"));
} else {
    $end = $_POST['end'];
}
// 將表單的值存入陣列
$add_subject = [
    'subject' => $subject,
    'multiple' => $_POST['multiple'],
    'start' => date("Y-m-d h:i"),
    'end' => $end
];
$find_max_subject=max_id_search('subjects',"`subject`='$subject'");
$max_subject=reset($find_max_subject);
$chk_subject=search('subjects',"`id`='$max_subject'");
// chk_array($chk_subject);
if (strtotime($chk_subject['end']) > strtotime(date("Y-m-d H:i:s"))) {
    echo "<h1>此投票尚未結束，無法創建一樣的投票</h1>";
    echo  "<a href='../vote/creatvote.php'>回上一頁</a>";
} else {
    save('subjects', $add_subject);
    //利用剛才存入的投票主題文字來找出該筆資料並取得id
    $id = search('subjects', $add_subject)['id'];
    foreach ($_POST['option'] as $opt) {
        //如果選項的文字內容不是空的 ,則建立資料陣列,並將主題對應的id代入
        if ($opt != "") {
            $add_option = [
                'option' => $opt,
                'subject_id' => $id
            ];
        }
        save("options", $add_option);
        to('../vote/vote_center.php');
    }
}
