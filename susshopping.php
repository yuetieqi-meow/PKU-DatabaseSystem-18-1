<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的购物车</title>
</head>
<body background="images/forest.jpg">
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
        font-size: 18px;
    }

    li.upper_navigation a:hover {
        background-color: #3CB371;
    }

    li.upper_navigation a:visited {
        color: black;
    }

    div.content_odd {
        background-color: DarkGray;
        padding: 5px;
        opacity: 0.8;
        float: right;
    }

    div.content_even {
        background-color: AliceBlue;
        padding: 5px;
        opacity: 0.8;
        float: right;
    }

    div:link {
    }

    div:hover {
        background-color: #3CB371;
        opacity: 0.8;
    }

    #submit {
        width: 200px;
        height: 50px;
        padding: 5px 20px;
        font-size: 20px;
        color: white;
        background-color: #20B2AA;
        border: solid;
        border-color: #20B2AA;
        opacity: 0.9;
    }

    #submit:hover {
        background-color: #3CB371;
        border-color: #3CB371;
        opacity: 0.8;
    }

    img {
        width: 200px;
        height: 300px;
        border-radius: 8px;
        float: left;
    }

    div.sell_information div {
        display: inline-block;
        width: 24%;
        text-align: center;
    }
</style>
<div id="header" style="background-color: #98FB98; padding: 5px;">

    <ul class="upper_navigation">
        <li class="current_navigation"><a href="search_by_name">书目检索</a></li>
        <li class="upper_navigation"><a href="search_owner">库存检索</a></li>
        <li class="upper_navigation"><a href="search_sales">销量检索</a></li>
        <li class="upper_navigation"><a href="boolean_search">高级检索</a></li>
        <?php

        if (isset($_COOKIE['customer_name'])) {
            echo '<li class="upper_navigation" style="float: right;"><a href="admin_logout">' . $_COOKIE['customer_name'] . '</a></li>';
        } else {
            echo '<li class="upper_navigation" style="float: right;"><a href="admin_login">登陆</a></li>';
            echo '<li class="upper_navigation" style="float: right;"><a href="admin_userregister">注册</a></li>';
        }
        ?>
    </ul>
<?php
$username = $_COOKIE['username'];
$password = $_COOKIE['password'];
$sqlname = $_COOKIE['sqlname'];

//如果没有cookie就把变量设置为默认值以正常连接数据库
if (!isset($username)) $username = 'root';
if (!isset($sqlname)) $sqlname = 'booksql';

$mysqli = new mysqli('localhost', $username, $password, $sqlname);
//解决中文显示成问号的问题
$mysqli->query('set names utf8') or die('query字符集错误');
$isbn=$_POST['isbn'];
$buyer=$_POST['buyer'];
$seller=$_POST['seller'];
$number=$_POST['number'];
$buyer_sql="SELECT cID FROM customer WHERE cphone='".$buyer."'";
list($buyerID)=$mysqli->query($buyer_sql,MYSQLI_STORE_RESULT)->fetch_row();
    $salenumber_sql="SELECT COUNT(*) FROM sale";
    $salenumber1=$mysqli->query($salenumber_sql,MYSQLI_STORE_RESULT)->fetch_row();
    list($salenumber)=$salenumber1;
    $salenumber=(int)$salenumber+1;
    $ordernumber_sql="SELECT COUNT(*) FROM order_detail";
    $ordernumber1=$mysqli->query($ordernumber_sql,MYSQLI_STORE_RESULT)->fetch_row();
    list($ordernumber)=$ordernumber1;
    $ordernumber=(int)$ordernumber+1;
    $warehouse_number_sql="SELECT wnumber FROM warehouse WHERE wbook='".$isbn."'";
    $warehouse_number1=$mysqli->query($warehouse_number_sql,MYSQLI_STORE_RESULT)->fetch_row();
    list($warehouse_number)=$warehouse_number1;
    $warehouse_number=$warehouse_number-$number;
    $t=time();
    $time=date("Y-m-d",$t);
    $insert_sql1= "INSERT INTO sale(sID, scustomer, sseller, stime) VALUES('$salenumber','$buyerID','$seller','$time')";
     $insert_sql2= "UPDATE warehouse SET wnumber='$warehouse_number' WHERE wbook='$isbn' AND wowner='$seller'";
     $insert_sql3="INSERT INTO order_detail(oID,obook,oamount,osale) VALUES('$ordernumber','$isbn','$number','$salenumber')";
    $mysqli->query($insert_sql1);
    $mysqli->query($insert_sql2);
    $mysqli->query($insert_sql3);
    $mysqli->commit();
?>
    <h2 style="text-align: center">购物成功！</h2>
</div>
</body>
</html>
