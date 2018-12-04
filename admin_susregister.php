<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册成功</title>
</head>
<body>
	<style type="text/css">
		div.content_odd{
			background-color: AliceBlue;
			padding: 5px;
		}
		div.content_even{
			background-color: AliceBlue;
			padding: 5px;
		}
		div:link{}
		div:hover{
			background-color: Aqua;
		}
		a {font-size:16px
			text-align:center;
			} 
		a:link {color: blue; text-decoration:none;} //未访问：蓝色、无下划线 
		a:hover {background-color: Aqua; text-decoration:underline;} //鼠标移近：红色、下划线 
		h3{
			text-align: center;
		}

	</style>
	<script language=JavaScript></script>

	<div id="header" style="background-color: orange; padding: 5px;" >
		<h2 style="text-align: center;">注册</h2>		
	</div>


	<?php
 	$username = $_POST['name'];
	$userpd = $_POST['password'];
	$userpd2 = $_POST['password2'];
	$usergender = $_POST['sex'];
	$userphone = $_POST['phone'];

		echo '<h3>你好</h3>';

		//连接数据库
		$mysqli = new mysqli('localhost', 'root', '', 'booksql');
		
		if(!$mysqli){
			die("连接数据库失败：".mysqli_error());
		}
		
		//$user_query = "SELECT * FROM customer WHERE username= $username ";
		
		if (empty($_POST["name"])) {
			
		echo "<h3>错误：姓名不能为空。</h3><a href='javascript:history.back(-1);'><h3>返回</h3></a>";
			exit;
		} 
		

		if (empty($_POST["password"])) {
		echo '错误：密码是必填的。<a href="javascript:history.back(-1);">返回</a>';
			exit;
		} else {
		$password = test_input($_POST["password"]);
		}
		
		if (empty($_POST["sex"])) {
		echo '错误：性别是必填的。<a href="javascript:history.back(-1);">返回</a>';
			exit;
		} else {
		$sex = test_input($_POST["sex"]);
		}
		
		if (empty($_POST["phone"])) {
		echo '错误：手机号码是必填的。<a href="javascript:history.back(-1);">返回</a>';
			exit;
		} else {
		$phone = test_input($_POST["phone"]);
		}

		if (empty($_POST["password2"])) {
		echo '错误：必须确认密码。<a href="javascript:history.back(-1);">返回</a>';
			exit;
		} else {
		$password2 = test_input($_POST["password2"]);
		}if ($_POST["password"] != $_POST["password2"]) {
		echo '错误：两次输入的密码不一致。<a href="javascript:history.back(-1);">返回</a>';
			exit;
		}
		
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		
		
		//检测用户名是否已存在
		$check_query = mysqli_query($mysqli, 'SELECT * FROM customer WHERE cname="'. $username. '"' );
		if (mysqli_fetch_array($check_query)){
			echo '错误：用户名已存在。<a href="javascript:history.back(-1);">返回</a>';
			exit;
		}
		
		
		//解决中文显示成问号的问题
		$mysqli->query('set names utf8') or die('query字符集错误');	

		//在数据库中添加
		$sql_query = "INSERT customer(cname, cpassword, cphone, cgender) VALUES('$username','$userpd','$userphone','$usergender')";
		if(mysqli_query($mysqli,$sql_query )){
				exit('用户注册成功！点击此处<a href ="admin_login.php">登录</a>');
			
		}
		else{
			echo '添加数据失败：'.mysqli_error(),'<br />';
			echo '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
		}
		
	?>
	
	<br>
	<br>
	<form action="search_owner.php">
		<input type="submit" id="submit" value="继续注册">
	</form>

</body>
</html>
