<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>查询界面</title>
</head>
<body>
<?php
error_reporting(0);

$cmtID = $_POST['cmtID'];
$message = $_POST['message'];

//连接数据库
$mysqli = new mysqli('localhost', 'root', '', 'booksql');

//解决中文显示成问号的问题
$mysqli->query('set names utf8') or die('query字符集错误');

//执行SQL语句

$sql = "UPDATE comment SET cmtreplystatus = 1, cmtreplymessage = " .$message . "
WHERE cmtID=" . strval($cmtID) ;

$mysqli->query($sql);
header("Location: book_manage_success.php");
?>

</body>
</html>