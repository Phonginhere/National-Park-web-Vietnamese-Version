<div class="container">
  <ul class="breadcrumb">
    <li><a href="/home.php"><i class="fa fa-home"></i>Trang Chủ</a></li>
    <li><a href="/testimonial.php">Lời chứng thực</a></li>
  </ul>
  <div class="row">
    <div id="content" class="col-sm-9">
      
      <?php if ($testimonials) { ?>
      <!-- product compare if you want -->
      <div class="row">
        <div class="col-md-4">
          <div class="btn-group hidden-xs">
            <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
            <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
          </div>
        </div>

        <!--
        <div class="col-md-2 text-right">
          <label class="control-label" for="input-sort">Xếp theo</label>
        </div>
        -->

      </div>
      <br />
      <div class="row">
        <?php foreach ($testimonials as $testimonial) { ?>
        <div class="product-layout product-list col-xs-12">
          <div class="product-thumb">
            <div class="image">
                <a href="<?php echo $testimonial['href']; ?>">
                    <img src="<?php echo $testimonial['thumb']; ?>" alt="<?php echo $testimonial['name']; ?>" title="<?php echo $testimonial['name']; ?>" class="img-responsive" />
                </a>
                <h4><?php echo $testimonial['name']; ?></h4>-<span><?php echo $testimonial['job']; ?></span>
            </div>
            <div>
              <div class="caption">
                <!-- h3><?php echo $testimonial['name']; ?></h3 -->
                <blockquote><?php echo $testimonial['title']; ?></blockquote>
                <p>"<?php echo $testimonial['content']; ?>"</p>
              </div>
              <!--
              <div class="button-group">
                <button type="button" onclick="cart.add('<?php echo $testimonial['product_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Giỏ hàng</span></button>
                <button type="button" data-toggle="tooltip" title="<?php echo 'Whishlist'; ?>" onclick="wishlist.add('<?php echo $testimonial['product_id']; ?>');"><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="<?php echo 'So sánh sản phẩm'; ?>" onclick="compare.add('<?php echo $testimonial['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
              </div>
              -->
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <div class="row">
      	  <div class="col-sm-6 text-left"><?php echo $web_pagination_controls; ?></div>
          <div class="col-sm-6 text-right"><?php echo $web_pagination_results; ?></div>
      </div>
      <?php } ?>

      <?php if (!$testimonials) { ?>
      <p>Không tìm thấy lời chứng thực nào</p>
      <div class="buttons">
        <div class="pull-right"><a href="/home.php" class="btn btn-primary">Tiếp tục</a></div>
      </div>
      <?php } ?>
      </div>
    </div>
</div>
