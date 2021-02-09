<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>查询界面</title>
</head>
<body> 
      <?php
    $bookname = $_POST['bookname'];
    $bookISBN = $_POST['bookISBN'];
    $bookauthor = $_POST['bookauthor'];
    $bookpress = $_POST['bookpress'];
    $bookcin = $_POST['bookcin'];
    $bookein = $_POST['bookein'];
    $booktype = $_POST['booktype'];
    $bookimg = $_POST['bookimg'];

		//连接数据库
		$mysqli = new mysqli('localhost', 'root','', 'booksql');
		
		//解决中文显示成问号的问题
		$mysqli->query('set names utf8') or die('query字符集错误');

		//执行SQL语句
		$sql_query = "INSERT bookall(bISBN,bauthor,bname,bpress,bChineseIntroduction,bEnglishIntroduction,btype) VALUES('%".$bookISBN."%','%".$bookauthor."%','%".$bookname."%','%".$bookpress."%','%".$bookcin."%','%".$bookein."%','%".$booktype."%')";
		if(mysqli_query($mysqli,$sql_query )){
                echo"
					<script type='text/javascript'>  						
                    alert('添加成功');
						location.href='book_manage.php';
					</script> ";
			
		}
		else{
			echo '<h3 style="color:white;">添加数据失败：</h3>'.mysqli_error(),'<br/>';
			echo '<h3 style="color:white;">点击此处 <a href="javascript:history.back(-1);">返回</a> 重试</h3>';
		}
    ?> 
    
        </body>
</html>