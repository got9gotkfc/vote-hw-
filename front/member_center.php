<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/body.css">
    <title>會員中心</title>
    <style>
        #content>#ask {
            padding:0 10px;
            font-size: 25px;
            letter-spacing:3px;
            grid-column: 5/12;
            grid-row: 2/3;
            border-radius: 10px;
            overflow: hidden;
            background: #6c5ce7;
            border-top: 2px solid #6c5ce7;
            animation: expand 2s forwards;
            color:#dfe6e9;
        }
        @keyframes expand {

            0% {
                width: 0;
                height: 0;
            }
            50% {
                width: 100%;
                height: 0;
            }

            100% {
                width: 100%;
                height: 100%;
            }
        }
        


        #content>table {
            grid-column: 4/13;
            grid-row: 4/13;
        }

        .odd {
            border: 1px solid #fd79a8;
            background-color: #fd79a8;
            color: white;
        }

        .even {
            border: 1px solid #e84393;
            background-color: #e84393;
            color: white;
        }

        #content>#list {
            grid-column: 8/9;
            grid-row: 14/15;
        }
    </style>
</head>

<body>
    <div id="header">
        <div>會員中心</div>
        <nav>
            <a href="../index.php">首頁</a>
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
        <div id="ask">歡迎<?= $user['name']; ?>，祝你有美好的一天~~</div>
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
            echo "<tr><td>性別</td><td id='gender'>{$gender}</td></tr>";
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
                <input class="btn_update" type="submit" value="更新">
            </form>


        </div>
    </div>
    <div id="footer">
        <p>版權為XXX所有，電話09XX-XXXXXX</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('tr:odd').addClass('odd');
            $('tr:even').addClass('even');

            if ($('#gender').text() == "男") {
                $('.odd').css('background-color', '#00cec9');
                $('.even').css('background-color', '#00b894');
            }
        });
    </script>

</body>

</html>