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
    <h2 style="text-align: center;">我的购物车</h2>
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
    <h4>请确认购买信息</h4>
    <?php
    //从cookie获取用户最初在登陆界面输入的信息
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $sqlname = $_COOKIE['sqlname'];

    //如果没有cookie就把变量设置为默认值以正常连接数据库
    if (!isset($username)) $username = 'root';
    if (!isset($sqlname)) $sqlname = 'booksql';

    $mysqli = new mysqli('localhost', $username, $password, $sqlname);
    //解决中文显示成问号的问题
    $mysqli->query('set names utf8') or die('query字符集错误');

    //如果是从购买页面跳转过来，需要把购物车信息加入数据库
    if (isset($_POST['isbn'])) {
        $isbn = $_POST['isbn'];
        $seller = $_POST['seller'];
        $buynumber = $_POST['current_number'];
        $customer = $_COOKIE['customer_phone'];

        $update_sqli = "INSERT INTO shoppingcart(scISBN,sccustomer,scseller,scnumber) VALUES ('" . $isbn . "','" . $customer . "','" . $seller . "'," . strval($buynumber) . ")";
        $mysqli->query($update_sqli);
    }

    //显示购物车信息
    $sql = "SELECT * FROM shoppingcart WHERE sccustomer = '" . $_COOKIE['customer_phone'] . "'";
    $result = $mysqli->query($sql, MYSQLI_STORE_RESULT);
    $total_count = mysqli_num_rows($result);

    if ($total_count == 0) {
        echo "您的购物车是空的,请返回主页添加商品！";
    } else {
        echo "<table width=\"90%\" border=\"1\"cellspacing=\"0\" cellpadding=\"0\">
    <tr>
    <td>ISBN</td>
        <td>书名</td>
        <td>卖家</td>
        <td>单价</td>
        <td>数量</td>
        <td>购买</td>
        <td>删除</td>
    </tr>";
        while (list($isbn, $buyer, $seller, $number) = $result->fetch_row()) {
            //查书名
            $sqlbook = "SELECT bname FROM bookall WHERE bISBN='" . $isbn . "'";
            list($namebook) = $mysqli->query($sqlbook, MYSQLI_STORE_RESULT)->fetch_row();

            //查书单价
            $sqlprice = "SELECT wprice from warehouse where wbook='" . $isbn . "' and wowner ='" . $seller . "'";
            list($pricebook) = $mysqli->query($sqlprice, MYSQLI_STORE_RESULT)->fetch_row();

            //查卖家姓名
            $sqlsellername = "select cname from customer where cID='" . $seller . "'";
            list($sellername) = $mysqli->query($sqlsellername, MYSQLI_STORE_RESULT)->fetch_row();

            $temp = array($isbn,$seller); //用于传给deletebook的临时变量
            echo "<tr>
<td>".$isbn."</td>
        <td>" . $namebook . "</td>
        <td>" . $sellername . "</td>
        <td>" . $pricebook . "</td>
        <td>" . $number . "</td>
        <td><form action='susshopping.php' method='post'>
    <input name='isbn' value='".$isbn."' style='display: none'>
    <input name='buyer' value='".$buyer."' style='display: none'>
    <input name='seller' value='".$seller."' style='display: none'>
    <input name='number' value='".$number."' style='display: none'>
    <button class='button' type='submit' id='button' style='position: absolute;z-index: 3;display: block'>确认购买</button>
</form> </td>
        <td><a href='deletebook.php'>删除</a> </td>//这里要继续开发
    </tr>";

        }

        echo "</table>";
    }

    ?>

</body>
                </html>
