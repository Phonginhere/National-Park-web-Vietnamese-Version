<!DOCTYPE html><?php include_once $_SERVER["DOCUMENT_ROOT"].'/configs.php'; ?>
<html lang="en">
<head>
	<title><?php echo $web_title;?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link href="<?php echo web_icon_url(); ?>" rel="icon">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/ui/adminlogin/colorlib_v16/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/ui/adminlogin/colorlib_v16/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/ui/adminlogin/colorlib_v16/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/ui/adminlogin/colorlib_v16/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/ui/adminlogin/colorlib_v16/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/ui/adminlogin/colorlib_v16/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/ui/adminlogin/colorlib_v16/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/ui/adminlogin/colorlib_v16/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/ui/adminlogin/colorlib_v16/css/util.css">
	<link rel="stylesheet" type="text/css" href="/ui/adminlogin/colorlib_v16/css/main.css">
<!--===============================================================================================-->

<!--===============================================================================================-->
	<script href="/ui/adminlogin/colorlib_v16/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script href="/ui/adminlogin/colorlib_v16/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script href="/ui/adminlogin/colorlib_v16/vendor/bootstrap/js/popper.js"></script>
	<script href="/ui/adminlogin/colorlib_v16/vendor/bootstrap/js/bootstrap.min.js"></script>
</head>
<!-- https://colorlib.com/wp/template/login-form-v20/ -->
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('/ui/adminlogin/colorlib_v16/images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Account Login
				</span>
				<!-- https://stackoverflow.com/questions/31343096/bootstrap-alert-not-closing-on-clicking-the-x-button -->
				  <?php if ($_SESSION["ERROR_TEXT"]) { ?>
					<div class="alert alert-danger alert-dismissible">
						<div style="float: left;">
							<i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION["ERROR_TEXT"]; ?>
						</div>
						<button type="button" class="close" data-dismiss="alert" style="float: right;display: block;width: 1em;margin: 0">&times;</button>
						<br style="clear:both"/>
					</div>
				<?php } $_SESSION["ERROR_TEXT"] = null; ?>
				
				<form class="login100-form validate-form p-b-33 p-t-5" action="/admin-login.php" method="post" enctype="multipart/form-data">

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" placeholder="User name" name="username" value="<?php echo $_SESSION['FAILED_USERNAME'];?>" >
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" placeholder="Password" name="password" value="<?php echo $_SESSION['FAILED_PASSWORD'];?>" >
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script href="/ui/adminlogin/colorlib_v16/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script href="/ui/adminlogin/colorlib_v16/vendor/daterangepicker/moment.min.js"></script>
	<script href="/ui/adminlogin/colorlib_v16/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script href="/ui/adminlogin/colorlib_v16/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script href="/ui/adminlogin/colorlib_v16/js/main.js"></script>

</body>
</html>