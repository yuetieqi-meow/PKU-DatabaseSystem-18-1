<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>查询结果-根据书名检索书籍</title>
</head>
<body background="images/forest.jpg" >
<style type="text/css">

    ul.upper_navigation{
        list-style-type: none;
        margin: 0;
        padding: 10px;
        background-color: #98FB98;
        opacity:0.8

    }
    li{
        display: inline;
        margin: 0px;

    }
    li.current_navigation a{
        background-color: #3CB371;
    }
    li.upper_navigation a,li.current_navigation a{
        color: black;
        text-align: center;
        text-decoration: none;
        padding: 10px;
        font-size:18px;
    }
    li.upper_navigation a:hover{
        background-color: #3CB371;
    }
    li.upper_navigation a:visited{
        color: black;
    }
    div.content_odd{
        background-color: DarkGray;
        opacity:0.8;
        float:right;
        width: 100%;
    }
    div.content_even{
        background-color: AliceBlue;
        opacity:0.8;
        float:right;
        width: 100%;
    }
    div:link{}

    #submit{
        width:200px;
        height: 50px;
        padding: 5px 20px;
        font-size: 20px;
        color: white;
        background-color: #20B2AA;
        border: solid;
        border-color: #20B2AA;
        opacity:0.9;
    }
    #submit:hover{
        background-color:#3CB371;
        border-color: #3CB371;
        opacity:0.8;
    }
    img {
        width:200px;
        height:300px;
        border-radius: 8px;
        float:left;
    }
    div.sell_information div{
        display: inline-block;
        width: 24%;
        text-align: center;
    }
    div.margin_box{
        position:absolute;
        margintop:-50px;
        background-color:grey;
        opesity:0.8;
    }
</style>
<div id="header" style="background-color: #98FB98; padding: 5px; margin: 0;" >
    <h1 style="text-align: center;">滴滴打书 · 图书管理系统</h1>
</div>

<ul class="upper_navigation">
    <li class="current_navigation"><a href="admin_book_manage.php">图书管理</a></li>
    <li class="upper_navigation"><a href="boolean_search.php">高级检索</a></li>
    <li class="upper_navigation"><a href="admin_customer_manage.php">会员管理</a></li>
    <li class="upper_navigation" style="float: right;"><a href="search_by_name">退出管理员界面</a></li>
    <li class="upper_navigation" style="float: right;"><a href="admin_customer_manage.php">重新检索</a></li>
</ul>
<?php

//从cookie获取用户最初在登陆界面输入的信息
$username = $_COOKIE['username'];
$password = '';
$sqlname = $_COOKIE['sqlname'];

if(!isset($username)) $username = 'root';
if(!isset($sqlname)) $sqlname = 'booksql';

//连接数据库
$mysqli = new mysqli('localhost', $username, $password, $sqlname);

//解决中文显示成问号的问题
$mysqli->query('set names utf8') or die('query字符集错误');
echo"<div style='background: white'>";
echo'总销量排名为：<br><table width="90%" border="1" cellspacing="0" cellpadding="0"><tr><td>书名</td><td>销量</td><td>类型</td></tr>';
$sales_ranking_sql="SELECT bname,sum(oamount),btype FROM bookall,order_detail WHERE bookall.bISBN=order_detail.obook GROUP BY bname ORDER BY sum(oamount) DESC";
$sales_ranking=$mysqli->query($sales_ranking_sql,MYSQLI_STORE_RESULT);
while(list($bname,$bnumber,$btype)=$sales_ranking->fetch_row()){
    echo"<tr><td>".$bname."</td><td>".$bnumber."</td><td>".$btype."</td></tr>";
}
echo "</table></div>";

?>