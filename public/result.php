<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投票結果</title>
</head>
<body>
<div id="header">
        <h1>投票結果</h1>
        <nav>
            <a href="../front/vote_center.php">投票中心</a>
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
    <?php
    include "../function.php";
    $subject_id=['id'=>$_GET['id']];
    $subject=search('subjects',$subject_id);
    ?>
    <h1><?=$subject['subject'];?></h1>
    <table>
        <?php
        $option_id=['subject_id'=>$_GET['id']];
        $option=all('options',$option_id);
        foreach ($option as $key => $value) {
            $point=round(($value['total'])/($subject['total']),2)*100;
            echo "<tr>{$value['option']}:{$point}%</tr><br>";
        }
        ?>
    </table>
</body>
</html>