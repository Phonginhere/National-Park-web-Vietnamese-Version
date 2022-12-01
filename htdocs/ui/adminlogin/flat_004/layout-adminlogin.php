<!DOCTYPE html><?php include_once $_SERVER["DOCUMENT_ROOT"].'/configs.php'; ?>
<!-- saved from url=(0086)http://s.codepen.io/boomerang/a72e486364d56972035c6dacb0143bbb1453869468914/index.html -->
<html class=" js flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

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

<script src="/ui/src/js/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="/ui/src/css/bootstrap/3.1.0/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/ui/src/css/bootstrap/less-1.7.4.min.js"></script>

<script src="/ui/adminlogin/flat_004/layout-adminlogin_files/console_runner-19b53204114bb6697f7c32c3c848fd19.js"></script><meta charset="UTF-8"><meta name="robots" content="noindex"><link rel="canonical" href="http://codepen.io/reidark/pen/uAmey">
<script src="/ui/adminlogin/flat_004/layout-adminlogin_files/modernizr.js" type="text/javascript"></script>


<link rel="stylesheet prefetch" href="http://codepen.io/assets/reset/reset.css"><link rel="stylesheet prefetch" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/ui/adminlogin/flat_004/layout-adminlogin_files/style.css"/>
</head><body>
<form class="login" action="/admin-login.php" method="post" enctype="multipart/form-data">
  <?php if ($_SESSION["ERROR_TEXT"]) { ?>
	    <div class="alert alert-danger">
	    	<div style="float: left;">
	    		<i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION["ERROR_TEXT"]; ?>
	    	</div>
	        <button type="button" class="close" data-dismiss="alert" style="float: right;display: block;width: 1em;margin: 0">&times;</button>
	        <br style="clear:both"/>
	    </div>
	<?php } $_SESSION["ERROR_TEXT"] = null; ?>
  <fieldset>
    
  	<legend class="legend">Admin Login Form</legend>
    
    <div class="input">
    	<input name="username" value="<?php echo $_SESSION['FAILED_USERNAME'];?>" placeholder="Tên đăng nhập" type="text">
      <span style="opacity: 0;"><i class="fa fa-user fa-fw"></i></span>
    </div>
    
    <div class="input">
    	<input name="password" value="<?php echo $_SESSION['FAILED_PASSWORD'];?>" placeholder="Mật khẩu" type="password">
      <span style="opacity: 1;"><i class="fa fa-lock"></i></span>
    </div>
    
    <button type="submit" class="submit"><i class="fa fa-long-arrow-right"></i></button>
    
  </fieldset>
  
  <div class="feedback">
  <!-- 
  	login successful <br>
  	
    redirecting...
    -->
    
    Đang đăng nhập ...
  </div>
  
</form>
<script src="/ui/adminlogin/flat_004/layout-adminlogin_files/stopExecutionOnTimeout.js"></script><script src="/ui/adminlogin/flat_004/layout-adminlogin_files/jquery.min.js"></script>
<script>
$('.input').focusin(function () {
    $(this).find('span').animate({ 'opacity': '0' }, 200);
});
$('.input').focusout(function () {
    $(this).find('span').animate({ 'opacity': '1' }, 300);
});
$('.login').submit(function () {
    $(this).find('.submit i').removeAttr('class').addClass('fa fa-check').css({ 'color': '#fff' });
    $('.submit').css({
        'background': '#2ecc71',
        'border-color': '#2ecc71'
    });
    $('.feedback').show().animate({
        'opacity': '1',
        'bottom': '-80px'
    }, 400);
    $('input').css({ 'border-color': '#2ecc71' });

    //return false;
    return true; // by Phuong
});
//# sourceURL=pen.js
</script>
<script src="/ui/adminlogin/flat_004/layout-adminlogin_files/css_live_reload_init.js"></script>
</body></html>