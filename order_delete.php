<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>查询界面</title>
</head>
<body>
error_reporting(0);
<?php
$oID = $_POST['oID'];
$oamount = $_POST['oamount'];

//连接数据库
$mysqli = new mysqli('localhost', 'root', '', 'booksql');

//解决中文显示成问号的问题
$mysqli->query('set names utf8') or die('query字符集错误');

//执行SQL语句
$sql = 'DELETE FROM order_detail WHERE oID = "' . $oID . '"';
$mysqli->query($sql);
header("Location: book_manage_success.php");
?>

</body>
</html>