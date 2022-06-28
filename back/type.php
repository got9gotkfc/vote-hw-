<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>建立新種類</title>
</head>

<body>
    <div id="header">
        <h1>建立新種類</h1>
        <nav>
            <a href="../index.php">Home</a>
            <a href="../public/creatvote.php">創建投票</a>
            <?php
            include "../login/connect.php";
            if (isset($_SESSION['user'])) {
            ?>
                <a href="../login/member_center.php">會員中心</a>
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

    <?php
    include "../function.php";
    ?>
    <form action="./add_type.php" method="post"> 
        <div id="type">
            <label>種類:</label>
            <input type="text" name="type[]">
            <input type="button" value="新增選項" onclick="more()">
        </div>
        <input type="submit" value="確定新建">
    </form>
    <script>
        // 新增選項
        function more() {
            // 補上刪除按鈕
            let tp = `<div id="new"><label>種類:</label><input type="text" name="type[]"><input type="button" value="刪除" onclick="del()"></div>`;
            let tps = document.getElementById('type').innerHTML;
            tps = tps + tp;
            document.getElementById('type').innerHTML = tps;
        }
        // 刪除id為new的元素
        function del() {
            let tps = document.getElementById('new');
            tps.remove('new');
        }
    </script>


</body>

</html>