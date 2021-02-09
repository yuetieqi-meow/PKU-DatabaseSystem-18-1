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
        width: 100%;
        opacity: 0.8;
        float: right;
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
    <h1 style="text-align: center;">购物</h1>
</div>
    <ul class="upper_navigation">
        <li class="upper_navigation"><a href="search_by_name">书目检索</a></li>
        <li class="upper_navigation"><a href="boolean_search">高级检索</a></li>
    
        <?php

        if (isset($_COOKIE['customer_name'])) {
            echo '<li class="upper_navigation" style="float: right;"><a href="admin_logout.php">退出登录</a></li>';
            echo '<li class="upper_navigation" style="float: right;"><a href="shoppingcart.php">我的购物车</a></li>';
            echo '<li class="upper_navigation" style="float: right;"><a href="">您好，'.$_COOKIE['customer_name'].'</a></li>';
        } else {
            echo '<li class="upper_navigation" style="float: right;"><a href="admin_login">登陆</a></li>';
            echo '<li class="upper_navigation" style="float: right;"><a href="admin_userregister">注册</a></li>';
        }
        ?>
    </ul>
    <div class="content_odd">
    <h2 style="text-align: center">购物成功！</h2>
    </div>
</body>
</html>
