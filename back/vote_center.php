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
            <a href="../index.php">Home</a>
            <a href="../public/creatvote.php">創建投票</a>
            <?php
            include "../login/connect.php";
            if (isset($_SESSION['user'])) {
            ?>
                <a href="./type.php">新增種類</a>
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
    <div id="vote">
        <?php
        include "../function.php";

        $subjects = all('subjects');

        foreach ($subjects as $key => $subject) {
            $a = $key + 1;
            $find_log = [
                'user_id' => $_SESSION['id'],
                'subject_id' => $subject['id']
            ];
            $log = c('log', $find_log);
            $type = all('type');

            if ($log > 0 || strtotime($subject['end']) < strtotime(date("Y-m-d H:i:s"))) {
                echo "<div id='now_vote$a'>";
                echo "<div>投票主題:{$subject['subject']}</div>";
                foreach ($type as $key => $typ) {
                    if ($typ['id'] == $subject['type_id']) {
                        echo "<div>類型:{$typ['name']}</div>";
                    }
                }
                echo "<div>投票人數:{$subject['total']}</div>";
                echo "<div>截止時間:{$subject['end']}</div>";
                echo "<div><a href='../public/result.php?id={$subject['id']}'>查看結果</a></div>";
                echo " <a class='remove' href=" . "javascript:if(confirm('確實要刪除嗎?'))location='./delete.php?id={$subject['id']}'" . ">刪除</a>";
                echo "</div>";
                echo "<br>";
            } else {
                echo "<div id='now_vote$a'>";
                echo "<div>投票主題:{$subject['subject']}</div>";
                foreach ($type as $key => $typ) {
                    if ($typ['id'] == $subject['type_id']) {
                        echo "<div>類型:{$typ['name']}</div>";
                    }
                }
                echo "<div>投票人數:{$subject['total']}</div>";
                echo "<div>截止時間:{$subject['end']}</div>";
                echo "<div><a href='./vote.php?id={$subject['id']}'>開始投票</a></div>";
                echo "<a class='remove' href=" . "javascript:if(confirm('確實要刪除嗎?'))location='./delete.php?id={$subject['id']}'" . ">刪除</a>";
                echo "</div>";
                echo "<br>";
            }
        }
        ?>
    </div>
</body>

</html>