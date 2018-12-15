<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>加入购物车</title>
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
    <h2 style="text-align: center;">加入购物车</h2>
    <ul class="upper_navigation">
        <li class="current_navigation"><a href="search_by_name">书目检索</a></li>
        <li class="upper_navigation"><a href="search_owner">库存检索</a></li>
        <li class="upper_navigation"><a href="search_sales">销量检索</a></li>
        <li class="upper_navigation"><a href="boolean_search">高级检索</a></li>
        <?php
        if (isset($_COOKIE['customer_name'])) {
            echo '<li class="upper_navigation" style="float: right;"><a href="admin_logout.php">退出登录</a></li>';
            echo '<li class="upper_navigation" style="float: right;"><a href="shoppingcart.php">我的购物车</a></li>';
        } else {
            echo '<li class="upper_navigation" style="float: right;"><a href="admin_login">登陆</a></li>';
            echo '<li class="upper_navigation" style="float: right;"><a href="admin_userregister">注册</a></li>';
        }
        ?>
    </ul>
    <h4>请确认购买信息</h4>
    <?php
    error_reporting(0);
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
    $isbn = $_POST['book_isbn'];
    $seller = $_POST['owner_name'];
    $price = $_POST['price'];
    $name = $_POST['name'];
    $number = $_POST['number'];

    echo "<br><br>ISBN：" . $isbn . "<br>";
    echo "书名：" . $name . "<br>";
    echo "价格：￥" . $price . "<br>";
    echo "售卖者:" . $seller . "<br>";
    echo "<form action='shoppingcart.php' method='post'>
    请输入您要购买的数量<input name='current_number' class='box' type='number' required='required' min='1' max='" . $number . "'>
    <input name='isbn' value='" . $isbn . "' style='display:none; '>
    <input name='seller' value='" . $_POST['owner'] . "' style='display:none; '>
    <button class='button' type='submit' >一键加入购物车</button>
</form>";


    ?>

</body>