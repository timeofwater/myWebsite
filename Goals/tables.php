<?php
//给下次登陆留一个cookie
$expire = time() + 60 * 60 * 24 * 30;
if (!isset($_COOKIE["user"])) {
    setcookie("user", "姓名", $expire);
    setcookie("goalOfDay", "今日目标", $expire);
}
?>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes"/>
    <title>目标收集站</title>
    <link rel="stylesheet" href="base.css" type="text/css">

</head>
<body class="base" id="b"><!------------------------------------------------------------------------------------------->

<!--时间显示-->
<div class="time" onclick="reloadPage()">今天是:
    <div id="today"></div>
</div>
<script type="text/javascript">
    function reloadPage() {
        location.reload();
    }

    let d = new Date();
    let weekday = ["周日", "周一", "周二", "周三", "周四", "周五", "周六"];
    let x = document.getElementById("today");
    x.innerHTML = (1 + d.getMonth()) + "月" + d.getDate() + "日  " + weekday[d.getDay()];
</script>

<!--表单-->
<form action="result.php" method="post">
    <div class="cul">
        <div class="narrow">&emsp;&emsp;姓名:</div>
        <input type="text" name="name" placeholder="姓名"
            <?php if (isset($_COOKIE["user"])) echo 'value=' . $_COOKIE["user"]; ?>>
    </div>
    <div class="cul">
        <div class="narrow">本周目标:</div>
        <div class="show" id="goalOfWeek">本周目标</div>
    </div>
    <div class="cul">
        <div class="narrow">昨日目标:</div>
        <div class="show" id="goalOfDay">昨日目标</div>
        <script>
            document.getElementById("goalOfDay").innerHTML = "<? if (isset($_COOKIE["goalOfDay"])) echo $_COOKIE["goalOfDay"]; ?>";
        </script>
    </div>
    <div class="cul">
        <div class="narrow">今日目标:</div>
        <input type="text" name="goalOfDay" placeholder="今日目标">
    </div>
    <input class="button0" type="submit">
</form>

<!-- 点击特效-->
<span id="c"></span>
<script type="text/javascript">
    document.getElementById("b").addEventListener("click", click, true);
    let number = 0;

    function click(event) {
        let x = event.pageX;
        let y = event.pageY;
        let op = 100;
        let lang = ["Java", "C", "C++", "PHP", "Python", "Android", "JavaScript", "JSON", "XML", "MySQL"];
        document.getElementById("c").innerHTML = lang[number];
        number = (number + 1) % lang.length;

        let c = document.getElementById("c").style;
        c.color = "rgb(" + ~~(100 + 155 * Math.random()) + "," + ~~(100 + 155 * Math.random()) + "," + ~~(100 + 155 * Math.random()) + ")";
        c.left = x + "px";

        let move = setInterval(function () {
            c.top = y + "px";
            y -= 2;
        }, 5);
        setTimeout(function () {
            clearInterval(move);
        }, 1000);

        let clear = setInterval(function () {
            c.opacity = op + "%";
            op--;
        }, 10);
        setTimeout(function () {
            clearInterval(clear);
        }, 1000);
    }
</script>
</body>
</html>