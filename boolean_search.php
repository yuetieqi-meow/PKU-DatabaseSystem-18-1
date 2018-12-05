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
			width: 180px;
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
		<li class="upper_navigation"><a href="search_owner">库存检索</a></li>
		<li class="upper_navigation"><a href="search_sales">销量检索</a></li>
		<li class="current_navigation"><a href="boolean_search">高级检索</a></li>
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

	<form method="post" action="boolean_search_result.php" style="margin: auto;">
		<h4 style="text-align: center;">请输入高级检索的条件</h4>

		<div style="display: flex; justify-content: center;">
				<select name="condition1"> 
				<option value="bname">书名</option> 
				<option value="bauthor">作者</option> 
				<option value="bpress">出版社</option> 
				<option value="bChineseIntroduction">中文简介</option> 
				<option value="bEnglishIntroduction">英文简介</option> 
				</select>				
				<input class="box" type="text" name="term1">
				<select name="connection"> 
				<option value="AND">且</option> 
				<option value="OR">或</option> 
				</select>	
				<select name="condition2"> 
				<option value="bname">书名</option> 
				<option value="bauthor">作者</option> 
				<option value="bpress">出版社</option> 
				<option value="bChineseIntroduction">中文简介</option> 
				<option value="bEnglishIntroduction">英文简介</option> 
				</select>
				<input class="box" type="text" name="term2">						
				<button class="button" type="submit" id="submit">查询</button>		
		</div>

	</form>
	
</body>
</html>
