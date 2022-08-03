<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>提交结果</title>
    <style type="text/css">
        @font-face {
            font-family: "YEXNYXHMM";
            src: url("../font/FZSJ-YEXNYXHMM.TTF");
        }

        body {
            font-size: 16px;
            background-image: url("../pictures/stars.jpg");
            background-size: 100%;
        }
    </style>
</head>
<body>
<?php
include "tables.php";

$servername = "localhost";
$username = "zmbunny_com";
$password = "xuexi123";
$db = "db2";

// 创建连接
$conn = new mysqli($servername, $username, $password, $db);

//获取时间
$year = date(y) % 10;
$month = date(n);
$day = date(d);
$hour = date(g);
$min = date(i);
$shortDate = ((($year * 100 + $month) * 100 + $day) * 100 + $hour) * 100 + $min;

//获取表单内容
$name = $_POST["name"];
$goal = $_POST["goalOfDay"];
$_COOKIE["user"] = $_POST["name"];
$_COOKIE["goalOfDay"] = $_POST["goalOfDay"];
?>
<script>
    console.log("<?php echo $_COOKIE?>");
</script>
<?php

//提交给数据库
$sql = "insert into goals(time, name, content)values(" . $shortDate . ", '" . $name . "', '" . $goal . "');";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('提交成功')</script>";
} else {
    echo "Error:" . $sql . "<br>" . $conn->error;
}
?>
</body>
</html>