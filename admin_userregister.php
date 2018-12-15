
<!DOCTYPE HTML> 
<html>
<head>
<title>注册</title>
<style>
.error {color: #FF0000;}
	h2{
			background-color: AliceBlue;
			padding: 10px;
			text-align:center;
		}
		
	h3{
		text-align:center;
		padding:5px 20px;
		color: #FF0000;
	}
	
</style>

</head>
<body> 

<?php
// 定义变量并设置为空值
$nameErr = $passwordErr =  $password2Err = $sexErr = $phoneErr = "";
$name = $password = $password2 = $sex = $phone = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) {
     $nameErr = "姓名是必填的";
   } else {
     $name = test_input($_POST["name"]);
	 //检查姓名是否包含字母和空白字符
	 if (!preg_match("/^[a-zA-Z ]*$/",$name)){
	   $nameErr = "只允许字母和空格";
		}
   }

   if (empty($_POST["password"])) {
     $password = "";
   } else {
     $password = test_input($_POST["password"]);
   }

   if (empty($_POST["password2"])) {
     $password2 = "";
   } else {
     $password2 = test_input($_POST["password2"]);
	  if ($_POST["password"] != $_POST["password2"]) {
     $password2Err = "两次输入的密码不一致";
   }
   }
 
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2>用户注册</h2>
<h3>* 必需的字段</h3>

<form method="post" action="admin_susregister.php">
 
	<div style="display: flex; justify-content: center;">
   姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名：<input type="text" name="name">
   <span class="error">* <?php echo $nameErr;?></span>
   </div>
   <br>
   
   	<div style="display: flex; justify-content: center;">
   性&nbsp;&nbsp;&nbsp;&nbsp;别：<input type="radio" name="sex" value="male">Male<br>
   <input type="radio" name="sex" value="female">Female<br>
   <span class="error">* <?php echo $sexErr;?></span>
   </div>
   <br>
   
    <div style="display: flex; justify-content: center;">
   电话号码：<input type="text" name="phone">
   <span class="error">* <?php echo $phoneErr;?></span>
   </div>
   <br>
   
   <div style="display: flex; justify-content: center;">
   密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：<input type="password" name="password">
   <span class="error">* <?php echo $passwordErr;?></span>
   </div>
   <br>
   
   <div style="display: flex; justify-content: center;">
   确认密码：<input type="password" name="password2">
   <span class="error">* <?php echo $password2Err;?></span>
   </div>
   <br><br>
   
   <div style="display: flex; justify-content: center;">
   <input type="submit" name="submit" value="注册"> 
   </div>
   
</form>



</body>
</html>
