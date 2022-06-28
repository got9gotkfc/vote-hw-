<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>開始投票</title>
</head>

<body>
    <div id="header">
        <h1>開始投票</h1>
        <nav>
            <a href="../index.php">Home</a>
            <?php
            include "../login/connect.php";
            if (isset($_SESSION)) {
                if ($_SESSION['id'] <= 3) {
                    echo   "<a href='./back/vote_center.php'>投票中心</a>";
                } else {
                    echo   "<a href='./front/vote_center.php'>投票中心</a>";
                }
            } 
            if (isset($_SESSION['user'])) {
            ?>
                <a href="../login/member_center.php">會員中心</a>
                <a href="./type.php">新增種類</a>
                <a href="../login/logout.php">登出</a>
            <?php
            } else {
            ?>
                <a href="login/login.php">登入</a>
            <?php
            }
            ?>

        </nav>
    </div>
    <form action="./count_center.php?id=<?= $_GET['id']; ?>" method="post">
        <?php
        include "../function.php";
        $find_subject = [
            'id' => $_GET['id']
        ];
        $subject = search('subjects', $find_subject);
        echo "<h2>{$subject['subject']}</h2>";
        
        $find_options = [
            'subject_id' => $subject['id']
        ];
        $options = all('options', $find_options);

        foreach ($options as $key => $value) {
            echo "<input type='radio' name='options[]' value='{$key}'><label>{$value['option']}</label>";
        }
        echo " <input type='submit' value='投票'>";

        ?>
    </form>

</body>

</html>