<div class="container">
    <div class="row">
        <div id="content" class="col-sm-12">
             <!-- 
             SLIDE SHOW BANNER TO VÀ DÀI Ở TRANG CHỦ (đang bị lỗi khi thu nhỏ)
             phải xóa đi nhiều mã html sinh ra ở bản lưu từ IE về thì slide mới chạy được. 
             -->
             <div id="slideshow0" class="flexslider">
             	<ul class="slides" style="width: 400%; transition-duration: 0.6s; transform: translate3d(-1132px, 0px, 0px);">
                <?php foreach (banner_imageActives() as $banner) { ?>
					<li style="width: 1132px; float: left; display: block;">
						<?php if ($banner['link']) { ?>
						<a href="<?php echo $banner['link']; ?>">
							<img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
						</a>
						<?php } else { ?>
						<img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
						<?php } ?>
						<?php echo $banner['description'];?>
					</li>
				<?php } ?>
            	</ul>
            </div>
            <script type="text/javascript">
                $('#slideshow0').flexslider({
                    animation: 'slide',
                    animationLoop: true,
                    itemWidth: 1140
                });
            </script>
            
            <!-- START LOẠI TIN NỔI BẬT -->
            <h3>Loại Tin Nổi Bật</h3>
		    <div class="row"  style="border-bottom: #ddd solid 1px;">
		    	<?php foreach (post_categoryFeatureds() as $category) { ?>
				<div class="col-sm-4">
					<a href="<?php echo $category['href']; ?>">
					<img src="<?php echo $category['thumb']; ?>" alt="banner-3" title="banner-3" width="<?php echo $category['width']?>" height="<?php echo $category['height']?>" style="transition: all 0.5s ease;z-index: -100">
					<div class="s-desc" style="">
						<h1><?php echo $category['name']; ?></h1>
					</div>
					</a>
				</div>
				<?php } ?>
		    </div>
		    <!-- END LOẠI TIN GIỚI THIỆU -->
		    
		    <!-- START Bài Viết Nổi Bật -->
		    <h3>Bài Viết Nổi Bật</h3>
            <div class="row product-layout">
			    <?php foreach (postFeatureds() as $post) { ?>                
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="product-thumb transition">
                        <div class="image">
                            <a href="<?php echo $post['href']; ?>">
                            	<img src="<?php echo $post['thumb']; ?>" alt="<?php echo $post['title']; ?>" title="<?php echo $post['title']; ?>" class="img-responsive">
                            </a>
                        </div>
                        <div class="caption">
                            <h4><a href="<?php echo $post['href']; ?>"><?php echo $post['title_substr']; ?></a></h4>
                            <p><?php echo $post['content_substr']; ?></p>
                            <!-- 
                            <p class="price">
                                <span class="price-new"><?php echo $post['price']; ?></span> 
                                
                                <span class="price-old">$122.00</span>
                                <span class="price-tax">Ex Tax: $80.00</span>
                                
                            </p>
                            -->
                        </div>
                        <div class="button-group">
                            <button type="button" onclick="location.href='<?php echo $post['href']?>'"><i class="fa fa fa-exchange"></i> <span class="hidden-xs hidden-sm hidden-md">Đọc Thêm...</span></button>
                            <button type="button" data-toggle="tooltip" title="" onclick="Colorx()	" data-original-title=""><i class="fa fa-heart" id="heart"></i></button>
                            <button type="button" data-toggle="tooltip" title="" onclick="" data-original-title=""><i class="fa fa-shopping-cart"></i></button> 

                        </div>
                    </div>
                </div>
                <?php }  ?>
            </div>
			<script>
				var isSelected = true


const Colorx = (index) => {
    debugger
    var x = document.getElementsByClassName('fa fa-heart');
    if(isSelected) {
            x[0].style.color = "red";
           
    } else {
		x[0].style.color = "grey";
        
    }
    isSelected = !isSelected;
	
			</script>
            <!-- END Bài Viết Nổi Bật -->

			<!-- Start Slideshow Carousel -->
			<!-- 		    
			<h3>Nhãn Hàng Nổi Bật</h3>
             <div id="carousel0" class="flexslider carousel">
                    <ul class="slides" style="width: 2200%; transition-duration: 0.6s; transform: translate3d(-1540px, 0px, 0px);">
                        
                        <?php //foreach (manufacturerFeatureds() as $manufacturer) { ?>
                        <li style="width: 208px; float: left; display: block;">
						    <a href="<?php echo $manufacturer['link']; ?>">
						    	<img src="<?php echo $manufacturer['image']; ?>" alt="<?php echo $manufacturer['name']; ?>" class="img-responsive" draggable="false" />
						    </a>
						 </li>
						 <?php //} ?>
                    </ul>
            </div>
            -->
            
            <script type="text/javascript">
//                 $(window).load(function() {
//                     $('#carousel0').flexslider({
//                         animation: 'slide',
//                         itemWidth: 130,
//                         itemMargin: 100,
//                         minItems: 2,
//                         maxItems: 4
//                     });
//                 });
            </script>
            
            <!-- End Slideshow Carousel -->
            
			<!-- Tham khảo cách nhúng bản đồ Google Map vào html
			https://support.google.com/maps/answer/144361?hl=vi&co=GENIE.Platform%3DDesktop
			 -->
			<?php echo $settings['html_google_map_embed'];?>
        </div>
    </div>
</div>

