<?php 
	//连接数据库
	$username = $_COOKIE['username'];
	$password = $_COOKIE['password'];
	$sqlname = $_COOKIE['sqlname'];


	//如果没有cookie就把变量设置为默认值以正常连接数据库
	if(!isset($username)) $username = 'root';
	if(!isset($sqlname)) $sqlname = 'booksql';

	$mysqli = new mysqli('localhost', $username, $password, $sqlname);
	$mysqli->query('set names utf8') or die('query字符集错误');	

	//拥有的书目类型列表
	$type_array = array('小说','历史','社会','教材','科技');

	//获取书的ISBN和类型
	$book_rank_sql = 'SELECT bISBN, btype FROM bookall';
	$book_rank_result = $mysqli->query($book_rank_sql, MYSQLI_STORE_RESULT);

	$book_rank_array = array();
	while(list($isbn, $type) = $book_rank_result->fetch_row()){

		//根据ISBN获取销量信息
		$query_sales_sql = "SELECT sum(oamount) AS selling_nunmber
					FROM order_detail
					WHERE obook in
					(SELECT bookall.bISBN
					FROM bookall
					WHERE (((bookall.bISBN)='".$isbn."')));";
		$query_sales_result = $mysqli->query($query_sales_sql, MYSQLI_STORE_RESULT);
		list($sales) = $query_sales_result->fetch_row();

		//如果没有卖出，就设为0
		if(!isset($sales))$sales = 0;

		//将ISBN和销量、类型作为键值对添加到数组中
		$book_rank_array[$isbn] = array($sales, $type); 
	}

	//根据值（销量优先于类型）进行降序排序
	arsort($book_rank_array);

	while(list($isbn, $sales_type_array) = each($book_rank_array)){
		//输出ISBN、销量、类型
		echo $isbn.' '.$sales_type_array[0].' '.$sales_type_array[1].'<br>';

		//根据ISBN获取这本书的其他信息
		$get_book_metadata_sql = 'SELECT bname, bauthor, bpress FROM bookall WHERE bISBN = "'.$isbn.'"';
		$book_metadata_result = $mysqli->query($get_book_metadata_sql, MYSQLI_STORE_RESULT);
		list($name, $author, $press) = $book_metadata_result->fetch_row();

		//输出这些其他信息
		echo $name.' '.$author.' '.$press.'<br>';
	}

?>