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
			font-size:18px;
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
		
		round{
			width:400px;                              
			height:200px;
			margin:auto;
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
		div.footer{
            width: 100%;
            height: 200px;
            background-color: #AAA;
            position: absolute;
            top: 900px;
            left: 0px;
        }
        div.footer div{
            width: 50%;
            text-align: center;
        }
        div.footer p{
            color: white;
            text-decoration: underline;
        }
        div.footer a{
            color: white;
            text-decoration: none;
        }

	</style>
	<div id="header" style="background-color: #98FB98; padding: 5px;" >
		<h1 style="text-align: center;">滴滴打书 · 图书购买系统</h1>		
	</div>

	<ul class="upper_navigation">
		<li class="upper_navigation"><a href="admin_book_manage.php">书目检索</a></li>
		<li class="current_navigation"><a href="boolean_search">高级检索</a></li>
        <li class="upper_navigation"><a href="admin_customer_manage.php">会员管理</a></li>

        <li class="upper_navigation" style="float: right;"><a href="manage_logout.php">退出管理员界面</a></li>
	</ul>

	<form method="post" action="boolean_search_result.php" style="margin: auto; padding :100px;">
		<h2 style="text-align: center;">请输入高级检索的条件</h2>

		<div style="display: flex; justify-content: center;">
				<select name="condition1"> 
				<option value="bname">书名</option> 
				<option value="bauthor">作者</option> 
				<option value="bpress">出版社</option> 
				<option value="bChineseIntroduction">中文简介</option> 
				<option value="bEnglishIntroduction">英文简介</option> 
				</select>				
				<input class="box" type="text" name="term1">
				<select name="connection"> 
				<option value="AND">且</option> 
				<option value="OR">或</option> 
				</select>	
				<select name="condition2"> 
				<option value="bname">书名</option> 
				<option value="bauthor">作者</option> 
				<option value="bpress">出版社</option> 
				<option value="bChineseIntroduction">中文简介</option> 
				<option value="bEnglishIntroduction">英文简介</option> 
				</select>
				<input class="box" type="text" name="term2">						
				<button class="button" type="submit" id="submit">查询</button>		
		</div>
	</form>
</body>
<script type="text/javascript">
	function recommend_buy(bookname){
		var expression = '<form action="search_by_name_result" name="search_form" method="post">';
		expression += '<input name="book_name" value="' + bookname + '"/></form>';
		document.write(expression);
		document.forms['search_form'].submit();
	}
</script>


</html>
