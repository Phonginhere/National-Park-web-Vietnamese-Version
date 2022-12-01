<!DOCTYPE html><?php include_once $_SERVER["DOCUMENT_ROOT"].'/configs.php'; ?>
<!-- saved from url=(0050)http://p.w3layouts.com/demos/purple_loginform/web/ -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- tích hợp css và js của các thành phần giao diện cũ
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
<link href="/ui/adminlogin/flat_003/layout-adminlogin_files/css" rel="stylesheet" type="text/css">
<link href="/ui/adminlogin/flat_003/layout-adminlogin_files/style.css" rel="stylesheet" type="text/css" media="all">

<script src="/ui/src/js/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="/ui/src/css/bootstrap/3.1.0/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/ui/src/css/bootstrap/less-1.7.4.min.js"></script>


<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 
<!-- -->
<script src="/ui/adminlogin/flat_003/layout-adminlogin_files/ca-pub-9153409599391170.js"></script><script async="" src="/ui/adminlogin/flat_003/layout-adminlogin_files/analytics.js"></script><script>var __links = document.querySelectorAll('a');function __linkClick(e) { parent.window.postMessage(this.href, '*');} ;for (var i = 0, l = __links.length; i < l; i++) {if ( __links[i].getAttribute('data-t') == '_blank' ) { __links[i].addEventListener('click', __linkClick, false);}}</script>
  <script src="/ui/adminlogin/flat_003/layout-adminlogin_files/jquery.min.js"></script>

<script>$(document).ready(function(c) {
	$('.alert-close').on('click', function(c){
		$('.message').fadeOut('slow', function(c){
	  		$('.message').remove();
		});
	});	  
});
</script>
</head>
<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-30027142-1', 'w3layouts.com');
  ga('send', 'pageview');
</script>
<script async="" type="text/javascript" src="/ui/adminlogin/flat_003/layout-adminlogin_files/fancybar.js" id="_fancybar_js"></script>



<!-- contact-form -->	
<div class="message warning">
<div class="inset">
	<div class="login-head">
		<!-- <h1>Admin Login Form</h1> -->
		<h1>Đăng Nhập Quản Trị</h1>
		 <div class="alert-close"> </div> 			
	</div>
	
		<form action="/admin-login.php" method="post" enctype="multipart/form-data">
        <?php if ($_SESSION["ERROR_TEXT"]) { ?>
	    <div class="alert alert-danger">
	    	<div style="float: left;">
	    		<i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION["ERROR_TEXT"]; ?>
	    	</div>
	        <button type="button" class="close" data-dismiss="alert" style="float: right;display: block;width: 1em;margin: 0">&times;</button>
	        <br style="clear:both"/>
	    </div>
	<?php } $_SESSION["ERROR_TEXT"] = null; ?>
	        <ul>
			<li>
				<input type="text" class="text" name="username" value="<?php echo $_SESSION['FAILED_USERNAME'];?>" onfocus="this.value = &#39;&#39;;" onblur="if (this.value == &#39;&#39;) {this.value = &#39;Tên đăng nhập&#39;;}"><a href="#" class="icon user"></a>
			</li>
				
			<li>
				<input type="password" name="password" value="<?php echo $_SESSION['FAILED_PASSWORD'];?>"  onfocus="this.value = &#39;&#39;;" onblur="if (this.value == &#39;&#39;) {this.value = &#39;Mật khẩu&#39;;}"> <a href="#" class="icon lock"></a>
			</li>
			</ul>
			<div class="clear"> </div>
			<div class="submit">
				<input type="submit" onclick="myFunction()" value="Đăng Nhập">
				<h4><a href="http://p.w3layouts.com/demos/purple_loginform/web/#">Quên mật khẩu ?</a></h4>
						  <div class="clear">  </div>	
			</div>
				
		</form>
		</div>					
	</div>
	
	<div class="clear"> </div>
	<!---728x90--->
<div style="text-align: center;">

</div>
<!--- footer --->
<div class="footer">
	<p> Copyright © <?php echo date('Y')?> <?php echo web_name();?>. All Rights Reserved.</p>
</div>
<!---728x90--->
<div style="text-align: center;"></div>

</body></html>