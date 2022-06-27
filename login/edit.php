<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編輯會員資料</title>
</head>
<body>
    <h1>編輯會員資料</h1>
    <?php 
    include_once "connect.php";
    $sql="SELECT * FROM users WHERE `id`='{$_SESSION['id']}'";
    $user=$pdo->query($sql)->fetch();
    ?>
<form action="save_member.php" method="post">
    <table>
        <tr>
            <td>帳號</td>
            <td><input type="text" name="acc" value="<?=$user['acc'];?>"></td>
        </tr>
        <tr>
            <td>密碼</td>
            <td><input type="password" name="pw" value="<?=$user['pw'];?>"></td>
        </tr>
        <tr>
            <td>姓名</td>
            <td><input type="text" name="name" value="<?=$user['name'];?>"></td>
        </tr>
        <tr>
            <td>性別</td>
            <!-- 選擇性別的預設值 -->
            <?php
            if ($user['gender']==0) {
                $man='checked';
                $woman='';
            }else{
                $man='';
                $woman='checked';
            }
            ?>
            <td><input type="radio" name="gender" value="0" <?php echo $man;?>>男</td>
            <td><input type="radio" name="gender" value="1" <?php echo $woman;?>>女</td>
        </tr>
        <tr>
            <td>生日</td>
            <td><input type="date" name="birthday" value="<?=$user['birthday'];?>"></td>
        </tr>
        <tr>
            <td>畢業學校</td>
            <td><input type="text" name="eduction" value="<?=$user['eduction'];?>"></td>
        </tr>
        <tr>
            <td>地址</td>
            <td><input type="text" name="addr" value="<?=$user['addr'];?>"></td>
        </tr>
        <tr>
            <td>身分證字號</td>
            <td><input type="text" name="idcard" value="<?=$user['idcard'];?>"></td>
        </tr>
        <tr>
            <td>e-mail</td>
            <td><input type="email" name="e-mail" value="<?=$user['e-mail'];?>"></td>
        </tr>
        <tr>
            <td>電話</td>
            <td><input type="number" name="phone" value="<?=$user['phone'];?>"></td>
        </tr>
        <tr>
            <td>密碼提示</td>
            <td><input type="text" name="passnote" value="<?=$user['passnote'];?>"></td>
        </tr>
        <tr>
            <td><input type="hidden" name="update_date" value="<?=date('Y-m-d H:i:s');?>"></td>
        </tr>
    </table>
    <div>
        <input type="hidden" name="id" value="<?=$user['id'];?>">
        <input type="submit" value="更新"><input type="reset" value="重置">
    </div>
</form>
</body>
</html>