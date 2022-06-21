<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員中心</title>
    <style>
        .remove {
            color: #eee;
        }

        .remove:hover {
            color: red;
        }
    </style>
</head>

<body>
    <nav><a href="logout.php"> 登出</a></nav>
    <h1>會員中心</h1>
    <?php include "connect.php";
    $sql = "select * from `users` where acc='{$_SESSION['user']}'";
    $user = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    ?>
    歡迎<?= $user['name']; ?>,祝你有美好的一天<br>
    <?php

    echo '序號:' . $user['id'] . "<br>";
    echo '帳號:' . $user['acc'] . "<br>";
    echo '姓名:' . $user['name'] . "<br>";
    // 將性別0 1 代回 男 女
    if ($user['gender'] == 0) {
        $gender = '男';
    } else {
        $gender = '女';
    }
    echo '性別:' . $gender . "<br>";
    echo '生日:' . $user['birthday'] . "<br>";
    echo '畢業學校:' . $user['eduction'] . "<br>";
    echo '地址:' . $user['addr'] . "<br>";
    echo '信箱:' . $user['e-mail'] . "<br>";
    echo '電話:' . $user['phone'] . "<br>";
    echo '註冊日期:' . $user['reg_date'] . "<br>";
    ?>
    <button><a href='edit.php?id=<?= $user['id']; ?>'>更新</a></button>
    <form action="edit.php" method="post">
        <input type="hidden" name="id" value="<?= $user['id']; ?>">
        <input type="submit" value="更新">
    </form>
    <button onclick="location.href='edit.php?id=<?= $user['id']; ?>'">更新</button>

    <a class="remove" href="javascript:if(confirm('確實要刪除嗎?'))location='remove.php?id=<?= $user['id']; ?>'">刪除</a>
</body>

</html>