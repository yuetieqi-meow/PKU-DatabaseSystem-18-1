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
			font-size:18px;
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


	<div id="header" style="background-color: #98FB98; padding: 5px; margin: 0;" >
		<h1 style="text-align: center;">滴滴打书 · 图书管理系统</h1>		
	</div>

	<ul class="upper_navigation">
		<li class="current_navigation"><a href="admin_book_manage.php">图书管理</a></li>
		<li class="upper_navigation"><a href="boolean_search">高级检索</a></li>
        <li class="upper_navigation" style="float: right;"><a href="search_by_name">退出管理员界面</a></li>
        <li class="upper_navigation" style="float: right;"><a href="book_manage">重新检索</a></li>
	</ul>


	
	<?php
		//error_reporting(0);
        
        $condition1 = $_POST['condition1'];
		$term1 = $_POST['term1'];
		$connection = $_POST['connection'];
		$condition2 = $_POST['condition2'];
		$term2 = $_POST['term2'];


		//从cookie获取用户最初在登陆界面输入的信息
		$username = $_COOKIE['username'];
		$password = '';
		$sqlname = $_COOKIE['sqlname'];

		//如果没有cookie就把变量设置为默认值以正常连接数据库
		if(!isset($username)) $username = 'root';
		if(!isset($sqlname)) $sqlname = 'booksql';

		//连接数据库
		$mysqli = new mysqli('localhost', $username, $password, $sqlname);
		
		//解决中文显示成问号的问题
		$mysqli->query('set names utf8') or die('query字符集错误');
    
        /*找出检索点
        $pot;$search_part;$order;
        $points= array(".$bookname.",".$bookISBN.",".$bookauthor.",".$bookpress.",".$booktype.");
        for($i=0;$i++;){
            if($point[i]!= null){
                $pot = $point[$i];
                $order = $i;
                break;
            }
        }
        if($order==1)$search_part="bname";
        if($order==2)$search_part="bISBN";
        if($order==3)$search_part="bauthor";
        if($order==4)$search_part="bpress";
        if($order==5)$search_part="btype";-->*/
    
		//执行SQL语句
		$sql_query =  "SELECT * FROM bookall WHERE (".$condition1." LIKE '%".$term1."%' ".$connection." ".$condition2." LIKE '%".$term2."%')";
        $result = $mysqli->query($sql_query, MYSQLI_STORE_RESULT);
    
    
		//统计并显示结果数量
		$total_count = mysqli_num_rows($result);
		echo '<h4 style="color:white;">共有'.$total_count.'个符合要求的结果：</h4>';
        
        echo '	<form action="book_manage.php" style="float:right;">
                <button type="submit" id="submit">重新检索</button>
                </form>';
		
		while(list($isbn, $author, $name, $press, $cin, $ein, $type, $img) = $result->fetch_row()){
			echo '<div style="background-color:MintCream;">';
				echo '<div style="overflow: hidden; ">';
				echo '<img src = "images/'.$img.'" />';
				echo "<br><br>ISBN：".$isbn."<br>";
				echo "书名：".$name."<br>";
				echo "作者：".$author."<br>";
				echo "出版社：".$press."<br>";
				echo "中文简介：".$cin."<br>";
				echo "英文简介：".$ein."<br><br><br><br><br><br>";			
				echo "</div><br>";

		
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
					                    
					echo '	<div style="margin-left:300px;background-color:MintCream;">
                    <form method="post"  name="manage" >
                        &nbsp&nbspISBN号：<button name="book_isbn" >'.$isbn.' </button>
				        卖家：<input name="owner" value="'.$owner_name.'"  "/>				
                		<input name="bookname" value="'.$name.'" style="display:none; "/>
                		&nbsp&nbsp库存：<input name="number" class="box" type="number" required="required" value="'.$number.'"  "/>
                		&nbsp&nbsp价格：<input name="price"  class="box" type="number" required="required" value="'.$price.'"  "/>
                        <button type="submit" id="change" onclick=changeAction()>修改</button>
                        <button type="submit" id="delete" onclick=deleteAction())>删除</button>
							</form></div>';
					echo '</div>';
				}
				if($buy_information_avaliable == false){
                    echo '<h3 style="text-align:center;">暂时没有用户出售本书</h3>';
                    echo '	<div style="margin-left:300px;;"><form action="book_add.php" method="post">
                        &nbsp&nbspISBN号：<button name="book_isbn" >'.$isbn.' </button>
				        卖家：<input name="owner" type="text"/>				
                		<input name="bookname" type="text" style="display:none; "/>
                		&nbsp&nbsp库存：<input name="number" class="box" type="number" required="required" />
                		&nbsp&nbsp价格：<input name="price"  class="box" type="number" required="required" type="text"/>
                        <button type="submit" id="add">添加</button>
							</form></div>';
					echo '</div>';
                }				
            }
        }
	?>
		<form action="book_manage.php" style="margin-left:700px;">
                <button type="submit" id="submit">重新检索</button>
        </form>
    <script type='text/javascript'>
                function changeAction(){
                    document.manage.action='book_change.php';//提交的url
                    document.manage.submit();
                }

                function deleteAction(){
                    document.manage.action='book_delete.php';//提交的url
                    document.manage.submit()

                }
                </script>
</body>
</html>