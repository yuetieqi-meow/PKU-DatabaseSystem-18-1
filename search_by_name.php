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
		a.recommend_buy{
			text-decoration: underline;
			cursor: pointer;
		}
	</style>

	

	<div id="header" style="background-color: #98FB98; padding: 5px; margin: 0;" >
		<h1 style="text-align: center;">滴滴打书 · 图书购买系统</h1>		
	</div>

	<ul class="upper_navigation">
		<li class="current_navigation"><a href="search_by_name">书目检索</a></li>
		<li class="upper_navigation"><a href="boolean_search">高级检索</a></li>
		
		<?php
			if(isset($_COOKIE['customer_name'])){
                echo '<li class="upper_navigation" style="float: right;"><a href="admin_logout.php">退出登录</a></li>';
                echo '<li class="upper_navigation" style="float: right;"><a href="shoppingcart.php">我的购物车</a></li>';
                echo '<li class="upper_navigation" style="float: right;"><a href="">您好，'.$_COOKIE['customer_name'].'</a></li>';
			}
			else{
				echo '<li class="upper_navigation" style="float: right;"><a href="admin_login">登录</a></li>';
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
	
<h3 style="text-align: center;">猜您喜欢<br>(点击书名购买)</h3>

<table border="1" rules="all">
	<tr>
		<td><b>书名</b></td>
		<td><b>作者</b></td>
		<td><b>出版社</b></td>
	</tr>



<?php 
	require "algorithms/book_recommendation.php";
	recommend();
?>

</table>

<script type="text/javascript">
	function recommend_buy(bookname){
		var expression = '<form action="search_by_name_result" name="search_form" method="post">';
		expression += '<input name="book_name" value="' + bookname + '"/></form>';
		document.write(expression);
		document.forms['search_form'].submit();
	}
</script>

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
