<?php

$temp = $_GET["temp"];
$isbn = $temp[0];
$seller = $temp[1];
$customer = $_COOKIE['customer_phone'];

//从cookie获取用户最初在登陆界面输入的信息
$username = $_COOKIE['username'];
$password = $_COOKIE['password'];
$sqlname = $_COOKIE['sqlname'];

//如果没有cookie就把变量设置为默认值以正常连接数据库
if (!isset($username)) $username = 'root';
if (!isset($sqlname)) $sqlname = 'booksql';

//连接数据库
$mysqli = new mysqli('localhost', $username, $password, $sqlname);

//解决中文显示成问号的问题
$mysqli->query('set names utf8') or die('query字符集错误');

$sql = "DELETE FROM shoppingcart WHERE scISBN='" . $isbn . "' and sccustomer ='" . $customer . "' and scseller ='".$seller."'";
$mysqli->query($sql);


header("location:shoppingcart.php");
//删除完跳转回去

