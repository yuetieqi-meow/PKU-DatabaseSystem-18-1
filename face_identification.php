<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>正在识别您的信息……</title>
    <style type="text/css">
        div.container{
            width: 100%;
            margin-top: 100px;
            text-align: center;
        }
        div.footer{
            width: 100%;
            height: 200px;
            background-color: #AAA;
            position: absolute;
            top: 900px;
            left: 0px;
            text-align: center;
        }
        div.identify_background{
            width: 300px;
            height: 350px;
            background-color: rgba(100,100,100,0.8);
            display: inline-block;
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
        #success, #fail{
            position: absolute;
            display: none;
            margin-top: 100px;
            margin-left: 40px;
            background-color: rgba(100,100,100,0.0);
            text-align: center;
        }
        #success h1{
            color: green;
            display: inline-block;
        }
        #fail h1{
            color: red;
            display: inline-block;
        }
    </style>

</head>
<body background="images/forest.jpg" style="background-repeat:no-repeat">

    <div id="header" style="background-color: #98FB98; padding: 5px;" >
        <h1 style="text-align: center;">滴滴打书 · 管理员登录</h1>      
    </div>

    <div class="container">
        <div class="identify_background">

            <div id="success">
                <h1>识别成功</h1>
            </div>

            <div id="fail">
                <h1>识别失败</h1>
            </div>

            <img src="images/figure.jpg" style="margin-top: 50px;">
            <p style="font-size: 20px;">正在识别面容信息<br>请双眼直视摄像头</p>
        </div>
    </div>

    <div class="footer">
    <div>
        <p><b>联系我们</b></p>
        <a href="leavemessage.php"><p>留言给管理员</p></a>
        <a href="face_identification.php"><p>管理员登录</p></a>
    </div>
</div>
</body>

<script>
    var valid = 0;

    document.onkeypress=function()  
    {   
          if (event.keyCode == 32)   
          {   
            valid = 1;
            console.log('space');
          }   
    }   

    setTimeout(identify, 2000);
    function identify(){
        console.log('here');
        if(valid){
            success = document.getElementById('success');
            success.style.display = "inline-block";
        }
        else{
            fail = document.getElementById('fail');
            fail.style.display = "inline-block";
        }
    }

    setTimeout(navigate, 3000);
    function navigate(){
        if(valid){
            window.location.href = "admin_book_manage";
        }
        else{
            window.location.href = "search_by_name";
        }
    }



</script>
</html>