<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/body.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>投票中心</title>
    <style>
        
        #content{
            width: 80%;
            display: block;
        }
        #voting_btn {
            font-weight: bold;
            margin-bottom: 10px;
        }
        #voted_btn {
            font-weight: bold;
            margin-bottom: 10px;
        }
        table{
            width: 100%;
        }
        table th{
            width: 100%;
            justify-content: center;
        }
        table tr {
            display: flex;
            padding: 5px ;
            width: 100%;
        }
        table tr .sub{
            width: 50%;
        }
        table tr .end{
            width: 20%;
        }
        table tr .typ{
            width: 10%;
        }
        table tr .tal{
            width: 10%;
        }
        
        table tr .do{
            width: 10%;
        }
        
        
        
        .result {
            width: 100%;
            border-top : 1px solid #636e72;
            border-bottom : 1px solid #636e72;

        }

        .result tr {
            display: flex;
            width: 100%;
            /* border: 1px solid #636e72; */
        }

        .result tr .opt {
            width: 266px;
        }

        .color0 {
            width: calc(100% - 266px);
            color: rgba(255, 255, 255, 0);
            background-color: #d63031;
            border: 1px solid #636e72;
        }

        .color1 {
            width: calc(100% - 266px);
            color: rgba(255, 255, 255, 0);
            background-color: #e17055;
            border: 1px solid #636e72;
        }

        .color2 {
            width: calc(100% - 266px);
            color: rgba(255, 255, 255, 0);
            background-color: #fdcb6e;
            border: 1px solid #636e72;
        }

        .color3 {
            width: calc(100% - 266px);
            color: rgba(255, 255, 255, 0);
            background-color: #00b894;
            border: 1px solid #636e72;
        }

        .color4 {
            width: calc(100% - 266px);
            color: rgba(255, 255, 255, 0);
            background-color: #74b9ff;
            border: 1px solid #636e72;
        }

        

        .color5 {
            width: calc(100% - 266px);
            color: rgba(255, 255, 255, 0);
            background-color: #0984e3;
            border: 1px solid #636e72;

        }

        .color6 {
            width: calc(100% - 266px);
            color: rgba(255, 255, 255, 0);
            background-color: #6c5ce7;
            border: 1px solid #636e72;

        }

        .card{
            display: inline-block;
            border: solid black 2px;
            margin: 5px; 
        }
        
        .card:hover{
            box-shadow: 5px 10px;
            transform:  translateY(-5px);
        }

        .btnResult{
            border: none;
            background: #D2E9FF;
            padding: 5px;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div id="header">
        <div>投票中心</div>
        <nav>
            <a href="../index.php">首頁</a>
            <a href="./creatvote.php">創建投票</a>

            <?php
            include "../login/connect.php";
            if (isset($_SESSION['user'])) {
            ?>
                <a href="./member_center.php">會員中心</a>
                <a href="../login/logout.php">登出</a>
            <?php
            } else {
            ?>
                <a href="../login/login.php">登入</a>
            <?php
            }
            ?>
        </nav>
    </div>
    <div id="content">

        <button id="voting_btn">正在進行的投票</button>
        <button id="voted_btn">參與過的投票</button>
        <div id="voting">
            <h3 colspan="5">正在進行的投票</h3>
            <?php
            include "../function.php";
            $subjects = all('subjects');
            $join = [];
            // chk_array($subjects);
            $NoVotingSubject=true;
            foreach ($subjects as $key => $subject) {
                $a = $key + 1;
                // 判斷有沒有參與過投票
                $find_log = [
                    'user_id' => $_SESSION['id'],
                    'subject_id' => $subject['id']
                ];
                $log = c('log', $find_log);
                $type = all('type');
                if ($log == 0 && strtotime($subject['end']) > strtotime(date("Y-m-d H:i:s"))) {
                    $a=$key+1;
                    $NoVotingSubject=false;
                    echo "<div class='card' style='width: 18rem;'>";
                    echo "<div class='card-body'>";
                    echo "<h4 class='card-title'>{$subject['subject']}</h5>";
                    echo "<h6 class='card-text'>截止時間 : {$subject['end']}</h6>";
                    echo "<h6 class='card-text'>投票人數 : {$subject['total']}</h6>";
                    if (strtotime($subject['end']) < strtotime(date("Y-m-d H:i:s"))) {
                        echo "<h6 class='card-text'>類型 : 已截止</h6>";
                    } else {
                        echo "<h6 class='card-text'>類型 : 已投過</h6>";
                    }
                    echo "<a href='./vote.php?id={$subject['id']}' class='card-link'>開始投票</a>";
                    echo "</div>";
                    echo "</div>";
                }
                if (search('log', $find_log)!="") {
                array_push($join, search('log', $find_log));
                }
            
            }
            if($NoVotingSubject){
                echo "<h6>無</h6>";
            }
            ?>
        </div>

        <div id="voted">
            <h3 colspan="5">參與過的投票</p3><br>
            <?php
            $NoVotedSubject=true;
            foreach ($subjects as $key => $subject) {
                foreach ($join as $key => $value) {
                    if ($value['subject_id'] == $subject['id']) {
                        if ($log > 0 || strtotime($subject['end']) < strtotime(date("Y-m-d H:i:s"))) {
                            $a=$key+1;
                            $NoVotedSubject=false;
                            echo "<div class='card' style='width: 18rem;'>";
                            echo "<div class='card-body'>";
                            echo "<h4 class='card-title'>{$subject['subject']}</h4>";
                            echo "<h6 class='card-text'>截止時間 : {$subject['end']}</h6>";
                            echo "<h6 class='card-text'>投票人數 : {$subject['total']}</h6>";
                            if (strtotime($subject['end']) < strtotime(date("Y-m-d H:i:s"))) {
                                echo "<h6 class='card-text'>類型 : 已截止</h6>";
                            } else {
                                echo "<h6 class='card-text'>類型 : 已投過</h6>";
                            }
                            echo "<button class='btnResult' type='button' id='open_result$a'>查看結果</button>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                }
            }
            if($NoVotedSubject){
                echo "<h6>無</h6>";
            }
            ?>
        </div>
    </div>
    <div id="footer">
        <p>版權為XXX所有，電話09XX-XXXXXX</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {


            var tab = document.getElementById('voted');
            var len = (tab.rows.length) / 2 - 1;
            // var w=$(`#result1 tr td.color2`).width();
            console.log(len)
            
            var opt_len = $(`#result6 tr td.opt`).length;
                console.log(opt_len);
            for (let i = 1; i <= len; i++) {

                var opt_len = $(`#result${i} tr td.opt`).length;
                console.log(opt_len);
                for (let j = 0; j < opt_len; j++) {
                    var a = $(`#result${i} tr td.color${j}`).text();
                    var w = $(`#result${i} tr td.color${j}`).width();
                    
                    $(`#result${i} tr td.color${j}`).width(w * a);
                    if ($(`#result${i} tr td.color${j}`).text()==0) {
                        $(`#result${i} tr td.color${j}`).hide()
                    }
                }

            }
            for (let i = 1; i <= len; i++) {
                $(`#result${i}`).hide();
            }
            // 判斷是否查看結果
            for (let i = 1; i <= len; i++) {
                $(`#open_result${i}`).click(function() {
                    if ($(`#result${i}`).is(':hidden')) {
                        $(`#result${i}`).show();
                        $('#voting').hide();
                        if ($('#voting').is(':hidden')) {
                            $('#voting_btn').show();
                        } else {
                            $('#voting_btn').hide();
                        }
                    } else {
                        $(`#result${i}`).hide();
                    }
                })
            }
            // 正在進行的投票按鈕的作業方式
            $('#voting_btn').click(function() {
                $('#voted').hide();
                $('#voting_btn').hide();
                $('#voting').show();
                if ($('#voted').is(':hidden')) {
                    $('#voted_btn').show();
                } else {
                    $('#voted_btn').hide();
                }
            })
            // 結束的投票按鈕的作業方式
            $('#voted_btn').click(function() {
                $('#voting').hide();
                $('#voted_btn').hide();
                $('#voted').show();
                if ($('#voting').is(':hidden')) {
                    $('#voting_btn').show();
                } else {
                    $('#voting_btn').hide();
                }
            })

            if ($('#voting').is(':hidden')) {
                $('#voting_btn').show();
            } else {
                $('#voting_btn').hide();
            }
            if ($('#voted').is(':hidden')) {
                $('#voted_btn').show();
            } else {
                $('#voted_btn').hide();
            }
        })
    </script>
</body>

</html>