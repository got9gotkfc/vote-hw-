<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header.css">
    <title>會員中心</title>

    <style>
        .remove {
            color: #eee;
        }

        .remove:hover {
            color: red;
        }
        
        #ask{
            color: #d63031;
            font-size: 50px;
        }
        table{
            width: 500px;
            height: 540px;
            border: 1px solid #b2bec3;
            box-shadow: 3px 3px 7px rgba(0, 0, 0, 0.7);
        }
        tr{
            width: 100%;
            height: calc(100% / 9);
            
        }
        td{
            font-size: 30px;
            border: 1px solid #b2bec3;
        }
        #list{
            font-size: 30px;
        }
        #list > a{
            width:100px;
            height:40px;
            
        }
    </style>
</head>

<body>
    <div id="header">
        <h1>會員中心</h1>
        <nav>
            <a href="../index.php">Home</a>
            <?php
            include "../login/connect.php";
            if (isset($_SESSION)) {
                if ($_SESSION['id'] <= 3) {
                    echo   "<a href='../back/vote_center.php'>投票中心</a>";
                } else {
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

    <?php
    $sql = "select * from `users` where acc='{$_SESSION['user']}'";
    $user = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    ?>
    <div id="content">
        <div id="ask">歡迎<?= $user['name']; ?>,祝你有美好的一天</div>
        <table>
            <?php
            echo "<tr><td>帳號</td><td>{$user['acc']}</td></tr>";
            echo "<tr><td>姓名</td><td>{$user['name']}</td></tr>";
            // 將性別0 1 代回 男 女
            if ($user['gender'] == 0) {
                $gender = '男';
            } else {
                $gender = '女';
            }
            echo "<tr><td>性別</td><td>{$gender}</td></tr>";
            echo "<tr><td>生日</td><td>{$user['birthday']}</td></tr>";
            echo "<tr><td>畢業學校</td><td>{$user['eduction']}</td></tr>";
            echo "<tr><td>地址</td><td>{$user['addr']}</td></tr>";
            echo "<tr><td>信箱</td><td>{$user['e-mail']}</td></tr>";
            echo "<tr><td>電話</td><td>{$user['phone']}</td></tr>";
            echo "<tr><td>註冊日期</td><td>{$user['reg_date']}</td></tr>";
            ?>
        </table>
        <br>
        <div id="list">
            <form action="./edit.php" method="post">
                <input type="hidden" name="id" value="<?= $user['id']; ?>">
                <input type="submit" value="更新"style="width:100px;height:40px;font-size:30px">
                <?php
            if ($_SESSION['id'] <= 3) {
                echo   " <a class='remove' href=" . "javascript:if(confirm('確實要刪除嗎?'))location='../login/remove.php?id={$user['id']}'" . ">刪除</a>";
            }
            ?>
            </form>
            

        </div>
    </div>




</body>

</html>