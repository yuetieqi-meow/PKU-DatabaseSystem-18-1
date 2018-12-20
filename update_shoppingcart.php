<?php
    //从cookie获取用户最初在登陆界面输入的信息
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $sqlname = $_COOKIE['sqlname'];

    //如果没有cookie就把变量设置为默认值以正常连接数据库
    if (!isset($username)) $username = 'root';
    if (!isset($sqlname)) $sqlname = 'booksql';

    $mysqli = new mysqli('localhost', $username, $password, $sqlname);
    //解决中文显示成问号的问题
    $mysqli->query('set names utf8') or die('query字符集错误');

    //如果是从购买页面跳转过来，需要把购物车信息加入数据库
    if (isset($_POST['isbn'])) {
        $isbn = $_POST['isbn'];
        $seller = $_POST['seller'];
        $buynumber = $_POST['current_number'];
        $customer = $_COOKIE['customer_phone'];

        //检查本界面是不是由confirm_purchase.php调用的
        $check_repetition_sql = 'SELECT * FROM shoppingcart WHERE scISBN = "'.$isbn.'" AND sccustomer="'.$customer.'" AND scseller = "'.$seller.'"';

        $check_repetition_result = $mysqli -> query($check_repetition_sql, MYSQLI_STORE_RESULT);

        $repetition_status = 'a';
        while($repetition_list = $check_repetition_result -> fetch_row()){
            $repetition_status = 'b';
        }

        if($repetition_status == 'b'){   //如果销售记录中已经有同名的记录存在
            $update_sql = 'UPDATE shoppingcart SET scnumber = scnumber +'.$buynumber.' WHERE scISBN = "'.$isbn.'" AND sccustomer="'.$customer.'" AND scseller = "'.$seller.'"';
        }
        else{
            $update_sql = "INSERT INTO shoppingcart(scISBN,sccustomer,scseller,scnumber) VALUES ('" . $isbn . "','" . $customer . "','" . $seller . "'," . strval($buynumber) . ")";
        }

        echo $update_sql;
        $mysqli->query($update_sql);
    }
    header("Location: shoppingcart.php");
?>