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
            <a href="login/chk_login.php">Votes</a>
            <a href="index.php">Home</a>
            <?php
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
    <div id="now_vote">

    </div>
    <div id="end_vote">

    </div>
    <div>
        footer
    </div>

</body>

</html>