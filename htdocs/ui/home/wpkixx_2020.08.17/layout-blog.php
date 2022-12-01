<!doctype html><?php include_once $_SERVER["DOCUMENT_ROOT"].'/configs.php'; ?>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <title><?php echo $web_title; ?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
      <meta name="description" content="">
      <meta name="keywords" content="">
      <!-- Styles -->
      <link rel="stylesheet" href="/ui/home/wpkixx/template_files/font-awesome.css">
      <link rel="stylesheet" href="/ui/home/wpkixx/template_files/bootstrap.css">
      <link rel="stylesheet" href="/ui/home/wpkixx/template_files/owl.css">
      <link rel="stylesheet" href="/ui/home/wpkixx/template_files/animate.css">
      <link rel="stylesheet" href="/ui/home/wpkixx/template_files/perfect-scrollbar.css">
      <link rel="stylesheet" href="/ui/home/wpkixx/template_files/style.css" type="text/css">
      <link rel="stylesheet" href="/ui/home/wpkixx/template_files/color.css" type="text/css">
      <link rel="stylesheet" href="/ui/home/wpkixx/template_files/responsive.css" type="text/css">
      <link rel="stylesheet" href="/ui/home/wpkixx/template_files/fontello.htm" type="text/css">
      <link rel="stylesheet" href="/ui/home/wpkixx/template_files/icons/css/fontello.css" type="text/css">
   </head>
   <body itemscope="" onload="goforit()">
      <div class="theme-layout">
         <header class="style1">
            <div class="top-bar">
               <div class="container">
                  <div class="current-time"><!-- PHP date() in foreign languages - e.g. Mar 25 Aoû 09 -->
                     <!-- <span id="clock"><small>Saturday, August 15, 2020</small></span> -->
                    <!--  <span id="clock"><small><?php //setlocale(LC_ALL, 'vi_VN'); echo strftime("%A %e %B %Y"); // SUNDAY, AUGUST 16, 2020 ?></small></span> -->
                     <span id="clock"><small><?php echo date("d/m/Y h:i:sa");  ?></small></span> 
                     <ul>
                        <li><a href="/home-blog.php" title="">Blog</a></li>
                        <li><a href="/contact-blog.php" title="">Liên Hệ</a></li>
                     </ul>
                  </div>
                  
                  <?php if ( !isset ($_SESSION['CUS_LOGGED']) ) { // nếu chưa đăng nhập ?>
                  <div class="login-register"><!-- được viết kịch bản trong file script.js -->
                     <a href="#" title=""><i class="fa fa-lock"></i>&nbsp;Đăng Nhập</a>
                     <div class="login-wraper">
                        <div class="login-popup">
                           <img itemprop="image" src="/ui/home/wpkixx/template_files/login-background.jpg" alt="">
                           <span class="close"><i class="fa fa-close"></i></span>
                           <b>Chào mừng bạn đến với chúng tôi !</b>
                           <h3 itemprop="headline">Đăng Nhập</h3>
                           <div class="row">
                              <div class="col-sm-12">
                                 <form method="post" action="/login.php">
                                    <label>
                                    <input placeholder="E-mail" class="username" type="text" name="email">
                                    </label>
                                    <label>
                                    <input placeholder="Password" class="password" type="password" name="password">
                                    </label>
                                    <button><i class="fa fa-paper-plane"></i>Đăng Nhập</button>
                                    <span>Bạn là người mới ?</span>
                                    <a itemprop="url" href="/register.php" title="">Tạo Tài Khoản</a>
                                    <label><input class="check" type="checkbox"><i>Nhớ Mật Khẩu ?</i></label>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
                  
                  <ul class="social-btns">
                     <li><a href="https://vi-vn.facebook.com/aptechvietnam.com.vn/" target="_blank" title=""><i class="fa fa-facebook"></i></a></li>
                     <li><a href="https://twitter.com/aptechvietnam" target="_blank" title=""><i class="fa fa-twitter"></i></a></li>
                     <li><a href="phongdaotao@aptechlearning.edu.vn" target="_blank" title=""><i class="fa fa-google-plus"></i></a></li>
                     <li><a href="https://www.youtube.com/channel/UCQ79KpUU535awmyi-fqXsRQ" target="_blank" title=""><i class="fa fa-youtube"></i></a></li>
                     <li><a href="https://vn.linkedin.com/in/aprotrainaptech" target="_blank" title=""><i class="fa fa-linkedin"></i></a></li>
                     <?php if ( !isset ($_SESSION['CUS_LOGGED']) ) { // nếu chưa đăng nhập ?>
                     <li><a href="/register.php" title=""><i class="fa fa-user"></i>&nbsp;Đăng Kí</a></li>
                     <?php } else { ?>
                     <li><a href="/account.php"><i class="fa fa-user"></i>&nbsp;Tài Khoản của <?php echo customer_fullname();?></a></li>
                     <li><a href="/logout.php"><i class="fa fa-sign-out"></i>&nbsp;Đăng Thoát</a></li>
                     <?php } ?>
                  </ul>
               </div>
            </div>
            <!-- Top Bar -->
            <div class="logo-bar" style="background: url(/ui/home/wpkixx/template_files/bg-goexplore-2.jpg)">
               <div class="container">
                  <div class="row">
                     <div class="col-sm-3">
                        <div class="logo">
<!--                            <a title="#" href="#.html"><img alt="headline" src="/ui/home/wpkixx/template_files/logo.png"></a> -->
                            <a title="#" href="/home-blog.php"><img alt="headline" src="/ui/home/wpkixx/template_files/logo-ecopark.png" style="height:90px"></a> 
                        </div>
                     </div>
                     <!-- 
                     <div class="col-sm-9">
                        <div class="ad">
                           <a href="#" title=""><img alt="" src="/ui/home/wpkixx/template_files/ad.jpg"></a>
                        </div>
                     </div>
                     -->
                  </div>
               </div>
            </div>
            <!-- Logo Bar -->
            <div class="menu-bar light">
               <div class="container">
                  <nav>
                     <ul>
                        <li class="menu-item-has-children">
                           <a href="/home-blog.php" title="">Trang Chủ</a>
                           <ul class="sub-menu">
                              <li style="transition-delay: 0ms;"><a href="/about.php" title="">Giới Thiệu</a></li>
                              <li style="transition-delay: 50ms;"><a href="/contact.php" title="">Liên Hệ</a></li>
                              <li style="transition-delay: 100ms;"><a href="#3.html" title="">Quảng Cáo</a></li>
                              <li style="transition-delay: 150ms;"><a href="#4.html" title="">Chính Sách</a></li>
                              <li style="transition-delay: 200ms;"><a href="#5.html" title="">Góc Báo Chí</a></li>
                              <li style="transition-delay: 250ms;"><a href="#-video.html" title="">Video</a></li>
                           </ul>
                        </li>
                        <?php foreach (post_categoryGetAllForMenuHomePage() as $category) { ?>
                        <?php if ($category['children']) { ?>
                        <li class="menu-item-has-children">
                           <a href="<?php echo $category['href']?>" title=""><?php echo $category['name']?></a>
                           <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
                           <ul class="sub-menu">
                              <?php foreach ($children as $child) { ?><!-- hiệu ứng transition delay không hiệu quả, ko chạy -->
                              <li style="transition-delay: 0ms;"><a href="<?php echo $child['href'] ?>" title=""><?php echo $child['name'] ?></a></li>
                              <?php } ?>
                           </ul>
                           <?php } ?>
                        </li>
                        <?php } else { ?>
                        <li><a href="<?php echo $category['href']?>" title=""><?php echo $category['name']?></a></li>
                        <?php } ?>
                        <?php } // end foreach ?>
                        <!-- 
                        <li class="menu-item-has-children">
                           <a href="#.html" title="">Home</a>
                           <ul class="sub-menu">
                              <li class="menu-item-has-children" style="transition-delay: 0ms;"><a href="#.html" title="">Home Page 1</a></li>
                              <li style="transition-delay: 50ms;"><a href="#2.html" title="">Home Page 2</a></li>
                              <li style="transition-delay: 100ms;"><a href="#3.html" title="">Home Page 3</a></li>
                              <li style="transition-delay: 150ms;"><a href="#4.html" title="">Home Page 4</a></li>
                              <li style="transition-delay: 200ms;"><a href="#5.html" title="">Home Page 5</a></li>
                              <li style="transition-delay: 250ms;"><a href="#-video.html" title="">Home Video</a></li>
                           </ul>
                        </li>
                        <li><a href="http://wpkixx.com/html/headline/about.html" title="">about Us</a></li>
                        <li><a href="http://wpkixx.com/html/headline/contact.html" title="">Contact Us</a></li>
                         -->
                     </ul>
                     <div class="header-search">
                        <a href="#" title=""><i class="fa fa-search"></i></a>
                     </div>
                  </nav>
               </div>
            </div>
            <!-- Menu Bar -->
            <form class="search-here">
               <input type="text" placeholder="Tìm kiếm ...">
               <i class="fa fa-close"></i>
            </form>
            <!-- Search keyword -->
         </header>
         <!-- Header -->
         <div class="responsive-header">
            <div class="res-logo-area">
               <div class="col-sm-9 col-xs-6">
                  <a href="#" title=""><img src="/ui/home/wpkixx/template_files/logo2.png" alt=""></a>
               </div>
               <div class="col-sm-3 col-xs-6">
                  <div id="nav-icon3">
                     <span></span>
                     <span></span>
                     <span></span>
                     <span></span>
                  </div>
               </div>
            </div>
            <div class="responsive-menu ps-container" data-ps-id="de0b7043-4e2f-27db-5749-39cfc123b8d5">
               <a href="#" title=""><img src="/ui/home/wpkixx/template_files/logo2.png" alt=""></a>
               <ul>
                  <li class="menu-item-has-children">
                     <a href="/home-blog.php" title="">Trang Chủ</a>
                     <ul class="sub-menu">
                        <li><a href="/about.php" title="">Giới Thiệu</a></li>
                        <li><a href="/contact-blog.php" title="">Liên Hệ</a></li>
                        <li><a href="#3.html" title="">Quảng Cáo</a></li>
                        <li><a href="#4.html" title="">Chính Sách</a></li>
                        <li><a href="#5.html" title="">Góc Báo Chí</a></li>
                        <li><a href="#-video.html" title="">Video</a></li>
                     </ul>
                  </li>
                  <?php foreach (post_categoryGetAllForMenuHomePage() as $category) { ?>
                        <?php if ($category['children']) { ?>
                        <li class="menu-item-has-children">
                           <a href="<?php echo $category['href']?>" title=""><?php echo $category['name']?></a>
                           <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
                           <ul class="sub-menu">
                              <?php foreach ($children as $child) { ?><!-- hiệu ứng transition delay không hiệu quả, ko chạy -->
                              <li><a href="<?php echo $child['href'] ?>" title=""><?php echo $child['name'] ?></a></li>
                              <?php } ?>
                           </ul>
                           <?php } ?>
                        </li>
                        <?php } else { ?>
                        <li><a href="<?php echo $category['href']?>" title=""><?php echo $category['name']?></a></li>
                        <?php } ?>
                   <?php } // end foreach ?>
               </ul>
               <ul class="little-info">
                  <li><i class="fa fa-phone-square"></i><span><?php echo web_telephone();?></span></li>
                  <li><i class="fa fa-envelope"></i><span><?php echo web_email();?></span></li>
               </ul>
               <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                  <div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div>
               </div>
               <div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;">
                  <div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div>
               </div>
               <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                  <div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div>
               </div>
               <div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;">
                  <div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div>
               </div>
            </div>
            <a href="#" title="" class="res-search"><i class="fa fa-search"></i></a>
            <form class="search-insite" method="post">
               <i class="fa fa-close"></i>
               <input type="text" placeholder="Tìm kiếm ...">
               <button type="submit"></button>
            </form>
            <ul class="socials">
               <li><a href="#" title="" class="facebook"><i class="fa fa-facebook"></i></a></li>
               <li><a href="#" title="" class="twitter"><i class="fa fa-twitter"></i></a></li>
               <li><a href="#" title="" class="google"><i class="fa fa-google-plus"></i></a></li>
               
               <!-- ko hiện được cho
               <?php if ( !isset ($_SESSION['CUS_LOGGED']) ) { // nếu chưa đăng nhập ?>
               <li><a href="/register.php" title=""><i class="fa fa-user"></i>&nbsp;Đăng Kí</a></li>
               <li><a href="/login.php" title=""><i class="fa fa-lock"></i>&nbsp;Đăng Nhập</a></li>
               <?php } else { ?>
               <li><a href="/account.php" title=""><i class="fa fa-user"></i>&nbsp;Tài Khoản của <?php echo customer_fullname();?></a></li>
               <li><a href="/logout.php"><i class="fa fa-sign-out"></i>&nbsp;Đăng Thoát</a></li>
               <?php } ?>
               -->
            </ul>
         </div>
         <!-- responsive header -->
         
         <!-- web content, web_content, ruột -->
    	 <?php include_once $web_content ; ?>
         
         <!-- grid posts with side widgets -->
         <!-- instagram footer -->
         <footer>
            <div class="gap nogap">
               <div class="container">
                  <div class="row">
                     <div class="footer-widget">
                        <div class="col-md-3 col-sm-4">
                           <div class="widget">
                              <div class="footer-logo">
<!--                                  <h1><a href="#.html" title=""><img src="/ui/home/wpkixx/template_files/logo2.png" alt=""></a></h1> -->
                                 <h1><a href="/home-blog.php" title=""><img src="/ui/home/wpkixx/template_files/logo-ecopark.png" alt=""></a></h1>
                                 <p>Chúng tôi là những lập trình viên yêu thích Web, HTML,CSS, JavaScript, PHP, MySQL
                                 </p>
                              </div>
                              <ul class="social">
                                 <li><a href="#" title=""><i class="fa fa-facebook"></i></a></li>
                                 <li><a href="#" title=""><i class="fa fa-twitter"></i></a></li>
                                 <li><a href="#" title=""><i class="fa fa-dribbble"></i></a></li>
                                 <li><a href="#" title=""><i class="fa fa-google-plus"></i></a></li>
                              </ul>
                           </div>
                        </div>
                        
                        <div class="col-md-2 col-sm-4">
                           <div class="widget">
                              <div class="widget-title">
                                 <h4>Tin Nổi Bật</h4>
                              </div>
                              <ul class="ftr-popular-caro owl-carousel">
                              <?php foreach( postFeatureds() as $post_f)  {?>
                              	<li><!-- phải khống chế kích thước ảnh bằng style css mới xong, thuộc tính width, height của img không ăn thua. -->
                                	<a href="<?php echo $post_f['href']?>" title=""><img src="<?php echo $post_f['image']?>" alt="" style="width:170px;height:211px"></a>
                                    <div class="over-meta">
                                    	<h5><a href="<?php echo $post_f['href']?>" title="">
                                    		<?php echo utf8_substr(strip_tags(html_entity_decode( $post_f['title'], ENT_QUOTES, 'UTF-8')), 0, 45).'..'; ?>
                                    		</a>
                                    	</h5>
                                    </div>
                              	</li>
                              <?php }?>
                              
                              <!-- 
                                                   <li>
                                                      <a href="#" title=""><img src="/ui/home/wpkixx/template_files/footer-carousel-1.jpg" alt=""></a>
                                                      <div class="over-meta">
                                                         <h5><a href="#" title="">sydney trafic block</a></h5>
                                                      </div>
                                                   </li>
                                                   <li>
                                                      <a href="#" title=""><img src="/ui/home/wpkixx/template_files/footer-carousel-2.jpg" alt=""></a>
                                                      <div class="over-meta">
                                                         <h5><a href="#" title="">sydney trafic block</a></h5>
                                                      </div>
                                                   </li>
                                                   <li>
                                                      <a href="#" title=""><img src="/ui/home/wpkixx/template_files/footer-carousel-3.jpg" alt=""></a>
                                                      <div class="over-meta">
                                                         <h5><a href="#" title="">sydney trafic block</a></h5>
                                                      </div>
                                                   </li>
                                    -->  
                                 
                              </ul>
                           </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-4">
                           <div class="widget">
                              <div class="widget-title">
                                 <h4>Loại Tin Top</h4>
                              </div>
                              <ul class="ftr-popu-categories">
                                 <!-- 
                                 <li><a href="#" title="">Gadgets</a><i>09</i></li>
                                 <li><a href="#" title="">Fashion 2017</a><i>87</i></li>
                                 <li><a href="#" title="">Mobile &amp; Phone</a><i>109</i></li>
                                 <li><a href="#" title="">Food &amp; Recepies</a><i>09</i></li>
                                 <li><a href="#" title="">Architechure &amp; Interori Deesign</a><i>09</i></li>
                                 -->
                                 <?php foreach (post_categoryGetAllForMenuHomePage() as $category) { ?>
                                 <li><a href="<?php echo $category['href']?>" title=""><?php echo $category['name']; ?></a><i><?php echo postGetTotalForCategory($category['category_id']); ?></i></li>
                                 <?php } ?>
                              </ul>
                           </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                           <div class="widget">
                              <div class="widget-title">
                                 <h4>Tin Mới</h4>
                              </div>
                              <ul class="ftr-recent">
                                 <?php foreach(postLatests(array('limit'=>3)) as $new_post) {?>
                                 <li>
                                    <a href="<?php echo $new_post['href']?>" title=""><img src="<?php echo $new_post['image']?>" alt=""></a>
                                    <div class="recent-meta">
                                       <h2><a href="<?php echo $new_post['href']?>" title=""><?php echo $new_post['title']?></a></h2>
                                       <span><?php echo $new_post['date_published']?></span>
                                    </div>
                                    <br style="clear:both"/><!-- chống sập khi các phần tử con bên trong bị làm nổi -->
                                 </li>
                                 <?php } ?>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </footer>
         <!-- footer -->	
         <div class="bottom-bar">
            <div class="container">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="copyright">
                        <h5>All right reserved by <span>WPKixx</span> © 2017</h5>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- bottombar -->	
      </div>
      <!-- Theme Layout -->
      <!-- Scripts -->
      <script src="https://www.youtube.com/iframe_api"></script>
      <script src="/ui/home/wpkixx/template_files/froogaloop2.min.js"></script>
      <script type="text/javascript" id="www-widgetapi-script" src="https://s.ytimg.com/yts/jsbin/www-widgetapi-vfldn1jRM/www-widgetapi.js"></script>
      <script type="text/javascript" id="www-widgetapi-script" src="/ui/home/wpkixx/template_files/www-widgetapi.js"></script>
      <script src="/ui/home/wpkixx/template_files/iframe_api"></script><script src="/ui/home/wpkixx/template_files/froogaloop2.htm"></script>
      <script type="text/javascript" src="/ui/home/wpkixx/template_files/jquery.js"></script><!-- Jquery -->
      <script type="text/javascript" src="/ui/home/wpkixx/template_files/bootstrap.js"></script><!-- Bootstrap -->
      <script type="text/javascript" src="/ui/home/wpkixx/template_files/owl.js"></script><!-- Carousal -->
      <script type="text/javascript" src="/ui/home/wpkixx/template_files/jquery_002.js"></script>
      <script type="text/javascript" src="/ui/home/wpkixx/template_files/html5lightbox.js"></script>
      <script type="text/javascript" src="/ui/home/wpkixx/template_files/perfect-scrollbar.js"></script>
      <script type="text/javascript" src="/ui/home/wpkixx/template_files/perfect-scrollbar_002.js"></script>
      <script type="text/javascript" src="/ui/home/wpkixx/template_files/scrolltopcontrol.js"></script>	
      <script type="text/javascript" src="/ui/home/wpkixx/template_files/clock.js"></script><!-- Current time show on topbar plugin -->
      <script src="/ui/home/wpkixx/template_files/script.js"></script>
      <div id="topcontrol" style="position: fixed; bottom: 5px; right: 5px; opacity: 0; cursor: pointer;" title="Scroll Back to Top"><i class="fa fa-angle-up"></i></div>
      <div id="topcontrol" style="position: fixed; bottom: 5px; right: 5px; opacity: 1; cursor: pointer;" title="Scroll Back to Top"><i class="fa fa-angle-up"></i></div>
   </body>
</html>

