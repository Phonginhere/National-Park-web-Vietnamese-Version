		 <!--News carousel-->
		 <section><!-- Các bài viết nổi bật -->
            <div class="gap">
               <div class="container">
                  <div class="row merged">
                     <div class="col-md-5">
                     
                        <?php $featured_posts = postFeatureds(); ?>
                        <?php $post_f = array_shift($featured_posts); ?>
                        <div class="featured-post">
                           <div class="featured-avatar">
                              <img src="<?php echo $post_f['image']?>" alt="" style="height:390px">
                           </div>
                           <div class="featured-meta">
                              <h2><a href="<?php echo $post_f['href']?>" title=""><?php echo $post_f['title']?></a></h2>
                              <ul class="post-info">
                                 <!-- 
                                 <li><a href="#" title=""><i class="fa fa-heart"></i>68 views</a></li>
                                 <li><a href="#" title=""><i class="fa fa-comments"></i>6 commments</a></li>
                                 <li><a href="#" title=""><i class="fa fa-heart"></i>8 likes</a></li>
                                 -->
                                 <li><a href="#" title=""><i class="fa fa-heart"></i>Tin Nổi Bật</a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-7 col-sm-12 col-xs-12">
                        <div class="row">
	                        
	                       <?php foreach ($featured_posts as $post_f) {?>
                           <div class="col-sm-6">
                              <div class="featured-post">
                                 <div class="featured-avatar">
                                    <img src="<?php echo $post_f['image']?>" alt="" style="height:190px">
                                 </div>
                                 <div class="featured-meta small">
                                    <h2><a href="<?php echo $post_f['href']?>" title=""><?php echo $post_f['title']?></a></h2>
                                    <ul class="post-info">
                                       <!-- 
		                                 <li><a href="#" title=""><i class="fa fa-heart"></i>68 views</a></li>
		                                 <li><a href="#" title=""><i class="fa fa-comments"></i>6 commments</a></li>
		                                 <li><a href="#" title=""><i class="fa fa-heart"></i>8 likes</a></li>
		                                 -->
		                                 <li><a href="#" title=""><i class="fa fa-heart"></i>Tin Nổi Bật</a></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <?php } ?>
                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         
         <!-- Top Featured Posts -->
         <section>
            <div class="gap nogap">
               <div class="container">
                  <div class="row">
                     <div class="col-sm-12">
                        <h4 class="sec-heading strips">Tin Mới</h4>
                     </div>
                     
                     <?php foreach(postLatests(array('limit'=>4)) as $new_post) {?>
                     <div class="col-md-3 col-sm-4">
                        <div class="grid-post md3 fadeInup">
                           <div class="post-avatar">
                              <a href="<?php echo $new_post['href'] ?>" title="" class="img-link">
                              <img src="<?php echo $new_post['image'] ?>" alt="">
                              </a>
                           </div>
                           <div class="post-data">
                              <a class="category" href="#" title="">Bài Viết Mới</a>
                              <h2><a href="http://wpkixx.com/html/headline/single.html" title=""><?php echo $new_post['title'] ?></a></h2>
                              <ul class="post-meta2">
                                 <li><i class="fa fa-calendar-o"></i><a href="#" title=""><?php echo $new_post['date_published'];?></a></li>
                                 <li><i class="fa fa-heart"></i><a href="#" title="">8 likes</a></li>
                              </ul>
                           </div>
                        </div>
                        <!-- Post Stye 3 -->
                     </div>
                     <?php } ?>
                     
                  </div>
               </div>
            </div>
         </section>
         
         <!-- weekly gird post md3 -->
         <section>
            <div class="">
               <div class="container">
                  <div class="row">
                     <div class="col-md-8">
                        <div class="row">
                           <div class="col-md-6 col-sm-7">
                              <h4 class="sec-heading strips">Loại Tin Nổi Bật</h4>
                              
                              <?php foreach( post_categoryFeatureds() as $category_f ) { ?>
                              <div class="list-small-post">
                                 <a href="<?php echo $category_f['href']?>" title=""><img src="<?php echo $category_f['image']?>" alt="" width="152" height="155" style="object-fit:cover;height:100%;"></a></a>
                                 <div class="list-small-meta">
                                    <ul class="post-meta2">
                                       <li><i class="fa fa-calendar-o"></i><a href="<?php echo $category_f['href']?>" title="">Read more...</a></li>
                                       <li><i class="fa fa-heart"></i><a href="<?php echo $category_f['href']?>" title="">68k likes</a></li>
                                    </ul>
                                    <h2><a href="<?php echo $category_f['href']?>" title=""><?php echo $category_f['name']; ?></a></h2>
                                    <ul class="socials">
                                       <li><a href="" title="" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                       <li><a href="" title="" class="google"><i class="fa fa-google"></i></a></li>
                                       <li><a href="" title="" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                       <li><a href="" title="" class="dribble"><i class="fa fa-dribbble"></i></a></li>
                                       <li><a href="" title="" class="pinterest"><i class="fa fa-pinterest-p"></i></a></li>
                                    </ul>
                                 </div>
                              </div>
                              <?php } ?>
                           </div>
                           
                           <?php $next_post_cat = array_shift($post_categories); ?>
                           <?php $next_cat_id = $next_post_cat['category_id']; ?>
                           <div class="col-md-6 col-sm-5">
                              <div class="tab-base-post">
                                 <ul class="nav nav-tabs branches">
                                    <li class="active"><a href="#cat1" aria-controls="cat1" data-toggle="tab" aria-expanded="true">Bài 1</a></li>
                                    <li class=""><a href="#cat2" aria-controls="cat2" data-toggle="tab" aria-expanded="false">Bài 2</a></li>
                                    <li class=""><a href="#cat3" aria-controls="cat3" data-toggle="tab" aria-expanded="false">Bài 3</a></li>
                                    <li class=""><a href="#cat4" aria-controls="cat4" data-toggle="tab" aria-expanded="false">Bài 4</a></li>
                                    <li class=""><a href="#cat5" aria-controls="cat5" data-toggle="tab" aria-expanded="false">Bài 5</a></li>
                                 </ul>
                                 <!-- Tab panes -->
                                 <div class="tab-content">
                                    <?php $filter_data = array('filter_category_id'=>$next_cat_id, 'sort'=>'sort_order', 'limit'=>5); ?>
                                    <?php $n=1;?>
                                    <?php foreach(postGetAllForCategory($filter_data) as $post) { ?>
                                    <div role="tabpanel" class="tab-pane fade <?php if($n==1) echo 'remove-ext active in'?>" id="cat<?php echo $n++;?>">
<!--                                     <div role="tabpanel" class="tab-pane fade remove-ext active in" id="cat1"> -->
                                    <!--  div role="tabpanel" class="tab-pane fade" id="cat4" -->
                                       <div class="post-grid-style">
                                          <a href="/blog-post.php?post_id=<?php echo $post['post_id']?>" title="">
                                          	<img src="<?php echo URL_IMAGE.$post['image']?>" alt="">
                                          </a>
                                          <div class="post-detail">
                                             <a class="category" href="/post_category.php?path=<?php echo $next_cat_id ?>" title=""><?php echo $next_post_cat['name']?></a>
                                             <ul class="stars-rank">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                             </ul>
                                             <h2><a href="<?php echo $post['href'];?>" title=""><?php echo $post['title']?></a></h2>
                                             <ul class="post-meta3">
                                                <li><i class="fa fa-calendar-o"></i><a href="#" title=""><?php echo date('d/m/Y', strtotime($post['date_added'])) ?></a></li>
                                                <!-- li class="admin"><a href="#" title="">Admin</a></li-->
                                             </ul>
                                             <p><?php echo utf8_substr(strip_tags(html_entity_decode($post['content'], ENT_QUOTES, 'UTF-8')), 0, 250) . '..' ?></p>
                                          </div>
                                       </div>
                                    </div>
                                    <?php } // end foreach ?>
                                 </div>
                              </div>
                           </div>
                           
                           <?php 
                           	$next_post_cat = array_shift($post_categories); 
                           	$next_cat_id = $next_post_cat['category_id']; 
                           ?>
                           <section>
                              <div class="gap no-bottom">
                                 <div class="col-sm-12">
                                    <h4 class="sec-heading strips"><?php echo $next_post_cat['name'] ?></h4>
                                    
                                    <?php $filter_data = array('filter_category_id'=>$next_cat_id, 'sort'=>'sort_order', 'limit'=>3); ?>
                                    <?php foreach(postGetAllForCategory($filter_data) as $post) { ?>
                                    <div class="post-list-style">
                                       <a href="/blog-post.php?post_id=<?php echo $post['post_id']?>" title="">
                                       	<img src="<?php echo URL_IMAGE.$post['image']?>" alt="">
                                       </a>
                                       <div class="list-post-detail">
                                          <a class="category" href="/post_category.php?path=<?php echo $next_cat_id ?>" title=""><?php echo $next_post_cat['name'] ?></a>
                                          <ul class="post-meta3">
                                             <li><i class="fa fa-calendar-o"></i><a href="#" title=""><?php echo date('d/m/Y', strtotime($post['date_added'])) ?></a></li>
                                             <!-- li class="admin"><a href="#" title="">Admin</a></li  -->
                                          </ul>
                                          <a href="/blog-post.php?post_id=<?php echo $post['post_id']?>" title="">
                                             <h2><?php echo $post['title'] ?></h2>
                                          </a>
                                          <p><?php echo utf8_substr(strip_tags(html_entity_decode($post['content'], ENT_QUOTES, 'UTF-8')), 0, 250) . '..' ?></p>
                                       </div>
                                    </div>
                                    <?php } ?>
                                    
                                 </div>
                              </div>
                           </section>
                        </div>
                     </div>
                     <!-- content -->
                     <div class="col-md-4">
                        <aside>
                           <div class="widget">
                              <div class="widget-title">
                                 <h4>User Authentication</h4>
                              </div>
                              <div class="sidebar-login">
                                 <form action="/login.php" method="post">
                                    <label>
                                    <input type="text" placeholder="Email*" name="email">
                                    <i class="fa fa-user"></i>
                                    </label>
                                    <label>
                                    <input type="password" placeholder="Password*" name="password">
                                    <i class="fa fa-lock"></i>
                                    </label>
                                 </form>
                              </div>
                           </div>
                           <!-- user login -->
                           
                           <?php 
                           	$next_post_cat = array_shift($post_categories); 
                           	$next_cat_id = $next_post_cat['category_id']; 
                           ?>
                           <!-- Test carousel -->
                           <div class="widget">
                              <div class="widget-title">
                                 <h4><?php echo $next_post_cat['name'] ?></h4>
                              </div>
                              <div class="progress-caro owl-carousel owl-theme">
                              
                                 <?php $filter_data = array('filter_category_id'=>$next_cat_id, 'sort'=>'sort_order', 'limit'=>5); ?>
                                 <?php foreach(postGetAllForCategory($filter_data) as $post) { ?>
                                 <div class="owl-item" style="width: 308px; margin-right: 0px;">
                                    <div class="progress-unit">
                                       
                                       <div class="post-progress">
                                          <img src="<?php echo URL_IMAGE.$post['image']?>" alt="">
                                          <span><a href="#" title=""><?php echo $post['title']?></a></span>
                                       </div>
                                       <?php echo utf8_substr(strip_tags(html_entity_decode($post['content'], ENT_QUOTES, 'UTF-8')), 0, 200) . '..' ?>
                                    </div>
                                  </div>
                                  <?php }// end foreach ?>
                                 <!-- đã xóa owl controls ở đây --> 
                              </div>
                           </div>
                           
                           <?php 
                           	$next_post_cat = array_shift($post_categories); 
                           	$next_cat_id = $next_post_cat['category_id']; 
                           ?>
                           <!-- progressbar carousel -->
                           <div class="widget">
                              <div class="widget-title">
                                 <h4><?php echo $next_post_cat['name'] ?></h4>
                              </div>
                              <div class="tab-base-post">
                                 <!-- Tab panes: tab-pane fade active in -->
                                 <div class="tab-content">
                                 
                                    <?php $filter_data = array('filter_category_id'=>$next_cat_id, 'sort'=>'post_id', 'limit'=>8); ?>
                                    <?php $i=0; $n=1;// biến đếm để theo dõi sự thay đổi html phức tạp bên trong mỗi bước lặp ?>
                                    <?php foreach(postGetAllForCategory($filter_data) as $post) { ?>
                                    <?php if($i%2==0) {?>
                                    <div role="tabpanel" class="tab-pane fade <?php if($i==0) echo 'active in'?>" id="post<?php echo $n++; ?>">
                                       <div class="row">
                                          <div class="col-sm-6"><!-- chẵn -->
                                             <div class="wid-tab-post">
                                                <a href="/blog-post.php?post_id=<?php echo $post['post_id']?>" title=""><img src="<?php echo URL_IMAGE.$post['image']?>" alt=""></a>
                                                <h5><a href="/blog-post.php?post_id=<?php echo $post['post_id']?>" title=""><?php echo $post['title']?></a></h5>
                                             </div>
                                          </div>
                                   <?php } else {?>
                                          <div class="col-sm-6">
                                             <div class="wid-tab-post"><!-- lẻ -->
                                                <a href="/blog-post.php?post_id=<?php echo $post['post_id']?>" title=""><img src="<?php echo URL_IMAGE.$post['image']?>" alt=""></a>
                                                <h5><a href="/blog-post.php?post_id=<?php echo $post['post_id']?>" title=""><?php echo $post['title']?></a></h5>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <?php } // end if else ?>
                                    <?php $i++;} // end foreach() ?>
                                    
                                    <!-- 
                                    <div role="tabpanel" class="tab-pane fade" id="post1">
                                       <div class="row">
                                          <div class="col-sm-6">
                                             <div class="wid-tab-post">
                                                <a href="#" title=""><img src="/ui/home/wpkixx/template_files/widget-tab-1.jpg" alt=""></a>
                                                <h5><a href="#" title="">special wearing in the parties</a></h5>
                                             </div>
                                          </div>
                                          <div class="col-sm-6">
                                             <div class="wid-tab-post">
                                                <a href="#" title=""><img src="/ui/home/wpkixx/template_files/widget-tab-2.jpg" alt=""></a>
                                                <h5><a href="#" title="">10 tips for facing charm in..</a></h5>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                     -->
                                    
                                 </div>
                                 <!-- Tab button -->
                                 <ul class="nav nav-tabs branches wgt-style">
                                    <li class="active"><a href="#post1" aria-controls="post1" data-toggle="tab" aria-expanded="false">Tab1</a></li>
                                    <li class=""><a href="#post2" aria-controls="post2" data-toggle="tab" aria-expanded="true">Tab2</a></li>
                                    <li class=""><a href="#post3" aria-controls="post3" data-toggle="tab" aria-expanded="false">Tab3</a></li>
                                    <li class=""><a href="#post4" aria-controls="post4" data-toggle="tab" aria-expanded="false">Tab4</a></li>
                                    <!-- li class=""><a href="#post5" aria-controls="post5" data-toggle="tab" aria-expanded="false">Tab5</a></li  bị hỏng ăn -->
                                 </ul>
                              </div>
                           </div>
                           <!-- end tab base widget -->
                           
                           <div class="widget">
                              <div class="widget-title">
                                 <h4>tags cloud</h4>
                              </div>
                              <ul class="tags-cloud">
                                 <li><a href="/blog.php?tag=web" title="">web</a></li>
                                 <li><a href="/blog.php?tag=html" title="">Html</a></li>
                                 <li><a href="/blog.php?tag=css" title="">css</a></li>
                                 <li><a href="/blog.php?tag=javascript" title="">JavaScript</a></li>
                                 <li><a href="/blog.php?tag=jquery" title="">jquery</a></li>
                                 <li><a href="/blog.php?tag=php" title="">Php</a></li>
                                 <li><a href="/blog.php?tag=mysql" title="">MySQL</a></li>
                                 <li><a href="/blog.php?tag=xampp" title="">Xampp</a></li>
                                 <li><a href="/blog.php?tag=notepad" title="">Notepad</a></li>
                              </ul>
                           </div>
                           <!-- end tags cloud -->
                           
                           <div class="widget">
                              <div class="ad-widget">
                                 <img src="/ui/home/wpkixx/template_files/ad-widget.jpg" alt="">
                              </div>
                           </div>
                           <!-- end Ad Widget -->
                           
                        </aside>
                     </div>
                     <!-- side-widgets -->
                  </div>
               </div>
            </div>
         </section>

		 <!-- content with side widgets -->
         <!--parallax Ads-->         
         <section>
            <div class="">
               <div class="container">
                  <div class="row">
                     <div class="col-md-8">
                        <?php $next_post_cat = array_shift($post_categories); ?>
                        <?php $next_cat_id = $next_post_cat['category_id']; ?>
                        <h4 class="sec-heading strips"><?php echo $next_post_cat['name'] ?></h4>
                        <div class="row remove-ext">
						   <?php $filter_data = array('filter_category_id'=>$next_cat_id, 'sort'=>'post_id', 'limit'=>6); ?>
                           <?php foreach(postGetAllForCategory($filter_data) as $post) { ?>                        
                           <div class="col-sm-6">
                              <div class="post-grid-style">
                                 <a href="/blog-post.php?post_id=<?php echo $post['post_id']?>" title="">
                                 	<img src="<?php echo URL_IMAGE.$post['image']?>" alt="">
                                 </a>
                                 <div class="post-detail">
                                    <a class="category" href="/post_category.php?path=<?php echo $next_cat_id;?>" title=""><?php echo $next_post_cat['name'] ?></a>
                                    <ul class="stars-rank">
                                       <!-- li><i class="fa fa-star-half-empty"></i></li  -->
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <h2><a href="/blog-post.php?post_id=<?php echo $post['post_id']?>" title=""><?php echo $post['title'] ?></a></h2>
                                    <ul class="post-meta3">
                                       <li><i class="fa fa-calendar-o"></i><a href="#" title=""><?php echo date('d/m/Y',strtotime($post['date_added']))?></a></li>
                                       <!--li class="admin"><a href="#" title="">Admin</a></li-->
                                    </ul>
                                    <p>Scelerisque at, duis torquent laoreet neque, magna maecenas tortor convallis 
                                       aptent pellentesque duis torquent...
                                    </p>
                                 </div>
                              </div>
                           </div>
                           <?php } ?>                        
                        </div>
                     </div>
                     <div class="col-md-4">
                        <aside>
                           <!-- 
                           <div class="widget">
                              <div class="ad-widget">
                                 <img src="/ui/home/wpkixx/template_files/ad-widget.jpg" alt="">
                              </div>
                           </div>
                           -->
                           <div class="widget">
                              <div class="widget-title">
                                 <h4>Our Social Network</h4>
                              </div>
                              <ul class="social-widget">
                                 <li>
                                    <a class="social-meta facebook" href="#" title="">
                                    <i class="fa fa-facebook"></i>
                                    <span>104, 725</span>
                                    <ins>Facebook</ins>
                                    </a>
                                 </li>
                                 <li>
                                    <a class="social-meta google" href="#" title="">
                                    <i class="fa fa-google-plus"></i>
                                    <span>5, 932</span>
                                    <ins>google+</ins>
                                    </a>
                                 </li>
                                 <li>
                                    <a class="social-meta twitter" href="#" title="">
                                    <i class="fa fa-twitter"></i>
                                    <span>43, 239</span>
                                    <ins>twitter</ins>
                                    </a>
                                 </li>
                                 <li>
                                    <a class="social-meta flickr" href="#" title="">
                                    <i class="fa fa-flickr"></i>
                                    <span>1, 009</span>
                                    <ins>flickr</ins>
                                    </a>
                                 </li>
                                 <li>
                                    <a class="social-meta pinterest" href="#" title="">
                                    <i class="fa fa-pinterest-p"></i>
                                    <span>78, 294</span>
                                    <ins>pinterest</ins>
                                    </a>
                                 </li>
                              </ul>
                           </div>
                           <!-- end flickr widger -->
                           
                           <?php 
                           	$next_post_cat = array_shift($post_categories); 
                           	$next_cat_id = $next_post_cat['category_id']; 
                           ?>
                           <div class="widget">
                              <div class="widget-title">
                                 <h4><?php echo $next_post_cat['name']?></h4>
                              </div>
                              <ul class="flickr-widget">
                                 <?php $filter_data = array('filter_category_id'=>$next_cat_id, 'sort'=>'post_id', 'limit'=>9); ?>
                                 <?php foreach(postGetAllForCategory($filter_data) as $post) { ?>
                                 <li><a href="/blog-post.php?post_id=<?php echo $post['post_id']?>" title="">
                                 	<img src="<?php echo URL_IMAGE.$post['image']?>" alt="" width="100" height="85">
                                 	</a>
                                 </li>
                                 <?php } ?>
                              </ul>
                           </div>
                           <!--end flickr widger -->
                           
                           <div class="widget">
                              <div class="widget-title">
                                 <h4>Videos</h4>
                              </div>
                              <div class="popular-video owl-carousel owl-theme owl-center owl-loaded">
                                                <div class="owl-item active center" style="width: 308px; margin-right: 0px;">
                                                   <div class="video-carousel" data-hash="tab1">
                                                      <div class="video-meta">
                                                         <img src="/ui/home/wpkixx/template_files/video-widget-1.jpg" alt="">
                                                         <a href="https://player.vimeo.com/video/1084537" data-showsocial="false" class="html5lightbox" data-group="set2" title=""><i class="fa fa-play-circle-o"></i></a>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="owl-item" style="width: 308px; margin-right: 0px;">
                                                   <div class="video-carousel" data-hash="tab2">
                                                      <div class="video-meta">
                                                         <img src="/ui/home/wpkixx/template_files/video-widget-2.jpg" alt="">
                                                         <a href="https://www.youtube.com/watch?v=c9-gOVGjHvQ" data-showsocial="false" class="html5lightbox" data-group="set2" title=""><i class="fa fa-play-circle-o"></i></a>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="owl-item" style="width: 308px; margin-right: 0px;">
                                                   <div class="video-carousel" data-hash="tab3">
                                                      <div class="video-meta">
                                                         <img src="/ui/home/wpkixx/template_files/video-widget-3.jpg" alt="">
                                                         <a href="https://www.youtube.com/watch?v=nYTrIcn4rjg" data-showsocial="false" class="html5lightbox" data-group="set2" title=""><i class="fa fa-play-circle-o"></i></a>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="owl-item" style="width: 308px; margin-right: 0px;">
                                                   <div class="video-carousel" data-hash="tab4">
                                                      <div class="video-meta">
                                                         <img src="/ui/home/wpkixx/template_files/video-widget-4.jpg" alt="">
                                                         <a href="https://player.vimeo.com/video/1084537" data-showsocial="false" class="html5lightbox" data-group="set2" title=""><i class="fa fa-play-circle-o"></i></a>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="owl-item" style="width: 308px; margin-right: 0px;">
                                                   <div class="video-carousel" data-hash="tab5">
                                                      <div class="video-meta">
                                                         <img src="/ui/home/wpkixx/template_files/video-widget-5.jpg" alt="">
                                                         <a href="https://player.vimeo.com/video/1084537" data-showsocial="false" class="html5lightbox" data-group="set2" title=""><i class="fa fa-play-circle-o"></i></a>
                                                      </div>
                                                   </div>
                                                </div>
                                 
                              </div>
                              <div class="carousel-btn">
                                            <a href="#tab1" title=""><img src="/ui/home/wpkixx/template_files/video-widget-btn-1.jpg" alt=""><i class="fa fa-play-circle-o"></i></a>
                                            <a href="#tab2" title=""><img src="/ui/home/wpkixx/template_files/video-widget-btn-2.jpg" alt=""><i class="fa fa-play-circle-o"></i></a>
                                            <a href="#tab3" title=""><img src="/ui/home/wpkixx/template_files/video-widget-btn-3.jpg" alt=""><i class="fa fa-play-circle-o"></i></a>
                                            <a href="#tab4" title=""><img src="/ui/home/wpkixx/template_files/video-widget-btn-4.jpg" alt=""><i class="fa fa-play-circle-o"></i></a>
                                            <a href="#tab5" title=""><img src="/ui/home/wpkixx/template_files/video-widget-btn-5.jpg" alt=""><i class="fa fa-play-circle-o"></i></a>
                              </div>
                           </div>
                           <!-- end popular video widger -->
                        </aside>
                     </div>
                     <!-- side widgets -->
                  </div>
               </div>
            </div>
         </section>