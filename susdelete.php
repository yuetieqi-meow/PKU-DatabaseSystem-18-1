<! doctype html>
<html lang="en">
<head>
    
    <meta charset ="utf-8">
    <title>删除中……</title>
    </head>
    
<body>
    <?php
    $isbn = $_POST['isbn'];
    $buyer = $_POST['buyer'];
    $seller = $_POST['seller'];
    $number = $_POST['number'];
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $sqlname = $_COOKIE['sqlname'];
    //连接数据库
    $mysqli = new mysqli('localhost','root', '', $sqlname );
    
    //执行删除操作
    $mysqli->query('set names utf8') or die('query字符集错误');
    $delete_sql = 'delete from shoppingcart where scISBN = "'.$isbn.'"';
    $delete_result = $mysqli->query($delete_sql, MYSQLI_STORE_RESULT);    
    
    header("Location: shoppingcart.php");
    ?>
     
    </body>    
        
        
</html>