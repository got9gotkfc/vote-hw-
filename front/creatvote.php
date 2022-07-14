<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/body.css">
    <title>創建投票</title>

</head>

<body>
    <div id="header">
        <div>創建投票</div>
        <?php
        // include "../function.php";
        // if (!isset($_SESSION['user'])) {
        //     to('../login/login.php');
        // }
        ?>
        <nav>
            <a href="../index.php">首頁</a>
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

            <div>
                <label for="subject">投票主題</label>
                <input type="text" name="subject" id="subject">
                <input type="button" value="新增選項" id="more">
            </div>
            <div id="type">
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
                <input type="button" value="刪除" onclick="del()">
            </div>

            <div id="end">
                <label>結束時間:</label>
                <input type="datetime-local" name="end" value="">
            </div>
            <input type="submit" value="新增">

        </form>
    </div>
    <div id="footer">
        <p>版權為XXX所有，電話09XX-XXXXXX</p>
    </div>
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
            $('#more').click(function() {
                let opt = `<div id="new"><label>選項:</label>
            <input type="text" name="option[]">
            <input type="button" value="刪除" onclick="del()"></div>`;
                $('#opt').after(opt);
            })
            // 新增和移除選項
            $('#selector').click(function() {
                if($('#radio2').length>0){
                    if ($('#radio').is(':checked')){
                        $('#chose').append("<option value='1' id='radio1'>1</option>")
                        for (let i = 2; i <7; i++) {
                            $(`#radio${i}`).remove()
                        }
                    }
                }else if ($('#check').is(':checked')){
                        $('#radio1').remove()
                    for (let i = 2; i < 7; i++) {
                        $('#chose').append(`<option value='${i}' id='radio${i}'>${i}</option>`)
                    }
                }
            })
            // 刪除id為new的元素
            function del() {
                let opts = document.getElementById('new');
                opts.remove('new');
            }
        })
    </script>
</body>

</html>