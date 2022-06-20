<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員註冊</title>
</head>
<body>
    <?php
    date_default_timezone_set('Asia/Taipei');
    // echo date("Y-m-d H:i:s");
    ?>
    <h1>會員註冊</h1>
    <form action="store_member.php" method="post">
    <table>
        <tr>
            <td>帳號</td>
            <td><input type="text" name="acc" value=""></td>
        </tr>
        <tr>
            <td>密碼</td>
            <td><input type="password" name="pw" value=""></td>
        </tr>
        <tr>
            <td>姓名</td>
            <td><input type="text" name="name" value=""></td>
        </tr>
        <tr>
            <td>性別</td>
            <td><input type="radio" name="gender" value="0">男</td>
            <td><input type="radio" name="gender" value="1">女</td>
        </tr>
        <tr>
            <td>生日</td>
            <td><input type="date" name="birthday" value=""></td>
        </tr>
        <tr>
            <td>畢業學校</td>
            <td><input type="text" name="eduction" value=""></td>
        </tr>
        <tr>
            <td>地址</td>
            <td><input type="text" name="addr" value=""></td>
        </tr>
        <tr>
            <td>身分證字號</td>
            <td><input type="text" name="idcard" value=""></td>
        </tr>
        <tr>
            <td>e-mail</td>
            <td><input type="e-mail" name="e-mail" value=""></td>
        </tr>
        <tr>
            <td>電話</td>
            <td><input type="text" name="phone" value=""></td>
        </tr>
        <tr>
            <td>密碼提示</td>
            <td><input type="text" name="passnote" value=""></td>
        </tr>
        <tr>
            <td><input type="hidden" name="reg_date" value="<?=date('Y-m-d H:i:s');?>"></td>
        </tr>
    </table>
        </table>
        <input type="submit" value="註冊">
        <input type="reset" value="重置">
    </form>
</body>
</html>