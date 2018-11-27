<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>图书数据库检索系统</title>
</head>
<body>
	<style type="text/css">
		div.function_odd{
			background-color: AliceBlue;
			padding: 1px;
		}
		div.function_even{
			background-color: DarkGray;
			padding: 1px;
		}
		div>a:first-child{
			text-decoration: none;
		}

		div:link{}
		div:hover{
			background-color: Aqua;
		}
	</style>

	<?php
		$username = $_POST['username'];
		$password = $_POST['password'];
		$sqlname = $_POST['sqlname'];

		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); 
		
		$mysqli = new mysqli('localhost', $username, $password, $sqlname);
		$error = error_get_last()
		if($error != null){
			echo "连接出现错误";
		}
		//不知道为什么mysql连接时如果报错不能被catch到，所以这里暂时先这么处理了
		//等以后进一步研究之后再改

		//将用户的登陆信息保存到cookie
		setcookie('username',$username);
		setcookie('password',$password);
		setcookie('sqlname',$sqlname);


	?>

	<div id="header" style="background-color: orange; padding: 5px;" >
		<h2 style="text-align: center;">图书数据库检索系统</h2>		
	</div>

	<div class="function_odd">
		<a href="/php_scripts/1search_by_name/sbn_entrance.php">
			<p style="text-align: center;">根据书名检索书籍</p>
		</a>
	</div>

	<div class="function_even">
		<a href="/php_scripts/2search_owner/so_entrance.php">
			<p style="text-align: center;">根据书名查找拥有的人</p>
		</a>
	</div>
</body>
</html>