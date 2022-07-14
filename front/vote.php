<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/body.css">
    <title>開始投票</title>
    <style>
        form {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            grid-template-rows: repeat(6, 1fr);
            grid-column: 7/12;
            grid-row: 3/9;
        }

        #tittle {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            grid-column: 1/6;
            grid-row: 1/2;
            border-radius: 10px 10px 0 0;
            overflow: hidden;
            background: #6c5ce7;
            border-top: 2px solid #6c5ce7;
            animation: expand 1s forwards ease-in-out;
            color: #dfe6e9;
        }

        @keyframes expand {

            0% {
                /* margin-left: 100%; */
                width: 0;
                height: 0;
            }

            50% {
                /* margin-left: 0%; */
                width: 100%;
                height: 0;
            }

            100% {
                width: 100%;
                height: 100%;
            }
        }

        #op {
            width: calc(100% - 20px);
            height: 0;
            grid-column: 1/6;
            grid-row: 2/7;
            font-size: 20px;
            border-radius: 0 0 0 10px ;
            overflow: hidden;
            background: #6c5ce7;
            animation: expand2 1s forwards ;
            animation-delay: 0.7s;
            color: #dfe6e9;
        }
        @keyframes expand2 {

0% {
    /* margin-left: 100%; */
    width: 0;
    height: 0;
}

50% {
    /* margin-left: 0%; */
    width: 80%;
    height: 0;
}

75% {
    width: 80%;
    height: 100%;
}
100% {
    width: 100%;
    height: 100%;
}
}
        #sm{
            font-size: 20px;
            grid-column: 5/6;
            grid-row: 6/7;
            overflow: hidden;
            background: #6c5ce7;
            border: #dfe6e9;
            animation: expand3 0.6s forwards ;
            animation-delay: 1.6s;
            color: #dfe6e9;
        }
        @keyframes expand3 {

0% {
    /* margin-left: 100%; */
    background: white;
}

100% {
    /* margin-left: 0%; */
    border: #dfe6e9;
    background: #6c5ce7;
}

}

        #limit {
            display: none;
        }
    </style>
</head>

<body>
    <div id="header">
        <div>開始投票</div>
        <nav> <a href="../index.php">首頁</a>
            <?php
            include "../login/connect.php";

            if (isset($_SESSION)) {
                if ($_SESSION['id'] <= 3) {
                    echo   "<a href='../front/vote_center.php'>投票中心</a>";
                    echo   "<a href='../back/back.php'>後台中心</a>";
                } else {
                    echo   "<a href='../front/vote_center.php'>投票中心</a>";
                }
            }
            if (isset($_SESSION['user'])) {
            ?>
                <a href="../login/member_center.php">會員中心</a>
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
    <div id="content">
        <form action="../back/count_center.php?id=<?= $_GET['id']; ?>" method="post">
            <?php
            include "../function.php";
            $find_subject = [
                'id' => $_GET['id']
            ];
            $subject = search('subjects', $find_subject);
            echo "<div id='tittle'>{$subject['subject']}</div>";
            echo "<div id='op'>";
            $find_options = [
                'subject_id' => $subject['id']
            ];
            $options = all('options', $find_options);
            if ($subject['multiple'] == 0) {
                foreach ($options as $key => $value) {
                    echo "<div><label><input type='radio' name='options[]' value='{$key}'>{$value['option']}</label></div>";
                }
            } else {
                echo "<div>(最多選{$subject['mulit_limit']}個)</div>";
                echo "<div id='limit'>{$subject['mulit_limit']}</div>";
                foreach ($options as $key => $value) {

                    echo "<div><label><input type='checkbox' name='options[]' value='{$key}' id='{$key}'>{$value['option']}</label></div>";
                }
            }
            echo "</div>";
            echo " <input type='submit' id='sm' value='投票'>";
            ?>
        </form>
    </div>
    <div id="footer">
        <p>版權為XXX所有，電話09XX-XXXXXX</p>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {


        $('#content div').click(function() {
            if ($("input[type='checkbox']:checked").length > $('#limit').text()) {
                for (let i = 0; i < 6; i++) {
                    $(`input[value='${i}']`).prop('checked', false);
                }
            }
        })
    })
</script>

</html>