<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录中……</title>
</head>
<body>
	
	<?php 
//		error_reporting(0);
		//在出现bug的时候把上面这句注释掉！！

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

		$customer_phone = $_POST['customer_phone'];
		$customer_password = $_POST['customer_password'];

		$username = $_COOKIE['username'];
		$password = $_COOKIE['password'];
		$sqlname = $_COOKIE['sqlname'];

		echo $customer_phone."<br>";
		echo $customer_password."<br>";

		//连接数据库
		$mysqli = new mysqli('localhost', $username, $password, $sqlname);
		$mysqli->query('set names utf8') or die('query字符集错误');

		$sql_query = 'SELECT cpassword FROM customer WHERE cphone ="'.$customer_phone.'"';
		
		$result = $mysqli->query($sql_query, MYSQLI_STORE_RESULT);
		$pass = $result->fetch_row();

		if($pass[0] == ''){
			$data = array('error_type'=>'customer_phone_not_found');
			buildRequestForm('admin_login.php', $data);
		}
		else{	
			if($pass[0] != $customer_password){
				$data = array('error_type'=>'customer_password_incorrect');
//				echo "incorrect";		//ceshi
				buildRequestForm('admin_login.php', $data);
			}
			else{		//登录正常
				$query_name = 'SELECT cname FROM customer where cphone = "'.$customer_phone.'"';
				$query_name_result = $mysqli->query($query_name, MYSQLI_STORE_RESULT);
				$customer_name = $query_name_result->fetch_row()[0];
				echo $customer_name;
				setcookie('customer_name', $customer_name);
				header("Location: search_by_name.php"); 
			}
		}

	?>
</body>
</html>

