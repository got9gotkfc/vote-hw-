<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header.css">
    <title>投票中心</title>
    <style>

        #voting_btn {
            font-size: large;
            font-weight: bold;
        }

        #voted_btn {
            font-size: large;
            font-weight: bold;
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
    </style>
</head>

<body>
    <div id="header">
        <h1>投票中心</h1>
        <nav>
            <a href="../index.php">Home</a>
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
        <table id="voting">
            <tr>
                <th colspan="5">正在進行的投票</th>

            </tr>
            <tr>
                <td class='sub'>投票主題</td>
                <td class='end'>截止時間</td>
                <td class='typ'>類型</td>
                <td class='tal'>投票人數</td>
                <td class='do'>執行</td>
            </tr>
            <?php
            include "../function.php";
            $subjects = all('subjects');
            $join = [];
            // chk_array($subjects);
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
                    echo "<tr id='now_vote$a'>";
                    echo "<td class='sub'>{$subject['subject']}</td>";
                    echo "<td class='end'>{$subject['end']}</td>";
                    foreach ($type as $key => $typ) {
                        if ($typ['id'] == $subject['type_id']) {
                            echo "<td class='typ'>{$typ['name']}</td>";
                        }
                    }
                    echo "<td class='tal'>{$subject['total']}</td>";
                    echo "<td class='do'><a href='./vote.php?id={$subject['id']}'>開始投票</a></td>";
                    echo "</tr>";
                }
                if (search('log', $find_log)!="") {
                array_push($join, search('log', $find_log));
                }
            
            }
            ?>
        </table>

        <table id="voted">
            <tr>
                <th colspan="5">參與過的投票</th>
            </tr>
            <tr>
                <td class='sub'>投票主題</td>
                <td class='end'>截止時間</td>
                <td class='typ'>類型</td>
                <td class='tal'>投票人數</td>
                <td class='do'>執行</td>
            </tr>
            <?php
            foreach ($subjects as $key => $subject) {
                foreach ($join as $key => $value) {
                    if ($value['subject_id'] == $subject['id']) {
                        if ($log > 0 || strtotime($subject['end']) < strtotime(date("Y-m-d H:i:s"))) {
                            $a=$key+1;
                            echo "<tr id='vote_end$a'>";
                            echo "<td id='sub' class='sub'>{$subject['subject']}</td>";
                            if (strtotime($subject['end']) < strtotime(date("Y-m-d H:i:s"))) {
                                echo "<td class='end'>已截止</td>";
                            } else {
                                echo "<td class='end'>已投過</td>";
                            }
                            foreach ($type as $key => $typ) {
                                if ($typ['id'] == $subject['type_id']) {
                                    echo "<td class='typ'>{$typ['name']}</td>";
                                }
                            }
                            echo "<td id='count' class='tal'>{$subject['total']}</td>";
                            echo "<td class='do'><button type='button' id='open_result$a'>查看結果</button></td>";
                            echo "</tr>";
                            echo "<tr><th colspan='5'>";
                            include "../back/result.php";
                            echo "</th></tr>";
                        }
                    }
                }
            }
            ?>
        </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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