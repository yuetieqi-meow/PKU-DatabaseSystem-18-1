<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>查询界面</title>
</head>
<body background="images/forest.jpg" style="background-repeat:no-repeat"> 
	<style type="text/css">
		ul.upper_navigation{
			list-style-type: none;
			margin: 0;
			padding: 10px;
			background-color: #98FB98;
			opacity:0.8
			
		}
		li{
			display: inline;
			margin: 0px;
			
		}
		li.current_navigation a{
			background-color: #3CB371;
		}
		li.upper_navigation a,li.current_navigation a{
			color: black;
			text-align: center;
			text-decoration: none;
			padding: 10px;
			font-size:18;
		}
		li.upper_navigation a:hover{
			background-color: #3CB371;
		}
		li.upper_navigation a:visited{
			color: black;
		}
		input.box{
			width: 300px;
    	    height: 38px;
			border:1px solid gray;
			padding: 5px 20px;
			font-size: 20px;

		}
		button.button{
			width:100px;
        	height: 50px;
			padding: 5px 20px;
			font-size: 20px;
			color: white;
			background-color: #20B2AA;
			border: solid;
			border-color: #20B2AA;
			opacity:0.9;
		}
		
		button.button:hover{
			background-color:#3CB371;
			border-color: #3CB371;
			opacity:0.8;
		}

		table{
			border-color: black;
			text-align: center; 
			margin: auto;
		}

		td{
			padding: 5px;
		}
	</style>

	

	<div id="header" style="background-color: #98FB98; padding: 5px; margin: 0;" >
		<h1 style="text-align: center;">图书数据库检索系统</h1>		
	</div>

	<ul class="upper_navigation">
		<li class="current_navigation"><a href="search_by_name">书目检索</a></li>
		<li class="upper_navigation"><a href="search_owner">库存检索</a></li>
		<li class="upper_navigation"><a href="search_sales">销量检索</a></li>
		<li class="upper_navigation"><a href="boolean_search">高级检索</a></li>
		
		<?php
			if(isset($_COOKIE['customer_name'])){
				echo '<li class="upper_navigation" style="float: right;"><a href="admin_logout">欢迎您，'.$_COOKIE['customer_name'].'</a></li>';
			}
			else{
				echo '<li class="upper_navigation" style="float: right;"><a href="admin_login">登陆</a></li>';
				echo '<li class="upper_navigation" style="float: right;"><a href="admin_userregister">注册</a></li>';
			}
		?>

	</ul>

	<form method="post" action="search_by_name_result.php" style="margin: auto; padding :100px;">
		<h2 style="text-align: center;">请输入要检索的书籍的名称</h2>

		<div style="display: flex; justify-content: center;">
				<input class="box" type="text" name="book_name">
				<button class="button" type="submit" id="submit" >查询</button>		
		</div>

	</form>

<!--以下是个性推荐部分-->
	
<h3 style="text-align: center;">猜您喜欢</h3>

<table border="1" rules="all">
	<tr>
		<td><b>书名</b></td>
		<td><b>作者</b></td>
		<td><b>出版社</b></td>
	<tr>
	<?php
	//获取需要的连接数据库信息
		error_reporting(0);
		$username = 'root';
		$password = '';
		$sqlname = 'booksql';
		if(isset($_COOKIE['username']))$username = $_COOKIE['username'];
		if(isset($_COOKIE['password']))$password = $_COOKIE['password'];
		if(isset($_COOKIE['sqlname']))$sqlname = $_COOKIE['sqlname'];

		$mysqli = new mysqli('localhost', $username, $password, $sqlname);
		$mysqli->query('set names utf8') or die('query字符集错误');	

		//拥有的书目类型列表
		$type_array = array('小说','历史','经济','教材','科技','其他');

		function sql_query($mysqli, $sql){	//执行sql查寻的函数，输入sqli对象和要执行的语句，返回查询结果对象
			$sql_result = $mysqli -> query($sql, MYSQLI_STORE_RESULT);
			return $sql_result;
		}

		function get_sales_vector($mysqli, $customer_name, $type_array){	//获取指定用户的销售向量的函数
			$tempo = array();	//存储当前用户的购买向量
			//开始计算本用户的购买向量
			foreach($type_array as $tp){
                $sql = "SELECT sum(oamount) FROM order_detail WHERE 
                obook in
                (SELECT bISBN FROM bookall WHERE btype = '".$tp."')
                AND 
                osale in
                (SELECT sID FROM sale WHERE scustomer in
                (SELECT cID FROM customer WHERE cname = '".$customer_name."'))";

				$sql_result = sql_query($mysqli, $sql);
				list($type_amount)=$sql_result->fetch_row();

				if(!isset($type_amount)) $type_amount = 0;
				array_push($tempo, $type_amount);
			}
			return $tempo;
		}

		function vector_dot_product($vec1, $vec2){
			if(sizeof($vec1) != sizeof($vec2))return -1;	//如果向量维度不等，返回-1
			$ret = 0;
			for($i = 0; $i < sizeof($vec1); ++$i){
				$ret += $vec1[$i] * $vec2[$i];
			}
			return $ret;
		}

		function vector_cosine($vec1, $vec2){
			if(sizeof($vec1) != sizeof($vec2))return -1;	//如果向量维度不等，返回-1
			if(vector_dot_product($vec1, $vec1) == 0 || vector_dot_product($vec2, $vec2) == 0) return 0;	//如果其中一个向量是零向量就返回0
			return vector_dot_product($vec1, $vec2)/(sqrt(vector_dot_product($vec1, $vec1)) * sqrt(vector_dot_product($vec2, $vec2)));
		}


		if(!isset($_COOKIE['customer_name'])){	//如果没有登录，执行默认推荐

			$sql_result = sql_query($mysqli, 'SELECT obook, sum(oamount) FROM order_detail GROUP BY obook;');
			$book_rank_array = array();
			
			while(list($isbn, $sale) = $sql_result -> fetch_row()){
				$book_rank_array[$isbn] = $sale;
			}
			
			arsort($book_rank_array);
			
			//遍历，输出前五个
			$i= 0;
			while(list($isbn, $sale) = each($book_rank_array)){
				echo "<tr>";
				$book_result = sql_query($mysqli, 'SELECT bname, bauthor, bpress FROM bookall WHERE bISBN = "'.$isbn.'"');
				list($bname, $bauthor, $bpress) = $book_result -> fetch_row();
				echo "<td>".$bname."</td><td>".$bauthor."</td><td>".$bpress."</td>";
				$i += 1;
				if($i == 5)break;
				echo "</tr>";
			}
			

		}
		else{		//如果有用户登录信息
			$customer_name = $_COOKIE['customer_name'];
            $curr_user_vector = get_sales_vector($mysqli, $customer_name, $type_array);

            //foreach ($curr_user_vector as $value) {
			//		echo $value.' ';
			//	}
			//echo '<br>';

			//$tempo是当前用户的购买向量

            //首先生成一个所有书目的清单，销量记为0
            $book_isbn_sales_array = array();
            $book_isbn_result = sql_query($mysqli, "SELECT bISBN FROM bookall");
            while($isbn = $book_isbn_result -> fetch_row()){
            	$book_isbn_sales_array[$isbn] = 0;
            }

			$ocn = sql_query($mysqli, 'SELECT cname FROM customer WHERE cname != "'.$customer_name.'"');

			while (list($other_customer_name) = $ocn -> fetch_row()) {

				//echo $other_customer_name;

				$this_user_vector = get_sales_vector($mysqli, $other_customer_name, $type_array);

				//foreach ($this_user_vector as $value) {
				//	echo $value.' ';
				//}

				//求向量夹角作为权重
				$weight = vector_cosine($curr_user_vector, $this_user_vector);

				//echo 'weight: '.$weight;

			//获得这个用户购买的书的isbn和数量的键值对
				$sql = 'SELECT obook, sum(oamount) FROM order_detail WHERE osale IN (SELECT sID FROM sale WHERE scustomer in (SELECT cID from customer where cname = "'.$other_customer_name.'")) group by obook';
				$sales_list = sql_query($mysqli, $sql);
				//将销售信息加权后加入所有书目清单中
				while(list($isbn, $sales) = $sales_list -> fetch_row()){
			
					$book_isbn_sales_array[$isbn] += $sales * $weight;
				}
			}

			//while(list($isbn, $sale) = each($book_isbn_sales_array)){
			//	echo $isbn." ".$sale;
			//	echo "<br>";
			//}

			arsort($book_isbn_sales_array);

			//先检查这个用户是不是已经购买了这本书，所以要生成用户已经购买了的书单
			$customer_bought = sql_query($mysqli, 'SELECT obook FROM order_detail WHERE osale in (SELECT sID FROM sale WHERE scustomer in (SELECT cID from customer where cname = "'.$customer_name.'"))');
			$customer_bought_list = array();
			while(list($isbn) = $customer_bought -> fetch_row()){
				array_push($customer_bought_list, $isbn);
			//	echo $isbn.' ';
			}

			//遍历销量排名，输出前五个
			$i= 0;
			while(list($isbn, $sale) = each($book_isbn_sales_array)){

				//如果这本书用户已经买过了，跳过
				if(in_array($isbn, $customer_bought_list))continue;

				echo "<tr>";
				$book_result = sql_query($mysqli, 'SELECT bname, bauthor, bpress FROM bookall WHERE bISBN = "'.$isbn.'"');
				list($bname, $bauthor, $bpress) = $book_result -> fetch_row();
				echo "<td>".$bname."</td><td>".$bauthor."</td><td>".$bpress."</td>";
				$i += 1;
				if($i == 5)break;
				echo "</tr>";
			}
		}
?>

</table>
</body>
</html>




<?php
/*
		//下面是杨旭航原来写的代码

		//判断用户是否登录，登录获取ta喜欢类型的书前五，否则获取所有书前五
		if(isset($_COOKIE['customer_name'])){
					//遍历各个种类统计用户买各种书的总数
					foreach($type_array as $tp)
					{
                        $sql="SELECT sum(oamount) FROM order_detail WHERE 
                        obook in
                        (SELECT bISBN FROM bookall WHERE btype = '".$tp."')
                        AND 
                        osale in
                        (SELECT sID FROM sale WHERE scustomer in
                        (SELECT cID FROM customer WHERE cname = '".$_COOKIE['customer_name']."'))";

						$sql_result = $mysqli -> query($sql, MYSQLI_STORE_RESULT);
						list($type_amount)=$sql_result->fetch_row();
						if(!isset($type_amount)) $type_amount = 0;
						$tempo[$tp]=$type_amount;
					}

					//排序并选出用户最爱种类
					arsort($tempo);
					$tempotypes=array_keys($tempo);
					$user_prefer_type=$tempotypes[0];
					$book_rank_sql = 'SELECT bISBN, btype FROM bookall WHERE btype ="'.$user_prefer_type.'"';
					}
		else{$book_rank_sql = 'SELECT bISBN, btype FROM bookall';}
				

		//获取书的ISBN和类型
		
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
		
        $isbns=array_keys($book_rank_array);
        $isbns=array_slice($isbns,0,5);
        

		//输出书名行
		
		echo '<div id = "round"><td>'."书名".'</td></div>';
		
        foreach($isbns as $bookk)
		{
			//根据ISBN获取这本书的其他信息
			$get_book_metadata_sql = 'SELECT bname FROM bookall WHERE bISBN = "'.$bookk.'"';
			$book_metadata_result = $mysqli->query($get_book_metadata_sql, MYSQLI_STORE_RESULT);
			list($name) = $book_metadata_result->fetch_row();
			echo '<td>'.$name.'</td>';

		}
		echo '</tr> <tr>';

		//输出作者行
		echo '<td>'."作者".'</td>';
        foreach($isbns as $bookk)
        {
            //根据ISBN获取这本书的其他信息
            $get_book_metadata_sql = 'SELECT bauthor FROM bookall WHERE bISBN = "'.$bookk.'"';
            $book_metadata_result = $mysqli->query($get_book_metadata_sql, MYSQLI_STORE_RESULT);
            list($author) = $book_metadata_result->fetch_row();
            echo '<td>'.$author.'</td>';

        }
		echo '</tr> <tr>';

		//输出出版社行
		echo '<td>'."出版社".'</td>';
        foreach($isbns as $bookk)
        {
            //根据ISBN获取这本书的其他信息
            $get_book_metadata_sql = 'SELECT bpress FROM bookall WHERE bISBN = "'.$bookk.'"';
            $book_metadata_result = $mysqli->query($get_book_metadata_sql, MYSQLI_STORE_RESULT);
            list($press) = $book_metadata_result->fetch_row();
            echo '<td>'.$press.'</td>';

        }
		echo '</tr>';

*/
	
?>
