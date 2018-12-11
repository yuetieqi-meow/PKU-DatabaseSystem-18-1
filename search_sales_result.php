<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>查询结果-根据书名检索销量</title>
</head>
<body background="images/forest.jpg"> 
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
		div.content_odd{
			background-color: DarkGray;
			padding: 5px;
			opacity:0.8;
			float:right;			
		}
		div.content_even{
			background-color: AliceBlue;
			padding: 5px;
			opacity:0.8;
		}
		div:link{}
		div:hover{
			background-color: #3CB371;
			opacity:0.8;
		}
		button{
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
		button:hover{
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
	</style>


	<div id="header" style="background-color: #98FB98; padding: 5px;" >
		<h2 style="text-align: center;">根据书名检索书籍 · 检索结果</h2>
	</div>
	<ul class="upper_navigation">
		<li class="upper_navigation"><a href="search_by_name">书目检索</a></li>
		<li class="upper_navigation"><a href="search_owner">库存检索</a></li>
		<li class="current_navigation"><a href="search_sales">销量检索</a></li>
		<li class="upper_navigation"><a href="boolean_search">高级检索</a></li>
        <?php
        if(isset($_COOKIE['admin_username'])){
            echo '<li class="upper_navigation" style="float: right;"><a href="admin_logout">'.$_COOKIE['admin_username'].'</a></li>';
        }
        else{
            echo '<li class="upper_navigation" style="float: right;"><a href="admin_login">登陆</a></li>';
            echo '<li class="upper_navigation" style="float: right;"><a href="admin_userregister">注册</a></li>';
        }
        ?>
		
	</ul>
	<?php
		error_reporting(0);

		$bookname = $_POST['book_name'];
		//从cookie获取用户最初在登陆界面输入的信息
		$username = $_COOKIE['username'];
		$password = $_COOKIE['password'];
		$sqlname = $_COOKIE['sqlname'];

		//如果没有cookie就把变量设置为默认值以正常连接数据库
		if(!isset($username)) $username = 'root';
		if(!isset($sqlname)) $sqlname = 'booksql';
		
		$mysqli = new mysqli('localhost', $username, $password, $sqlname);
		//解决中文显示成问号的问题
		$mysqli->query('set names utf8') or die('query字符集错误');	
		//执行SQL语句
		$sql_query = "SELECT sum(oamount) AS selling_nunmber
					FROM order_detail
					WHERE obook in
					(SELECT bookall.bISBN
					FROM bookall
					WHERE (((bookall.bname)='".$bookname."')));";
		$result = $mysqli->query($sql_query, MYSQLI_STORE_RESULT);
		//统计并显示结果数量
		$total_count = mysqli_num_rows($result);

			list($num) = $result->fetch_row();
			if(isset($num)==false)$num=0;
			//输出检索结果
			echo '<div style="background-color:DarkTurquoise; padding:5px;"><h4>《'.$bookname.'》的总销量为'.$num.'</h4></div>';
		
	?>
	<form action="search_sales.php">
		<button type="submit" id="submit">重新检索</button>
	</form>
</body>
</html>

