<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>查询界面</title>
</head>
<body background="森林.jpg" style="background-repeat:no-repeat"> 
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
		
		round{
			width:400px;                              
			height:200px;
			margin:auto;
		}


	</style>
	
	<div id="header" style="background-color: #98FB98; padding: 5px;" >
		<h1 style="text-align: center;">图书数据库检索系统</h1>		
	</div>

	<ul class="upper_navigation">
		<li class="upper_navigation"><a href="search_by_name">书目检索</a></li>
		<li class="current_navigation"><a href="search_owner">库存检索</a></li>
		<li class="upper_navigation"><a href="search_sales">销量检索</a></li>
		<li class="upper_navigation"><a href="boolean_search">高级检索</a></li>
		<?php
			if(isset($_COOKIE['customer_name'])){
				echo '<li class="upper_navigation" style="float: right;"><a href="admin_logout">欢迎您，'.$_COOKIE['customer_name'].'</a></li>';
			}
			else{
				echo '<li class="upper_navigation" style="float: right;"><a href="admin_login">登陆</a></li>';
				echo '<li class="upper_navigation" style="float: right;"><a href="admin_userregister">注册</a></li>';
			}
		?>
		
	</ul>

	<form method="post" action="search_owner_result.php" style="margin: auto; padding :100px;">
		<h2 style="text-align: center;">请输入要检索的书籍的名称</h2>

		<div style="display: flex; justify-content: center;">
				<input class="box" type="text" name="book_name">
				<button class="button" type="submit" id="submit">查询</button>		
		</div>

	</form>
	
</body>
</html>
