
<!DOCTYPE HTML> 
<html>
<head>
<title>登录</title>
<style>
.error {color: #FF0000;}
	h2{
			background-color: AliceBlue;
			padding: 10px;
		}
</style>

</head>
<body> 

<h2>管理员登录</h2>
<p><span class="error">* 必需的字段</span></p>

<form name="form" onsubmit="return validateForm()" method="post" action="admin_login_verification.php" >
   姓名：<input type="text" name="admin_username">
   <span id="username_span" class="error">* </span>
   <br><br>
   密码：<input type="password" name="admin_password">
   <span id="password_span" class="error">* </span>
   <br><br>
   <button type="submit" name="submit">登录</button> 
</form>
<br><br>

<?php 
   if(isset($_POST['error_type'])){
      if($_POST['error_type'] == 'admin_username_not_found'){
         echo '<span class="error"> · 用户名不存在！</span>';    
      }
      else if($_POST['error_type'] == 'admin_password_incorrect'){
         echo '<span class="error"> · 密码错误！</span>';
      }
   }
?>

<script type="text/javascript">
   function validateForm(){
      /*验证表单是否填充完全*/
      var legal = 1;    //合法性变量，如果存在不合法的情况就将其改为0
      var username = document.forms["form"]["username"].value;
      var password = document.forms["form"]["password"].value;
      if(username == ""){
         document.getElementById('username_span').innerHTML = "* 用户名不能为空";
         legal = 0;
      }
      else{
         document.getElementById('username_span').innerHTML = "*";
      }
      if(password == ""){
         document.getElementById('password_span').innerHTML = "* 密码不能为空";
         legal = 0;
      }
      else{
         document.getElementById('password_span').innerHTML = "*";
      }

      if(!legal) return false;
      return true;
   }
</script>



</body>
</html>
