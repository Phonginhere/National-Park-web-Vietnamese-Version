<!DOCTYPE html><?php include_once $_SERVER["DOCUMENT_ROOT"].'/configs.php'; ?>
<!-- saved from url=(0048)http://p.w3layouts.com/demos/login_animated/web/ -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
        
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
        
		<link href="/ui/adminlogin/flat_006/layout-adminlogin_files/style.css" rel="stylesheet" type="text/css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="/ui/adminlogin/flat_006/layout-adminlogin_files/ca-pub-9153409599391170.js"></script><script async src="/ui/adminlogin/flat_006/layout-adminlogin_files/analytics.js"></script><script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!--webfonts-->
		<link href="/ui/adminlogin/flat_006/layout-adminlogin_files/css" rel="stylesheet" type="text/css">
		<!--//webfonts-->
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
<script async type="text/javascript" src="/ui/adminlogin/flat_006/layout-adminlogin_files/fancybar.js" id="_fancybar_js"></script>


	<!---728x90--->
<div style="text-align: center;"><script async src="/ui/adminlogin/flat_006/layout-adminlogin_files/adsbygoogle.js"></script>
<ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-9153409599391170" data-ad-slot="6850850687" data-adsbygoogle-status="done"><ins id="aswift_0_expand" style="display:inline-table;border:none;height:90px;margin:0;padding:0;position:relative;visibility:visible;width:728px;background-color:transparent"><ins id="aswift_0_anchor" style="display:block;border:none;height:90px;margin:0;padding:0;position:relative;visibility:visible;width:728px;background-color:transparent"><iframe width="728" height="90" frameborder="0" marginwidth="0" marginheight="0" vspace="0" hspace="0" allowtransparency="true" scrolling="no" allowfullscreen="true" onload="var i=this.id,s=window.google_iframe_oncopy,H=s&amp;&amp;s.handlers,h=H&amp;&amp;H[i],w=this.contentWindow,d;try{d=w.document}catch(e){}if(h&amp;&amp;d&amp;&amp;(!d.body||!d.body.firstChild)){if(h.call){setTimeout(h,0)}else if(h.match){try{h=s.upd(h,i)}catch(e){}w.location.replace(h)}}" id="aswift_0" name="aswift_0" style="left:0;position:absolute;top:0;"></iframe></ins></ins></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script></div>
				 <!-----start-main---->
				<div class="login-form">
				
					<div class="head">
						<img src="/ui/adminlogin/flat_006/layout-adminlogin_files/mem2.jpg" alt="">
						
					</div>
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
                
					<li>
						<input name="username" type="text" class="text" value="<?php echo $_SESSION['FAILED_USERNAME'];?>" onfocus="this.value = &#39;&#39;;" onblur="if (this.value == &#39;&#39;) {this.value = &#39;USERNAME&#39;;}"><a href="http://p.w3layouts.com/demos/login_animated/web/#" class=" icon user"></a>
					</li>
					<li>
						<input name="password" type="password" value="<?php echo $_SESSION['FAILED_PASSWORD'];?>" onfocus="this.value = &#39;&#39;;" onblur="if (this.value == &#39;&#39;) {this.value = &#39;Password&#39;;}"><a href="http://p.w3layouts.com/demos/login_animated/web/#" class=" icon lock"></a>
					</li>
					<div class="p-container">
						<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Remember Me</label>
						<input type="submit" onclick="myFunction()" value="Đăng Nhập">
						<div class="clear"> </div>
					</div>
				</form>
			</div>
			<!--//End-login-form-->
			<!---728x90--->
<div style="text-align: center;"><script async src="/ui/adminlogin/flat_006/layout-adminlogin_files/adsbygoogle.js"></script>
<ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-9153409599391170" data-ad-slot="6850850687" data-adsbygoogle-status="done"><ins id="aswift_1_expand" style="display:inline-table;border:none;height:90px;margin:0;padding:0;position:relative;visibility:visible;width:728px;background-color:transparent"><ins id="aswift_1_anchor" style="display:block;border:none;height:90px;margin:0;padding:0;position:relative;visibility:visible;width:728px;background-color:transparent"><iframe width="728" height="90" frameborder="0" marginwidth="0" marginheight="0" vspace="0" hspace="0" allowtransparency="true" scrolling="no" allowfullscreen="true" onload="var i=this.id,s=window.google_iframe_oncopy,H=s&amp;&amp;s.handlers,h=H&amp;&amp;H[i],w=this.contentWindow,d;try{d=w.document}catch(e){}if(h&amp;&amp;d&amp;&amp;(!d.body||!d.body.firstChild)){if(h.call){setTimeout(h,0)}else if(h.match){try{h=s.upd(h,i)}catch(e){}w.location.replace(h)}}" id="aswift_1" name="aswift_1" style="left:0;position:absolute;top:0;"></iframe></ins></ins></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script></div>
		  <!-----start-copyright---->
   					<div class="copy-right">
						<p> Copyright © <?php echo date('Y')?> <?php echo web_name() ;?>. All Rights Reserved.</p>
					</div>
					<!---728x90--->
<div style="text-align: center;"><script async src="/ui/adminlogin/flat_006/layout-adminlogin_files/adsbygoogle.js"></script>
<ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-9153409599391170" data-ad-slot="6850850687" data-adsbygoogle-status="done"><ins id="aswift_2_expand" style="display:inline-table;border:none;height:90px;margin:0;padding:0;position:relative;visibility:visible;width:728px;background-color:transparent"><ins id="aswift_2_anchor" style="display:block;border:none;height:90px;margin:0;padding:0;position:relative;visibility:visible;width:728px;background-color:transparent"><iframe width="728" height="90" frameborder="0" marginwidth="0" marginheight="0" vspace="0" hspace="0" allowtransparency="true" scrolling="no" allowfullscreen="true" onload="var i=this.id,s=window.google_iframe_oncopy,H=s&amp;&amp;s.handlers,h=H&amp;&amp;H[i],w=this.contentWindow,d;try{d=w.document}catch(e){}if(h&amp;&amp;d&amp;&amp;(!d.body||!d.body.firstChild)){if(h.call){setTimeout(h,0)}else if(h.match){try{h=s.upd(h,i)}catch(e){}w.location.replace(h)}}" id="aswift_2" name="aswift_2" style="left:0;position:absolute;top:0;"></iframe></ins></ins></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script></div>
				<!-----//end-copyright---->
		 		

</body></html>