<?php
include_once "../function.php";
// 抓從表單傳來的值
$subject = $_POST['subject'];

// 將表單的值存入陣列
$add_subject = [
    'subject' => $subject,
    'multiple' => $_POST['multiple'],
    'start' => date("Y-m-d"),
    'end' => date("Y-m-d", strtotime("+10 days"))
];
// 測試BUG用
// chk_array(isset($date['subject']));
// 如果已經在資料庫就會有單筆資料+id，如果沒有則是""
$subj = chk_subjects('subjects', $add_subject);
save('subjects', $add_subject, $subj);

//利用剛才存入的投票主題文字來找出該筆資料並取得id
$id = search('subjects', $add_subject)['id'];



//判斷表單資料有沒有option這個項目，如果有，則使用迴圈把選項一個一個取出
if (isset($_POST['option'])) {
    $opti = chk_options('options', $id);

    if (empty($opti)) {
        foreach ($_POST['option'] as $opt) {
            //如果選項的文字內容不是空的 ,則建立資料陣列,並將主題對應的id代入
            if ($opt != "") {
                $add_option = [
                    'option' => $opt,
                    'subject_id' => $id
                ];
            }
            save("options", $add_option, $opti);
            //使用to()函式來取代header，請參考base.php中的函式to($url)
            to('../vote/vote.php');

        }
    } else {
        echo "<h1>選項無法修改!!</h1>";
        echo "<a href='../vote/creatvote.php'>回上一頁</a>";
    }
}
