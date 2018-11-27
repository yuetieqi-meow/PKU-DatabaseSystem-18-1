<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>查询界面</title>
</head>
<body>
	<style type="text/css">
		ul.upper_navigation{
			list-style-type: none;
			margin: 0;
			padding: 10px;
			background-color: gray;
		}
		li{
			display: inline;
			margin: 0px;
		}
		li.current_navigation a{
			background-color: #111;
		}
		li.upper_navigation a,li.current_navigation a{
			color: white;
			text-align: center;
			text-decoration: none;
			padding: 10px;
		}
		li.upper_navigation a:hover{
			background-color: #111;
		}
		li.upper_navigation a:visited{
			color: white;
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
			background-color: blue;
			border: solid;
			border-color: blue;
		}


	</style>
	<div id="header" style="background-color: orange; padding: 5px;" >
		<h2 style="text-align: center;">图书数据库检索系统</h2>		
	</div>

	<ul class="upper_navigation">
		<li class="upper_navigation"><a href="search_by_name">书目检索</a></li>
		<li class="current_navigation"><a href="search_owner">作者检索</a></li>
		<li class="upper_navigation"><a href="search_sales">销量检索</a></li>
		<li class="upper_navigation"><a href="boolean_search">布尔检索</a></li>
		<?php
			if(isset($_COOKIE['admin_username'])){
				echo '<li class="upper_navigation" style="float: right;"><a href="admin_logout">'.$_COOKIE['admin_username'].'</a></li>';
			}
			else{
				echo '<li class="upper_navigation" style="float: right;"><a href="admin_login">管理员登陆</a></li>';
			}
		?>
		
	</ul>

	<form method="post" action="search_owner_result.php" style="margin: auto;">
		<h4 style="text-align: center;">请输入要检索的书籍的名称</h4>

		<div style="display: flex; justify-content: center;">
				<input class="box" type="text" name="book_name">
				<button class="button" type="submit" id="submit">查询</button>		
		</div>

	</form>
	
</body>
</html>