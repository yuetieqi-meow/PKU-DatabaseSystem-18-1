<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>查询结果-根据书名检索书籍</title>
</head>
<body background="images/forest.jpg" > 
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
		div.content_odd{
			background-color: DarkGray;
			opacity:0.8;
			float:right;		
			width: 100%;	
		}
		div.content_even{
			background-color: AliceBlue;
			opacity:0.8;
			float:right;
			width: 100%;	
		}
		div:link{}

		#submit{
			width:200px;
        	height: 50px;
			padding: 5px 20px;
			font-size: 20px;
			color: white;
			background-color: #20B2AA;
			border: solid;
			border-color: #20B2AA;
			opacity:0.9;
		}
		#submit:hover{
			background-color:#3CB371;
			border-color: #3CB371;
			opacity:0.8;
		}
		img {
			width:200px;
        	height:300px;
			border-radius: 8px;
			float:left;
		}
		div.sell_information div{
			display: inline-block;
			width: 24%;
			text-align: center;
		}
		div.margin_box{
			position:absolute;
			margintop:-50px;
			background-color:grey;
			opesity:0.8;
		}
	</style>


	<div id="header" style="background-color: #98FB98; padding: 5px;" >
		<h2 style="text-align: center;">根据书名检索书籍 · 检索结果</h2>		
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
            echo '<li class="upper_navigation" style="float: right;"><a href="admin_login">登陆</a></li>';
            echo '<li class="upper_navigation" style="float: right;"><a href="admin_userregister">注册</a></li>';
        }
        ?>
	</ul>


	<?php
		error_reporting(0);

		$bookname = $_POST['book_name'];

		//从cookie获取用户最初在登陆界面输入的信息
		$username = $_COOKIE['username'];
		$password = $_COOKIE['password'];
		$sqlname = $_COOKIE['sqlname'];

		//如果没有cookie就把变量设置为默认值以正常连接数据库
		if(!isset($username)) $username = 'root';
		if(!isset($sqlname)) $sqlname = 'booksql';

		//连接数据库
		$mysqli = new mysqli('localhost', $username, $password, $sqlname);
		
		//解决中文显示成问号的问题
		$mysqli->query('set names utf8') or die('query字符集错误');

		//执行SQL语句
		$sql_query = "SELECT * FROM bookall WHERE bname LIKE '%".$bookname."%'";
		$result = $mysqli->query($sql_query, MYSQLI_STORE_RESULT);

		//统计并显示结果数量
		$total_count = mysqli_num_rows($result);
		echo '<div style="background-color:#3CB371; padding:5px;"><h4>共有'.$total_count.'个符合要求的结果：</h4></div>';

		$line = 0;
		while(list($isbn, $author, $name, $press, $cin, $ein, $type, $img) = $result->fetch_row()){
			//为奇偶行设置不同背景颜色
			$line++;
			if ($line % 2) $divclass = 'content_even';
			else $divclass = 'content_odd';

			//输出检索结果
			echo '<div class="'.$divclass.'">';
				echo '<div style="overflow: hidden; ">';
				echo '<img src = "images/'.$img.'" />';
				echo "<br><br>ISBN：".$isbn."<br>";
				echo "书名：".$name."<br>";
				echo "作者：".$author."<br>";
				echo "出版社：".$press."<br>";
				echo "中文简介：".$cin."<br>";
				echo "英文简介：".$ein."<br>";
				echo '</div><br>';			

			echo "本书的购买信息：<br>";

            $warehouse_sql = 'SELECT wowner, wnumber, wprice FROM warehouse WHERE wbook = "'.$isbn.'"';
            $warehouse_result = $mysqli->query($warehouse_sql, MYSQLI_STORE_RESULT);
            $bookall_sql = 'select bname from bookall where bISBN = "'.$isbn.'"';
            $bookall_result = $mysqli->query($bookall_sql, MYSQLI_STORE_RESULT);
            $name = $bookall_result -> fetch_row()[0];

            //判断是否登录，登录可以执行购买，否则需要注册或者登录
			if(isset($_COOKIE['customer_name'])){
				$buy_information_avaliable = false;
				while(list( $owner, $number, $price) = $warehouse_result -> fetch_row()){
					$buy_information_avaliable = true;

					//获取卖家姓名
					$owner_sql = 'SELECT cname from customer where cID = "'.$owner.'"';
					$owner_result = $mysqli->query($owner_sql, MYSQLI_STORE_RESULT);
					$owner_name = $owner_result -> fetch_row()[0];

					echo '<div class="sell_information">';
					echo '	<div ><p>'.$owner_name.'</p></div>';
					echo '	<div ><p>￥'.$price.'</p></div>';
					echo '	<div ><p>库存'.$number.'本</p></div>';
					
					//从cookie获取用户最初在登陆界面输入的信息
					$admin_name = $COOKIE['phone'];
					$admin_password = $COOKIE['password'];
                    
					echo '	<div><form action="confirm_purchase.php" method="post">
						<input name="owner" value="'.$owner_name.'" style="display:none; "/>				
                		<input name="bookname" value="'.$name.'" style="display:none; "/>
                		<input name="number" value="'.$number.'" style="display:none; "/>
                		<input name="book_isbn" value="'.$isbn.'" style="display:none; "/>
                		<input name="price" value="'.$price.'" style="display:none; "/>
						<button type="submit">购买</button>
							</form></div>';
					echo '</div>';
				}
				if($buy_information_avaliable == false){
                    echo '<h3 style="text-align:center;">暂时没有用户出售本书</h3>';
                }
				echo '</div>';
				}else{
					echo"
					<script type='text/javascript'>  						
                    alert('您尚未登录，无法浏览详细的商品信息和进行购买,请先登录或注册');
						location.href='admin_login.php';
					</script> ";
				}
				echo '</div>';					
            }
					
	?>

	<form action="search_by_name.php" style="margin:auto;">
        <button type="submit" id="submit">重新检索</button>
    </form>

	<script type="text/javascript">
		
	</script>
		
</body>
</html>

