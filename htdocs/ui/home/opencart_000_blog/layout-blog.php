<!DOCTYPE HTML><?php include_once $_SERVER["DOCUMENT_ROOT"].'/configs.php'; ?>
<!-- saved from url=(0026)https://demo.opencart.com/ -->
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<HTML lang="en" dir="ltr"><!-- HTML Design Template: https://demo.opencart.com -->
<!--<![endif]-->

<HEAD>
    <META content="IE=11.0000" http-equiv="X-UA-Compatible">

    <META charset="UTF-8">
    <META name="viewport" content="width=device-width, initial-scale=1">
    <TITLE><?php echo $web_title;?></TITLE>
    <!-- <LINK href="https://demo.opencart.com/image/catalog/cart.png" rel="icon"> -->
    <LINK href="<?php echo web_icon_url();?>" rel="icon">
    <META name="description" content="The OpenCart demo store">
    <META name="keywords" content="opencart,demo,store,ecommerce">
    <META http-equiv="X-UA-Compatible" content="IE=edge">
    
    
    <LINK href="/ui/home/opencart_000_blog/template_files/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen">
    <LINK href="/ui/home/opencart_000_blog/template_files/font-awesome.min.css" rel="stylesheet" type="text/css" media="screen">
    <LINK href="/ui/home/opencart_000_blog/template_files/css.css" rel="stylesheet" rel="stylesheet" type="text/css" media="screen">
    <LINK href="/ui/home/opencart_000_blog/template_files/stylesheet.css" rel="stylesheet" type="text/css" media="screen">
    <LINK href="/ui/home/opencart_000_blog/template_files/flexslider.css" rel="stylesheet" type="text/css" media="screen">
    <link href="/ui/src/js/jquery/plugins/magnific/magnific-popup.css" rel="stylesheet" type="text/css" media="screen">
	<link href="/ui/src/js/jquery/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" media="screen">
	<link href="/ui/src/js/jquery/plugins/owl-carousel/owl.transitions.css" rel="stylesheet" type="text/css" media="screen">
	<link href="/ui/src/css/common-home.css" rel="stylesheet" type="text/css" media="screen">
    
    <SCRIPT src="/ui/home/opencart_000_blog/template_files/jquery-2.1.1.min.js" type="text/javascript"></SCRIPT>
    <SCRIPT src="/ui/home/opencart_000_blog/template_files/bootstrap.min.js" type="text/javascript"></SCRIPT>
    <SCRIPT src="/ui/home/opencart_000_blog/template_files/common.js" type="text/javascript"></SCRIPT>
    <SCRIPT src="/ui/home/opencart_000_blog/view/cart.js" type="text/javascript"></SCRIPT>
    <SCRIPT src="/ui/home/opencart_000_blog/template_files/jquery.flexslider-min.js" type="text/javascript"></SCRIPT>
	<script src="/ui/src/js/jquery/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
	<!-- thư viện javascript cho xem slide ảnh chi tiết sản phẩm: -->
	<script src="/ui/src/js/jquery/plugins/magnific/jquery.magnific-popup.min.js" type="text/javascript"></script>
	

	
    <META name="GENERATOR" content="MSHTML 11.00.9600.16384">
</HEAD>

<BODY class="common-home">
    <NAV id="top">
        <DIV class="container">
        <!-- 
        	<DIV class="nav pull-left" id="top-links">
                <DIV id="logo">
                        <A href="/home-blog.php">
                            <IMG height="32" width="32" title="<?php echo web_name(); ?>" class="img-responsive" alt="<?php echo web_name(); ?>" src="<?php echo web_logo_url(); ?>">
                        </A>
                </DIV>
            </DIV>
            -->
            
            <DIV class="nav pull-right" id="top-links">
                <UL class="list-inline">
                    <LI>
                        <A href="#"><I class="fa fa-phone"></I></A>
                        <SPAN class="hidden-xs hidden-sm hidden-md"><?php echo web_telephone(); ?></SPAN>
                    </LI>
                    <LI class="dropdown">
                        <?php if (isset ($_SESSION['CUS_LOGGED'])) { ?>
                        <A title="My Account" class="dropdown-toggle" href="/account.php" data-toggle="dropdown">
                        	<I class="fa fa-user"></I> <SPAN class="hidden-xs hidden-sm hidden-md"><?php echo $_SESSION['CUS_FULLNAME'] ?></SPAN> <SPAN class="caret"></SPAN>
                        </A>
                        <UL class="dropdown-menu dropdown-menu-right">
                            <li>
                            	<a href="/order-history.php"><i class="fa fa-list"></i>&nbsp;Lịch Sử Đơn Hàng</a>
                            </li>
                            <li><a href="/logout.php"><i class="fa fa-sign-out"></i>&nbsp;Đăng Thoát</a></li>
                        </UL>
                        <?php } else {?>
                        <A title="My Account" class="dropdown-toggle" href="/account.php" data-toggle="dropdown"><I class="fa fa-user"></I> <SPAN class="hidden-xs hidden-sm hidden-md">Tài Khoản</SPAN> <SPAN class="caret"></SPAN></A>
                        <UL class="dropdown-menu dropdown-menu-right">
                            <LI>
                                <A href="/register.php"><i class="fa fa-user"></i>&nbsp;Đăng Kí</A>
                            </LI>
                            <LI>
                                <A href="/login.php"><i class="fa fa-lock"></i>&nbsp;Đăng Nhập</A>
                            </LI>
                        </UL>                        
                        <?php } ?>
                    </LI>
                    
                    <!-- Tạm thời giấu đi web bán hàng khi làm web blog
                    <LI>
                        <A title="Shopping Cart" href="/cart.php"><I class="fa fa-shopping-cart"></I> <SPAN class="hidden-xs hidden-sm hidden-md">Giỏ Hàng</SPAN></A>
                    </LI>
                    <LI>
                        <A title="Checkout" href="/checkout.php"><I class="fa fa-share"></I> <SPAN class="hidden-xs hidden-sm hidden-md">Thanh Toán</SPAN></A>
                    </LI>
                    <LI>
                        <A title="Compare Products" href="/product-compare.php"><I class="fa fa-exchange"></I> <SPAN class="hidden-xs hidden-sm hidden-md">So Sánh Sản Phẩm</SPAN></A>
                    </LI>
                    -->
                </UL>
            </DIV>
        </DIV>
    </NAV>
    <HEADER>
        <DIV class="container">
            <DIV class="row">
             <DIV class="col-sm-4">
                    <DIV id="logo">
                        <A href="/home-blog.php">
                            <IMG height="64" width="64" title="<?php echo web_name(); ?>" class="img-responsive" alt="<?php echo web_name(); ?>" src="<?php echo web_logo_url(); ?>">
                        </A>
                    </DIV>
                </DIV>
                
            	<DIV class="col-sm-3">
                    <DIV class="input-group" id="search">
                        <INPUT name="search-post" class="form-control input-lg" type="text" placeholder="Tìm bài viết..." value="">
                        <SPAN class="input-group-btn"><BUTTON class="btn btn-default btn-lg" type="button"><I class="fa fa-search"></I></BUTTON> </SPAN> </DIV>
                </DIV>
                
            	<!-- Tạm thời giấu đi giao diện Web Bán Hàng khi làm Web Blog
                <DIV class="col-sm-4">
                    <DIV id="logo">
                        <A href="/">
                            <IMG height="64" width="64" title="<?php echo web_name(); ?>" class="img-responsive" alt="<?php echo web_name(); ?>" src="<?php echo web_logo_url(); ?>">
                        </A>
                    </DIV>
                </DIV>
                <DIV class="col-sm-5">
                    <DIV class="input-group" id="search">
                        <INPUT name="search-post" class="form-control input-lg" type="text" placeholder="Tìm bài viết..." value="">
                        <SPAN class="input-group-btn"><BUTTON class="btn btn-default btn-lg" type="button"><I class="fa fa-search"></I></BUTTON> </SPAN> </DIV>
                </DIV>
                <DIV class="col-sm-3">
                    <?php include_once "view/view-cart.php";?>
                </DIV>
                -->
                
            </DIV>
        </DIV>
    </HEADER>
    <DIV class="container">
        <NAV class="navbar" id="menu">
            <DIV class="navbar-header">
                <SPAN class="visible-xs" id="category">Danh Mục</SPAN>
                <BUTTON class="btn btn-navbar navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-ex1-collapse"><I 
class="fa fa-bars"></I></BUTTON> </DIV>
            <DIV class="collapse navbar-collapse navbar-ex1-collapse">
            	<ul class="nav navbar-nav">
				  <li><a href="/home-blog.php">Trang Chủ</a></li>
				  
					<!-- Menu bài viết (chưa cần cho Blog Music, Origami)-->
					<!-- 
				    <?php foreach (postGetAllForMenuHomePage() as $post) { ?>
			        <?php if ($post['children']) { ?>
			        <li class="dropdown">
			          <a href="<?php echo $post['href']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $post['menu']; ?>&nbsp;<i class="fa fa-angle-down"></i></a>
			          <div class="dropdown-menu">
			            <div class="dropdown-inner">
			              <?php foreach (array_chunk($post['children'], ceil(count($post['children']) / $post['column'])) as $children) { ?>
			              <ul class="list-unstyled">
			                <?php foreach ($children as $child) { ?>
			                <li><a href="<?php echo $child['href']; ?>"><?php echo $child['menu']; ?></a></li>
			                <?php } ?>
			              </ul>
			              <?php } ?>
			            </div>
			            <a href="<?php echo $post['href']; ?>" class="see-all">Xem tất <?php echo $post['menu']; ?></a> </div>
			        </li>
			        <?php } else { ?>
			        <li><a href="<?php echo $post['href']; ?>"><?php echo $post['menu']; ?></a></li>
			        <?php } ?>
			      <?php } ?>
				   -->
				   
				  <!-- Menu loại bài viết -->
			      <?php foreach (post_categoryGetAllForMenuHomePage() as $category) { ?>
			        <?php if ($category['children']) { ?>
			        <li class="dropdown">
			          <a href="<?php echo $category['href']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $category['name']; ?>&nbsp;<i class="fa fa-angle-down"></i></a>
			          <div class="dropdown-menu">
			            <div class="dropdown-inner">
			              <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
			              <ul class="list-unstyled">
			                <?php foreach ($children as $child) { ?>
			                <li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
			                <?php } ?>
			              </ul>
			              <?php } ?>
			            </div>
			            <a href="<?php echo $category['href']; ?>" class="see-all">Xem tất <?php echo $category['name']; ?></a> </div>
			        </li>
			        <?php } else { ?>
			        <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
			        <?php } ?>
			      <?php } ?>
				  
				    <li><a href="/contact-blog.php">Liên Hệ</a></li>
			      </ul>
            </DIV>
        </NAV>
    </DIV>
    
    <!-- web content, web_content, ruột -->
    <?php include_once $web_content ; ?>
	
    <footer>
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <h5>Thông Tin</h5>
        <ul class="list-unstyled">
          <li><a href="/about.php">Giới Thiệu</a></li>
          <li><a href="#">Bản Đồ Site</a></li>
          <li><a href="#3">Quyền Riêng Tư</a></li>
          <li><a href="#5">Điều Khoản Sử Dụng</a></li>
        </ul>
      </div>
      
      <div class="col-sm-3">
        <h5>Kết Nối</h5>
        <ul class="list-unstyled">
          <li><a href="/contact-blog.php">Liên Hệ</a></li>
          <li><a href="https://www.facebook.com/aptechvietnam.com.vn/">Facebook</a></li>
          <li><a href="https://github.com/Phonginhere">GitHub</a></li>
          <li><a href="https://www.youtube.com/user/aprotrainaptechvn">Youtube</a></li>
        </ul>
      </div>
      
      <div class="col-sm-3">
        <h5>Tài Khoản</h5>
        <ul class="list-unstyled">
          <li><a href="#">Tài Khoản Của Tôi</a></li>
          <li><a href="#">Wish List</a></li>
          <li><a href="https://mail.google.com/">Thư Thông Báo</a></li><!-- Newsletter -->
        </ul>
      </div>
      
      <div class="col-sm-3">
        <h5>Blog</h5>
        <ul class="list-unstyled">
          <?php foreach (post_categoryGetAllForMenuHomePage(5) as $category) { ?>
          <li><a href="<?php echo $category['href']?>"><?php echo $category['name']?></a></li>
          <?php } ?>
        </ul>
      </div>
      
    </div>
    <hr>
    <p>Copyright © <?php echo date('Y')?> <?php echo web_name() ;?>. All Rights Reserved.</p> 
  </div>
</footer>

<!-- begin olark code -->
<script type="text/javascript" async> ;(function(o,l,a,r,k,y){if(o.olark)return; r="script";y=l.createElement(r);r=l.getElementsByTagName(r)[0]; y.async=1;y.src="//"+a;r.parentNode.insertBefore(y,r); y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)}; y.extend=function(i,j){y("extend",i,j)}; y.identify=function(i){y("identify",k.i=i)}; y.configure=function(i,j){y("configure",i,j);k.c[i]=j}; k=y._={s:[],t:[+new Date],c:{},l:a}; })(window,document,"static.olark.com/jsclient/loader.js");
/* custom configuration goes here (www.olark.com/documentation) */
olark.identify('4199-889-10-6193');</script>
<!-- end olark code -->
</BODY>

</HTML>