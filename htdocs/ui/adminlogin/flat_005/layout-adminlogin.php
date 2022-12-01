<!DOCTYPE html><?php include_once $_SERVER["DOCUMENT_ROOT"].'/configs.php'; ?>
<html class=""><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<meta name="robots" content="noindex"><link rel="canonical" href="http://codepen.io/petertoth/pen/BtGkp">

<!-- 
tích hợp css và js của các thành phần giao diện cũ
ví dụ: alert báo lỗi đăng nhập  cần css và js cũ 

-->
<title><?php echo $web_title;?></title>
<link href="<?php echo web_icon_url(); ?>" rel="icon">

<link href="/ui/src/css/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet/less">
<!-- Đoạn mã này hay gây lỗi 
<link href="/ui/src/js/admin/bootstrap/less/bootstrap.less" rel="stylesheet/less">

 -->
<link href="/ui/src/css/bootstrap/normalize.css" rel="stylesheet/less" id="less:admin-view-javascript-bootstrap-less-bootstrap">
<link href="/ui/src/css/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">

<script src="/ui/src/js/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="/ui/src/css/bootstrap/3.1.0/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/ui/src/css/bootstrap/less-1.7.4.min.js"></script>

<style class="cp-pen-styles">@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,700);
/*@import url(https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css);*/
/*@import url(https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css);*/
* {
  margin: 0;
  padding: 0;
}

html {
  background: url(/ui/adminlogin/flat_005/layout-adminlogin_files/vai-tro-cua-rung.jpg) no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  
}

body {
  background: transparent;
  
}

body, input, button {
  font-family: 'Source Sans Pro', sans-serif;
}

.login {
  padding: 15px;
  width: 400px;
  min-height: 400px;
  margin: 2% auto 0 auto;
}
.login .heading {
  text-align: center;
  margin-top: 50%; /* đưa form đăng nhập ra giữa màn hình */
}
.login .heading h2 {
  font-size: 3em;
  font-weight: 300;
  color: /*rgba(255, 255, 255, 0.7)*/ yellow;
  display: inline-block;
  padding-bottom: 5px;
  text-shadow: 1px 1px 3px #23203b;
}
.login form .input-group {
  border-bottom: 1px solid rgba(255, 255, 255, 0.1) ;
  border-top: 1px solid rgba(255, 255, 255, 0.1) ;
}
.login form .input-group:last-of-type {
  border-top: none;
}
.login form .input-group span {
  background: transparent;
  min-width: 53px;
  border: none;
}
.login form .input-group span i {
  font-size: 1.5em;
  color: /*rgba(255, 255, 255, 0.2)*/ grey;
}
.login form input.form-control {
  display: block;
  width: auto;
  height: auto;
  border: none;
  outline: none;
  box-shadow: none;
  background: none;
  border-radius: 0px;
  padding: 10px;
  font-size: 1.6em;
  width: 100%;
  background: transparent;
  color: #c2b8b1;
}
.login form input.form-control:focus {
  border: none;
  
}
.login form button {
  margin-top: 20px;
  background: #27AE60;
  border: none;
  font-size: 1.6em;
  font-weight: 300;
  padding: 5px 0;
  width: 100%;
  border-radius: 3px;
  color: /* #b3eecc */black;
  border-bottom: 4px solid #1e8449;
}
.login form button:hover {
  background: #2fb166;
  -webkit-animation: hop 1s;
  animation: hop 1s;
}

.float {
  display: inline-block;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-property: transform;
  transition-property: transform;
  -webkit-transform: translateZ(0);
  transform: translateZ(0);
  box-shadow: 0 0 1px transparent;
}

.float:hover, .float:focus, .float:active {
  -webkit-transform: translateY(-3px);
  transform: translateY(-3px);
}

/* Large Devices, Wide Screens */
@media only screen and (max-width: 1200px) {
  .login {
    width: 600px;
    font-size: 2em;
  }
}
@media only screen and (max-width: 1100px) {
  .login {
    margin-top: 2%;
    width: 600px;
    font-size: 1.7em;
  }
}
/* Medium Devices, Desktops */
@media only screen and (max-width: 992px) {
  .login {
    margin-top: 1%;
    width: 550px;
    font-size: 1.7em;
    min-height: 0;
  }
}
/* Small Devices, Tablets */
@media only screen and (max-width: 768px) {
  .login {
    margin-top: 0;
    width: 500px;
    font-size: 1.3em;
    min-height: 0;
  }
}
/* Extra Small Devices, Phones */
@media only screen and (max-width: 480px) {
  .login {
    margin-top: 0;
    width: 400px;
    font-size: 1em;
    min-height: 0;
  }
  .login h2 {
    margin-top: 0;
  }
}
/* Custom, iPhone Retina */
@media only screen and (max-width: 320px) {
  .login {
    margin-top: 0;
    width: 200px;
    font-size: 0.7em;
    min-height: 0;
  }
}

</style></head><body>
<div class="login">
  <div class="heading">
    <h2>Admin Login Form</h2>
    <form action="/admin-login.php" method="post" enctype="multipart/form-data">
		
	<?php if ($_SESSION["ERROR_TEXT"]) { ?>
	    <div class="alert alert-danger"><!-- Dùng biện pháp tinh chỉnh khi bê các thành phần giao diện từ thiết kế cũ sang thiết kế mới -->
	    	<div style="float: left;">
	    		<i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION["ERROR_TEXT"]; ?>
	    	</div>
	        <button type="button" class="close" data-dismiss="alert" style="float: right;display: block;width: 1em;margin: 0">&times;</button>
	        <br style="clear:both"/>
	    </div>
	<?php } $_SESSION["ERROR_TEXT"] = null; ?>
	      
      <div class="input-group input-group-lg">
       <span class="input-group-addon"><i class="fa fa-user"></i></span>
       <input name="username" value="<?php echo $_SESSION['FAILED_USERNAME'];?>" class="form-control" placeholder="Username" type="text" >
      </div>

      <div class="input-group input-group-lg">
        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
        <input name="password" value="<?php echo $_SESSION['FAILED_PASSWORD'];?>" class="form-control" placeholder="Password" type="password" >
      </div>

     <button type="submit" class="float" style="width: 50%;">Sign In</button>
    </form>
    <p style="margin-top: 200px;color: white;">Copyright © <?php echo date('Y')?> <?php echo web_name() ;?>. All Rights Reserved.</p>
   </div>
   
   
 </div>
 <footer>
 	
 </footer>

<script src="/ui/adminlogin/flat_005/layout-adminlogin_files/css_live_reload_init.js"></script>
</body></html>