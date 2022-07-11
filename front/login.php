<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員登入</title>
    <link rel="stylesheet" href="../css/header.css">
    <style>
        #content {
            width: 40%;
            height: 60%;
        }

        #login {
            width: 100%;
            border: 1px solid #636e72;
            display: flex;
            justify-content: center;
            flex-direction: column;
            padding: 10px;
            align-items: center;
            text-align: center;
            color: #dfe6e9;
            background-color: #0984e3;
            border-radius: 10px;
            /* filter: hue-rotate(20deg); */
        }

        form {
            width: 100%;
            display: flex;
            justify-content: center;
            flex-direction: column;
            padding: 10px;
            font-size: 30px;
            align-items: center;
        }

        form input {
            font-size: 30px;
        }

        table tr #btn {
            /* display: flex; */
            width: 100%;

            justify-content: center;
        }

        #register_form {
            display: none;
            border: 1px solid #636e72;
            padding: 2px;
        }

        #fg {
            display: none;
            border: 1px solid #636e72;
            padding: 2px;
        }
        #alert{
            display: none;
        }
    </style>
</head>

<body>


    <div id="header">
        <h1>登入</h1>
        <nav>

            <a href="index.php">Home</a>
            <?php
            include "../login/connect.php";
            if (isset($_SESSION)) {
            } else if ($_SESSION['id'] <= 3) {
                echo   "<a href='./back/vote_center.php'>投票中心</a>";
            } else {
                echo   "<a href='./front/vote_center.php'>投票中心</a>";
            }

            if (isset($_SESSION['user'])) {
            ?>
                <a href="./login/member_center.php">會員中心</a>
                <a href="./login/logout.php">登出</a>
            <?php
            } ?>
        </nav>
    </div>

    <div id="content">
        <div id="login">
            <div id="alert"><?=$_GET['alert'];?></div>
            <?php
            if (isset($_GET['error'])) {
                echo "<h2 style='color:#fd79a8;text-align:center'>{$_GET['error']}</h2>";
            }
            ?>
            <form action="../login/chk_login.php" method="post">
                <table>
                    <tr>
                        <td>帳號</td>
                        <td><input type="text" name="acc_login" ></td>
                    </tr>
                    <tr>
                        <td>密碼</td>
                        <td><input type="password" name="pw_login"></td>
                    </tr>
                    <tr style="width:100%">

                        <td id="btn"> <a href="#" id="register" style="font-size: 20px;">尚未註冊</a></td>
                        <td> <a href="#" id="forget" style="font-size: 20px;">忘記密碼</a></td>

                    </tr>
                </table>
                <div class="btns">
                    <input type="submit" id="login_btn" value="登入">
                    <input type="reset" value="重置">
                </div>

            </form>
        </div>
        <?php
        include "./register.php";
        include "./forgot.php";
        ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#register').click(function() {
                if ($('#register_form').is(':hidden')) {
                    $('#register_form').show()
                    $('#login').hide()
                }
            })
            $('#forget').click(function() {
                if ($('#fg').is(':hidden')) {
                    $('#fg').show()
                    $('#login').hide()
                }
            })
            
            if ($('#alert').text()==0) {
                alert("請輸入完整資料");
            }
            if ($('#alert').text()==1) {
                alert("請輸入完整的帳號和密碼");
            }
        })
    </script>
</body>

</html>