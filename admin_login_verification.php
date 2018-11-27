<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录中……</title>
</head>
<body>
	
	<?php 
		error_reporting(0);

		//带post跳转函数
		function buildRequestForm($url, $data, $method = 'post'){
		    $sHtml = "<form id='requestForm' name='requestForm' action='".$url."' method='".$method."'>";
		    foreach($data as $key => $val){
		        $sHtml.= "<input name='".$key."' value='".$val."' />";
		    }
		    $sHtml = $sHtml."<input type='submit' value='确定' style='display:none;'></form>";
		    $sHtml = $sHtml."<script>document.forms['requestForm'].submit();</script>";
		    echo $sHtml;
		}

		$admin_username = $_POST['admin_username'];
		$admin_password = $_POST['admin_password'];
		$username = $_COOKIE['username'];
		$password = $_COOKIE['password'];
		$sqlname = $_COOKIE['sqlname'];

//		echo $admin_username."<br>";
//		echo $admin_password."<br>";

		//连接数据库
		$mysqli = new mysqli('localhost', $username, $password, $sqlname);
		

		$sql_query = 'SELECT password FROM user_login_data WHERE username ="'.$admin_username.'"';
		
		$result = $mysqli->query($sql_query, MYSQLI_STORE_RESULT);
		$pass = $result->fetch_row();

		if($pass[0] == ''){
			$data = array('error_type'=>'admin_username_not_found');
			buildRequestForm('admin_login.php', $data);
		}
		else{	
			if($pass[0] != $admin_password){
				$data = array('error_type'=>'admin_password_incorrect');
//				echo "incorrect";		//ceshi
				buildRequestForm('admin_login.php', $data);
			}
			else{		//登录正常
				setcookie('admin_username', $admin_username);
				header("Location: search_by_name.php"); 
			}
		}

	?>
</body>
</html>
