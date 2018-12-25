
<?php
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $sqlname = $_COOKIE['sqlname'];

    //如果没有cookie就把变量设置为默认值以正常连接数据库
    if (!isset($username)) $username = 'root';
    if (!isset($password)) $password = '';
    if (!isset($sqlname)) $sqlname = 'booksql';

    $mysqli = new mysqli('localhost', $username, $password, $sqlname);
    //解决中文显示成问号的问题
    $mysqli->query('set names utf8') or die('query字符集错误');

    $isbn = $_POST['isbn'];
    $buyerID = $_POST['buyer'];
    $sellerID = $_POST['seller'];
    $number = $_POST['number'];

    $salenumber_sql = "SELECT COUNT(*) FROM sale";
    list($salenumber) = $mysqli -> query($salenumber_sql, MYSQLI_STORE_RESULT) -> fetch_row();
    $salenumber = (int)$salenumber + 1;

    $ordernumber_sql = "SELECT COUNT(*) FROM order_detail";
    list($ordernumber) = $mysqli -> query($ordernumber_sql, MYSQLI_STORE_RESULT) -> fetch_row();
    $ordernumber = (int)$ordernumber + 1;

    $warehouse_number_sql = 'SELECT wnumber FROM warehouse WHERE wbook= "'.$isbn.'"AND wowner="'.$sellerID.'"';
    list($warehouse_number) = $mysqli -> query($warehouse_number_sql, MYSQLI_STORE_RESULT) -> fetch_row();
    (int)$warehouse_number = (int)$warehouse_number - (int)$number;
    $t = time();
    $time = date("Y-m-d", $t);
    $insert_sql1 = 'INSERT INTO sale(sID, scustomer, sseller, stime) VALUES("'.$salenumber.'","'.$buyerID.'","'.$sellerID.'","'.$time.'")';
    echo $insert_sql1;

    $insert_sql2 = 'UPDATE warehouse SET wnumber = "'.$warehouse_number.'" WHERE wbook = "'.$isbn.'" AND wowner = "'.$sellerID.'"';

    $insert_sql3 ='INSERT INTO order_detail(oID, obook, oamount, osale) VALUES("'.$ordernumber.'","'.$isbn.'","'.$number.'","'.$salenumber.'")';
    echo $insert_sql3;

    $insert_sql4 = 'DELETE FROM shoppingcart WHERE scISBN = "'.$isbn.'" AND sccustomer = "'.$buyerID.'" AND scseller = "'.$sellerID.'"';

    $mysqli->query($insert_sql1);
    $mysqli->query($insert_sql2);
    $mysqli->query($insert_sql3);
    $mysqli->query($insert_sql4);
    $mysqli->commit();
    header("Location: susshopping.php");

?>
   
</body>
</html>
