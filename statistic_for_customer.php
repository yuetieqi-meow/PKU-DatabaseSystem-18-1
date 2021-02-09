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
    <li class="upper_navigation"><a href="admin_book_manage.php">图书管理</a></li>
    <li class="upper_navigation"><a href="boolean_search.php">高级检索</a></li>
    <li class="current_navigation"><a href="admin_customer_manage.php">会员管理</a></li>
    <li class="upper_navigation" style="float: right;"><a href="search_by_name">退出管理员界面</a></li>
    <li class="upper_navigation" style="float: right;"><a href="admin_customer_manage.php">重新检索</a></li>
</ul>
<script src="排名选项.js"></script>
<select   name="state"   onChange="cll(this.value,'div1','div2') " style="position:absolute;right: 0;width: 150px;height: 25px">
    <option   value="1" >按购书量排名</option>
    <option   value="0">按订单数量排名</option>
</select>
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
echo"<div style='background: white' id='div1'>";
echo'买书排名为：<br><table width="90%" border="1" cellspacing="0" cellpadding="0"><tr><td>姓名</td><td>购书单数</td><td>购书量</td></tr>';
$customer_ranking1_sql="SELECT cname,COUNT(*),SUM(oamount) FROM customer,sale,order_detail WHERE(customer.cID=sale.scustomer AND sale.sID=order_detail.osale) GROUP BY cname ORDER BY sum(oamount)	DESC";
$customer_ranking1=$mysqli->query($customer_ranking1_sql,MYSQLI_STORE_RESULT);
while(list($cname,$snumber,$oamount)=$customer_ranking1->fetch_row()){
    echo"<tr><td>".$cname."</td><td>".$snumber."</td><td>".$oamount."</td></tr>";
}
echo "</table></div>";
echo"<div style='background: white;display: none' id='div2'>";
echo'买书排名为：<br><table width="90%" border="1" cellspacing="0" cellpadding="0"><tr><td>姓名</td><td>购书单数</td><td>购书量</td></tr>';
$customer_ranking1_sql="SELECT cname,COUNT(*),SUM(oamount) FROM customer,sale,order_detail WHERE(customer.cID=sale.scustomer AND sale.sID=order_detail.osale) GROUP BY cname ORDER BY count(*) DESC";
$customer_ranking1=$mysqli->query($customer_ranking1_sql,MYSQLI_STORE_RESULT);
while(list($cname,$snumber,$oamount)=$customer_ranking1->fetch_row()){
    echo"<tr><td>".$cname."</td><td>".$snumber."</td><td>".$oamount."</td></tr>";
}
echo "</table></div>";
?>
<br>
<select   name="state"   onChange="cll(this.value,'div3','div4') " style="position:absolute;right: 0;width: 150px;height: 25px">
    <option   value="0" >按卖书量排名</option>
    <option   value="1">按订单数量排名</option>
</select><div style='background: white;display: none' id='div3'>";
    <?php
echo'卖书排名为：<br><table width="90%" border="1" cellspacing="0" cellpadding="0"><tr><td>姓名</td><td>卖书单数</td><td>卖书量</td></tr>';
$customer_ranking1_sql="SELECT cname,COUNT(*),SUM(oamount) FROM customer,sale,order_detail WHERE(customer.cID=sale.sseller AND sale.sID=order_detail.osale) GROUP BY cname ORDER BY COUNT(*)	DESC";
$customer_ranking1=$mysqli->query($customer_ranking1_sql,MYSQLI_STORE_RESULT);
while(list($cname,$snumber,$oamount)=$customer_ranking1->fetch_row()){
    echo"<tr><td>".$cname."</td><td>".$snumber."</td><td>".$oamount."</td></tr>";
}
echo "</table></div>";
echo"<div style='background: white' id='div4'>";
echo'卖书排名为：<br><table width="90%" border="1" cellspacing="0" cellpadding="0"><tr><td>姓名</td><td>卖书单数</td><td>卖书量</td></tr>';
$customer_ranking1_sql="SELECT cname,COUNT(*),SUM(oamount) FROM customer,sale,order_detail WHERE(customer.cID=sale.sseller AND sale.sID=order_detail.osale) GROUP BY cname ORDER BY sum(oamount) DESC ";
$customer_ranking1=$mysqli->query($customer_ranking1_sql,MYSQLI_STORE_RESULT);
while(list($cname,$snumber,$oamount)=$customer_ranking1->fetch_row()){
    echo"<tr><td>".$cname."</td><td>".$snumber."</td><td>".$oamount."</td></tr>";
}
echo "</table></div>";
$gender_sql="SELECT cgender,COUNT(*) from customer GROUP BY cgender";
$gender_result=$mysqli->query($gender_sql,MYSQLI_STORE_RESULT);
while (list($gender,$gnumber)=$gender_result->fetch_row()){
    if($gender=='female'){
        $female=$gnumber;
    }
    else $male=$gnumber;
}
$total=(int)$male+(int)$female;
echo"目前系统中有".$total."名用户，其中，男性用户有".$male."名，女性用户有".$female."名。"
?>