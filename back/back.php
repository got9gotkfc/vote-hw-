<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/body.css">
    <title>後台頁面</title>
    <style>
        #type_table{
            text-align: center;
            grid-column: 2/6;
            grid-row: 2/3;
        }
        #typ_update{
            text-align: center;
            grid-column: 4/9;
            grid-row: 4/12;
        }
        #typ_del{
            grid-column: 11/15;
            grid-row: 4/12;
        }


        #user_table{
            text-align: center;
            grid-column: 8/12;
            grid-row: 2/3;
        }
        #users{
            grid-column: 2/20;
            grid-row: 3/19;
        }
        #user_del{
            grid-column: 9/11;
            grid-row: 19/20;
        }


        #subject_table{
            text-align: center;
            grid-column: 14/18;
            grid-row: 2/3;
        }
        #sub_table{
            grid-column: 2/20;
            grid-row: 3/19;
        }
        #sub_del{
            grid-column: 9/11;
            grid-row: 19/20;
        }
        
    </style>
</head>

<body>
    <div id="header">
        <div>會員中心</div>
        <nav>
            <a href="../index.php">首頁</a>
            <?php
            include "../login/connect.php";
            if (isset($_SESSION)) {
                if ($_SESSION['id'] <= 3) {
                    echo   "<a href='../front/vote_center.php'>投票中心</a>";
                    echo   "<a href='../front/member_center.php'>會員中心</a>";
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
    <div id="content">
        <a href="./back.php?table=1" id="type_table">分類管理</a>
        <a href="./back.php?table=2" id="user_table">會員管理</a>
        <a href="./back.php?table=3" id="subject_table">投票管理</a>
        <?php
        if(isset($_GET['table'])){
        switch ($_GET['table']) {
            case '1':
        ?><div id="typ_update">
                <form action="./add_type.php" method="post">
                    <div id="typ">
                        <div>新增種類
                        <input type="button" value="新增選項" id="more"></div>
                        <label>種類名稱:
                        <input type="text" name="type[]"></label>
                        <input type="button" value="刪除" id="del">
                    </div>
                    <input type="submit" value="新增">
                </form> 
            </div>
            <div id="typ_del">
                <form action="./delete.php?id=type" method="post">
                    <table>
                        <tr>
                            <td>種類</td>
                        </tr>
                    <?php
                    include_once "../function.php";
                    $table = 'type';
                    $types = all($table);
                    // chk_array($type);
                    foreach ($types as $key => $type) {
                        echo "<tr>";
                        echo "<td><input type='checkbox' name='types[]' value='{$key}'><label>{$type['name']}</label></td>";
                        echo "</tr>";
                    }
                    ?>
                    </table>
                    <input type='submit' value='刪除選項'>
                </form>
                </div>
        <?php
                break;
            case '2':        
        ?><table id="users">
            <form action="./delete.php?id=users" method="post">
                    
                        <tr>
                            <td>序號</td>
                            <td>帳號</td>
                            <td>姓名</td>
                            <td>性別</td>
                            <td>生日</td>
                            <td>學歷</td>
                            <td>地址</td>
                            <td>電子信箱</td>
                            <td>電話</td>
                            <td>註冊日期</td>
                            <td>執行</td>
                        </tr>
                    <?php
                    include_once "../function.php";
                    $table = 'users';
                    $users = all($table);
                    // chk_array($type);
                    foreach ($users as $key => $user) {
                        echo "<tr>";
                        echo "<td>{$key}</td>";
                        echo "<td>{$user['acc']}</td>";
                        echo "<td>{$user['name']}</td>";
                        // 將性別0 1 代回 男 女
                        if ($user['gender'] == 0) {
                            $gender = '男';
                        } else {
                            $gender = '女';
                        }
                        echo "<td id='gender'>{$gender}</td>";
                        echo "<td>{$user['birthday']}</td>";
                        echo "<td>{$user['eduction']}</td>";
                        echo "<td>{$user['addr']}</td>";
                        echo "<td>{$user['e-mail']}</td>";
                        echo "<td>{$user['phone']}</td>";
                        echo "<td>{$user['reg_date']}</td>";
                        echo "<td><input type='checkbox' name='user[]' value='{$user['id']}'><label></label></td>";
                        echo "</tr>";
                    }
                    ?>
                    
                    <input type='submit' id='user_del' value='刪除選項'>
            </form>
        </table>


        <?php
                break;
            case '3'
        ?><table id="sub_table">
            <form action="./delete.php?id=subjects" method="post">
                    
                        <tr>
                            <td>主題</td>
                            <td>狀態</td>
                            <td>投票人數</td>
                            <td>點選</td>
                        </tr>
                    <?php
                    include_once "../function.php";
                    $table = 'subjects';
                    $subjects = all($table);
                    // chk_array($type);
                    foreach ($subjects as $key => $subject) {
                        echo "<tr>";
                        echo "<td>{$subject['subject']}</td>";
                        // 將性別0 1 代回 男 女
                        if (strtotime($subject['end']) > strtotime(date("Y-m-d H:i:s")) ){
                            $n = '進行中';
                        } else {
                            $n = '已結束';
                        }
                        echo "<td>{$n}</td>";
                        echo "<td>{$subject['total']}</td>";
                        echo "<td><input type='checkbox' name='subject[]' value='{$subject['id']}'><label></label>";
                        echo "</tr>";
                    }
                    ?>
                    
                    <input type='submit'id='sub_del' value='刪除選項'>
            </form>
        </table>
        <?php  
                break;
            
        }
    }
        ?>

    </div>
    <div id="footer">
        <p>版權為XXX所有，電話09XX-XXXXXX</p>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            var a = 0;
            $('#more').click(function() {
                const opt = $(`<div id='new${a}' ><label>種類名稱:</label>
            <input type="text" name="type[]">
            <input type="button" value="刪除" id="del"></div>`);
                $('#typ').append(opt);
                a += 1;
                console.log(a);
            })
            $("#typ").on("click", "#del", function() {
                var b = a - 1;
                $(`#new${b}`).remove();
                a -= 1;
                console.log(b);
            })
        })
    </script>
</body>

</html>