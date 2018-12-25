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
        div.content_odd{
            background-color: DarkGray;
            opacity:0.8;
            float:right;
            width: 100%;      
            text-align: center;      
        }
        div.content_even{
            background-color: AliceBlue;
            opacity:0.8;
            float:right;
            width: 100%;
            text-align: center;      
        }
        div.content_odd p, div.content_even p{
            display: inline-block;
            width: 15%;
        }
        input.box{
            width: 60%;
            height: 30px;
            border: 1px solid gray;
            padding: 5px 20px;
            font-size: 20px;
            text-align: center;
            margin: 0px;
        }     
        .preview_box img {
          width: 200px;
        }
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
    </style>

    

    <div id="header" style="background-color: #98FB98; padding: 5px; margin: 0;" >
        <h1 style="text-align: center;">管理我的图书</h1>        
    </div>

    <ul class="upper_navigation">
        <li class="upper_navigation"><a href="search_by_name">书目检索</a></li>
        <li class="upper_navigation"><a href="boolean_search">高级检索</a></li>
    <?php
        if(isset($_COOKIE['customer_name'])){
            echo '<li class="upper_navigation" style="float: right;"><a href="admin_logout.php">退出登录</a></li>';
            echo '<li class="upper_navigation" style="float: right;"><a href="book_manage.php">管理我的图书</a></li>';
            echo '<li class="upper_navigation" style="float: right;"><a href="shoppingcart.php">我的购物车</a></li>';
            echo '<li class="upper_navigation" style="float: right;"><a href="">您好，'.$_COOKIE['customer_name'].'</a></li>';
        }
        else{
            echo '<li class="upper_navigation" style="float: right;"><a href="admin_login">登录</a></li>';
            echo '<li class="upper_navigation" style="float: right;"><a href="admin_userregister">注册</a></li>';
        }
    ?>
    </ul>

    <div class="content_odd" style="background-color: orange; text-align: center;">
        <h2>您所出售的图书</h2>
    </div>
    <div class="content_odd" style="background-color: orange; text-align: center;">
        <p>ISBN</p>
        <p>书名</p>
        <p>作者</p>
        <p>出版社</p>
        <p>上架数量</p>
        <p>定价</p>
    </div>
    <?php
    error_reporting(0);

    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $sqlname = $_COOKIE['sqlname'];
    $cid = $_COOKIE['customer_id'];
    $mysqli = new mysqli('localhost', $username, $password, $sqlname);
    $mysqli->query('set names utf8') or die('query字符集错误');

    $sql = 'SELECT wbook, wnumber, wprice FROM warehouse WHERE wowner ="'.$cid.'"';
    $result = $mysqli->query($sql, MYSQLI_STORE_RESULT);
    $i = 0;
    while(list($isbn, $number, $price) = $result -> fetch_row()){
        $i = ($i + 1) % 2;
        $book_sql = 'SELECT bname, bpress, bauthor FROM bookall WHERE bISBN = "'.$isbn.'"';
        $book_result = $mysqli->query($book_sql, MYSQLI_STORE_RESULT);
        list($name, $press, $author) = $book_result -> fetch_row();
        if($i == 1){$class = 'content_odd';}
        else {$class = 'content_even';}
        echo '<div class="'.$class.'">
        <p>'.$isbn.'</p>
        <p>'.$name.'</p>
        <p>'.$author.'</p>
        <p>'.$press.'</p>
        <p><input name="number" class="box" type="number" required="required" min="1" max="" value="'.$number.'"></p>
        <p><input name="price" class="box" type="number" required="required" min="0" max="" value="'.$price.'"></p>
        </div>';  
    }
    ?>
    <div style="width: 100%; text-align: center; margin-top: 30px; display: inline-block;">
        <button id="submit" onclick="submit()">提交</button>
    </div>
    </body>

    <script type="text/javascript">
    function submit(){
        var input_list = document.getElementsByTagName('input');
        var expression = '<form id="requestFrom" action="book_manage_update" method="post">';
        for(var i = 0; i < input_list.length; i += 2){
            var number = input_list[i].value;
            var price = input_list[i + 1].value;
            expression += '<input name="number' + i + '" value="' + number + '">'
            expression += '<input name="price' + i + '" value="' + price + '">'
        }
        expression += '<input type="submit"></form>'
        console.log(expression);
        document.write(expression);
        document.forms['requestFrom'].submit();
    }
    </script>
</html>