<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>查询结果-布尔检索</title>
</head>
<body>
	<style type="text/css">
		div.content_odd{
			background-color: DarkGray;
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
		button{
			width:200px;
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
		<h2 style="text-align: center;">布尔检索 · 检索结果</h2>		
	</div>


	<?php
		error_reporting(0);

		$condition1 = $_POST['condition1'];
		$term1 = $_POST['term1'];
		$connection = $_POST['connection'];
		$condition2 = $_POST['condition2'];
		$term2 = $_POST['term2'];

		//连接数据库
		$username = $_COOKIE['username'];
		$password = $_COOKIE['password'];
		$sqlname = $_COOKIE['sqlname'];
		$mysqli = new mysqli('localhost', $username, $password, $sqlname);
		
		//解决中文显示成问号的问题
		$mysqli->query('set names utf8') or die('query字符集错误');	

		//执行SQL语句
		$sql_query =  "SELECT * FROM bookall WHERE (".$condition1." LIKE '%".$term1."%' ".$connection." ".$condition2." LIKE '%".$term2."%')";

		$result = $mysqli->query($sql_query, MYSQLI_STORE_RESULT);

		//统计并显示结果数量
		$total_count = mysqli_num_rows($result);
		echo '<div style="background-color:DarkTurquoise; padding:5px;"><h4>共有'.$total_count.'个符合要求的结果：</h4></div>';

		$line = 0;
		while(list($isbn, $author, $name, $press, $cin, $ein) = $result->fetch_row()){
			//为奇偶行设置不同背景颜色
			$line++;
			if ($line % 2) $divclass = 'content_even';
			else $divclass = 'content_odd';

			//输出检索结果
			echo '<div class="'.$divclass.'">';
			echo "ISBN：".$isbn."<br>";
			echo "书名：".$name."<br>";
			echo "作者：".$author."<br>";
			echo "出版社：".$press."<br>";
			echo "中文简介：".$cin."<br>";
			echo "英文简介：".$ein."<br>";
			echo "</div>";
		}
	?>

	<form action="boolean_search.php">
		<button type="submit" id="submit">重新检索</button>
	</form>

</body>
</html>

