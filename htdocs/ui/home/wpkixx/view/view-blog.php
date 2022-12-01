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
                                                <h4 class="sec-heading strips">Các Bài Viết Tìm Thấy</h4>
                                                
                                                <?php foreach ($postsSearched as $post) { ?>
                                                <div class="post-list-style">
                                                    <a href="<?php echo $post['href'] ?>" title=""><img src="<?php echo $post['thumb']?>" alt=""></a>
                                                    <div class="list-post-detail">
                                                        <a class="category" href="#" title="">tìm thấy</a>
                                                        <ul class="post-meta3">
                                                            <li><i class="fa fa-calendar-o"></i><a href="#" title=""><?php echo $post['date_published']?></a></li>
                                                            <!-- <li class="admin"><a href="#" title="">Admin</a></li> -->
                                                        </ul>
                                                        <a href="<?php echo $post['href'] ?>">
                                                            <h2><?php echo $post['title'] ?></h2>
                                                        </a>
                                                        <p><?php echo $post['content_short'] ?></p>
                                                        
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
                                 <h4>Filter Form</h4>
                              </div>
                              <div class="sidebar-login">
                                 <form action="/blog.php" method="post">
                                    <label for="input-search" class="element-visible">Từ Khóa&nbsp;</label>
                                          <input id="input-search" type="text" name="search" tabindex="0" size="18" placeholder="Tìm..." value="<?php echo $search;?>">
                                          
                               <!--     <label class="checkbox-inline">
									          <?php if ($content) { ?>
									          <input type="checkbox" name="content" value="1" id="description" checked="checked" id="input-content"/>
									          <?php } else { ?>
									          <input type="checkbox" name="content" value="1" id="description" id="input-content"/>
									          <?php } ?>
									          <?php echo 'Tìm trong cả nội dung bài viết'; ?></label> -->
									          
                                   <label for="modlgn-username" class="element-visible">Xếp&nbsp;</label>
                                          <select id="input-sort" class="form-control" onchange="location = this.value;">
								            <?php foreach ($blog_sorts as $sorts) { ?>
								            <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
								            <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
								            <?php } else { ?>
								            <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
								            <?php } ?>
								            <?php } ?>
								          </select>
								          
                                     <label for="modlgn-passwd" class="element-visible">Hiện</label>
                                          <select id="input-limit" class="form-control" onchange="location = this.value;">
								            <?php foreach ($blog_limits as $lim) { ?>
								            <?php if ($lim['value'] == $limit) { ?>
								            <option value="<?php echo $lim['href']; ?>" selected="selected"><?php echo $lim['text']; ?></option>
								            <?php } else { ?>
								            <option value="<?php echo $lim['href']; ?>"><?php echo $lim['text']; ?></option>
								            <?php } ?>
								            <?php } ?>
								          </select>
                                    <!-- <button type="submit">Login</button> -->
                                 </form>
                              </div>
                           </div>
                           <!-- user login -->
                           
                           <div class="widget">
						   <!--
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
                                    <button type="submit">Login</button>
                                 </form>
                              </div> -->
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
                                 	<img src="<?php echo URL_IMAGE.$post['image']?>" alt="" width="100" height="85">
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
                                                    <a href="/blog-post.php?post_id=<?php echo $post['post_id']?>" title=""><img src="<?php echo URL_IMAGE.$post['image']?>" alt=""></a>
                                                    <h3><a href="/blog-post.php?post_id=<?php echo $post['post_id']?>" title=""><?php echo $post['title']?></a></h3>
                                                </div>
                                            </div>
                                         <?php } ?>
                                        </div>
                                    </div>
                                    <div class="gap no-top comments-sec">
                                        <div class="single-title">
                                            <h4>03 Bình luận.</h4>
                                        </div>
                                        <ul>
                                            <li>
                                                <div class="comment">
                                                    <img alt="" src="/ui/home/wpkixx/template_files/comment-avatar1.jpg">
                                                    <div class="comment-detail">
                                                        <h4><a title="" href="#">Quảng Nổ</a></h4><span>2 tháng trước</span>
                                                        <p>Tôi cực kì thích bài viết này. Tôi cực kì thích bài viết này. Tôi cực kì thích bài viết này...</p>
                                                        <a title="" href="#" class="reply"><i class="fa fa-reply"></i>Reply</a>
                                                    </div>
                                                </div><!-- Comment -->
                                                <ul>
                                                    <li>
                                                        <div class="comment">
                                                            <img alt="" src="/ui/home/wpkixx/template_files/comment-avatar2.jpg">
                                                            <div class="comment-detail">
                                                                <h4><a title="" href="#">Trương Gia Bình</a></h4><span>2 tháng trước</span>
                                                                <p>Tôi cực kì thích bài viết này. Tôi cực kì thích bài viết này. Tôi cực kì thích bài viết này...</p>
                                                                <a title="" href="#" class="reply"><i class="fa fa-reply"></i>Reply</a>
                                                            </div>
                                                        </div><!-- Comment -->
                                                    </li>
                                                </ul>											
                                            </li>
                                            <li>
                                                <div class="comment">
                                                    <img alt="" src="/ui/home/wpkixx/template_files/comment-avatar3.jpg">
                                                    <div class="comment-detail">
                                                        <h4><a title="" href="#">Phạm Nhật Vượng</a></h4><span>2 tháng trước</span>
                                                        <p>Tôi cực kì thích bài viết này. Tôi cực kì thích bài viết này. Tôi cực kì thích bài viết này...</p>
                                                        <a title="" href="#" class="reply"><i class="fa fa-reply"></i>Reply</a>
                                                    </div>
                                                </div><!-- Comment -->
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="contact-form">
                                        <div class="single-title">
                                            <h4>Để Lại Bình Luận</h4>
                                        </div>
                                        <div class="row">
                                            <form>
                                                <div class="col-sm-6">
                                                    <input placeholder="Tên của bạn*" type="text">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input placeholder="email*" type="text">
                                                </div>
                                                <div class="col-sm-12">
                                                    <textarea cols="30" rows="10" placeholder="Bình luận*"></textarea>
                                                </div>
                                                <div class="col-sm-12">
                                                    <button type="submit">Gửi</button>
                                                </div>
                                            </form>
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
         
<script type="text/javascript">

// Khi nhấp chuột vào nút tìm kiếm ...
jQuery('#button-search').bind('click', function() { 

	// ...thì điều hướng sang trang sau...
	url = '/blog.php';

	// ...với các tham số :
	// từ khóa tìm kiếm (để so sánh với tựa đề bài viết)
// 	var search = jQuery('#content input[name=\'search\']').prop('value');
	var search = jQuery('#input-search').prop('value');
	
	if (search) 
	{
		url += '?search=' + encodeURIComponent(search);
	}

	// nếu người dùng muốn tìm kiếm từ khóa cả ở trong nội dung của bài viết:
	var filter_content = jQuery('input[name=\'content\']:checked').prop('value');
	//var filter_content = jQuery('#input-content']).prop('value');
	
	if (filter_content) 
	{
		url += '&content=true';
	}

	// Bắt đầu điều hướng:
	location = url;
});

// Khi ấn phím Enter trên hộp tìm kiếm
//jQuery('#content input[name=\'search\']').bind('keydown', function(e) {
jQuery("#content input[name='search']").bind('keydown', function(e) {
	if (e.keyCode == 13) {
		jQuery('#button-search').trigger('click');
	}
});


</script>          