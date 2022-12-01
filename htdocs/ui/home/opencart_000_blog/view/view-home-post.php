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
            
            <!-- START LOẠI SẢN PHẨM NỔI BẬT -->
            <h3>Danh Mục Nổi Bật</h3>
		    <div class="row"  style="border-bottom: #ddd solid 1px;">
		    	<?php foreach (categoryFeatureds() as $category) { ?>
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
		    <!-- END LOẠI SẢN PHẨM GIỚI THIỆU -->
		    
		    <!-- START SẢN PHẨM NỔI BẬT -->
		    <h3>Sản Phẩm Nổi Bật</h3>
            <div class="row product-layout">
			    <?php foreach (productFeatureds() as $product) { ?>                
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="product-thumb transition">
                        <div class="image">
                            <a href="<?php echo $product['href']; ?>">
                            	<img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive">
                            </a>
                        </div>
                        <div class="caption">
                            <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
                            <p><?php echo $product['description']; ?></p>
                            <p class="price">
                                <span class="price-new"><?php echo $product['price']; ?></span> 
                                <!-- 
                                <span class="price-old">$122.00</span>
                                <span class="price-tax">Ex Tax: $80.00</span>
                                 -->
                            </p>
                        </div>
                        <div class="button-group">
                            <button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Thêm vào giỏ</span></button>
                            <button type="button" data-toggle="tooltip" title="" onclick="alert('đang xây dựng...');//wishlist.add('30');" data-original-title="Add to Wish List"><i class="fa fa-heart"></i></button>
                            <button type="button" data-toggle="tooltip" title="" onclick="compare.add('<?php echo $product['product_id']?>');" data-original-title="So sánh sản phẩm"><i class="fa fa-exchange"></i></button>
                        </div>
                    </div>
                </div>
                <?php }  ?>
            </div>
			
			<h3>Nhãn Hàng Nổi Bật</h3>
             <!-- SLIDE SHOW ẢNH LOGO CÁC HÃNG SẢN XUẤT -->
             <div id="carousel0" class="flexslider carousel">
                    <ul class="slides" style="width: 2200%; transition-duration: 0.6s; transform: translate3d(-1540px, 0px, 0px);">
                        
                        <?php foreach (manufacturerFeatureds() as $manufacturer) { ?>
                        <li style="width: 208px; float: left; display: block;">
						    <a href="<?php echo $manufacturer['link']; ?>">
						    	<img src="<?php echo $manufacturer['image']; ?>" alt="<?php echo $manufacturer['name']; ?>" class="img-responsive" draggable="false" />
						    </a>
						 </li>
						 <?php } ?>
                    </ul>
            </div>
            
            <script type="text/javascript">
                $(window).load(function() {
                    $('#carousel0').flexslider({
                        animation: 'slide',
                        itemWidth: 130,
                        itemMargin: 100,
                        minItems: 2,
                        maxItems: 4
                    });
                });
            </script>
            
			<!-- Tham khảo cách nhúng bản đồ Google Map vào html
			https://support.google.com/maps/answer/144361?hl=vi&co=GENIE.Platform%3DDesktop
			 -->
			<?php echo $settings['html_google_map_embed'];?>
        </div>
    </div>
</div>

