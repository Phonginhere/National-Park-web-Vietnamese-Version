<div class="container">
  <ul class="breadcrumb">
    <li><a href="/home-blog.php"><i class="fa fa-home"></i>Trang Chủ</a></li>
    <li><a href="/blog.php">Blog Search</a></li>
  </ul>
  <div class="row">
  	
  	<!-- START CATEGORIES SIDE BAR MENU -->
  	<column id="column-left" class="col-sm-3 hidden-xs">
		<div class="list-group">
		  <?php foreach (post_categoryGetAllForMenuHomePage() as $category) { ?>
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
      <h1><?php echo $search_title; ?></h1>
      <!-- label class="control-label" for="input-search">Tiêu chí tìm kiếm</label  -->
      <div class="row">
        <div class="col-sm-4">
          <input type="text" name="search" value="<?php echo $search; ?>" placeholder="Từ khóa tìm kiếm" id="input-search" class="form-control" />
        </div>
        <label class="checkbox-inline">
          <?php if ($content) { ?>
          <input type="checkbox" name="content" value="1" id="description" checked="checked" />
          <?php } else { ?>
          <input type="checkbox" name="content" value="1" id="description" />
          <?php } ?>
          <?php echo 'Tìm trong cả nội dung bài viết'; ?></label>
          <input type="button" value="Tìm kiếm" id="button-search" class="btn btn-primary" />
      </div>
      
      <h2>Blog</h2>
      
      <?php if ($postsSearched) { ?>
      <!-- post compare if you want -->
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
            <?php foreach ($blog_sorts as $sorts) { ?>
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
            <?php foreach ($blog_limits as $limit) { ?>
            <?php if ($limit['value'] == $limit) { ?>
            <option value="<?php echo $limit['href']; ?>" selected="selected"><?php echo $limit['text']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $limit['href']; ?>"><?php echo $limit['text']; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
      </div>
      <br />
      <div class="row">
        <?php foreach ($postsSearched as $post) { ?>
        <div class="product-layout product-list col-xs-12">
          <div class="product-thumb">
            <div class="image"><a href="<?php echo $post['href']; ?>"><img src="<?php echo $post['thumb']; ?>" alt="<?php echo $post['name']; ?>" title="<?php echo $post['name']; ?>" class="img-responsive" /></a></div>
            <div>
              <div class="caption">
                <h4><a href="<?php echo $post['href']; ?>"><?php echo $post['title']; ?></a></h4>
                <p><?php echo $post['content']; ?></p>
              </div>
			  <!--
              <div class="button-group">
                <button type="button" onclick="cart.add('<?php echo $post['post_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Giỏ hàng</span></button>
                <button type="button" data-toggle="tooltip" title="<?php echo 'Whishlist'; ?>" onclick="wishlist.add('<?php echo $post['product_id']; ?>');"><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="<?php echo 'So sánh sản phẩm'; ?>" onclick="compare.add('<?php echo $post['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
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
      
      <?php if (!$postsSearched) { ?>
      <p>Không tìm thấy bài viết nào !</p>
      <div class="buttons">
        <div class="pull-right"><a href="/home.php" class="btn btn-primary">Tiếp tục</a></div>
      </div>
      <?php } ?>
      </div>
    </div>
</div>

<script type="text/javascript">

// Khi nhấp chuột vào nút tìm kiếm ...
$('#button-search').bind('click', function() { 

	// ...thì điều hướng sang trang sau...
	url = '/blog.php';

	// ...với các tham số :
	// từ khóa tìm kiếm (để so sánh với tựa đề bài viết)
	var search = $('#content input[name=\'search\']').prop('value');
	
	if (search) {
		url += '?search=' + encodeURIComponent(search);
	}

	// nếu người dùng muốn tìm kiếm từ khóa cả ở trong nội dung của bài viết:
	var filter_content = $('#content input[name=\'content\']:checked').prop('value');
	
	if (filter_content) {
		url += '&content=true';
	}

	// Bắt đầu điều hướng:
	location = url;
});

// Khi ấn phím Enter trên hộp tìm kiếm
//$('#content input[name=\'search\']').bind('keydown', function(e) {
$("#content input[name='search']").bind('keydown', function(e) {
	if (e.keyCode == 13) {
		$('#button-search').trigger('click');
	}
});


</script> 