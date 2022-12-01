<!DOCTYPE html><?php include_once $_SERVER["DOCUMENT_ROOT"].'/configs.php'; ?>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<meta name="description" content="A clean login and registration template based on Bootstrap framework">
<meta name="author" content="">
<!-- <link rel="shortcut icon" href="http://swoopthemes.com/templates/logg/assets/ico/favicon.ico"> -->
<title><?php echo $web_title;?></title>
<link href="<?php echo web_icon_url(); ?>" rel="icon">

<link href="/ui/src/css/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet/less">
<!-- Đoạn mã này hay gây lỗi 
<link href="/ui/src/js/admin/bootstrap/less/bootstrap.less" rel="stylesheet/less">
 -->
<link href="/ui/src/css/bootstrap/normalize.css" rel="stylesheet/less" id="less:admin-view-javascript-bootstrap-less-bootstrap">
<link href="/ui/src/css/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">
<!-- Bootstrap core CSS -->
<link href="/ui/adminlogin/flat_000/layout-adminlogin_files/bootstrap.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="/ui/adminlogin/flat_000/layout-adminlogin_files/custom.css" rel="stylesheet">
<link href="/ui/adminlogin/flat_000/layout-adminlogin_files/font-awesome.css" rel="stylesheet">
<link media="screen" rel="stylesheet" href="/ui/adminlogin/flat_000/layout-adminlogin_files/css.css">
			
<script src="/ui/src/js/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="/ui/src/css/bootstrap/3.1.0/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/ui/src/css/bootstrap/less-1.7.4.min.js"></script>



			<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
			<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
			<![endif]-->
		</head>

		<body>
			<div id="mainWrap">
			<div id="loggit">
				<h1><i class="fa fa-lock"></i> Đăng Nhập</h1>
				<!-- <h3>Bạn vui lòng <strong>đăng nhập</strong></h3> -->

				<form action="#" id="logForm" method="post" class="form-horizontal">
					<?php if ($_SESSION["ERROR_TEXT"]) { ?>
		             <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION["ERROR_TEXT"]; ?>
		               <button type="button" class="close" data-dismiss="alert">&times;</button>
		             </div>
		             <?php } $_SESSION["ERROR_TEXT"] = null; ?>
					<div class="form-group">
						<div class="col-xs-12">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
								<input name="username" class="form-control input-lg" placeholder="Tên đăng nhập" autocomplete="off" type="text">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
								<input name="password" class="form-control input-lg" placeholder="Mật khẩu" autocomplete="off" type="password">
							</div>
						</div>
					</div>
					<div class="form-group formSubmit">
						<div class="col-sm-7">
							<div class="checkbox">
								<label>
									<input checked="checked" autocomplete="off" type="checkbox"> Keep me logged in
								</label>
							</div>
						</div>
						<div class="col-sm-5 submitWrap">
							<button type="submit" class="btn btn-primary btn-lg">Đăng nhập</button>
						</div>
					</div>
					<!--
					<div class="form-group formNotice">
						<div class="col-xs-12">
							<p class="text-center">Don't have an account? <span>Register now</span></p>
						</div>
					</div>
					-->
				</form>
				<form action="#" id="regForm" method="post" class="form-horizontal">
					<div class="form-group">
						<div class="col-xs-12">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
								<input class="form-control input-lg" placeholder="Username" autocomplete="off" type="text">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
								<input class="form-control input-lg" placeholder="Email" autocomplete="off" type="text">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
								<input class="form-control input-lg" placeholder="Password" autocomplete="off" type="password">
							</div>
						</div>
					</div>
					<div class="form-group formSubmit">
						<div class="col-sm-7">
							<div class="checkbox">
								<label>
									<input autocomplete="off" type="checkbox"> I agree to the Terms &amp; Conditions
								</label>
							</div>
						</div>
						<div class="col-sm-5 submitWrap">
							<button type="submit" class="btn btn-success btn-lg">Register</button>
						</div>
					</div>
					<div class="form-group formNotice">
						<div class="col-xs-12">
							<p class="hasAccount text-center">Already have an account? <span>Log in here</span></p>
						</div>
					</div>
				</form>
			</div>

			</div>
			<footer class="clearfix">
				<p>Copyright © <?php echo date('Y')?> <?php echo web_name() ;?>. All Rights Reserved.</p>
			</footer>


			<!-- Bootstrap core JavaScript
			================================================== -->
			<!-- Placed at the end of the document so the pages load faster -->
			<script src="/ui/adminlogin/flat_000/layout-adminlogin_files/jquery.js"></script>
			<script src="/ui/adminlogin/flat_000/layout-adminlogin_files/bootstrap.js"></script>
			
			<script type="text/javascript">
				$(document).ready(function() {
					
					$('.formNotice span').click(function() {
						$("#logForm").toggle();
						$("#regForm").toggle();
					});
					
						
				});
			</script>
	
		
</body></html>