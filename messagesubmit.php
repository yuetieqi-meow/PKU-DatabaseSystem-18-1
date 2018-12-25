<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>提交中……</title>
</head>

<body>
<?php
$message = $_POST['message'];
$t = time();
$time = date("Y-m-d", $t);

$username = $_COOKIE['username'];
$password = $_COOKIE['password'];
$sqlname = $_COOKIE['sqlname'];
//连接数据库

$mysqli = new mysqli('localhost', $username, $password, $sqlname);
$number_sql = "SELECT COUNT(*) FROM comment";
list($number) = $mysqli->query($number_sql, MYSQLI_STORE_RESULT)->fetch_row();
$number = (int)$number + 1;
$customer_phone = $_COOKIE['customer_phone'];
$search_user_sql='SELECT cID FROM customer where cphone="'.$customer_phone.'"';
list($customer)=$mysqli->query($search_user_sql)->fetch_row();
$sql = 'INSERT INTO comment(cmtID, cmtcustomer, cmttime, cmtmessage,cmtreplystatus) VALUES("' . $number . '","' . $customer . '","' . $time . '","' . $message . '",0)';
$mysqli->query($sql);
header("Location: leavemessage.php");
?>

</body>


</html>