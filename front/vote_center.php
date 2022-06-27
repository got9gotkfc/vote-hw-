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
            <a href="../public/creatvote.php">創建投票</a>
            <a href="../index.php">Home</a>
            <?php
            include "../login/connect.php";
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
    <div id="vote">
        <?php
        include "../function.php";

        $subjects = all('subjects');
        // chk_array($subjects);
        foreach ($subjects as $key => $subject) {
            $a = $key + 1;

            $find_log = ['subject_id' => $subject['id']];
            $log = search('log', $find_log);

           
            if ($log['subject_id'] == $_SESSION['id']) {
                echo "<div id='now_vote$a'>";
                echo "<div>投票主題:{$subject['subject']}</div>";
                echo "<div>投票人數:{$subject['total']}</div>";
                echo "<div>截止時間:{$subject['end']}</div>";
                echo "<div><a href='../public/result.php?subject={$subject['id']}'>察看結果</a></div>";
                echo "</div>";
                echo "<br>";
            } else {
                echo "<div id='now_vote$a'>";
                echo "<div>投票主題:{$subject['subject']}</div>";
                echo "<div>投票人數:{$subject['total']}</div>";
                echo "<div>截止時間:{$subject['end']}</div>";
                echo "<div><a href='./vote.php?subject={$subject['id']}'>開始投票</a></div>";
                echo "</div>";
                echo "<br>";
            }
        }
        ?>
    </div>
</body>

</html>