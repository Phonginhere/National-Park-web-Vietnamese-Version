<?php $post_categories = post_categoryGetAll(); ?>

		 
         
         <!-- weekly gird post md3 -->
         <section>
            <div class="">
               <div class="container">
                  <div class="row">
                     <div class="col-md-8">
                        <!-- đã xóa nội dung cũ -->
                        
                        <!-- Nội dung mới -->
                        <div class="row">
                                    
                                    <section>
                                        <div class="gap no-bottom">
                                            <div class="col-sm-12">
                                                <h4 class="sec-heading strips"><?php echo $category_name; ?></h4>
                                                
                                                <?php foreach ($postsByCategory as $post) { ?>
                                                <div class="post-list-style">
                                                    <a href="<?php echo $post['href']; ?>"><img src="<?php echo $post['thumb']; ?>" alt="<?php echo $post['name']; ?>" title="<?php echo $post['name']; ?>" class="img-responsive" /></a>
                                                    <div class="list-post-detail">
                                                        <a class="category" href="#" title=""><?php echo $category_name; ?></a>
                                                        <ul class="post-meta3">
                                                            <li><i class="fa fa-calendar-o"></i><a href="#" title=""><?php echo $post['date_published']; ?></a></</li>
                                                        <!--    <li class="admin"><a href="#" title="">ADMIN</a></li> -->
                                                        </ul>
                                                        <a href="<?php echo $post['href']; ?>" title="">
                                                            <h2><?php echo $post['title']?></h2>
                                                        </a>
                                                        <p><?php echo utf8_substr(strip_tags(html_entity_decode($post['content'], ENT_QUOTES, 'UTF-8')), 0, 250) . '..'?></p>
                                                        
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </section>
                                    <div class="pagination">
							      	  <?php echo $web_pagination_controls; ?>
							          <p class="counter pull-right"><?php echo $web_pagination_results; ?></p>
							      </div>
                                    
                                    
                          </div><!-- end .row -->
                     </div><!-- end col-md-8 -->
                     <!-- content -->
                     <div class="col-md-4">
                        <aside>
						
                           <div class="widget">
						   
                              <div class="widget-title">
                            <!--     <h4>Filter Form</h4>
                              </div>
							 
                              <div class="sidebar-login">
							  
                                 <form action="/login.php" method="post">
                                    <label for="modlgn-username" class="element-visible">Xếp&nbsp;</label>
                                          <select id="input-sort" class="form-control" onchange="location = this.value;">
								            <?php foreach ($post_sorts as $sorts) { ?>
								            <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
								            <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
								            <?php } else { ?>
								            <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
								            <?php } ?>
								            <?php } ?>
								          </select> 
								          
                                     <label for="modlgn-passwd" class="element-visible">Hiện</label>
                                          <select id="input-limit" class="form-control" onchange="location = this.value;">
								            <?php foreach ($limits as $limi) { ?>
								            <?php if ($limi['value'] == $limit) { ?>
								            <option value="<?php echo $limi['href']; ?>" selected="selected"><?php echo $limi['text']; ?></option>
								            <?php } else { ?>
								            <option value="<?php echo $limi['href']; ?>"><?php echo $limi['text']; ?></option>
								            <?php } ?>
								            <?php } ?>
								          </select> -->
										  
										  
                                    <!-- <button type="submit">Login</button> -->
                                 </form> 
                              </div>
                           </div>
                           <!-- user login -->
                           
                           <div class="widget">
                        <!--      <div class="widget-title">
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
                                    <button type="submit">Login</button>
                                 </form>
                              </div>  -->
							  <div class="widget-title"> 
                                            <h4>Tin Thư</h4>
                                        </div>
                                        <div class="subscribe-us">
                                            <i class="fa fa-envelope-o"></i>
                                            <span>Hãy đăng kí nhận tin từ chúng tôi để luôn cập nhật với tin tức hằng ngày.</span>
                                            <form method="post" action="/contact.php">
                                                <input type="text" placeholder="Your Email*">
                                                <button><i class="fa fa-reply"></i></button>
                                                
                                                <input type="hidden" name="subject" value="Nhận Tin Thư"/>
                                                <input type="hidden" name="message" value="Tôi muốn nhận tin thư hằng ngày"/>
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
                           <div class="widget">
                              <div class="widget-title">
                                 <h4><?php echo $next_post_cat['name_no_path']?></h4>
                              </div>
                              <ul class="flickr-widget">
                                 <?php $filter_data = array('filter_category_id'=>$next_cat_id, 'sort'=>'post_id', 'limit'=>9); ?>
                                 <?php foreach(postGetAllForCategory($filter_data) as $post) { ?>
                                 <li><a href="/blog-post.php?post_id=<?php echo $post['post_id']?>" title="">
                                 	<img src="<?php echo URL_IMAGE.$post['image']?>" alt="" width="30" >
                                 	</a>
                                 </li>
                                 <?php } ?>
                              </ul>
                           </div>
                           <!--end flickr widger: phải chèn 1 widget vào trên tab-base-post thì mới xong !!! -->
                           
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
                                    
                                 </div>
                                 <br style="clear:both"/>
                                 <!-- Tab button -->
                                 <ul class="nav nav-tabs branches wgt-style">
                                    <li class="active"><a href="#post1" aria-controls="post1" data-toggle="tab" aria-expanded="false">Tab1</a></li>
                                    <li class=""><a href="#post2" aria-controls="post2" data-toggle="tab" aria-expanded="true">Tab2</a></li>
                                    <li class=""><a href="#post3" aria-controls="post3" data-toggle="tab" aria-expanded="false">Tab3</a></li>
                                    <li class=""><a href="#post4" aria-controls="post4" data-toggle="tab" aria-expanded="false">Tab4</a></li>
                                    <!-- li class=""><a href="#post5" aria-controls="post5" data-toggle="tab" aria-expanded="false">Tab5</a></li  bị hỏng ăn -->
                                 </ul>
                              </div>
                              <br style="clear:both"/>
                           </div>
                           <!-- end tab base widget -->
                           
                           
                           <div class="widget">
                              <div class="widget-title">
                                 <h4>tags cloud</h4>
                              </div>
                              <ul class="tags-cloud">
                                 <li><a href="/blog.php?tag=Cát Bà" title="">Cát Bà</a></li>
                                 <li><a href="/blog.php?tag=Nam Cát Tiên" title="">Nam Cát Tiên</a></li>
                                 <li><a href="/blog.php?tag=Núi Chúa" title="">Núi Chúa</a></li>
                                 <li><a href="/blog.php?tag=Động Vật" title="">Động Vật</a></li>
                                 <li><a href="/blog.php?tag=Du lịch" title="">Du lịch</a></li>
                                 <li><a href="/blog.php?tag=Tình Nguyện Viên" title="">Tình Nguyện Viên</a></li>
                                 <li><a href="/blog.php?tag=Thiên Nhiên" title="">Thiên Nhiên</a></li>
                                 <li><a href="/blog.php?tag=Du Khách" title="">Du Khách</a></li>
                                 <li><a href="/blog.php?tag=Tiềm Năng" title="">Tiềm Năng</a></li>
                              </ul>
                           </div>
                           
                           <!-- end tags cloud -->
                           
                           <!-- 
                           <div class="widget">
                              <div class="ad-widget">
                                 <img src="/ui/home/wpkixx/template_files/ad-widget.jpg" alt="">
                              </div>
                           </div>
                           -->
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
                       <!-- nội dung cũ đã bị xóa -->
                       <div class="blog-single">
                       <?php 
                           	$next_post_cat = array_shift($post_categories); 
                           	$next_cat_id = $next_post_cat['category_id']; 
                       ?>
                                    <div class="gap single-related">
                                        <div class="single-title">
                                            <h4><?php echo $next_post_cat['name'] ?></h4>
                                        </div>
                                        <div class="row">
                                        <?php $filter_data = array('filter_category_id'=>$next_cat_id, 'sort'=>'post_id', 'limit'=>3); ?>
                                        <?php foreach(postGetAllForCategory($filter_data) as $post) { ?>
                                            <div class="col-sm-4">
                                                <div class="single-related">
                                                    <a href="/blog-post.php?post_id=<?php echo $post['post_id']?>" title=""><img src="<?php echo URL_IMAGE.$post['image']?>" alt="" style="height: 180px; width: 250px;"></a>
                                                    <h3><a href="/blog-post.php?post_id=<?php echo $post['post_id']?>" title=""><?php echo $post['title']?></a></h3>
                                                </div>
                                            </div>
                                         <?php } ?>
                                        </div>
                                    </div>
								
                                    
                                </div>
                     </div><!-- end col-md-8 -->
                     <div class="col-md-4">
                        <aside>
                           <!-- 
                           <div class="widget">
                              <div class="ad-widget">
                                 <img src="/ui/home/wpkixx/template_files/ad-widget.jpg" alt="">
                              </div>
                           </div>
                           -->
                           
                           
                           <?php 
                           	$next_post_cat = array_shift($post_categories); 
                           	$next_cat_id = $next_post_cat['category_id']; 
                           ?>
                           <div class="widget">
                              <div class="widget-title">
                                 <h4><?php echo $next_post_cat['name_no_path']?></h4>
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
                        </aside>
                     </div>
                     <!-- side widgets -->
                  </div>
               </div>
            </div>
         </section>