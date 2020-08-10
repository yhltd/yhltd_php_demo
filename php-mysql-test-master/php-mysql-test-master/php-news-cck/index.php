<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>新闻后台管理系统</title>
</head>
<style type="text/css">
    .wrapper {
        width: 1000px;
        margin: 20px auto;
    }

    h2 {
        text-align: center;
    }

    .add {
        margin-bottom: 20px;
    }

    .add a {
        text-decoration: none;
        color: #fff;
        background-color: green;
        padding: 6px;
        border-radius: 5px;
    }

    td {
        text-align: center;
    }
</style>
<body>
<div class="wrapper">
    <h2>新闻后台管理系统</h2>
    <div class="add">
        <a href="addnews.html">增加新闻</a>
    </div>
    <table width="960" border="1">
        <tr>
            <th>ID</th>
            <th>标题</th>
            <th>关键字</th>
            <th>作者</th>
            <th>发布时间</th>
            <th>内容</th>
            <th>操作</th>
        </tr>

        <?php
        // 1.导入配置文件
        require "dbconfig.php";

        // 2. 连接mysql
        $link = @mysqli_connect(HOST, USER, PASS, DBNAME) or die("提示：数据库连接失败！");
        //  var_dump(DBNAME);
        // 选择数据库
        @mysqli_select_db(DBNAME, $link);
        // 编码设置
        @mysqli_set_charset('utf8', $link);

        // 3. 从DBNAME中查询到news数据库，返回数据库结果集,并按照addtime降序排列
        $sql = 'select * from news order by id asc';
        // 结果集
        //$result =@mysqli_query($sql,$link);
        $result = $link->query($sql);
        //var_dump($result);die;
        if ($result->num_rows > 0) {
            // 输出数据
            while ($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"] . " - title: " . $row["title"] . " " . $row["keywords"] . "<br>";
            }
        } else {
            echo "0 结果";
        }
        // 解析结果集,$row为新闻所有数据，$newsNum为新闻数目
        $newsNum = @mysqli_num_rows($result);
        //  var_dump($newsNum);
        // die("跟踪信息：");
        //error_log("跟踪信息：");
        // log('得到了$newsNum的值',intval($newsNum) );
        // log(’撒大声地‘);
        // echo  intval($newsNum);
        // error_log("结束：");
        // var_dump(121221);
        $result = $link->query($sql);
      /*  if ($result->num_rows > 0) {
            while ($row1 = $result->fetch_assoc()) {
                echo "<tr>";
                //echo "rte";
                echo "id: " . $row1["id"];
            }
            //var_dump($newsNum);die;
        }*/
        for ($i = 0; $i < $newsNum; $i++) {
            $row = @mysqli_fetch_assoc($result);


            echo "<tr>";
            echo "<td>{$row["id"]}</td>";
            echo "<td>{$row["title"]}</td>";
            echo "<td>{$row["keywords"]}</td>";
            echo "<td>{$row["autor"]}</td>";
            echo "<td>{$row["addtime"]}</td>";
            echo "<td>{$row["content"]}</td>";
            echo "<td>
							<a href='javascript:del({$row["id"]})'>删除</a>
							<a href='editnews.php?id={$row["id"]}'>修改</a>
						  </td>";
            echo "</tr>";
        }
        // 5. 释放结果集
        @mysqli_free_result($result);
        @mysqli_close($link);
        ?>

    </table>
</div>

<script type="text/javascript">
    function del(id) {
        if (confirm("确定删除这条新闻吗？")) {
            window.location = "action-del.php?id=" + id;
        }
    }
</script>
</body>
</html>
