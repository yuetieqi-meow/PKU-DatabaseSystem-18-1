<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>查询界面</title>
</head>
<body background="images/forest.jpg" style="background-repeat:no-repeat">
<style type="text/css">
    ul.upper_navigation {
        list-style-type: none;
        margin: 0;
        padding: 10px;
        background-color: #98FB98;
        opacity: 0.8

    }

    li {
        display: inline;
        margin: 0px;

    }

    li.current_navigation a {
        background-color: #3CB371;
    }

    li.upper_navigation a, li.current_navigation a {
        color: black;
        text-align: center;
        text-decoration: none;
        padding: 10px;
        font-size: 18;
    }

    li.upper_navigation a:hover {
        background-color: #3CB371;
    }

    li.upper_navigation a:visited {
        color: black;
    }

    input.box {
        width: 300px;
        height: 38px;
        border: 1px solid gray;
        padding: 5px 20px;
        font-size: 20px;

    }

    button.button {
        width: 100px;
        height: 50px;
        padding: 5px 20px;
        font-size: 20px;
        color: white;
        background-color: #20B2AA;
        border: solid;
        border-color: #20B2AA;
        opacity: 0.9;
    }

    button.button:hover {
        background-color: #3CB371;
        border-color: #3CB371;
        opacity: 0.8;
    }

    table {
        border-color: black;
        text-align: center;
        margin: auto;
    }

    td {
        padding: 5px;
    }

    a.recommend_buy {
        text-decoration: underline;
        cursor: pointer;
    }

    .preview_box img {
        width: 200px;
    }
</style>


<div id="header" style="background-color: #98FB98; padding: 5px; margin: 0;">
    <h1 style="text-align: center;">滴滴打书 · 图书管理系统</h1>
</div>


<div style='display:inline;'>
    <ul class="upper_navigation">
        <li class="upper_navigation"><a href="admin_book_manage.php">图书管理</a></li>
        <li class="upper_navigation"><a href="admin_customer_manage.php">会员管理</a></li>
        <li class="upper_navigation"><a href="admin_order_manage.php">订单管理</a></li>
        <li class="upper_navigation" style="float: right;"><a href="search_by_name.php">退出管理员界面</a></li>
    </ul>
    <div class="content_odd">
        <h2 style="text-align: center">操作成功！</h2>
    </div>


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