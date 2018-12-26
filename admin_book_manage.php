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
        
.preview_box img {
  width: 200px;
}
	</style>

	

	<div id="header" style="background-color: #98FB98; padding: 5px; margin: 0;" >
		<h1 style="text-align: center;">滴滴打书 · 图书管理系统</h1>		
	</div>

	<ul class="upper_navigation">
		<li class="current_navigation"><a href="admin_book_manage.php">图书管理</a></li>
		<li class="upper_navigation"><a href="boolean_search">高级检索</a></li>
        <li class="upper_navigation"><a href="admin_customer_manage.php">会员管理</a></li>
        <li class="upper_navigation" style="float: right;"><a href="manage_logout.php">退出管理员界面</a></li>
	</ul>
    
    <div style='display:inline;'>

         <form method="post" action="mana_result.php" style="margin-left: 120px; float:left;padding:50px;">
		      <h2 style="text-align: left; padding-left:200px; color:white; font-size:40px;">查询管理图书</h2>
		          <div style=" justify-content:left;padding-left:150px;font-size:24px; color:white;">
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
        
        <script>
            doucument.getElementById("mytype").onchange=function(){showradio()};
            function showradio(){
            document.getElementById("demo").innerHTML="图书类型：<input type="radio" value='hist' name= 'booktype'>历史
                           <input type="radio" value='jiaocai' name= 'booktype'>教材
                            <input type="radio" value='tech' name= 'booktype'>科技<br>
                            <input type="radio" value='eco' name= 'booktype'>经济
                            <input type="radio" value='novel' name= 'booktype'>小说
                            <input type="radio" value='other' name= 'booktype'>其他 ";
            }
        </script>
    
        <!--分割线
        <div style='margin-left:auto;margin-right:auto;'>
       <div style='width:1px;border:2px solid  #98FB98;float:left;height:600px;'></div></div>-->
               
        <form method='post' action="susadd.php" style='margin-right:40px;display:block; float:right;'>
            <h2 style="text-align: right; padding-right:300px; color:white;font-size:40px;" >添加图书</h2>
                <div style="text-align: right; padding-right:250px; color:white;font-size:24px;">
                        <p>图书名称：<input type="text" name='bookname'></p>
                        <p>图书ISBN号：<input type="text" name='bookISBN'></p>
                        <p>图书作者：<input type="text" name='bookauthor'></p>
                        <p>图书出版社：<input type="text" name='bookpress'></p>
                        <p>图书中文简介：<input type="text" name='bookcin'></p>
                        <p>图书英文简介：<input type="text" name='bookein'></p>
                        <p>图书图片：<input type="text" name='bookimg'><!--<input id="img_input" type="file" accept="image/*"/>
                                                                    <label for="img_input">选择文件并预览</label>
                                                                    <div class="preview_box"></div>-->
                        <p>图书类型：<input type="radio" value='hist' name= 'booktype'>历史
                           <input type="radio" value='jiaocai' name= 'booktype'>教材
                            <input type="radio" value='tech' name= 'booktype'>科技<br>
                            <input type="radio" value='eco' name= 'booktype'>经济
                            <input type="radio" value='novel' name= 'booktype'>小说
                            <input type="radio" value='other' name= 'booktype'>其他</p>  
                    <div style='padding-right:100px;'>
                        <button class="button" type="submit" id="submit"  >添加</button></div>
                </div>
        </form>
    </div>
<!--
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


    </script>-->
      
    </body>
</html>