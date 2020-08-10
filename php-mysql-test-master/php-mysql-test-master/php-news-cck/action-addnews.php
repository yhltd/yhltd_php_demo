<?php
// 处理增加操作的页面 
require "dbconfig.php";
// 连接mysql
$link = @mysqli_connect(HOST,USER,PASS, DBNAME) or die("提示：数据库连接失败！");
//var_dump(DBNAME);
// 选择数据库
@mysqli_select_db(DBNAME,$link);
// 编码设置
@mysqli_set_charset('utf8',$link);


// 获取增加的新闻
$title = $_POST['title'];


$keywords = $_POST['keywords'];
$autor = $_POST['autor'];
$addtime = $_POST['addtime'];
$content = $_POST['content'];
// 插入数据
//@mysqli_query("INSERT INTO news(title,keywords,autor,addtime,content) VALUES ('$title','$keywords','$autor','$addtime','$content')",$link) or die('添加数据出错：'.@mysqli_error());
$sql = "INSERT INTO news (title, keywords, autor,addtime,content)
VALUES ('$title','$keywords','$autor','$addtime','$content')";

if ($link->query($sql) === TRUE) {
    echo "新记录插入成功";
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

$link->close();

header("Location:index.php");
//var_dump($title);die;
