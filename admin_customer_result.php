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
<?php
$condition1 = $_POST['condition1'];
$term1 = $_POST['term1'];
$connection = $_POST['connection'];
$condition2 = $_POST['condition2'];
$term2 = $_POST['term2'];

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

$sql_query =  "SELECT * FROM customer WHERE (".$condition1." LIKE '%".$term1."%' ".$connection." ".$condition2." LIKE '%".$term2."%')";
$result = $mysqli->query($sql_query, MYSQLI_STORE_RESULT);

$total_count = mysqli_num_rows($result);
echo '<h4 style="color:white;">共有'.$total_count.'个符合要求的结果：</h4>';

echo '	<form action="book_manage.php" style="float:right;">
                <button type="submit" id="submit">重新检索</button>
                </form>';
while(list($ID, $name, $gender, $phone, $customer_password) = $result->fetch_row()) {
    echo '<div style="background-color:MintCream;">';
    echo '<div style="overflow: hidden; ">';
    echo "<br><br>用户ID：" . $ID . "<br>";
    echo "姓名：" . $name . "<br>";
    echo "性别：" . $gender . "<br>";
    echo "电话：" .$phone."<br>";
    echo "</div><br>";
    echo '购买记录：<br><table width="90%" border="1" cellspacing="0" cellpadding="0" >
<tr><td>订单号</td><td>卖家</td><td>书名</td><td>数量</td><td>时间</td></tr>';
    $search_sID_sql="SELECT * FROM sale WHERE scustomer='".$ID."'";
    $search_sID_result=$mysqli->query($search_sID_sql,MYSQLI_STORE_RESULT);
    while(list($sID,$scustomer,$seller,$time)=$search_sID_result->fetch_row()){
            $search_order_sql="SELECT * FROM order_detail where osale='".$sID."'";
            $search_order_result=$mysqli->query($search_order_sql,MYSQLI_STORE_RESULT);
        $search_sellername_sql="SELECT cname FROM customer WHERE cID='".$seller."'";
        list($seller_name)=$mysqli->query($search_sellername_sql)->fetch_row();
            while(list($oID,$obook,$oamount,$osale)=$search_order_result->fetch_row()){
                $search_book_sql="SELECT bname FROM bookall where bISBN='".$obook."'";
                list($bookname)=$mysqli->query($search_book_sql)->fetch_row();
                echo"<tr><td>".$sID."</td>
<td>".$seller_name."</td>
<td>".$bookname."</td>
<td>".$oamount."</td>
<td>".$time."</td></tr>";
            }
    }
echo'</table>';

}

?>