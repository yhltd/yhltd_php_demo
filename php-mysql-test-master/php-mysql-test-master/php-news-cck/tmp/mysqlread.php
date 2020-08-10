<?php
$dbname = "phpnews";
$servername = "yhocn.cn";
$username = "root";
$password = "Lyh07910";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$sql = "SELECT id, title, keywords FROM news";
$result = $conn->query($sql);
//var_dump($result);die;
if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - title: " . $row["title"]. " " . $row["keywords"]. "<br>";
    }
} else {
    echo "0 结果";
}
$conn->close();
?>