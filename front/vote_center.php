<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/body.css">
    <title>投票中心</title>
    <style>
        #voting_btn {
            grid-column: 2/4;
            grid-row: 2/3;
            font-weight: bold;
            margin-bottom: 10px;
        }

        #voted_btn {
            grid-column: 4/6;
            grid-row: 2/3;
            font-weight: bold;
            margin-bottom: 10px;
        }

        #ving {
            grid-column: 6/13;
            grid-row: 3/4;
        }

        #ving0 {
            grid-column: 2/6;
            grid-row: 6/12;
            border-radius: 5px;
            border: 1px solid #74b9ff;
            border-left: 2px solid black;
            border-bottom: 2px solid black;
            background-color: #74b9ff;
            color: white;
        }

        #ving1 {
            grid-column: 7/12;
            grid-row: 5/13;
            border-radius: 5px;
            background-color: #74b9ff;
            color: white;
        }

        #ving2 {
            grid-column: 13/16;
            grid-row: 6/12;
            border-radius: 5px;
            border: 1px solid #74b9ff;
            border-right: 2px solid black;
            border-bottom: 2px solid black;
            background-color: #74b9ff;
            color: white;
        }

        #prev {
            text-align: center;
            grid-column: 1/2;
            grid-row: 8/10;
            border-color: transparent #0984e3 transparent transparent;
            border-style: solid solid solid solid;
            border-width: 40px;
        }

        #next {
            text-align: center;
            grid-column: 16/17;
            grid-row: 8/10;
            border-color: transparent transparent transparent #0984e3;
            border-style: solid solid solid solid;
            border-width: 40px;
        }



        .result {
            width: 100%;
            border-top: 1px solid #636e72;
            border-bottom: 1px solid #636e72;

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
    </style>
</head>

<body>
    <div id="header">
        <div>投票中心</div>
        <nav>
            <a href="../index.php">首頁</a>
            <a href="./creatvote.php">創建投票</a>
            <?php
            include_once "../login/connect.php";
            if (isset($_SESSION)) {
                if ($_SESSION['id'] <= 3) {
                    echo "<a href='./member_center.php'>會員中心</a>";
                    echo "<a href='../back/back.php'>後台中心</a>";
                } else {
                    echo   "<a href='./vote_center.php'>投票中心</a>";
                }
            }
            if (isset($_SESSION['user'])) {
            ?>
                <a href="../login/logout.php">登出</a>
            <?php
            } else {
            ?>
                <a href="./login.php">登入</a>
            <?php
            }
            ?>
        </nav>
    </div>
    <div id="content">
        <a href="./vote_center.php?table=1" id="voting_btn">正在進行的投票</a>
        <a href="./vote_center.php?table=2" id="voted_btn">餐與過的投票</a>

        <div id="prev"></div>
        <div id="next"></div>
        <?php
        include_once "../function.php";
        $subjects = all('subjects');
        $join = [];
        $ving = [];
        // chk_array($_SESSION);
        
        if (isset($_GET['table'])) {
            switch ($_GET['table']) {
                case '1':
                    echo "<div id='ving'>正在進行的投票</div>";
                    foreach ($subjects as $key => $subject) {
                        // 判斷有沒有參與過投票
                        $find_log = [
                            'user_id' => $_SESSION['id'],
                            'subject_id' => $subject['id'],
                        ];
                        $log = c('log', $find_log);
                        $type = all('type');
                        if ($log == 0 && strtotime($subject['end']) > strtotime(date("Y-m-d H:i:s"))) {
                            $NoVotingSubject = false;
                            array_push($ving, $subject);
                        }
                        if (search('log', $find_log) != "") {
                            array_push($join, search('log', $find_log));
                        }
                    }
                    foreach ($ving as $key => $subject) {
                        echo "<div id='ving{$key}'>";
                        echo "<div >{$subject['subject']}</div>";
                        echo "<div >截止時間 : {$subject['end']}</div>";
                        echo "<div >投票人數 : {$subject['total']}</hdiv>";
                        foreach ($type as $key => $typ) {
                            if ($typ['id'] == $subject['type_id']) {
                                echo "<div class='typ'>類型:{$typ['name']}</div>";
                            }
                        }
                        echo "<a href='./vote.php?id={$subject['id']}' class='card-link'>開始投票</a>";
                        echo "</div>";
                    }
                    break;

                case '2':
            echo "<div id='ved'>參與過的投票</div>";
            foreach ($subjects as $key => $subject) {
                foreach ($join as $key => $value) {
                    if ($value['subject_id'] == $subject['id']) {
                        if ($log > 0 || strtotime($subject['end']) < strtotime(date("Y-m-d H:i:s"))) {
                            $a=$key+1;
                            $NoVotedSubject=false;
                            echo "<div class='card-body'>";
                            echo "<div>{$subject['subject']}</div>";
                            echo "<div>截止時間 : {$subject['end']}</div>";
                            echo "<div>投票人數 : {$subject['total']}</div>";
                            foreach ($type as $key => $typ) {
                                if ($typ['id'] == $subject['type_id']) {
                                    echo "<div class='typ'>類型:{$typ['name']}</div>";
                                }
                            }
                            echo "<div><button class='btnResult' type='button' id='open_result$a'>查看結果</button></div>";
                            echo "</div>";
                        }
                    }
                }
            }
                        break;
            }
        } 
        ?>


    <div id="footer">
        <p>版權為XXX所有，電話09XX-XXXXXX</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
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
                    if ($(`#result${i} tr td.color${j}`).text() == 0) {
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


        })
    </script>
</body>

</html>