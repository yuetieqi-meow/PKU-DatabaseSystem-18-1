<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>查询界面</title>
</head>
<body background="images/forest.jpg" style="background-repeat:no-repeat">
<style type="text/css">
    ul.upper_navigation {
        list-style-type: none;
        margin: 0;
        padding: 10px;
        background-color: #98FB98;
        opacity: 0.8

    }

    li {
        display: inline;
        margin: 0px;

    }

    li.current_navigation a {
        background-color: #3CB371;
    }

    li.upper_navigation a, li.current_navigation a {
        color: black;
        text-align: center;
        text-decoration: none;
        padding: 10px;
        font-size: 18;
    }

    li.upper_navigation a:hover {
        background-color: #3CB371;
    }

    li.upper_navigation a:visited {
        color: black;
    }

    input.box {
        width: 300px;
        height: 38px;
        border: 1px solid gray;
        padding: 5px 20px;
        font-size: 20px;

    }

    button.button {
        width: 100px;
        height: 50px;
        padding: 5px 20px;
        font-size: 20px;
        color: white;
        background-color: #20B2AA;
        border: solid;
        border-color: #20B2AA;
        opacity: 0.9;
    }

    button.button:hover {
        background-color: #3CB371;
        border-color: #3CB371;
        opacity: 0.8;
    }

    table {
        border-color: black;
        text-align: center;
        margin: auto;
    }

    td {
        padding: 5px;
    }

    a.recommend_buy {
        text-decoration: underline;
        cursor: pointer;
    }

    .preview_box img {
        width: 200px;
    }
</style>


<div id="header" style="background-color: #98FB98; padding: 5px; margin: 0;">
    <h1 style="text-align: center;">滴滴打书 · 图书管理系统</h1>
</div>

<ul class="upper_navigation">
    <li class="upper_navigation"><a href="admin_book_manage.php">图书管理</a></li>
    <li class="upper_navigation"><a href="boolean_search">高级检索</a></li>
    <li class="upper_navigation"><a href="admin_customer_manage.php">会员管理</a></li>
    <li class="current_navigation"><a href="admin_comment_manage.php">留言管理</a></li>
    <li class="upper_navigation" style="float: right;"><a href="manage_logout.php">退出管理员界面</a></li>

</ul>

<?php
error_reporting(0);

$bookname = $_POST['book_name'];

//从cookie获取用户最初在登陆界面输入的信息
$username = $_COOKIE['username'];
$password = $_COOKIE['password'];
$sqlname = $_COOKIE['sqlname'];

//如果没有cookie就把变量设置为默认值以正常连接数据库
if (!isset($username)) $username = 'root';
if (!isset($sqlname)) $sqlname = 'booksql';

//连接数据库
$mysqli = new mysqli('localhost', $username, $password, $sqlname);

//解决中文显示成问号的问题
$mysqli->query('set names utf8') or die('query字符集错误');

//执行SQL语句
$sql_query = "SELECT * FROM comment WHERE cmtreplystatus=0";
$result = $mysqli->query($sql_query, MYSQLI_STORE_RESULT);

//统计并显示结果数量
$total_count = mysqli_num_rows($result);
echo '<div style="background-color:#3CB371; padding:5px;"><h4>共有' . $total_count . '个符合要求的结果：</h4>';

$line = 0;
while (list($cmtID, $cmtcustomer, $cmttime, $cmtmessage, $cmtreplystatus, $cmtreplymessage) = $result->fetch_row()) {
    //为奇偶行设置不同背景颜色


    //输出检索结果
    echo '<div style="overflow: hidden; ">';

    echo '用户：' . $cmtcustomer . '&nbsp;&nbsp;';
    echo '留言：' . $cmtmessage . '&nbsp;&nbsp;';
    echo "<form action='admin_comment_reply.php' method='post'>
        <textarea name='message' style='width:600px;height:100px;'></textarea><br>
<input name='cmtID' value=".strval($cmtID)." style='display:none; '/>
        <button class='button' type='submit'>回复</button>
        
        </button>
    </form>";

        echo '</div><br>';


        ;
    }
echo '</div>'

?>


</body>
</html>