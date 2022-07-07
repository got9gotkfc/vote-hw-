<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>網路大哉問</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            flex-direction: column;

        }

        #header {
            width: 100%;
            height: 200px;
            margin: auto;
            display: grid;
            border: 1px solid #0984e3;
            grid-template-columns: 1fr 1fr 1fr;
            align-items: end;
            background-color: #74b9ff;

        }

        #header>h1 {
            display: grid;
            height: 100%;
            grid-column: 1;
            justify-content: center;
            align-items: center;
            color: #dfe6e9;
        }

        #header>nav {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-column: 3;
            align-items: end;
            height: 50%;

        }

        nav>a {
            grid-column: auto;
            text-align: center;
            text-decoration: none;

        }
        #mycanvs{
            width: 500px;
            height: 500px;
        }
    </style>
</head>

<body>
    <div id="header">
        <h1>網路大哉問</h1>
        <nav>

            <a href="index.php">Home</a>
            <?php
            include "./login/connect.php";
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
            } else {
            ?>
                <a href="./login/login.php">登入</a>
            <?php
            }
            ?>
        </nav>
    </div>
    <canvas id="mycanvas">

    </canvas>
    <!-- <div id="now_vote"> -->
    <!-- <?php
            // include "./function.php";

            // $subjects = all('subjects');

            // foreach ($subjects as $key => $subject) {
            //     $a = $key + 1;
            //     if (strtotime($subject['end']) >= strtotime(date("Y-m-d H:i:s"))) {
            //         echo "<div id='now_vote$a'>";
            //         echo "<div>正在進行的投票:{$subject['subject']}</div>";
            //         echo "<div>投票人數:{$subject['total']}</div>";
            //         echo "<div>截止時間:{$subject['end']}</div>";
            //         echo "</div>";
            //         echo "<br>";
            //     }
            // }
            ?>
    </div>
    <hr>
    <div id="end_vote">
        <?php
        // $subjects = all('subjects');
        // // chk_array($subjects);
        // foreach ($subjects as $key => $subject) {
        //     $a = $key + 1;

        //     if (strtotime($subject['end']) < strtotime(date("Y-m-d H:i:s"))) {
        //         echo "<div id='now_vote$a'>";
        //         echo "<div>已經結束投票:{$subject['subject']}</div>";
        //         echo "<div>投票人數:{$subject['total']}</div>";
        //         echo "<div>截止時間:{$subject['end']}</div>";
        //         echo "</div>";
        //         echo "<br>";
        //     }
        // }
        ?> -->

    <!-- </div> -->
    <div>
        footer
    </div>
    <script>
        var canvas = document.getElementById("mycanvas")
        var ctx = canvas.getContext("2d")
        var time = 0

        function initCanvas() {
            ww = canvas.width = window.innerWidth
            wh = canvas.height = window.innerHeight

        }

        function talk(startx, starty, wordlong, r, left) {
            ctx.moveTo(startx, starty)
            ctx.lineTo(startx + wordlong, starty)
            ctx.arcTo(startx + wordlong + r, starty, startx + wordlong + r, starty + r, r)
            ctx.arcTo(startx + wordlong + r, starty + 2 * r, startx + wordlong, starty + 2 * r, r)
            if (left == 1) {
                ctx.lineTo(startx + 20, starty + 2 * r)
                ctx.lineTo(startx, starty + 2 * r + 20)
            } else if (left == 0) {
                ctx.lineTo(startx + wordlong, starty + 2 * r + 20)
                ctx.lineTo(startx + wordlong - 20, starty + 2 * r)
            } else {}
            ctx.lineTo(startx, starty + 2 * r)
            ctx.arcTo(startx - r, starty + 2 * r, startx - r, starty + r, r)
            ctx.arcTo(startx - r, starty, startx, starty, r)
        }

        function talk2(appearTime, text, fontSize, ifLeft, x, y) {
            if (time > appearTime) {
                ctx.save()
                var text = text
                ctx.font = '' + fontSize + 'px serif';
                var w = ctx.measureText(text).width
                ctx.lineWidth = 2;
                ctx.translate(ww / 2, wh / 2)
                ctx.beginPath()
                ctx.fillStyle = "#0984e3"
                if (ifLeft) {
                    ctx.fillStyle = "#00b894"
                } else {
                    x = x - w
                }
                talk(x, y, w, 20, ifLeft)
                ctx.strokeStyle = "white"
                ctx.fill()
                ctx.fillStyle = "white"
                ctx.fillText(text, x, y + 2 * r - 5)
                ctx.stroke()
                ctx.restore()
            }
        }
        initCanvas()
        var x = 80
        var y = 200
        var r = 20
        var h = 0
        var l = 0

        function draw() {
            ctx.fillStyle = "white"
            ctx.fillRect(0, 0, ww, wh)
            ctx.lineWidth = 10;
            //   右邊手機
            ctx.save()
            ctx.translate(ww / 2, wh / 2)
            ctx.beginPath()
            if (time > 120 && time <= 140 || time > 360 && time < 380 || time > 480 && time < 500) {
                ctx.translate(10 * Math.cos(Math.PI / 2 - Math.PI * time / 30), 10 * Math.sin(Math.PI / 2 - Math.PI * time / 30))
            }
            ctx.moveTo(ww / 6, wh / 2 - y)
            ctx.lineTo(ww / 6 + x, wh / 2 - y)
            ctx.arcTo(ww / 6 + x + r, wh / 2 - y, ww / 6 + x + r, wh / 2 - y + r, r)
            ctx.lineTo(ww / 6 + x + r, wh / 2 - 2 * r)
            ctx.arcTo(ww / 6 + x + r, wh / 2 - r, ww / 6 + x, wh / 2 - r, r)
            ctx.lineTo(ww / 6, wh / 2 - r)
            ctx.arcTo(ww / 6 - r, wh / 2 - r, ww / 6 - r, wh / 2 - 2 * r, r)
            ctx.lineTo(ww / 6 - r, wh / 2 - y + r)
            ctx.arcTo(ww / 6 - r, wh / 2 - y, ww / 6, wh / 2 - y, r)
            ctx.strokeStyle = "block"
            if (time > 120 && time <= 130 || time > 360 && time < 370 || time > 480 && time < 490) {
                //有振動時淺色 
                ctx.fillStyle = "#74b9ff"
                ctx.fill()
            } else {
                //沒振動時深色
                ctx.fillStyle = "#0984e3"
                ctx.fill()
            }

            ctx.stroke()
            // time++
            ctx.restore()
            //   左邊手機  
            ctx.save()
            ctx.translate(ww / 2, wh / 2)
            ctx.beginPath()
            if (time > 60 && time <= 80 || time > 180 && time <= 200 || time > 240 && time <= 260 || time > 300 && time <= 320 || time > 420 && time < 440 || time > 540 && time < 560 || time > 600 && time < 320) {
                ctx.translate(10 * Math.cos(Math.PI / 2 - Math.PI * time / 30), 10 * Math.sin(Math.PI / 2 - Math.PI * time / 30))
            }
            ctx.moveTo(-ww / 6, wh / 2 - y)
            ctx.lineTo(-ww / 6 - x, wh / 2 - y)
            ctx.arcTo(-ww / 6 - x - r, wh / 2 - y, -ww / 6 - x - r, wh / 2 - y + r, r)
            ctx.lineTo(-ww / 6 - x - r, wh / 2 - 2 * r)
            ctx.arcTo(-ww / 6 - x - r, wh / 2 - r, ww / 6 - x, wh / 2 - r, r)
            ctx.lineTo(-ww / 6, wh / 2 - r)
            ctx.arcTo(-ww / 6 + r, wh / 2 - r, -ww / 6 + r, wh / 2 - 2 * r, r)
            ctx.lineTo(-ww / 6 + r, wh / 2 - y + r)
            ctx.arcTo(-ww / 6 + r, wh / 2 - y, -ww / 6, wh / 2 - y, r)
            if (time > 60 && time <= 80 || time > 180 && time <= 200 || time > 240 && time <= 260 || time > 300 && time <= 320 || time > 420 && time < 440 || time > 540 && time < 560 || time > 600 && time < 620) {
                ctx.fillStyle = "#55efc4"
                ctx.fill()
            } else {
                ctx.fillStyle = "#00b894"
                ctx.fill()
            }
            ctx.strokeStyle = "block"
            ctx.stroke()
            ctx.restore()
            talk2(60, "明天聚餐要吃甚麼阿?", 35, true, -ww / 6, -wh / 2 + 10)
            talk2(120, "我也不知道", 35, false, ww / 6, -wh / 2 + 80)
            talk2(180, "炸雞?", 35, true, -ww / 6, -wh / 2 + 150)
            talk2(240, "牛排?", 35, true, -ww / 6, -wh / 2 + 220)
            talk2(300, "義大利麵?", 35, true, -ww / 6, -wh / 2 + 290)
            talk2(360, "我都可以耶", 35, false, ww / 6, -wh / 2 + 360)
            talk2(420, "其他人有想法嗎?", 35, true, -ww / 6, -wh / 2 + 430)
            talk2(480, "我...也不清楚", 35, false, ww / 6, -wh / 2 + 500)
            talk2(540, "算了 叫他們都來投票!!", 35, true, -ww / 6, -wh / 2 + 570)
            talk2(600, "網路投票所", 35, true, -ww / 6, -wh / 2 + 640)


            if (time > 660) {
                ctx.save()
                ctx.lineWidth = 5;
                ctx.translate(ww / 2, h * 10)
                ctx.fillRect(-ww / 2, -wh*2, ww, 2*wh)
                ctx.fillStyle = "white"
                ctx.strokeStyle = "black"
                ctx.strokeRect(-ww / 6, -wh / 3, ww / 3, wh / 3)
                ctx.strokeRect(-ww / 18, -wh / 9, ww / 9, wh / 9)
                //       正面
                ctx.save()
                ctx.beginPath()
                ctx.arc(0, -wh / 9 * 2, wh / 18, 0, 2 * Math.PI)
                ctx.strokeStyle = "red"
                ctx.stroke()
                ctx.beginPath()
                ctx.moveTo(0, -wh / 9 * 2 - wh / 18)
                ctx.lineTo(0, -wh / 9 * 2 + wh / 18)
                ctx.moveTo(0, -wh / 9 * 2)
                ctx.lineTo(0 + wh / 18 / 1.414, -wh / 9 * 2 + wh / 18 / 1.414)
                ctx.strokeStyle = "red"
                ctx.stroke()
                ctx.restore()
                //      大門
                ctx.save()
                ctx.beginPath()
                ctx.arc(-ww / 54, -wh / 18, 10, 0, 2 * Math.PI)
                ctx.stroke()
                ctx.beginPath()
                ctx.arc(ww / 54, -wh / 18, 10, 0, 2 * Math.PI)
                ctx.stroke()
                ctx.beginPath()
                ctx.moveTo(0, -wh / 9)
                ctx.lineTo(0, 0)
                ctx.stroke()
                ctx.restore()
                //     側面+上
                ctx.save()
                ctx.beginPath()
                ctx.moveTo(-ww / 6, -wh / 3)
                ctx.lineTo(-ww / 6 + ww / 9, -wh / 3 - wh / 9)
                ctx.lineTo(-ww / 6 + ww / 9 + ww / 3, -wh / 3 - wh / 9)
                ctx.lineTo(-ww / 6 + ww / 3, -wh / 3)
                ctx.moveTo(-ww / 6 + ww / 3, 0)
                ctx.lineTo(-ww / 6 + ww / 3 + ww / 9, -wh / 9)
                ctx.lineTo(-ww / 6 + ww / 3 + ww / 9, -wh / 3 - wh / 9)
                ctx.stroke()
                ctx.restore()
                //    右開
                ctx.save()
                ctx.beginPath()
                ctx.moveTo(ww / 6, -wh / 3)
                ctx.lineTo(ww / 6 + ww / 12 * 1.732, -wh / 3 - ww / 12)
                ctx.lineTo(-ww / 6 + ww / 9 + ww / 3 + ww / 12 * 1.732, -wh / 3 - wh / 9 - ww / 12)
                ctx.lineTo(-ww / 6 + ww / 9 + ww / 3, -wh / 3 - wh / 9)
                ctx.fillStyle = "white"
                ctx.fill()
                ctx.stroke()
                ctx.restore()

                ctx.save
                ctx.beginPath()
                ctx.moveTo(-ww / 6, -wh / 3)
                ctx.lineTo(-ww / 6 - ww / 12 * 1.732, -wh / 3 - ww / 12)
                ctx.lineTo(-ww / 6 + ww / 9 - ww / 12 * 1.732, -wh / 3 - wh / 9 - ww / 12)
                ctx.lineTo(-ww / 6 + ww / 9, -wh / 3 - wh / 9)

                ctx.fillStyle = "white"
                ctx.fill()
                ctx.strokeStyle = "black"
                ctx.stroke()
                ctx.restore

                ctx.restore()

                ctx.save()
                ctx.translate(ww / 2, h * 10)
                var text = "?"
                ctx.font = '' + 300 + 'px serif';
                var w = ctx.measureText(text).width
                ctx.lineWidth = 2;
                ctx.fillStyle = "black"
                ctx.strokeStyle = "#e17055"
                ctx.strokeText(text, -w / 2, -wh / 2)
                ctx.stroke()
                ctx.restore()

                ctx.save()
                ctx.translate(ww / 2, h * 10)
                var text = "網路投票所"
                ctx.font = '' + 200 + 'px serif';
                var w = ctx.measureText(text).width
                ctx.lineWidth = 2;
                if (h * 10 >= wh) {
                    ctx.beginPath()
                    talk(-w / 2, -wh + 20, l * 10, 100, 3)
                    ctx.fillStyle = "#6c5ce7"
                    ctx.fill()
                    ctx.stroke()
                    if (l * 10 < w) {
                        l++
                    }
                }
                ctx.fillStyle = "white"
                ctx.strokeStyle = "white"
                ctx.strokeText(text, -w / 2, -wh + 200)
                ctx.stroke()


                ctx.restore()
                if (h * 10 < wh) {
                    h++
                }
            }
            if (time < 6000) {
                time++
            }
        }

        function update() {

            draw()
            requestAnimationFrame(update)
        }

        function loaded() {
            initCanvas()

            update()
        }
        window.addEventListener("resize", initCanvas)
        window.addEventListener("load", loaded)
    </script>
</body>

</html>