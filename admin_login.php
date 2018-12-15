
<!DOCTYPE HTML> 
<html>
<head>
<title>登录</title>
<style>
	.error {
		color: #FF0000;
		text-align:center;
	}
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

<h2>登录</h2>
<h3>* 必需的字段</h3>

<form name="form" onsubmit="return validateForm()" method="post" action="admin_login_verification.php" >
   
   <div style="display: flex; justify-content: center;">
   手机号码：<input type="text" name="customer_phone">
   <span id="phone_span" class="error">* </span>
   </div>
   <br><br>
   
   <div style="display: flex; justify-content: center;">
   密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：<input type="password" name="customer_password">
   <span id="password_span" class="error">* </span>
   </div>
   <br><br>
   <div style="display: flex; justify-content: center;">
   <button type="submit" name="submit">登录</button> 
   </div>
</form>
<br><br>
<h3 style="text-align:center;">还未注册？<a href='admin_userregister'>立即注册获取更多信息</a></h3>


<?php 
   if(isset($_POST['error_type'])){
      if($_POST['error_type'] == 'customer_phone_not_found'){
         echo '<span class="error"> · 手机号码不存在！</span>';    
      }
      else if($_POST['error_type'] == 'customer_password_incorrect'){
         echo '<span class="error"> · 密码错误！</span>';
      }
   }
?>

<script type="text/javascript">
   function validateForm(){
      /*验证表单是否填充完全*/
      var legal = 1;    //合法性变量，如果存在不合法的情况就将其改为0
      var phone = document.forms["form"]["customer_phone"].value;
      var password = document.forms["form"]["customer_password"].value;
      if(phone == ""){
         document.getElementById('phone_span').innerHTML = "* 手机号不能为空";
         legal = 0;
      }
      else{
         document.getElementById('phone_span').innerHTML = "*";
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
