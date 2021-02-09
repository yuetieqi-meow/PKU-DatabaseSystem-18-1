<?php
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $sqlname = $_COOKIE['sqlname'];
    $cid = $_COOKIE['customer_id'];
    $mysqli = new mysqli('localhost', $username, $password, $sqlname);
    $mysqli->query('set names utf8') or die('query字符集错误');

    $i = -2;
    $sql = 'SELECT wbook FROM warehouse WHERE wowner ="'.$cid.'"';
    $result = $mysqli->query($sql, MYSQLI_STORE_RESULT);
    while(list($isbn) = $result -> fetch_row()){
        $i += 2;
        $number = $_POST['number'.$i];
        $price = $_POST['price'.$i];
        $change_sql = 'UPDATE warehouse SET wnumber = "'.$number.'", wprice= "'.$price.'" WHERE wbook = "'.$isbn.'" AND wowner = "'.$cid.'"';

        echo $change_sql;

        $mysqli -> query($change_sql);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改成功</title>
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
            font-size:18;
        }
        li.upper_navigation a:hover{
            background-color: #3CB371;
        }
        li.upper_navigation a:visited{
            color: black;
        }

    </style>
</head>
<body background="images/forest.jpg" style="background-repeat:no-repeat"> 
    <div id="header" style="background-color: #98FB98; padding: 5px; margin: 0;" >
        <h1 style="text-align: center;">修改成功！</h1>        
    </div>

    <ul class="upper_navigation">
        <li class="upper_navigation"><a href="search_by_name">书目检索</a></li>
        <li class="upper_navigation"><a href="boolean_search">高级检索</a></li>

    <?php
        error_reporting(0);
        
        if(isset($_COOKIE['customer_name'])){
            echo '<li class="upper_navigation" style="float: right;"><a href="admin_logout.php">退出登录</a></li>';
            echo '<li class="upper_navigation" style="float: right;"><a href="book_manage.php">管理我的图书</a></li>';
            echo '<li class="upper_navigation" style="float: right;"><a href="shoppingcart.php">我的购物车</a></li>';
            echo '<li class="upper_navigation" style="float: right;"><a href="">您好，'.$_COOKIE['customer_name'].'</a></li>';
        }
        else{
            echo '<li class="upper_navigation" style="float: right;"><a href="admin_login">登录</a></li>';
            echo '<li class="upper_navigation" style="float: right;"><a href="admin_userregister">注册</a></li>';
        }
    ?>
    </ul>
</body>
</html>