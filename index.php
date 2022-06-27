<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投票系統</title>
</head>

<body>
    <div id="header">
        <nav>
            <h1>投票系統</h1>
            <a href="index.php">Home</a>
            <?php
            include "./login/connect.php";  
            if ($_SESSION['id']<=3) {
              echo   "<a href='./back/vote_center.php'>投票中心</a>";
            }  else{
              echo   "<a href='./front/vote_center.php'>投票中心</a>";
            }       
            if (isset($_SESSION['user'])) {
            ?> 
                <a href="./login/logout.php">登出</a>
                <a href="./login/member_center.php">會員中心</a>
            <?php
            } else {
            ?>
                <a href="./login/login.php">登入</a>
            <?php
            }
            ?>
        </nav>
    </div>
    <div id="now_vote">

    </div>
    <div id="end_vote">

    </div>
    <div>
        footer
    </div>

</body>

</html>