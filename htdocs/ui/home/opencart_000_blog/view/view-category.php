<div class="container">
  <ul class="breadcrumb">
    <li><a href="/home.php"><i class="fa fa-home"></i>Trang Chủ</a></li>
    <li><a href="<?php echo $category_href; ?>">Loại Sản Phẩm</a></li>
  </ul>
  <div class="row">
  	
  	<!-- START CATEGORIES SIDE BAR MENU -->
  	<column id="column-left" class="col-sm-3 hidden-xs">
		<div class="list-group">
		  <?php foreach (categoryGetAllForMenuHomePage() as $category) { ?>
		  <?php if ($category['category_id'] == $category_id) { ?>
		  <a href="<?php echo $category['href']; ?>" class="list-group-item active"><?php echo $category['name']; ?></a>
		  <?php if ($category['children']) { ?>
		  <?php foreach ($category['children'] as $child) { ?>
		  <?php if ($child['category_id'] == $child_id) { ?>
		  <a href="<?php echo $child['href']; ?>" class="list-group-item active">&nbsp;&nbsp;&nbsp;- <?php echo $child['name']; ?></a>
		  <?php } else { ?>
		  <a href="<?php echo $child['href']; ?>" class="list-group-item">&nbsp;&nbsp;&nbsp;- <?php echo $child['name']; ?></a>
		  <?php } ?>
		  <?php } ?>
		  <?php } ?>
		  <?php } else { ?>
		  <a href="<?php echo $category['href']; ?>" class="list-group-item"><?php echo $category['name']; ?></a>
		  <?php } ?>
		  <?php } ?>
		</div>
	</column>
	<!-- END CATEGORIES SIDE BAR MENU -->
  	
    <div id="content" class="col-sm-9">
      <h2><?php echo $category_name; ?></h2>
      <?php if ($category_thumb || $category_description) { ?>
      <div class="row">
        <?php if ($category_thumb) { ?>
        <div class="col-sm-2"><img src="<?php echo $category_thumb; ?>" alt="<?php echo $category_name; ?>" title="<?php echo $category_name; ?>" class="img-thumbnail" /></div>
        <?php } ?>
        <?php if ($category_description) { ?>
        <div class="col-sm-10"><?php echo $category_description; ?></div>
        <?php } ?>
      </div>
      <hr>
      <?php } ?>
      <?php if ($sub_categories) { ?>
      <h3><?php echo "Tìm kiếm sâu hơn"; ?></h3>
      <?php if (count($sub_categories) <= 5) { ?>
      <div class="row">
        <div class="col-sm-3">
          <ul>
            <?php foreach ($sub_categories as $category) { ?>
            <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
      <?php } else { ?>
      <div class="row">
        <?php foreach (array_chunk($sub_categories, ceil(count($sub_categories) / 4)) as $sub_categories) { ?>
        <div class="col-sm-3">
          <ul>
            <?php foreach ($sub_categories as $category) { ?>
            <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
            <?php } ?>
          </ul>
        </div>
        <?php } ?>
      </div>
      <?php } ?>
      <?php } ?>
      <?php if ($productsByCategory) { ?>
      <!-- product compare if you want -->
      <div class="row">
        <div class="col-md-4">
          <div class="btn-group hidden-xs">
            <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
            <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
          </div>
        </div>
        <div class="col-md-2 text-right">
          <label class="control-label" for="input-sort">Xếp theo</label>
        </div>
        <div class="col-md-3 text-right">
          <select id="input-sort" class="form-control" onchange="location = this.value;">
            <?php foreach ($product_sorts as $sorts) { ?>
            <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
            <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-1 text-right">
          <label class="control-label" for="input-limit">Hiện</label>
        </div>
        <div class="col-md-2 text-right">
          <select id="input-limit" class="form-control" onchange="location = this.value;">
            <?php foreach ($limits as $limits) { ?>
            <?php if ($limits['value'] == $limit) { ?>
            <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
      </div>
      <br />
      <div class="row">
        <?php foreach ($productsByCategory as $product) { ?>
        <div class="product-layout product-list col-xs-12">
          <div class="product-thumb">
            <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
            <div>
              <div class="caption">
                <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
                <p><?php echo $product['description']; ?></p>
                <?php if ($product['rating']) { ?>
                <div class="rating">
                  <?php for ($i = 1; $i <= 5; $i++) { ?>
                  <?php if ($product['rating'] < $i) { ?>
                  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } else { ?>
                  <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } ?>
                  <?php } ?>
                </div>
                <?php } ?>
                <p class="price">
                  <?php echo $product['price']; ?>
                </p>
              </div>
              <div class="button-group">
                <button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Giỏ hàng</span></button>
                <button type="button" data-toggle="tooltip" title="<?php echo 'Whishlist'; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="<?php echo 'So sánh sản phẩm'; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
              </div>
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
      <?php if (!$categories && !$productsByCategory) { ?>
      <p>Không tìm thấy sản phẩm nào cho loại này</p>
      <div class="buttons">
        <div class="pull-right"><a href="/home.php" class="btn btn-primary">Tiếp tục</a></div>
      </div>
      <?php } ?>
      </div>
    </div>
</div>
