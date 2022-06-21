<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投票中心</title>
</head>
<body>
<div id="header">
    <h1>投票中心</h1>
        <nav>
            <a href="../vote/vote.php">Votes</a>
            <a href="../index.php">Home</a>
            <?php
            include "../login/connect.php";
            if (isset($_SESSION['user'])) {
            ?>
                <a href="logout.php">登出</a>
            <?php
            } else {
            ?>
                <a href="login/login.php">登入</a>
            <?php
            }
            ?>
        </nav>
    </div>
    <form action="./api/add_vote.php" method="post">
    <div >
        <label for="subject">投票主題</label>
        <input type="text" name="subject" id="subject">
        <input type="button" value="新增選項" onclick="more()">
    </div>
    <div id="selector">
        <input type="radio" name="multiple" value="0" checked>
        <label>單選</label>
        <input type="radio" name="multiple" value="1" >
        <label>複選</label>
    </div>
    <div id="options">
        <div>
            <!--當輸入的項目為多項時,記得name的屬性要以array option[]-->
            <label>選項:</label><input type="text" name="option[]">
        </div>
    </div>
    <input type="submit" value="新增">

    </form>
    <script>
function more(){
    let opt=`<div id="new"><label>選項:</label><input type="text" name="option[]"><input type="button" value="刪除" onclick="del()"></div>`;
    let opts=document.getElementById('options').innerHTML;
    opts=opts+opt;
    document.getElementById('options').innerHTML=opts;
}
function del(){
    let opts=document.getElementById('new');
     opts.remove('new');
}
</script>
</body>
</html>