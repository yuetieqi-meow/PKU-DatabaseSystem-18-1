<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>查询结果-根据书名检索书籍</title>
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
        font-size: 18;
    }

    li.upper_navigation a:hover {
        background-color: #3CB371;
    }

    li.upper_navigation a:visited {
        color: black;
    }

    div.content_odd {
        background-color: DarkGray;
        opacity: 0.8;
        float: right;
        width: 100%;
    }

    div.content_even {
        background-color: AliceBlue;
        opacity: 0.8;
        float: right;
        width: 100%;
    }

    div:link {
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

    div.margin_box {
        position: absolute;
        margintop: -50px;
        background-color: grey;
        opesity: 0.8;
    }
</style>


<div id="header" style="background-color: #98FB98; padding: 5px; margin: 0;">
    <h1 style="text-align: center;">滴滴打书 · 图书管理系统</h1>
</div>

<ul class="upper_navigation">
    <li class="upper_navigation"><a href="admin_book_manage.php">图书管理</a></li>
    <li class="upper_navigation"><a href="admin_customer_manage.php">会员管理</a></li>
    <li class="current_navigation"><a href="admin_order_manage.php">订单管理</a></li>
    <li class="upper_navigation" style="float: right;"><a href="search_by_name.php">退出管理员界面</a></li>
</ul>


<?php
//error_reporting(0);

//从cookie获取用户最初在登陆界面输入的信息
$username = $_COOKIE['username'];
$password = '';
$sqlname = $_COOKIE['sqlname'];

//如果没有cookie就把变量设置为默认值以正常连接数据库
if (!isset($username)) $username = 'root';
if (!isset($sqlname)) $sqlname = 'booksql';

//连接数据库
$mysqli = new mysqli('localhost', $username, $password, $sqlname);

//解决中文显示成问号的问题
$mysqli->query('set names utf8') or die('query字符集错误');

$order_array = array(); //存储所有订单号

if (isset($_POST['condition1'])) {
    $condition1 = $_POST['condition1'];
    $term1 = $_POST['term1'];
    $connection = $_POST['connection'];
    $condition2 = $_POST['condition2'];
    $term2 = $_POST['term2'];

//从cookie获取用户最初在登陆界面输入的信息
    $username = $_COOKIE['username'];
    $password = '';
    $sqlname = $_COOKIE['sqlname'];

    if (!isset($username)) $username = 'root';
    if (!isset($sqlname)) $sqlname = 'booksql';

//连接数据库
    $mysqli = new mysqli('localhost', $username, $password, $sqlname);

//解决中文显示成问号的问题
    $mysqli->query('set names utf8') or die('query字符集错误');

    $sql_query = "SELECT cID FROM customer WHERE (" . $condition1 . " LIKE '%" . $term1 . "%' " . $connection . " " . $condition2 . " LIKE '%" . $term2 . "%')";
    $customerresult = $mysqli->query($sql_query, MYSQLI_STORE_RESULT);

    //查询以上用户的所有订单
    while (list($cID) = $customerresult->fetch_row()) {
        $sql_cus_book = "SELECT sID FROM sale WHERE scustomer ='" . $cID . "'";
        $bookresult = $mysqli->query($sql_cus_book, MYSQLI_STORE_RESULT);
        while (list($sID) = $bookresult->fetch_row()) {
            array_push($order_array, $sID);
        }
    }
} //订单号查询情况
else {
    $order_array = array($_POST['order_id']);
}


//统计并显示结果数量
$total_count = count($order_array);
echo '<h4 style="color:white;">共有' . $total_count . '个符合要求的结果：</h4>';

echo '	<form action="admin_order_manage.php" style="float:right;">
                <button type="submit" id="submit">重新检索</button>
                </form>';

for ($i = 0; $i < $total_count; $i++) {

    $sql = "select * from sale where sID='" . $order_array[$i] . "'";
    $tempresult = $mysqli->query($sql, MYSQLI_STORE_RESULT);
    list($saleID, $salecustomer, $saleseller, $saletime) = $tempresult->fetch_row();
    $sqlcus = "select cname from customer where cID = '" . $salecustomer . "'";
    $temp1 = $mysqli->query($sqlcus, MYSQLI_STORE_RESULT);
    list($cusname) = $temp1->fetch_row();
    $sqlseller = "select cname from customer where cID = '" . $saleseller . "'";
    $temp2 = $mysqli->query($sqlseller, MYSQLI_STORE_RESULT);
    list($sellername) = $temp2->fetch_row();

    echo '<div style="background-color:MintCream;">';
    echo '<div style="overflow: hidden; ">';
    echo "订单号：" . $saleID . '&nbsp;&nbsp;&nbsp;';
    echo "买家：" . $cusname . '&nbsp;&nbsp;&nbsp;';
    echo "卖家：" . $sellername . '&nbsp;&nbsp;&nbsp;';
    echo "下单日期：" . $saletime . "<br>";
    echo "</div><br>";


    //输出订单详情结果
    $sql_orderdetail = "select oID,obook,oamount from order_detail where oID ='" . $order_array[$i] . "'";
    $detailresult = $mysqli->query($sql_orderdetail, MYSQLI_STORE_RESULT);
    while (list($oID, $obook, $oamount) = $detailresult->fetch_row()) {
        $sql1 = "select bname from bookall where bISBN ='" . $obook . "'";
        $result1 = $mysqli->query($sql1, MYSQLI_STORE_RESULT);
        list($oname) = $result1->fetch_row();



        echo '	<div style="margin-left:300px;background-color:MintCream;">
                        <form action="order_change.php" method="post" >
                        书名：' . $oname . '        
                        &nbsp;购买数量：<input name="oamount" class="box" type="number" required="required" value="' . $oamount . '"  "/>
                        <input name="oID" value="' . $oID . '" style="display:none; "/>
                        <button class="button" type="submit" id="button" style="z-index: 3;display: block align-items: center;">修改</button>
                        </form>
 
                        <form action="book_delete.php" method="post">
                        <input name="oID" value="' . $oID . '" style="display:none; "/>
                        <button class="button" type="submit" id="button" style="z-index: 3;display: block align-items: center;">删除</button>
                                
                        </form>
                        </div>';
    }

    echo '<br><br><br><br><br></div>';
}
?>
<form action="admin_book_manage.php" style="margin-left:700px;">
    <button type="submit" id="submit">重新检索</button>
</form>
