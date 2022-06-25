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
            <a href="../vote/vote_center.php">投票中心</a>
            <a href="../index.php">Home</a>
            <?php
            include "../login/connect.php";
            
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
   <form action="../back/count_center.php?subject=<?=$_GET['subject'];?>" method="post">
        <?php
        include "../function.php";
        
        $find_subject=[
            'subject'=>$_GET['subject']
        ];
        $id = search('subjects',$find_subject )['id'];
        $find_options=[
            'subject_id'=>$id
        ];
        $options= all('options', $find_options);
       
        foreach ($options as $key=> $value) {
            echo "<input type='radio' name='options[]' value='{$key}'><label>{$value['option']}</label>";
        }
            echo " <input type='submit' value='投票'>";
            
        ?>
   </form> 
    
</body>
</html>