<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/body.css">
    <title>創建投票</title>
    <style>
        #content>form {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            grid-template-rows: repeat(11, 1fr);
            grid-column: 7/12;
            grid-row: 3/14;
            border-radius: 10px;
            background-color: #e17055;
        }

        #sub {
            margin: 5px;
            text-align: center;
            grid-column: 1/6;
            grid-row: 1/2;
            color: white;
        }

        #type {
            text-align: center;
            grid-column: 1/6;
            grid-row: 2/3;
            color: white;
        }

        #selector {
            text-align: center;
            grid-column: 1/6;
            grid-row: 3/4;
            color: white;
        }

        #opt {
            text-align: center;
            grid-column: 1/6;
            grid-row: 1fr;
            color: white;
        }

        #new {
            text-align: center;
            grid-column: 1/6;
            grid-row: 1fr;
            color: white;

        }

        #end {
            text-align: center;
            grid-column: 1/6;
            color: white;
        }

        form>input {
            font-size: 20px;
            text-align: center;
            grid-column: 3/4;
        }
    </style>

</head>

<body>
    <div id="header">
        <div>創建投票</div>

        <nav>
            <a href="../index.php">首頁</a>
            <?php
            include "../login/connect.php";
            if (isset($_SESSION)) {
                if ($_SESSION['id'] <= 3) {
                    echo   "<a href='./vote_center.php'>投票中心</a>";
                    echo   "<a href='../back/back.php'>後台中心</a>";
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
                <a href="../login/login.php">登入</a>
            <?php
            }
            ?>
        </nav>
    </div>
    <div id="content">
        <form action="../back/add_vote.php" method="post">
            <div id="sub">
                <label for="subject">投票主題</label>
                <input type="text" name="subject" id="subject">
                <input type="button" value="新增選項" id="more">
            </div>
            <div id="type">
                <div>類別</div>
                <select name="type" id="">
                    <option value="2">生活</option>
                    <option value="3">吃喝</option>
                    <option value="4">娛樂</option>
                    <option value="5">心理</option>
                    <option value="6">旅遊</option>
                </select>
            </div>
            <div id="selector">
                <!-- checked為預設選項 -->
                <input type="radio" name="multiple" value="0" id="radio" checked>
                <label>單選</label>
                <input type="radio" name="multiple" value="1" id="check">
                <label>複選</label>
                <select name="mulit_limit" id="chose">
                    <option value="1" id="radio1">1</option>
                </select>
            </div>
            <!--當輸入的項目為多項時,name的屬性要以array option[]-->

            <div id="opt">
                <label>選項:</label>
                <input type="text" name="option[]">
                <input type="button" value="刪除" id="del">
            </div>

            <div id="end">
                <label>結束時間:</label>
                <input type="datetime-local" name="end" value="">
            </div>
            <input type="submit" value="新增">

        </form>
    </div>
   <?php
   include "../back/footer.php";
   ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            // 新增選項
            // function more() {
            //     // 補上刪除按鈕
            //     let opt = `<div id="new"><label>選項:</label><input type="text" name="option[]"><input type="button" value="刪除" onclick="del()"></div>`;
            //     let opts = document.getElementById('opt').innerHTML;
            //     opts = opts + opt;
            //     document.getElementById('opt').innerHTML = opts;
            // }
            var a = 0;
            $('#more').click(function() {
                const opt = $(`<div id='new${a}' ><label>選項:</label>
            <input type="text" name="option[]">
            <input type="button" value="刪除" id="del"></div>`);
                $('#opt').append(opt);
                a += 1;
                console.log(a);
            })
            // 新增和移除選項
            $('#selector').click(function() {
                if ($('#radio2').length > 0) {
                    if ($('#radio').is(':checked')) {
                        $('#chose').append("<option value='1' id='radio1'>1</option>")
                        for (let i = 2; i < 7; i++) {
                            $(`#radio${i}`).remove()
                        }
                    }
                } else if ($('#check').is(':checked')) {
                    $('#radio1').remove()
                    for (let i = 2; i < 7; i++) {
                        $('#chose').append(`<option value='${i}' id='radio${i}'>${i}</option>`)
                    }
                }
            })
            // 刪除id為new的元素

            $("#opt").on("click", "#del", function() {
                var b = a - 1;
                $(`#new${b}`).remove();
                a -= 1;
                console.log(b);
            })
        })
    </script>
</body>

</html>