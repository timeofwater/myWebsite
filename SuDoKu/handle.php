<?php

// 创建连接
$servername = "localhost";
$username = "zmbunny_com";
$password = "xuexi123";
$db = "db1";
$conn = new mysqli($servername, $username, $password, $db);

//获取表单内容
$type = $_POST["type"];
$content = $_POST["content"];

//处理
$result=$content;
echo "您提交的题目:".$result;

//提交
$sql_submit = "insert into SuDoKuPuzzle(puzzle)values('" . $result . "');";
if ($conn->query($sql_submit) === TRUE) {
    echo "<script>alert('提交成功')</script>";
} else {
    echo "Error:" . $sql_submit . "<br>" . $conn->error;
}