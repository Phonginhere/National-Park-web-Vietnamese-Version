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
                              <img src="<?php echo $post_f['image']?>" alt="">
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
                                    <img src="<?php echo $post_f['image']?>" alt="">
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
                                    <li class="active"><a href="#cat1" aria-controls="cat1" data-toggle="tab" aria-expanded="true">Minnesota</a></li>
                                    <li class=""><a href="#cat2" aria-controls="cat2" data-toggle="tab" aria-expanded="false">Florida</a></li>
                                    <li class=""><a href="#cat3" aria-controls="cat3" data-toggle="tab" aria-expanded="false">Australia</a></li>
                                    <li class=""><a href="#cat4" aria-controls="cat4" data-toggle="tab" aria-expanded="false">Australia</a></li>
                                 </ul>
                                 <!-- Tab panes -->
                                 <div class="tab-content">
                                    <?php $filter_data = array('filter_category_id'=>$next_cat_id, 'sort'=>'sort_order', 'limit'=>4); ?>
                                    <?php $n=1;?>
                                    <?php foreach(postGetAllForCategory($filter_data) as $post) { ?>
                                    <div role="tabpanel" class="tab-pane fade <?php if($n==1) echo 'remove-ext active in'?>" id="cat<?php echo $n++;?>">
<!--                                     <div role="tabpanel" class="tab-pane fade remove-ext active in" id="cat1"> -->
                                    <!--  div role="tabpanel" class="tab-pane fade" id="cat4" -->
                                       <div class="post-grid-style">
                                          <a href="http://wpkixx.com/html/headline/single.html" title=""><img src="/ui/home/wpkixx/template_files/gridpost-tab-1.jpg" alt=""></a>
                                          <div class="post-detail">
                                             <a class="category" href="#" title="">Bài Viết Nổi Bật</a>
                                             <ul class="stars-rank">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                             </ul>
                                             <h2><a href="http://wpkixx.com/html/headline/single.html" title="">Five Reasons You Should Fall In Love With Women</a></h2>
                                             <ul class="post-meta3">
                                                <li><i class="fa fa-calendar-o"></i><a href="#" title="">30 May, 2017</a></li>
                                                <li class="admin"><a href="#" title="">Admin</a></li>
                                             </ul>
                                             <p>Scelerisque at, duis torquent laoreet neque, magna maecenas tortor convallis aptent pellentesque duis torquent...</p>
                                          </div>
                                       </div>
                                    </div>
                                    <?php } // end foreach ?>
                                 </div>
                              </div>
                           </div>
                           <section>
                              <div class="gap no-bottom">
                                 <div class="col-sm-12">
                                    <h4 class="sec-heading strips">Featured Posts listing</h4>
                                    <div class="post-list-style">
                                       <a href="http://wpkixx.com/html/headline/single.html" title=""><img src="/ui/home/wpkixx/template_files/post-listing-1.jpg" alt=""></a>
                                       <div class="list-post-detail">
                                          <a class="category" href="#" title="">mixed</a>
                                          <ul class="post-meta3">
                                             <li><i class="fa fa-calendar-o"></i><a href="#" title="">30 May, 2017</a></li>
                                             <li class="admin"><a href="#" title="">Admin</a></li>
                                          </ul>
                                          <a href="http://wpkixx.com/html/headline/single.html" title="">
                                             <h2>Here's What People Saying About Car</h2>
                                          </a>
                                          <p>Congratulations
                                             to the students at The High School of Fashion to winning 
                                             the first 
                                             round in the Capital One Bank- Get Schooled Special thanks...
                                          </p>
                                       </div>
                                    </div>
                                    <div class="post-list-style">
                                       <a href="http://wpkixx.com/html/headline/single.html" title=""><img src="/ui/home/wpkixx/template_files/post-listing-2.jpg" alt=""></a>
                                       <div class="list-post-detail">
                                          <a class="category" href="#" title="">mixed</a>
                                          <ul class="post-meta3">
                                             <li><i class="fa fa-calendar-o"></i><a href="#" title="">30 May, 2017</a></li>
                                             <li class="admin"><a href="#" title="">Admin</a></li>
                                          </ul>
                                          <a href="http://wpkixx.com/html/headline/single.html" title="">
                                             <h2>This Story Behind Forest Will Haunt You!</h2>
                                          </a>
                                          <p>Congratulations
                                             to the students at The High School of Fashion to winning 
                                             the first 
                                             round in the Capital One Bank- Get Schooled Special thanks...
                                          </p>
                                       </div>
                                    </div>
                                    <div class="post-list-style">
                                       <a href="http://wpkixx.com/html/headline/single.html" title=""><img src="/ui/home/wpkixx/template_files/post-listing-3.jpg" alt=""></a>
                                       <div class="list-post-detail">
                                          <a class="category" href="#" title="">mixed</a>
                                          <ul class="post-meta3">
                                             <li><i class="fa fa-calendar-o"></i><a href="#" title="">30 May, 2017</a></li>
                                             <li class="admin"><a href="#" title="">Admin</a></li>
                                          </ul>
                                          <a href="http://wpkixx.com/html/headline/single.html" title="">
                                             <h2>5 Common Myths About Nature</h2>
                                          </a>
                                          <p>Congratulations
                                             to the students at The High School of Fashion to winning 
                                             the first 
                                             round in the Capital One Bank- Get Schooled Special thanks...
                                          </p>
                                       </div>
                                    </div>
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
                                 <form action="#">
                                    <label>
                                    <input type="text" placeholder="Username*">
                                    <i class="fa fa-user"></i>
                                    </label>
                                    <label>
                                    <input type="password" placeholder="Password*">
                                    <i class="fa fa-lock"></i>
                                    </label>
                                 </form>
                              </div>
                           </div>
                           <!-- user login -->
                           
                           <!-- Test carousel -->
                           <div class="widget">
                              <div class="widget-title">
                                 <h4>Top Reviews</h4>
                              </div>
                              <div class="progress-caro owl-carousel owl-theme">
                                 <div class="owl-item" style="width: 308px; margin-right: 0px;">
                                    <div class="progress-unit">
                                       <i>1 star</i><!-- có thể xóa cái đống progress này đi được --->
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>2 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>3 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>4 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:30%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>5 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <div class="post-progress">
                                          <img src="/ui/home/wpkixx/template_files/progressbar-post-2.jpg" alt="">
                                          <span><a href="#" title="">all the best fashion style</a></span>
                                       </div>
                                       <p>Scelerisque at, duis torquent laoreet neque, magna maecenas tortor convallis aptent pellentesque duis torquent...</p>
                                    </div>
                                 </div>
                                 <div class="owl-item" style="width: 308px; margin-right: 0px;">
                                    <div class="progress-unit">
                                       <i>1 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>2 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>3 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>4 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:30%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>5 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <div class="post-progress">
                                          <img src="/ui/home/wpkixx/template_files/progressbar-post-3.jpg" alt="">
                                          <span><a href="#" title="">all the best fashion style</a></span>
                                       </div>
                                       <p>Scelerisque at, duis torquent laoreet neque, magna maecenas tortor convallis aptent pellentesque duis torquent...</p>
                                    </div>
                                 </div>
                                 <div class="owl-item" style="width: 308px; margin-right: 0px;">
                                    <div class="progress-unit">
                                       <i>1 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>2 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>3 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>4 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:30%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>5 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <div class="post-progress">
                                          <img src="/ui/home/wpkixx/template_files/progressbar-post-1.jpg" alt="">
                                          <span><a href="#" title="">all the best fashion style</a></span>
                                       </div>
                                       <p>Scelerisque at, duis torquent laoreet neque, magna maecenas tortor convallis aptent pellentesque duis torquent...</p>
                                    </div>
                                 </div>
                                 <div class="owl-item" style="width: 308px; margin-right: 0px;">
                                    <div class="progress-unit">
                                       <i>1 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>2 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>3 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>4 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:30%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>5 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <div class="post-progress">
                                          <img src="/ui/home/wpkixx/template_files/progressbar-post-2.jpg" alt="">
                                          <span><a href="#" title="">all the best fashion style</a></span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="owl-item" style="width: 308px; margin-right: 0px;">
                                    <div class="progress-unit">
                                       <i>1 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>2 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>3 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>4 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:30%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>5 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <div class="post-progress">
                                          <img src="/ui/home/wpkixx/template_files/progressbar-post-3.jpg" alt="">
                                          <span><a href="#" title="">all the best fashion style</a></span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="owl-item" style="width: 308px; margin-right: 0px;">
                                    <div class="progress-unit">
                                       <i>1 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>2 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>3 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>4 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:30%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>5 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <div class="post-progress">
                                          <img src="/ui/home/wpkixx/template_files/progressbar-post-1.jpg" alt="">
                                          <span><a href="#" title="">all the best fashion style</a></span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="owl-item" style="width: 308px; margin-right: 0px;">
                                    <div class="progress-unit">
                                       <i>1 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>2 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>3 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>4 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:30%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <i>5 star</i>
                                       <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%">
                                             <span class="sr-only">70% Complete</span>
                                          </div>
                                       </div>
                                       <div class="post-progress">
                                          <img src="/ui/home/wpkixx/template_files/progressbar-post-2.jpg" alt="">
                                          <span><a href="#" title="">all the best fashion style</a></span>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- đã xóa owl controls ở đây --> 
                              </div>
                           </div>
                           <!-- progressbar carousel -->
                           <div class="widget">
                              <div class="widget-title">
                                 <h4>fashion posts</h4>
                              </div>
                              <div class="tab-base-post">
                                 <!-- Tab panes -->
                                 <div class="tab-content">
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
                                    <div role="tabpanel" class="tab-pane fade active in" id="post2">
                                       <div class="row">
                                          <div class="col-sm-6">
                                             <div class="wid-tab-post">
                                                <a href="#" title=""><img src="/ui/home/wpkixx/template_files/widget-tab-2.jpg" alt=""></a>
                                                <h5><a href="#" title="">special wearing in the parties</a></h5>
                                             </div>
                                          </div>
                                          <div class="col-sm-6">
                                             <div class="wid-tab-post">
                                                <a href="#" title=""><img src="/ui/home/wpkixx/template_files/widget-tab-1.jpg" alt=""></a>
                                                <h5><a href="#" title="">10 tips for facing charm in..</a></h5>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="post3">
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
                                    <div role="tabpanel" class="tab-pane fade" id="post4">
                                       <div class="row">
                                          <div class="col-sm-6">
                                             <div class="wid-tab-post">
                                                <a href="#" title=""><img src="/ui/home/wpkixx/template_files/widget-tab-2.jpg" alt=""></a>
                                                <h5><a href="#" title="">special wearing in the parties</a></h5>
                                             </div>
                                          </div>
                                          <div class="col-sm-6">
                                             <div class="wid-tab-post">
                                                <a href="#" title=""><img src="/ui/home/wpkixx/template_files/widget-tab-1.jpg" alt=""></a>
                                                <h5><a href="#" title="">10 tips for facing charm in..</a></h5>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- Tab button -->
                                 <ul class="nav nav-tabs branches wgt-style">
                                    <li class=""><a href="#post1" aria-controls="post1" data-toggle="tab" aria-expanded="false">Nature</a></li>
                                    <li class="active"><a href="#post2" aria-controls="post2" data-toggle="tab" aria-expanded="true">Lifestyle</a></li>
                                    <li class=""><a href="#post3" aria-controls="post3" data-toggle="tab" aria-expanded="false">Fashion</a></li>
                                    <li class=""><a href="#post4" aria-controls="post4" data-toggle="tab" aria-expanded="false">Travel</a></li>
                                 </ul>
                              </div>
                           </div>
                           <!-- tab base widget -->
                           <div class="widget">
                              <div class="widget-title">
                                 <h4>tags cloud</h4>
                              </div>
                              <ul class="tags-cloud">
                                 <li><a href="#" title="">wordpress</a></li>
                                 <li><a href="#" title="">Html</a></li>
                                 <li><a href="#" title="">css3</a></li>
                                 <li><a href="#" title="">jquery</a></li>
                                 <li><a href="#" title="">Php</a></li>
                                 <li><a href="#" title="">java</a></li>
                              </ul>
                           </div>
                           <!-- tags cloud -->
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
                        <h4 class="sec-heading strips">grid Posts style</h4>
                        <div class="row remove-ext">
                           <div class="col-sm-6">
                              <div class="post-grid-style">
                                 <a href="http://wpkixx.com/html/headline/single.html" title=""><img src="/ui/home/wpkixx/template_files/gridpost-tab-1.jpg" alt=""></a>
                                 <div class="post-detail">
                                    <a class="category" href="#" title="">Health</a>
                                    <ul class="stars-rank">
                                       <li><i class="fa fa-star-half-empty"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <h2><a href="http://wpkixx.com/html/headline/single.html" title="">The Reasons Why We Love Restaurant</a></h2>
                                    <ul class="post-meta3">
                                       <li><i class="fa fa-calendar-o"></i><a href="#" title="">30 May, 2017</a></li>
                                       <li class="admin"><a href="#" title="">Admin</a></li>
                                    </ul>
                                    <p>Scelerisque at, duis torquent laoreet neque, magna maecenas tortor convallis 
                                       aptent pellentesque duis torquent...
                                    </p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="post-grid-style">
                                 <a href="http://wpkixx.com/html/headline/single.html" title=""><img src="/ui/home/wpkixx/template_files/gridpost-tab-2.jpg" alt=""></a>
                                 <div class="post-detail">
                                    <a class="category" href="#" title="">Health</a>
                                    <ul class="stars-rank">
                                       <li><i class="fa fa-star-half-empty"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <h2><a href="http://wpkixx.com/html/headline/single.html" title="">Kerala, India: They call it Own Country</a></h2>
                                    <ul class="post-meta3">
                                       <li><i class="fa fa-calendar-o"></i><a href="#" title="">30 May, 2017</a></li>
                                       <li class="admin"><a href="#" title="">Admin</a></li>
                                    </ul>
                                    <p>Scelerisque at, duis torquent laoreet neque, magna maecenas tortor convallis 
                                       aptent pellentesque duis torquent...
                                    </p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="post-grid-style">
                                 <a href="http://wpkixx.com/html/headline/single.html" title=""><img src="/ui/home/wpkixx/template_files/gridpost-tab-3.jpg" alt=""></a>
                                 <div class="post-detail">
                                    <a class="category" href="#" title="">Health</a>
                                    <ul class="stars-rank">
                                       <li><i class="fa fa-star-half-empty"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <h2><a href="http://wpkixx.com/html/headline/single.html" title="">Designer fashion show kicks off Variety</a></h2>
                                    <ul class="post-meta3">
                                       <li><i class="fa fa-calendar-o"></i><a href="#" title="">30 May, 2017</a></li>
                                       <li class="admin"><a href="#" title="">Admin</a></li>
                                    </ul>
                                    <p>Scelerisque at, duis torquent laoreet neque, magna maecenas tortor convallis 
                                       aptent pellentesque duis torquent...
                                    </p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="post-grid-style">
                                 <a href="http://wpkixx.com/html/headline/single.html" title=""><img src="/ui/home/wpkixx/template_files/gridpost-tab-4.jpg" alt=""></a>
                                 <div class="post-detail">
                                    <a class="category" href="#" title="">Health</a>
                                    <ul class="stars-rank">
                                       <li><i class="fa fa-star-half-empty"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <h2><a href="http://wpkixx.com/html/headline/single.html" title="">Things That Make You Love for Works</a></h2>
                                    <ul class="post-meta3">
                                       <li><i class="fa fa-calendar-o"></i><a href="#" title="">30 May, 2017</a></li>
                                       <li class="admin"><a href="#" title="">Admin</a></li>
                                    </ul>
                                    <p>Scelerisque at, duis torquent laoreet neque, magna maecenas tortor convallis 
                                       aptent pellentesque duis torquent...
                                    </p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="post-grid-style">
                                 <a href="http://wpkixx.com/html/headline/single.html" title=""><img src="/ui/home/wpkixx/template_files/gridpost-tab-5.jpg" alt=""></a>
                                 <div class="post-detail">
                                    <a class="category" href="#" title="">Health</a>
                                    <ul class="stars-rank">
                                       <li><i class="fa fa-star-half-empty"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <h2><a href="http://wpkixx.com/html/headline/single.html" title="">7 Stereotypes About Fashion...</a></h2>
                                    <ul class="post-meta3">
                                       <li><i class="fa fa-calendar-o"></i><a href="#" title="">30 May, 2017</a></li>
                                       <li class="admin"><a href="#" title="">Admin</a></li>
                                    </ul>
                                    <p>Scelerisque at, duis torquent laoreet neque, magna maecenas tortor convallis 
                                       aptent pellentesque duis torquent...
                                    </p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="post-grid-style">
                                 <a href="http://wpkixx.com/html/headline/single.html" title=""><img src="/ui/home/wpkixx/template_files/gridpost-tab-6.jpg" alt=""></a>
                                 <div class="post-detail">
                                    <a class="category" href="#" title="">Health</a>
                                    <ul class="stars-rank">
                                       <li><i class="fa fa-star-half-empty"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <h2><a href="http://wpkixx.com/html/headline/single.html" title="">New York Fashion Week the shape</a></h2>
                                    <ul class="post-meta3">
                                       <li><i class="fa fa-calendar-o"></i><a href="#" title="">30 May, 2017</a></li>
                                       <li class="admin"><a href="#" title="">Admin</a></li>
                                    </ul>
                                    <p>Scelerisque at, duis torquent laoreet neque, magna maecenas tortor convallis 
                                       aptent pellentesque duis torquent...
                                    </p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <aside>
                           <div class="widget">
                              <div class="ad-widget">
                                 <img src="/ui/home/wpkixx/template_files/ad-widget.jpg" alt="">
                              </div>
                           </div>
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
                           <!-- flickr widger -->
                           <div class="widget">
                              <div class="widget-title">
                                 <h4>Flickr Feed</h4>
                              </div>
                              <ul class="flickr-widget">
                                 <li><a href="#" title=""><img src="/ui/home/wpkixx/template_files/flickr-widget-1.jpg" alt=""></a></li>
                                 <li><a href="#" title=""><img src="/ui/home/wpkixx/template_files/flickr-widget-2.jpg" alt=""></a></li>
                                 <li><a href="#" title=""><img src="/ui/home/wpkixx/template_files/flickr-widget-3.jpg" alt=""></a></li>
                                 <li><a href="#" title=""><img src="/ui/home/wpkixx/template_files/flickr-widget-4.jpg" alt=""></a></li>
                                 <li><a href="#" title=""><img src="/ui/home/wpkixx/template_files/flickr-widget-5.jpg" alt=""></a></li>
                                 <li><a href="#" title=""><img src="/ui/home/wpkixx/template_files/flickr-widget-6.jpg" alt=""></a></li>
                                 <li><a href="#" title=""><img src="/ui/home/wpkixx/template_files/flickr-widget-7.jpg" alt=""></a></li>
                                 <li><a href="#" title=""><img src="/ui/home/wpkixx/template_files/flickr-widget-8.jpg" alt=""></a></li>
                                 <li><a href="#" title=""><img src="/ui/home/wpkixx/template_files/flickr-widget-9.jpg" alt=""></a></li>
                              </ul>
                           </div>
                           <!-- flickr widger -->
                           <div class="widget">
                              <div class="widget-title">
                                 <h4>Popular Videos</h4>
                              </div>
                              <div class="popular-video owl-carousel owl-theme owl-center owl-loaded">
                                 <div class="owl-stage-outer">
                                    <div class="owl-stage" style="transition: all 0s ease 0s; width: 616px; transform: translate3d(0px, 0px, 0px);">
                                       <div class="owl-item active center" style="width: 308px; margin-right: 0px;">
                                          <div class="owl-stage-outer">
                                             <div class="owl-stage" style="transition: all 0s ease 0s; width: 1540px; transform: translate3d(0px, 0px, 0px);">
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
                                                         <a href="https://player.vimeo.com/video/1084537" data-showsocial="false" class="html5lightbox" data-group="set2" title=""><i class="fa fa-play-circle-o"></i></a>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="owl-item" style="width: 308px; margin-right: 0px;">
                                                   <div class="video-carousel" data-hash="tab3">
                                                      <div class="video-meta">
                                                         <img src="/ui/home/wpkixx/template_files/video-widget-3.jpg" alt="">
                                                         <a href="https://player.vimeo.com/video/1084537" data-showsocial="false" class="html5lightbox" data-group="set2" title=""><i class="fa fa-play-circle-o"></i></a>
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
                                          </div>
                                       </div>
                                       <div class="owl-item" style="width: 308px; margin-right: 0px;">
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
                              </div>
                              <div class="carousel-btn owl-carousel owl-theme owl-loaded owl-responsive-1000">
                                 <div class="owl-stage-outer">
                                    <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 208px;">
                                       <div class="owl-item active" style="width: 100px; margin-right: 4px;">
                                          <div class="owl-stage-outer">
                                             <div class="owl-stage" style="transform: translate3d(-208px, 0px, 0px); transition: all 1s ease 0s; width: 520px;">
                                                <div class="owl-item" style="width: 100px; margin-right: 4px;"><a href="#tab1" title=""><img src="/ui/home/wpkixx/template_files/video-widget-btn-1.jpg" alt=""><i class="fa fa-play-circle-o"></i></a></div>
                                                <div class="owl-item" style="width: 100px; margin-right: 4px;"><a href="#tab2" title=""><img src="/ui/home/wpkixx/template_files/video-widget-btn-2.jpg" alt=""><i class="fa fa-play-circle-o"></i></a></div>
                                                <div class="owl-item active" style="width: 100px; margin-right: 4px;"><a href="#tab3" title=""><img src="/ui/home/wpkixx/template_files/video-widget-btn-3.jpg" alt=""><i class="fa fa-play-circle-o"></i></a></div>
                                                <div class="owl-item active" style="width: 100px; margin-right: 4px;"><a href="#tab4" title=""><img src="/ui/home/wpkixx/template_files/video-widget-btn-4.jpg" alt=""><i class="fa fa-play-circle-o"></i></a></div>
                                                <div class="owl-item active" style="width: 100px; margin-right: 4px;"><a href="#tab5" title=""><img src="/ui/home/wpkixx/template_files/video-widget-btn-5.jpg" alt=""><i class="fa fa-play-circle-o"></i></a></div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="owl-item active" style="width: 100px; margin-right: 4px;">
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
                              </div>
                           </div>
                           <!-- popular video widger -->
                        </aside>
                     </div>
                     <!-- side widgets -->
                  </div>
               </div>
            </div>
         </section>