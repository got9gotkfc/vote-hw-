<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>創建投票</title>
</head>

<body>
    <div id="header">
        <h1>創建投票</h1>
        <?php
        // include "../function.php";
        // if (!isset($_SESSION['user'])) {
        //     to('../login/login.php');
        // }
        ?>
        <nav>
            <a href="../index.php">Home</a>
            <?php
            include "../login/connect.php";
            if ($_SESSION['id'] <= 3) {
                echo   "<a href='../back/vote_center.php'>投票中心</a>";
            } else {
                echo   "<a href='../front/vote_center.php'>投票中心</a>";
            }
            if (isset($_SESSION['user'])) {
            ?>
                <a href="logout.php">登出</a>
            <?php
            } else {
            ?>
                <a href="../login/login.php">登入</a>
            <?php
            }
            ?>
        </nav>
    </div>
    <form action="../back/add_vote.php" method="post">

        <div>
            <label for="subject">投票主題</label>
            <input type="text" name="subject" id="subject">
            <input type="button" value="新增選項" onclick="more()">
        </div>
        <div id="selector">
            <!-- checked為預設選項 -->
            <input type="radio" name="multiple" value="0" checked>
            <label>單選</label>
            <input type="radio" name="multiple" value="1">
            <label>複選</label>
        </div>
        <!--當輸入的項目為多項時,name的屬性要以array option[]-->
        <div id="options">
            <div id="opt">

                <label>選項:</label>
                <input type="text" name="option[]">
                <input type="button" value="刪除" onclick="del()">
            </div>
        </div>
        <div id="end">
            <label>結束時間:</label>
            <input type="datetime-local" name="end" value="">
        </div>
        <input type="submit" value="新增">

    </form>
    <script>
        // 新增選項
        function more() {
            // 補上刪除按鈕
            let opt = `<div id="new"><label>選項:</label><input type="text" name="option[]"><input type="button" value="刪除" onclick="del()"></div>`;
            let opts = document.getElementById('options').innerHTML;
            opts = opts + opt;
            document.getElementById('options').innerHTML = opts;
        }
        // 刪除id為new的元素
        function del() {
            let opts = document.getElementById('new');
            opts.remove('new');
        }
    </script>
</body>

</html>