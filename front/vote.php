<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/body.css">
    <title>開始投票</title>
    <style>
    

    #limit{
        display: none;
    }
    </style>
</head>

<body>
    <div id="header">
        <div>開始投票</div>
        <nav> <a href="../index.php">首頁</a>
            <?php
            include "../login/connect.php";

            if (isset($_SESSION)) {
                if ($_SESSION['id'] <= 3) {
                    echo   "<a href='../front/vote_center.php'>投票中心</a>";
                    echo   "<a href='../back.php'>後台中心</a>";
                }else{
                echo   "<a href='../front/vote_center.php'>投票中心</a>";
            }
            }
            if (isset($_SESSION['user'])) {
            ?>
                <a href="../login/member_center.php">會員中心</a>
                <a href="../login/logout.php">登出</a>
            <?php
            } else {
            ?>
                <a href="login/login.php">登入</a>
            <?php
            }
            ?>

        </nav>
    </div>
    <div id="content">
    <form action="../back/count_center.php?id=<?= $_GET['id']; ?>" method="post">
        <?php
        include "../function.php";
        $find_subject = [
            'id' => $_GET['id']
        ];
        $subject = search('subjects', $find_subject);
        echo "<h2>{$subject['subject']}</h2>";

        $find_options = [
            'subject_id' => $subject['id']
        ];
        $options = all('options', $find_options);
        if ($subject['multiple'] == 0) {
            foreach ($options as $key => $value) {
                echo "<div><label><input type='radio' name='options[]' value='{$key}'>{$value['option']}</label></div>";
            }
        } else {
            echo "<div>(最多選{$subject['mulit_limit']}個)</div>";
            echo "<div id='limit'>{$subject['mulit_limit']}</div>";
            foreach ($options as $key => $value) {
                
                echo "<div><label><input type='checkbox' name='options[]' value='{$key}' id='{$key}'>{$value['option']}</label></div>";
            }
        }
        echo " <input type='submit' value='投票'>";

        ?>
    </form>
</div>
<div id="footer">
        <p>版權為XXX所有，電話09XX-XXXXXX</p>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {


    $('#content div').click(function(){
        if ($("input[name='options[]']:checked").length > $('#limit').text()) {
            for (let i = 0; i < 6; i++) {
                $(`input[value='${i}']`).prop('checked',false);
            }
        }
    })
    })
</script>
</html>