<?php

$servername = "localhost";
$username = "zmbunny_com";
$password = "xuexi123";
$db = "zmbunny_com";

// 创建连接
$conn = new mysqli($servername, $username, $password, $db);

//获取时间
$year = date(Y);
$month = date(n);
$day = date(d);
$hour = date(g);
$min = date(i);
$sec = date(s);

//提交给数据库
$para = $_GET["para"];
if($para==1){
    $sql = "insert into linkto_water(year, month, day, hour, min, sec)values(" . $year . ", " . $month . ", " . $day . ", " . $hour . ", " . $min . ", " . $sec . ");";
    if ($conn->query($sql) === TRUE) {
        echo "提交成功";
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
}else {
    echo "para should be 1.";
}

?>