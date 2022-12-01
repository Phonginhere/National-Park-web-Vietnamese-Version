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
                  <div class="current-time">
                     <span id="clock"><small>Saturday, August 15, 2020</small></span>
                     <ul>
                        <li><a href="#" title="">Blog</a></li>
                        <li><a href="#" title="">contact</a></li>
                        <li><a href="#" title="">buy now!</a></li>
                     </ul>
                  </div>
                  <div class="login-register">
                     <a href="#" title="">Login / Register</a>
                     <div class="login-wraper">
                        <div class="login-popup">
                           <img itemprop="image" src="/ui/home/wpkixx/template_files/login-background.jpg" alt="">
                           <span class="close"><i class="fa fa-close"></i></span>
                           <b>Best Membership You?</b>
                           <h3 itemprop="headline">Sign in / Signup</h3>
                           <div class="row">
                              <div class="col-sm-12">
                                 <form method="post">
                                    <label>
                                    <input placeholder="Complete Name" class="username" type="text">
                                    </label>
                                    <label>
                                    <input placeholder="Email Address" class="password" type="email">
                                    </label>
                                    <button><i class="fa fa-paper-plane"></i>SIGN IN</button>
                                    <span>New here?</span>
                                    <a itemprop="url" href="#" title="">Create an Account</a>
                                    <label><input class="check" type="checkbox"><i>Remember My Password?</i></label>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <ul class="social-btns">
                     <li><a href="#" target="_blank" title=""><i class="fa fa-facebook"></i></a></li>
                     <li><a href="#" target="_blank" title=""><i class="fa fa-twitter"></i></a></li>
                     <li><a href="#" target="_blank" title=""><i class="fa fa-google-plus"></i></a></li>
                     <li><a href="#" target="_blank" title=""><i class="fa fa-dribbble"></i></a></li>
                     <li><a href="#" target="_blank" title=""><i class="fa fa-linkedin"></i></a></li>
                  </ul>
               </div>
            </div>
            <!-- Top Bar -->
            <div class="logo-bar">
               <div class="container">
                  <div class="row">
                     <div class="col-sm-3">
                        <div class="logo">
                           <a title="#" href="#.html"><img alt="headline" src="/ui/home/wpkixx/template_files/logo.png"></a>
                        </div>
                     </div>
                     <div class="col-sm-9">
                        <div class="ad">
                           <a href="#" title=""><img alt="" src="/ui/home/wpkixx/template_files/ad.jpg"></a>
                        </div>
                     </div>
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
                        <li><a href="/contact.php" title="">Liên Hệ</a></li>
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
                                 <h1><a href="#.html" title=""><img src="/ui/home/wpkixx/template_files/logo2.png" alt=""></a></h1>
                                 <p>Typography traces its origins to the first 
                                    int punches and dies used to make seals 
                                    and currency in ancient times.
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
                                 <h4>Popular Posts</h4>
                              </div>
                              <ul class="ftr-popular-caro owl-carousel owl-theme owl-loaded owl-responsive-1000">
                                 <div class="owl-stage-outer">
                                    <div class="owl-stage" style="transform: translate3d(-170px, 0px, 0px); transition: all 1s ease 0s; width: 340px;">
                                       <div class="owl-item" style="width: 170px; margin-right: 0px;">
                                          <div class="owl-stage-outer">
                                             <div class="owl-stage" style="transform: translate3d(-340px, 0px, 0px); transition: all 1s ease 0s; width: 510px;">
                                                <div class="owl-item" style="width: 170px; margin-right: 0px;">
                                                   <li>
                                                      <a href="http://wpkixx.com/html/headline/single.html" title=""><img src="/ui/home/wpkixx/template_files/footer-carousel-1.jpg" alt=""></a>
                                                      <div class="over-meta">
                                                         <h5><a href="http://wpkixx.com/html/headline/single.html" title="">sydney trafic block</a></h5>
                                                      </div>
                                                   </li>
                                                </div>
                                                <div class="owl-item" style="width: 170px; margin-right: 0px;">
                                                   <li>
                                                      <a href="http://wpkixx.com/html/headline/single.html" title=""><img src="/ui/home/wpkixx/template_files/footer-carousel-2.jpg" alt=""></a>
                                                      <div class="over-meta">
                                                         <h5><a href="http://wpkixx.com/html/headline/single.html" title="">sydney trafic block</a></h5>
                                                      </div>
                                                   </li>
                                                </div>
                                                <div class="owl-item active" style="width: 170px; margin-right: 0px;">
                                                   <li>
                                                      <a href="http://wpkixx.com/html/headline/single.html" title=""><img src="/ui/home/wpkixx/template_files/footer-carousel-3.jpg" alt=""></a>
                                                      <div class="over-meta">
                                                         <h5><a href="http://wpkixx.com/html/headline/single.html" title="">sydney trafic block</a></h5>
                                                      </div>
                                                   </li>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="owl-item active" style="width: 170px; margin-right: 0px;">
                                          <div class="owl-controls">
                                             <div class="owl-nav">
                                                <div class="owl-prev" style="display: none;">prev</div>
                                                <div class="owl-next" style="display: none;">next</div>
                                             </div>
                                             <div style="display: none;" class="owl-dots"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="owl-controls">
                                    <div class="owl-nav">
                                       <div class="owl-prev" style="display: none;">prev</div>
                                       <div class="owl-next" style="display: none;">next</div>
                                    </div>
                                    <div style="display: none;" class="owl-dots"></div>
                                 </div>
                              </ul>
                           </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                           <div class="widget">
                              <div class="widget-title">
                                 <h4>Popular Categories</h4>
                              </div>
                              <ul class="ftr-popu-categories">
                                 <li><a href="#" title="">Gadgets</a><i>09</i></li>
                                 <li><a href="#" title="">Fashion 2017</a><i>87</i></li>
                                 <li><a href="#" title="">Mobile &amp; Phone</a><i>109</i></li>
                                 <li><a href="#" title="">Food &amp; Recepies</a><i>09</i></li>
                                 <li><a href="#" title="">Architechure &amp; Interori Deesign</a><i>09</i></li>
                              </ul>
                           </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                           <div class="widget">
                              <div class="widget-title">
                                 <h4>Recent Posts</h4>
                              </div>
                              <ul class="ftr-recent">
                                 <li>
                                    <a href="http://wpkixx.com/html/headline/single.html" title=""><img src="/ui/home/wpkixx/template_files/recent-post-1.jpg" alt=""></a>
                                    <div class="recent-meta">
                                       <h2><a href="http://wpkixx.com/html/headline/single.html" title="">Rose Pharmacy Water Benefits for Skin finishing care.</a></h2>
                                       <span>05 March, 2017</span>
                                    </div>
                                 </li>
                                 <li>
                                    <a href="http://wpkixx.com/html/headline/single.html" title=""><img src="/ui/home/wpkixx/template_files/recent-post-2.jpg" alt=""></a>
                                    <div class="recent-meta">
                                       <h2><a href="http://wpkixx.com/html/headline/single.html" title="">Rose Pharmacy Water Benefits for Skin finishing care.</a></h2>
                                       <span>05 March, 2017</span>
                                    </div>
                                 </li>
                                 <li>
                                    <a href="http://wpkixx.com/html/headline/single.html" title=""><img src="/ui/home/wpkixx/template_files/recent-post-3.jpg" alt=""></a>
                                    <div class="recent-meta">
                                       <h2><a href="http://wpkixx.com/html/headline/single.html" title="">Rose Pharmacy Water Benefits for Skin finishing care.</a></h2>
                                       <span>05 March, 2017</span>
                                    </div>
                                 </li>
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
      <script src="file:///C:/xampp/htdocs/web_epj1_blog_parks/ui/home/wpkixx/template_files/froogaloop2.min.js"></script>
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

