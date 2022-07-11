<div id="register_form">
    <form action="../login/store_member.php" method="post">
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
                <td><input type="radio" name="gender" value="0" checked>男</td>
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
                <td><input type="hidden" name="reg_date" value="<?= date('Y-m-d H:i:s'); ?>"></td>
            <tr>
            <tr>
                <td><input type="submit" value="註冊" id="reg"></td>
                <td><input type="reset" value="重置"></td>
            </tr>
        </table>
    </form>
</div>