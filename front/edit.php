<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/body.css">
    <title>編輯資料</title>
    <style>

        table {
            width: 500px;
            height: 540px;
            border: 1px solid #b2bec3;
            box-shadow: 3px 3px 7px rgba(0, 0, 0, 0.7);
        }

        tr {
            width: 100%;
            height: calc(100% / 9);

        }

        td {
            font-size: 30px;
            border: 1px solid #b2bec3;
        }
        td > input{
            font-size: 25px;
        }

        #list {
            font-size: 30px;
        }

        #list>input {
            width: 100px;
            height: 40px;
            font-size: 30px;
        }
    </style>
</head>

<body>
    <div id="header">
        <div>編輯資料</div>
        <?php
        include "../login/connect.php";
        $sql = "SELECT * FROM users WHERE `id`='{$_SESSION['id']}'";
        $user = $pdo->query($sql)->fetch();
        ?>
        <nav>
            <a href="../index.php">首頁</a>
            <a href="./member_center.php">會員中心</a>
            <?php
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
    </div>
    <div id="content">
        <form action="../login/save_member.php" method="post">
            <table>
                <tr>
                    <td>帳號</td>
                    <td><input type="text" name="acc" value="<?= $user['acc']; ?>"></td>
                </tr>
                <tr>
                    <td>密碼</td>
                    <td><input type="password" name="pw" value=""></td>
                </tr>
                <tr>
                    <td>姓名</td>
                    <td><input type="text" name="name" value="<?= $user['name']; ?>"></td>
                </tr>
                <tr>
                    <td>性別</td>
                    <!-- 選擇性別的預設值 -->
                    <?php
                    if ($user['gender'] == 0) {
                        $man = 'checked';
                        $woman = '';
                    } else {
                        $man = '';
                        $woman = 'checked';
                    }
                    ?>
                    <td><input type="radio" name="gender" value="0" <?php echo $man; ?>>男
                    <input type="radio" name="gender" value="1" <?php echo $woman; ?>>女</td>
                </tr>
                <tr>
                    <td>生日</td>
                    <td><input type="date" name="birthday" value="<?= $user['birthday']; ?>"></td>
                </tr>
                <tr>
                    <td>畢業學校</td>
                    <td><input type="text" name="eduction" value="<?= $user['eduction']; ?>"></td>
                </tr>
                <tr>
                    <td>地址</td>
                    <td><input type="text" name="addr" value="<?= $user['addr']; ?>"></td>
                </tr>
                <tr>
                    <td>身分證字號</td>
                    <td><input type="text" name="idcard" value="<?= $user['idcard']; ?>"></td>
                </tr>
                <tr>
                    <td>e-mail</td>
                    <td><input type="email" name="e-mail" value="<?= $user['e-mail']; ?>"></td>
                </tr>
                <tr>
                    <td>電話</td>
                    <td><input type="number" name="phone" value="<?= $user['phone']; ?>"></td>
                </tr>
                <tr>
                    <td>密碼提示</td>
                    <td><input type="text" name="passnote" value="<?= $user['passnote']; ?>"></td>
                </tr>
                <tr>
                    <td><input type="hidden" name="update_date" value="<?= date('Y-m-d H:i:s'); ?>"></td>
                </tr>
            </table>
            <br>
            <div id="list">
                <input type="hidden" name="id" value="<?= $user['id']; ?>">
                <input type="submit" value="更新">
                <input type="reset" value="重置">
            </div>
        </form>
    </div>
    <div id="footer">
        <p>版權為XXX所有，電話09XX-XXXXXX</p>
    </div>
</body>

</html>