<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員登入</title>
    <link rel="stylesheet" href="../css/body.css">
    <style>
        #login {
            grid-column: 7/12;
            grid-row: 5/12;
            background-color: #a29bfe;
            border-radius: 10px;
            overflow: hidden;
            border-top: 2px solid #6c5ce7;
            animation: expand 1s forwards;
        }

        @keyframes expand {

            0% {
                /* margin-left: 100%; */
                height: 0;
            }

            100% {
                height: 100%;
            }
        }

        #login>form {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            grid-template-rows: repeat(8,1fr);
        
        }

        #login>form>table {
            grid-column: 1/6;
            grid-row: 1/6;
        }

        table td {
            text-align: center;
            font-size: 25px;
            color: white;
        }

        table td input {
            font-size: 15px;
        }

        .btns {
            text-align: center;
            grid-column: 1/6;
            grid-row: 6/7;
        }

        #alert {
            font-size: 20px;
            margin: 0 auto;
            text-align: center;
            width: 90%;
            height: 0;
            border-radius: 0 0 10px 10px;
            background-color: #d63031;
            color: white;
            grid-column: 7/12;
            grid-row: 12/13;
            animation: expand 1s forwards;
            animation-delay: 1s;
            /* display: none; */
        }

        .btns input {
            font-size: 20px;
        }

        #btn {
            text-align: center;
        }

        #btn a {
            width: 100%;
            font-size: 20px;
            text-decoration: none;
            color: aliceblue;
        }

        #btn a:hover {
            font-size: 30px;
        }

        #register_form {
            display: none;
            grid-column: 7/12;
            grid-row: 5/17;
            background-color: #a29bfe;
            border-radius: 10px;
            overflow: hidden;
            border-top: 2px solid #6c5ce7;
            animation: expand 1s forwards;
        }

        #register_form table td {
            text-align: center;
            font-size: 22px;
            color: white;
        }



        #fg {
            display: none;
            color: aliceblue;
            font-size: 20px;
            text-align: center;
            grid-column: 7/12;
            grid-row: 5/9;
            background-color: #a29bfe;
            border-radius: 10px;
            overflow: hidden;
            border-top: 2px solid #6c5ce7;
            animation: expand 1s forwards;
        }

        #fg input {
            font-size: 20px;
        }

        #hit {
            width: 90%;
            height: 0;
            overflow: hidden;
            text-align: center;
            justify-content: center;
            margin: 0 auto;
            border-radius: 0 0 5px 5px;
            font-size: 20px;
            color: white;
            background-color: #d63031;
            grid-column: 7/12;
            grid-row: 13/14;
            animation: expand 1s forwards;
            animation-delay: 1s;
        }
    </style>
</head>

<body>
    <div id="header">
        <div>登入</div>
        <nav>

            <a href="../index.php">Home</a>
            <?php
            include "../login/connect.php";
            if (isset($_SESSION) && $_SESSION == "") {
                if ($_SESSION['id'] <= 3) {
                    echo   "<a href='./vote_center.php'>投票中心</a>";
                    echo   "<a href='../back.php'>後台中心</a>";
                } else {
                    echo   "<a href='./vote_center.php'>投票中心</a>";
                }
            }
            if (isset($_SESSION['user'])) {
            ?>
                <a href="./member_center.php">會員中心</a>
                <a href="../login/logout.php">登出</a>
            <?php
            } ?>
        </nav>
    </div>

    <div id="content">
        <?php
        if (isset($_GET['alert']) && $_GET['alert'] != "") {
            echo "<div id='alert'>{$_GET['alert']}</div>";
        }
        if (isset($_GET['error'])) {
            echo "<div id='alert'>{$_GET['error']}</div>";
        }
        ?>
        <div id="login">

            <form action="../login/chk_login.php" method="post">
                <table>
                    <tr>
                        <td>帳號:</td>
                        <td><input type="text" name="acc_login"></td>
                    </tr>
                    <tr>
                        <td>密碼:</td>
                        <td><input type="password" name="pw_login"></td>
                    </tr>
                    <tr style="width:100%">
                        <td id="btn" colspan=2>
                            <a href="#" id="register">尚未註冊</a>
                            <a href="#" id="forget">忘記密碼</a>
                        </td>
                    </tr>
                </table>
                <div class="btns">
                    <input type="submit" id="login_btn" value="登入">
                    <input type="reset" value="重置">
                </div>


            </form>
        </div>
        <?php
        if (isset($_POST['chk_acc']) && $_POST['chk_acc'] != "") {
            echo "<div id='hit'>";
            include "../login/chk_acc.php";
            echo "</div>";
        }
        ?>

        <?php
        include "./register.php";
        include "./forgot.php";
        ?>
    </div>
    <div id="footer">
        <p>版權為XXX所有，電話09XX-XXXXXX</p>
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
            

            if ($('#alert').text() != "") {
                $('#alert').show
            }
            

        })
    </script>
</body>

</html>