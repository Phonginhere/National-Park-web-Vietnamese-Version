<!DOCTYPE html><?php  include_once $_SERVER["DOCUMENT_ROOT"].'/configs.php'; ?>
<!-- saved from url=(0062)http://seantheme.com/color-admin-v1.9/admin/html/index_v2.html -->
<html lang="en"><!--<![endif]--><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<!-- 
	<title>Color Admin | Dashboard v2</title>
	 -->
	
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
	<meta content="" name="description">
	<meta content="" name="author">
	<title><?php echo $web_title;?></title>
	<link href="<?php echo web_icon_url(); ?>" rel="icon">
	<?php include_once $_SERVER['DOCUMENT_ROOT']."/ui/common-head-layout-admin.php";?>
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="/ui/admin/flat_000_blog/template_files/css" rel="stylesheet">
	<link href="/ui/admin/flat_000_blog/template_files/jquery-ui.min.css" rel="stylesheet">
	<link href="/ui/admin/flat_000_blog/template_files/bootstrap.min.css" rel="stylesheet">
	<link href="/ui/admin/flat_000_blog/template_files/font-awesome.min.css" rel="stylesheet">
	<link href="/ui/admin/flat_000_blog/template_files/animate.min.css" rel="stylesheet">
	<link href="/ui/admin/flat_000_blog/template_files/style.min.css" rel="stylesheet">
	<link href="/ui/admin/flat_000_blog/template_files/style-responsive.min.css" rel="stylesheet">
	<link href="/ui/admin/flat_000_blog/template_files/blue.css" rel="stylesheet" id="theme">
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <link href="/ui/admin/flat_000_blog/template_files/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <link href="/ui/admin/flat_000_blog/template_files/bootstrap_calendar.css" rel="stylesheet">
    <link href="/ui/admin/flat_000_blog/template_files/jquery.gritter.css" rel="stylesheet">
    <link href="/ui/admin/flat_000_blog/template_files/morris.css" rel="stylesheet">
	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script async src="/ui/admin/flat_000_blog/template_files/analytics.js"></script><script src="/ui/admin/flat_000_blog/template_files/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body class=" pace-done"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in hide"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed in">
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="#" class="navbar-brand">
                        <img src="<?php echo web_logo_url(); ?>" width="32" height="32"  style="display:inline"/>Admin Panel
                    </a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->
				
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					<!-- 
					<li>
						<form class="navbar-form full-width">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Enter keyword">
								<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
							</div>
						</form>
					</li>
					 -->
					<li>
						<a href="/home-blog.php" title="Trang Chủ" target="_blank"><i class="fa fa-home"></i></a>
					</li>
					<!-- 
					<li class="dropdown">
						<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14" aria-expanded="false">
							<i class="fa fa-bell-o"></i>
							<span class="label">5</span>
							<i class="fa fa-comments-o"></i>
							<span class="label">5</span>
						</a>
					</li>
					 -->
					<li class="dropdown navbar-user">
						<li><a href="/admin-logout.php">Log Out &nbsp;<i class="fa fa-sign-out fa-lg"></i></a></li>
						<!--
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<img src="/ui/admin/flat_000_blog/template_files/user-13.jpg" alt=""> 
							<span class="hidden-xs">Adam Schwartz</span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li><a href="javascript:;">Edit Profile</a></li>
							<li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li>
							<li><a href="javascript:;">Calendar</a></li>
							<li><a href="javascript:;">Setting</a></li>
							<li class="divider"></li>
							<li><a href="javascript:;">Log Out</a></li>
						</ul>
						-->
					</li>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;"><div data-scrollbar="true" data-height="100%" data-init="true" style="overflow: hidden; width: auto; height: 100%;">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<div class="image">
							<a href="javascript:;"><img src="<?php echo user_image(); ?>" alt=""></a>
						</div>
						<div class="info">
							<?php echo user_username(); ?>
							<small><?php echo user_fullname();?></small>
						</div>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
				<!-- 
					<li class="<?php if($active_page_admin == ACTIVE_PAGE_ADMIN_DASHBOARD) echo "active";?>">
						<a href="/admin/dashboard.php">
						    <i class="fa fa-laptop"></i>
						    <span>Dashboard</span>
					    </a>
					</li>
					
					
      				<li class="<?php if($active_page_admin == ACTIVE_PAGE_ADMIN_PRODUCT) echo "active";?>">
      					<a href="/admin/product.php">
      						<i class="fa fa-puzzle-piece fa-fw"></i><span>Sản phẩm</span>
      					</a>
      				</li>
      				<li class="<?php if($active_page_admin == ACTIVE_PAGE_ADMIN_MANUFACTURER) echo "active";?>">
      					<a href="/admin/manufacturer.php" title="Nhà Sản Xuất, Nhà Cung Cấp Dịch Vụ">
      						 <i class="fa fa-copyright fa-fw"></i><span>Nhà Sản Xuất</span>
      					</a>
      				</li>
      				<li class="<?php if($active_page_admin == ACTIVE_PAGE_ADMIN_CATEGORY) echo "active";?>">
						<a href="/admin/category.php" title="Danh Mục, Phân Loại">
						     <i class="fa fa-tags"></i><span>Danh Mục Sản Phẩm</span>
						</a>
					</li>
					<li style="padding: 8 20"><hr></li>
					-->
					<!-- dải phân cách -->
					
					<li class="<?php if($active_page_admin == ACTIVE_PAGE_ADMIN_CUSTOMER) echo "active";?>">
      				 <a href="/admin/customer.php" title="Khách Hàng">
      				  <i class="fa fa-users fa-fw"></i><span>Khách Hàng</span>
      				 </a>
					</li>
					<!-- 
					<li class="<?php if($active_page_admin == ACTIVE_PAGE_ADMIN_ORDER) echo "active";?>">
						<a href="/admin/order.php" title="Đơn Hàng">
							<i class="fa fa-shopping-cart fa-fw"></i><span>Đơn Hàng</span>
					    </a>
					</li>
					-->
					<li class="<?php if($active_page_admin == ACTIVE_PAGE_ADMIN_CONTACT) echo "active";?>">
      				 <a href="/admin/contact.php" title="Góp Ý, Phản Hồi, Khiếu Nại từ Khách Hàng">
      				  <i class="fa fa-envelope fa-fw"></i><span>Phản Hồi</span>
      				 </a>
					</li>	

                    
					
					<li><hr></li> <!-- dải phân cách -->
					
                    <li class="<?php if($active_page_admin == ACTIVE_PAGE_ADMIN_DEPARTMENT) echo "active";?>">
				     <a href="/admin/department.php" title="Phòng Ban, Trung Tâm, Viện, Đơn Vị">
				      <i class="fa fa-building-o fa-fw"></i><span>Phòng Ban</span>
				     </a>
					</li>

					<li class="<?php if($active_page_admin == ACTIVE_PAGE_ADMIN_USER) echo "active";?>">
				     <a href="/admin/user.php" title="Nhân Viên, Người Dùng Hệ Thống Nội Bộ">
				      <i class="fa fa-user fa-fw"></i><span>Nhân Viên</span>
				     </a>
					</li>

					<li class="<?php if($active_page_admin == ACTIVE_PAGE_ADMIN_JOB) echo "active";?>">
				     <a href="/admin/job.php" title="Vị Trí Chức Danh, Nghề Nghiệp">
				      <i class="fa fa-vcard-o fa-fw"></i><span>Chức Danh</span>
				     </a>
					</li>
					
					<li><hr></li> <!-- dải phân cách -->

                    <li class="<?php if($active_page_admin == ACTIVE_PAGE_ADMIN_POST) echo "active";?>">
				     <a href="/admin/post.php" title="Tin Tức, Bài Viết">
				      <i class="fa fa-newspaper-o fa-fw"></i><span>Bài Viết</span>
				     </a>
					</li>

                    <li class="<?php if($active_page_admin == ACTIVE_PAGE_ADMIN_POST_CATEGORY) echo "active";?>">
						<a href="/admin/post_category.php" title="Danh Mục, Phân Loại Bài Viết">
						     <i class="fa fa-tags"></i><span>Phân Loại Tin</span>
						</a>
					</li>

                    <li><hr></li> <!-- dải phân cách -->
					
					<li class="has-sub <?php if($active_page_admin == ACTIVE_PAGE_ADMIN_SYSTEM) echo "active";?>">
						<a href="javascript:;" title="Hệ Thống">
							<span class="caret pull-right"></span>
							<i class="fa fa-cog fa-fw"></i> 
							<span>Hệ Thống</span>
						</a>
						<ul class="sub-menu" style="">
						    <li class="<?php if($active_page_admin == ACTIVE_PAGE_ADMIN_SETTINGS) echo "active";?>">
							 <a href="/admin/setting-edit.php" title="Settings">
							  <i class="fa fa-cogs fa-fw"></i> <span>Settings</span>
							 </a>
							</li>
							<li class="<?php if($active_page_admin == ACTIVE_PAGE_ADMIN_BANNER) echo "active";?>">
							 <a href="/admin/banner-image.php" title="Banners">
							  <i class="fa fa-slideshare fa-fw"></i><span>Ảnh Banners</span>
							 </a>
						    </li>
						    <!-- 
							<li class="<?php if($active_page_admin == ACTIVE_PAGE_ADMIN_TESTIMONIAL) echo "active";?>">
							 <a href="/admin/testimonial.php" title="Lời Chứng Thực Từ Khách Hàng">
							  <i class="fa fa-commenting-o fa-fw"></i><span>Lời Chứng Thực</span>
							 </a>
							</li>
							 -->
						    
						</ul>
					</li>
					
					
					
					
					
					
					
					
			        <!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div><div class="slimScrollBar ui-draggable" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 576.086px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<?php include_once $web_content;?>
		</div>
		<!-- end #content -->
		
        <!-- begin theme-panel -->
        <div class="theme-panel">
            <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
            <div class="theme-panel-content">
                <h5 class="m-t-0">Color Theme</h5>
                <ul class="theme-list clearfix">
                    <li class=""><a href="javascript:;" class="bg-green" data-theme="default" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default" data-original-title="" title="">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-red" data-theme="red" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red" data-original-title="" title="">&nbsp;</a></li>
                    <li class="active"><a href="javascript:;" class="bg-blue" data-theme="blue" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Blue" data-original-title="" title="">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-purple" data-theme="purple" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple" data-original-title="" title="">&nbsp;</a></li>
                    <li class=""><a href="javascript:;" class="bg-orange" data-theme="orange" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange" data-original-title="" title="">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-black" data-theme="black" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Black" data-original-title="" title="">&nbsp;</a></li>
                </ul>
                <div class="divider"></div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Header Styling</div>
                    <div class="col-md-7">
                        <select name="header-styling" class="form-control input-sm">
                            <option value="1">default</option>
                            <option value="2">inverse</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label">Header</div>
                    <div class="col-md-7">
                        <select name="header-fixed" class="form-control input-sm">
                            <option value="1">fixed</option>
                            <option value="2">default</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Sidebar Styling</div>
                    <div class="col-md-7">
                        <select name="sidebar-styling" class="form-control input-sm">
                            <option value="1">default</option>
                            <option value="2">grid</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label">Sidebar</div>
                    <div class="col-md-7">
                        <select name="sidebar-fixed" class="form-control input-sm">
                            <option value="1">fixed</option>
                            <option value="2">default</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Sidebar Gradient</div>
                    <div class="col-md-7">
                        <select name="content-gradient" class="form-control input-sm">
                            <option value="1">disabled</option>
                            <option value="2">enabled</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Content Styling</div>
                    <div class="col-md-7">
                        <select name="content-styling" class="form-control input-sm">
                            <option value="1">default</option>
                            <option value="2">black</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-12">
                        <a href="http://seantheme.com/color-admin-v1.9/admin/html/index_v2.html#" class="btn btn-inverse btn-block btn-sm" data-click="reset-local-storage"><i class="fa fa-refresh m-r-3"></i> Reset Local Storage</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end theme-panel -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/ui/admin/flat_000_blog/template_files/jquery-1.9.1.min.js"></script>
	<script src="/ui/admin/flat_000_blog/template_files/jquery-migrate-1.1.0.min.js"></script>
	<script src="/ui/admin/flat_000_blog/template_files/jquery-ui.min.js"></script>
	<script src="/ui/admin/flat_000_blog/template_files/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="/ui/admin/flat_000_blog/template_files/jquery.slimscroll.min.js"></script>
	<script src="/ui/admin/flat_000_blog/template_files/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="/ui/admin/flat_000_blog/template_files/raphael.min.js"></script>
    <script src="/ui/admin/flat_000_blog/template_files/morris.js"></script>
    <script src="/ui/admin/flat_000_blog/template_files/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="/ui/admin/flat_000_blog/template_files/jquery-jvectormap-world-merc-en.js"></script>
    <script src="/ui/admin/flat_000_blog/template_files/bootstrap_calendar.min.js"></script>
	<script src="/ui/admin/flat_000_blog/template_files/jquery.gritter.js"></script>
	<script src="/ui/admin/flat_000_blog/template_files/dashboard-v2.min.js"></script>
	<script src="/ui/admin/flat_000_blog/template_files/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			DashboardV2.init();
		});
	</script>
	<script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
      ga('create', 'UA-53034621-1', 'auto');
      ga('send', 'pageview');
    </script>



<div class="jvectormap-label" style="display: none; left: 1220px; top: 304px;">Russia</div></body></html>