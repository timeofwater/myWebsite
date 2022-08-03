<?php
// 创建连接
$servername = "localhost";
$username = "zmbunny_com";
$password = "xuexi123";
$db = "db1";
$conn = new mysqli($servername, $username, $password, $db);

//读取
$sql_read = "select * from SuDoKuPuzzle;";
$result = $conn->query($sql_read);

if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
        echo "puzzle: " . $row["puzzle"]. "<br>";
    }
} else {
    echo "0 结果";
}