<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>查询界面</title>
</head>
<body background="images/forest.jpg" style="background-repeat:no-repeat">
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
    input.box{
        width: 300px;
        height: 38px;
        border:1px solid gray;
        padding: 5px 20px;
        font-size: 20px;

    }
    button.button{
        width:100px;
        height: 50px;
        padding: 5px 20px;
        font-size: 20px;
        color: white;
        background-color: #20B2AA;
        border: solid;
        border-color: #20B2AA;
        opacity:0.9;
    }

    button.button:hover{
        background-color:#3CB371;
        border-color: #3CB371;
        opacity:0.8;
    }

    table{
        border-color: black;
        text-align: center;
        margin: auto;
    }

    td{
        padding: 5px;
    }
    a.recommend_buy{
        text-decoration: underline;
        cursor: pointer;
    }

    .preview_box img {
        width: 200px;
    }
</style>
<div id="header" style="background-color: #98FB98; padding: 5px; margin: 0;" >
		<h1 style="text-align: center;">滴滴打书 · 图书管理系统</h1>
	</div>
<div style="display: inline">
	<ul class="upper_navigation">
		<li class="upper_navigation"><a href="admin_book_manage.php">图书管理</a></li>
		<li class="upper_navigation"><a href="boolean_search">高级检索</a></li>
		<li class="current_navigation"><a href="admin_customer_manage.php">会员管理</a></li>
        <li class="upper_navigation" style="float: right;"><a href="manage_logout.php">退出管理员界面</a></li>
	</ul>
<form method="post" action="admin_customer_result.php" style="margin-left: 120px; float:left;padding:50px;">
    <h2 style="text-align: left; padding-left:200px; color:white; font-size:40px;">查询用户</h2>
    <div style=" justify-content:left;padding-left:150px;font-size:24px; color:white;">
        <select name="condition1">
            <option value="cID">ID</option>
            <option value="cname">姓名</option>
            <option value="cphone">电话</option>
        </select><br>
        <p id='demo'></p>
        <input class="box" type="text" name="term1">
        <select name="connection">
            <option value="AND">且</option>
            <option value="OR">或</option>
        </select>	<br>
        <select name="condition2">
            <option value="cID">ID</option>
            <option value="cname">姓名</option>
            <option value="cphone">电话</option>
        </select><br>
        <p id='demo'></p>
        <input class="box" type="text" name="term2"><br><br>
        <div style='padding-left:100px;'>
            <button class="button" type="submit" id="submit">查询</button>
        </div>
    </div>
</form>
<div>
    <?php

    ?>
</div>

</div>
</body>
</html>

<!--
 * Created by PhpStorm.
 * User: 岳铁骐-PC
 * Date: 2018/12/26
 * Time: 11:12
 */-->