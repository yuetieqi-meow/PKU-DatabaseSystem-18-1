<?php
		error_reporting(0);
		$username = $_POST['username'];
		$password = $_POST['password'];
		$sqlname = $_POST['sqlname'];
		setcookie('username',$username);
		setcookie('password',$password);
		setcookie('sqlname',$sqlname);
		header("Location: search_by_name.php"); 
?>