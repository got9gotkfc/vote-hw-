<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>網路投票所</title>
    <link rel="stylesheet" href="./css/body.css">
    <style>
    #content>#mycanvas{
        grid-column: 1/16;
        grid-row: 1/30;
    }
    </style>
</head>

<body>
    <div id="header">
        <div>網路投票所</div>
        <nav>
            <a href="index.php">首頁</a>
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
                <a href="./front/member_center.php">會員中心</a>
                <a href="./login/logout.php">登出</a>

            <?php
            } else {
            ?>
                <a href="./front/login.php">登入</a>
            <?php
            }
            ?>
        </nav>
    </div>
    <div id="content">
    <canvas id="mycanvas"></canvas>
    </div>
    <div id="footer">
        <p>版權為XXX所有，電話09XX-XXXXXX</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>
        var canvas = document.getElementById("mycanvas")
        var ctx = canvas.getContext("2d")
        var time = 0

        function initCanvas() {
            ww = canvas.width = $('#content').width()
            wh = canvas.height = $('#content').height()

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
            talk2(60, "明天聚餐要吃甚麼阿?", wh/25, true, -ww / 6, -wh / 2 + 10)
            talk2(120, "我也不知道", wh/25, false, ww / 6, -wh / 2 + 80)
            talk2(180, "炸雞?", wh/25, true, -ww / 6, -wh / 2 + 150)
            talk2(240, "牛排?", wh/25, true, -ww / 6, -wh / 2 + 220)
            talk2(300, "義大利麵?", wh/25, true, -ww / 6, -wh / 2 + 290)
            talk2(360, "我都可以耶", wh/25, false, ww / 6, -wh / 2 + 360)
            talk2(420, "其他人有想法嗎?", wh/25, true, -ww / 6, -wh / 2 + 430)
            talk2(480, "我...也不清楚", wh/25, false, ww / 6, -wh / 2 + 500)
            talk2(540, "算了 叫他們都來投票!!", wh/25, true, -ww / 6, -wh / 2 + 570)
            talk2(600, "網路投票所", wh/25, true, -ww / 6, -wh / 2 + 640)


            if (time > 660) {
                ctx.save()
                ctx.lineWidth = 5;
                ctx.translate(ww / 2, h * 10)
                ctx.fillRect(-ww / 2, -wh * 2, ww, 2 * wh)
                ctx.fillStyle = "white"
                ctx.strokeStyle = "black"
                ctx.strokeRect(-ww / 8, -wh / 4, ww / 4, wh / 4)
                ctx.strokeRect(-ww / 24, -wh / 12, ww / 12, wh / 12)
                //       正面
                ctx.save()
                ctx.beginPath()
                ctx.arc(0, -wh / 12 * 2, wh / 24, 0, 2 * Math.PI)
                ctx.strokeStyle = "red"
                ctx.stroke()
                ctx.beginPath()
                ctx.moveTo(0, -wh / 12 * 2 - wh / 24)
                ctx.lineTo(0, -wh / 12 * 2 + wh / 24)
                ctx.moveTo(0, -wh / 12 * 2)
                ctx.lineTo(0 + wh / 24 / 1.414, -wh / 12 * 2 + wh / 24 / 1.414)
                ctx.strokeStyle = "red"
                ctx.stroke()
                ctx.restore()
                //      大門
                ctx.save()
                ctx.beginPath()
                ctx.arc(-ww / 54, -wh / 24, 10, 0, 2 * Math.PI)
                ctx.stroke()
                ctx.beginPath()
                ctx.arc(ww / 54, -wh / 24, 10, 0, 2 * Math.PI)
                ctx.stroke()
                ctx.beginPath()
                ctx.moveTo(0, -wh / 12)
                ctx.lineTo(0, 0)
                ctx.stroke()
                ctx.restore()
                //     側面+上
                ctx.save()
                ctx.beginPath()
                ctx.moveTo(-ww / 8, -wh / 4)
                ctx.lineTo(-ww / 8 + ww / 12, -wh / 4 - wh / 12)
                ctx.lineTo(-ww / 8 + ww / 12 + ww / 4, -wh / 4 - wh / 12)
                ctx.lineTo(-ww / 8 + ww / 4, -wh / 4)
                ctx.moveTo(-ww / 8 + ww / 4, 0)
                ctx.lineTo(-ww / 8 + ww / 4 + ww / 12, -wh / 12)
                ctx.lineTo(-ww / 8 + ww / 4 + ww / 12, -wh / 4 - wh / 12)
                ctx.stroke()
                ctx.restore()
                //    右開
                ctx.save()
                ctx.beginPath()
                ctx.moveTo(ww / 8, -wh / 4)
                ctx.lineTo(ww / 8 + ww / 16 * 1.732, -wh / 4 - ww / 16)
                ctx.lineTo(-ww / 8 + ww / 12 + ww / 4 + ww / 16 * 1.732, -wh / 4 - wh / 12 - ww / 16)
                ctx.lineTo(-ww / 8 + ww / 12 + ww / 4, -wh / 4 - wh / 12)
                ctx.fillStyle = "white"
                ctx.fill()
                ctx.stroke()
                ctx.restore()

                ctx.save
                ctx.beginPath()
                ctx.moveTo(-ww / 8, -wh / 4)
                ctx.lineTo(-ww / 8 - ww / 16 * 1.732, -wh / 4 - ww / 16)
                ctx.lineTo(-ww / 8 + ww / 12 - ww / 16 * 1.732, -wh / 4 - wh / 12 - ww / 16)
                ctx.lineTo(-ww / 8 + ww / 12, -wh / 4 - wh / 12)

                ctx.fillStyle = "white"
                ctx.fill()
                ctx.strokeStyle = "black"
                ctx.stroke()
                ctx.restore

                ctx.restore()

                ctx.save()
                ctx.beginPath()
                ctx.translate(ww / 2, h * 10)
                var text = "?"
                ctx.font = '' + wh/3 + 'px serif';
                var w = ctx.measureText(text).width
                ctx.lineWidth = 2;
                ctx.fillStyle = "black"
                ctx.strokeStyle = "#e17055"
                ctx.strokeText(text, -w / 2, -wh / 8 * 3)
                ctx.stroke()
                ctx.restore()

                ctx.save()
                ctx.translate(ww / 2, h * 10)
                var text = "網路投票所"
                ctx.font = '' + wh/5 + 'px serif';
                var w = ctx.measureText(text).width
                ctx.lineWidth = 2;
                if (h * 10 >= wh-20) {
                    ctx.beginPath()
                    talk(-w / 2, -wh + 20, l * 10, wh/10, 3)
                    ctx.fillStyle = "#a29bfe"
                    ctx.fill()
                    ctx.stroke()
                    if (l * 10 < w) {
                        l++
                    }
                }
                ctx.fillStyle = "white"
                ctx.strokeStyle = "white"
                ctx.strokeText(text, -w / 2, -wh +wh/5)
                ctx.stroke()


                ctx.restore()
                if (h * 10 < wh-20) {
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