<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>查询界面</title>
</head>
<body> 
    error_reporting(0);
      <?php
    $book_isbn = $_POST['book_isbn'];
    $book_owner = $_POST['owner'];
    $number = $_POST['number'];
    $price = $_POST['price'];                                                            

		//连接数据库
		$mysqli = new mysqli('localhost', 'root','', 'booksql');
		
		//解决中文显示成问号的问题
		$mysqli->query('set names utf8') or die('query字符集错误');

		//执行SQL语句
		$sql_query ='DELETE FROM warehouse WHERE wbook = "'.$isbn.'"';
		if ($mysqli->multi_query($sql_query)) {  
                echo "<script type='text/javascript'>  						
                    alert('删除成功');
						location.href='mana_result.php';
					</script> ";	
		}
		else{
			echo '<h3 style="color:white;">添加数据失败：</h3>'.mysqli_error(),'<br/>';
			echo '<h3 style="color:white;">点击此处 <a href="javascript:history.back(-1);">返回</a> 重试</h3>';
		}
    ?> 
    
        </body>
</html>