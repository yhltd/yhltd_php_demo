<?php
// 处理删除操作的页面 
require "dbconfig.php";
// 连接mysql
$link = @mysqli_connect(HOST,USER,PASS,DBNAME) or die("提示：数据库连接失败！");
// 选择数据库
@mysqli_select_db(DBNAME,$link);
// 编码设置
@mysqli_set_charset('utf8',$link);

$id = $_GET['id'];
var_dump($id);
//删除指定数据  
//@mysqli_query("DELETE FROM news WHERE id={$id}",$link) or die('删除数据出错：'.@mysqli_error());
// 删除完跳转到新闻页
mysqli_query($link,"DELETE FROM news WHERE id={$id}") or die('删除数据出错：'.@mysqli_error());

mysqli_close($link);

header("Location:index.php");


