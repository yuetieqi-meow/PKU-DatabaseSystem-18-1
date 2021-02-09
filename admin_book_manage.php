<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>查询界面</title>
</head>

	<style type="text/css">
        body{
            background-color:rgba(99,99,cc,0.5);
            font-family: 微软雅黑；
        }
        *{
            font-family: 微软雅黑；
        }
        #header{
            background-color: #FFF176; 
            padding: 5px; 
            margin: 0;
            border-radius:5px 5px 0 0;
        }
        .title{
            text-align: center;
            color:black;
        }
        .title img{
            width:60px;
            height:60px; 
            border-radius:40px;
            position: absolute;
            top: 25px;
            left: 500px;
        }
		ul.upper_navigation{
			list-style-type: none;
			margin: 0;
			padding: 10px;
			background-color: #90A4AE;
			opacity:0.8;
			border-radius: 0 0 5px 5px;
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
        .preview_box img {
          width: 200px;
        }
        div.footer{
            width: 100%;
            height: 150px;
            background-color: #90A4AE;
            z-index: 3;
            margin-top: 10px;
        }
        div.footer div{
            text-align: center;
            width: 100%;
            display: inline-block;
        }
        div.footer p{
            color: white;
            text-decoration: underline;
            text-align: center;
            font-size: 24px;
        }
        div.footer a{
            color: white;
        }
	</style>

	
<body> 
	<div id="header" >
		<h1 class="title"><img src="images/images/%E7%AE%A1%E7%90%86%E5%91%98.gif" >滴滴打书 · 图书管理系统</h1>		
	</div>


    <div style='display:inline-block; width: 100%;'>
    <ul class="upper_navigation">
        <li class="current_navigation"><a href="admin_book_manage.php">图书管理</a></li>
        <li class="upper_navigation"><a href="admin_customer_manage.php">会员管理</a></li>
        <li class="upper_navigation"><a href="admin_order_manage.php">订单管理</a></li>
        <li class="upper_navigation"><a href="admin_comment_manage.php">留言管理</a></li>
        <li class="upper_navigation" style="float: right;"><a href="search_by_name.php">退出管理员界面</a></li>
    </ul>

        <div>
         <form method="post" action="admin_book_result.php" style="margin-left: 120px; float:left;padding:50px;">
	      <h2 style="text-align: left; padding-left:200px; color:black; font-size:40px;">查询管理图书</h2>
          <div style=" justify-content:left;padding-left:150px;font-size:24px; color:black;">
                <select name="condition1"> 
                <option value="bname">书名</option> 
                <option value="bauthor">作者</option> 
                <option value="bpress">出版社</option> 
                <option value="bChineseIntroduction">中文简介</option> 
                <option value="bEnglishIntroduction">英文简介</option> 
                <option value="btype">类型</option> 
                </select><br>
              <p id='demo'></p>
                <input class="box" type="text" name="term1">
                <select name="connection"> 
                <option value="AND">且</option> 
                <option value="OR">或</option> 
                </select>	<br>	
                <select name="condition2"> 
                <option value="bname">书名</option> 
                <option value="bauthor">作者</option> 
                <option value="bpress">出版社</option> 
                <option value="bChineseIntroduction">中文简介</option> 
                <option value="bEnglishIntroduction">英文简介</option>
                <option value="btype" id="mytype">类型</option> 
                </select><br>
              <p id='demo'></p>   
                <input class="box" type="text" name="term2">	<br><br>	
              <div style='padding-left:100px;'>
                <button class="button" type="submit" id="submit">查询</button>	
                  </div>
            </div>

	   </form>
    </div>
        
        <script>
            doucument.getElementById("mytype").onchange=function(){showradio()};
            function showradio(){
            document.getElementById("demo").innerHTML="图书类型：<input type="radio" value='lish ' name= 'booktype'>历史 <input type="radio" value='jiaocai' name= 'booktype'>教材 <input type="radio" value='tech' name= 'booktype'>科技<br> <input type="radio" value='eco' name= 'booktype'>经济 <input type="radio" value='novel' name= 'booktype'>小说 <input type="radio" value='other' name= 'booktype'>其他 ";
            }
        </script>
        <div>
        <form method='post' action="admin_bookadd_success.php" style='margin-right:40px;display:block; float:right;'>
            <h2 style="text-align: right; padding-right:300px; color:black;font-size:40px;" >添加图书</h2>
                <div style="text-align: right; padding-right:250px; color:black;font-size:24px;">
                        <p>图书名称：<input type="text" name='bookname'></p>
                        <p>图书ISBN号：<input type="text" name='bookISBN'></p>
                        <p>图书作者：<input type="text" name='bookauthor'></p>
                        <p>图书出版社：<input type="text" name='bookpress'></p>
                        <p>图书中文简介：<input type="text" name='bookcin'></p>
                        <p>图书英文简介：<input type="text" name='bookein'></p>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;图书图片：<input id="img_input" type="file" accept="image/*" name="bookimg"/>
                                                                        <label for="img_input"></label>
                                                                        <div class="preview_box"></div></p>
                        <p>图书类型：<input type="radio" value='历史' name= 'booktype'>历史
                           <input type="radio" value='教材' name= 'booktype'>教材
                            <input type="radio" value='科技' name= 'booktype'>科技<br>
                            <input type="radio" value='经济' name= 'booktype'>经济
                            <input type="radio" value='小说' name= 'booktype'>小说
                            <input type="radio" value='其他' name= 'booktype'>其他</p>  
                    <div style='padding-right:100px;'>
                        <button class="button" type="submit" id="submit"  >添加</button></div>
                </div>
        </form>
    </div>

        <br>
        <div style="position:absolute;width: 800px;left: 25%;top:850px">
        <?php
        //从cookie获取用户最初在登陆界面输入的信息
        $username = $_COOKIE['username'];
        $password = '';
        $sqlname = $_COOKIE['sqlname'];

        if(!isset($username)) $username = 'root';
        if(!isset($sqlname)) $sqlname = 'booksql';

        //连接数据库
        $mysqli = new mysqli('localhost', $username, $password, $sqlname);

        //解决中文显示成问号的问题
        $mysqli->query('set names utf8') or die('query字符集错误');
        echo'<h2 style="float: left">总销量排名为：</h2><br><table width="90%" border="1" cellspacing="0" cellpadding="0"><tr><td>书名</td><td>销量</td><td>类型</td></tr>';
        $sales_ranking_sql="SELECT bname,sum(oamount),btype FROM bookall,order_detail WHERE bookall.bISBN=order_detail.obook GROUP BY bname ORDER BY sum(oamount) DESC";
        $sales_ranking=$mysqli->query($sales_ranking_sql,MYSQLI_STORE_RESULT);
        while(list($bname,$bnumber,$btype)=$sales_ranking->fetch_row()){
            echo"<tr><td>".$bname."</td><td>".$bnumber."</td><td>".$btype."</td></tr>";
        }
        echo "</table>";?>
        </div>
    <div width="1000" height="600" style="text-align: center; width: 100%; margin-top:500px; display: inline-block;">
        <h1 >库存图书分布图</h1>
        <canvas id="chart" style="display: inline-block;"></canvas>
        <!--这的canvas来放可视化饼图-->


        <?php 
            //查询库存信息
            $username = $_COOKIE['username'];
            $password = $_COOKIE['password'];
            $sqlname = $_COOKIE['sqlname'];
            //如果没有cookie就把变量设置为默认值以正常连接数据库
            if(!isset($username)) $username = 'root';
            if(!isset($sqlname)) $sqlname = 'booksql';
            //连接数据库
            //$mysqli = new mysqli('localhost', $username, $password, $sqlname);
            $mysqli = new mysqli('localhost', 'root', '', 'booksql');
            
            //解决中文显示成问号的问题
            $mysqli->query('set names utf8') or die('query字符集错误');
            $booksnum = array();
            $booksname = array();
            $sql_query = "SELECT sum(wnumber) FROM warehouse GROUP BY wbook";
            $sql_query_name = "SELECT bname FROM bookall WHERE bISBN IN (SELECT wbook FROM warehouse)";
            $result = $mysqli->query($sql_query, MYSQLI_STORE_RESULT);
            $result_name = $mysqli->query($sql_query_name, MYSQLI_STORE_RESULT);
        
            while(list($number) = $result->fetch_row()){
                array_push($booksnum, $number);
            }  
            
            while(list($name) = $result_name->fetch_row()){
                array_push($booksname, $name);
            }

            //调用饼图函数
            require 'visualization/pie_chart.php';
            PieChart($booksnum, $booksname)
        ?>
    </div>
</div>

<div class="footer" style="display: block;">
	<div style="display: inline-block;">
		<p>联系我们</p>
		<a href="leavemessage.php">留言</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="face_identification.php">管理员登录</a>
	</div>
</div>

    </body>

<script type = "text/javascript">

$("#img_input").on("change", function(e){

  var file = e.target.files[0]; //获取图片资源

  // 只选择图片文件
  if (!file.type.match('image.*')) {
    return false;
  }

  var reader = new FileReader();

  reader.readAsDataURL(file); // 读取文件

  // 渲染文件
  reader.onload = function(arg) {

    var img = '<img class="preview" src="' + arg.target.result + '" alt="preview"/>';
    $(".preview_box").empty().append(img);
  }
});
    var form_data = new FormData();
var file_data = $("#img_input").prop("files")[0];

// 把上传的数据放入form_data
form_data.append("user", "Mike");
form_data.append("img", file_data);

$.ajax({
    type: "POST", // 上传文件要用POST
    url: "",
    dataType : "json",
    crossDomain: true, // 如果用到跨域，需要后台开启CORS
  processData: false,  // 注意：不要 process data
  contentType: false,  // 注意：不设置 contentType
    data: form_data
}).success(function(msg) {
    console.log(msg);
}).fail(function(msg) {
    console.log(msg);
});


</script>
      
</html>