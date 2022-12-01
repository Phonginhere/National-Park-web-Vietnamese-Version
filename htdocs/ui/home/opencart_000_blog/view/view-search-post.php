<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h1><?php echo $search_title; ?></h1>
      <label class="control-label" for="input-search">Tiêu chí tìm kiếm</label>
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
          <?php echo 'Tìm kiếm trong cả mô tả sản phẩm'; ?></label>
          <input type="button" value="Tìm kiếm" id="button-search" class="btn btn-primary" />
      </div>
      
      <h2>Kết Quả Tìm Kiếm</h2>
      <?php if ($postsSearched) { ?>
      <div class="row">
        <div class="col-sm-3 hidden-xs">
          <div class="btn-group">
            <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
            <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
          </div>
        </div>
        <div class="col-sm-1 col-sm-offset-2 text-right">
          <label class="control-label" for="input-sort">Xếp theo</label>
        </div>
        <div class="col-sm-3 text-right">
          <select id="input-sort" class="form-control col-sm-3" onchange="location = this.value;">
            <?php foreach ($search_sorts as $sorts) { ?>
            <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
            <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
        <div class="col-sm-1 text-right">
          <label class="control-label" for="input-limit">Hiện</label>
        </div>
        <div class="col-sm-2 text-right">
          <select id="input-limit" class="form-control" onchange="location = this.value;">
            <?php foreach ($search_limits as $limits) { ?>
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
        <?php foreach ($postsSearched as $post) { ?>
        <div class="product-layout product-list col-xs-12">
          <div class="product-thumb">
            <div class="image"><a href="<?php echo $post['href']; ?>"><img src="<?php echo $post['thumb']; ?>" alt="<?php echo $post['title']; ?>" title="<?php echo $post['title']; ?>" class="img-responsive" /></a></div>
            <div class="caption">
              <h4><a href="<?php echo $post['href']; ?>"><?php echo $post['title']; ?></a></h4>
              <p><?php echo $post['content']; ?></p>
              <!-- p class="price"><?php echo $post['price']; ?></p -->
              <?php if ($post['rating']) { ?>
              <div class="rating">
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                <?php if ($post['rating'] < $i) { ?>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                <?php } else { ?>
                <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                <?php } ?>
                <?php } ?>
              </div>
              <?php } ?>
            </div>
            <!--
			<div class="button-group">
              <button type="button" onclick="cart.add('<?php echo $post['product_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Giỏ hàng</span></button>
              <button type="button" data-toggle="tooltip" title="Whishlist" onclick="wishlist.add('<?php echo $post['product_id']; ?>');"><i class="fa fa-heart"></i></button>
              <button type="button" data-toggle="tooltip" title="So sánh" onclick="compare.add('<?php echo $post['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
            </div>
			-->
          </div>
        </div>
        <?php } ?>
      </div>
      <div class="row">
      	<div class="col-sm-6 text-left"><?php echo $web_pagination_controls; ?></div>
          <div class="col-sm-6 text-right"><?php echo $web_pagination_results; ?></div>
      </div>
      <?php } else { ?>
      <p><?php echo 'Không tìm thấy kết quả nào phù hợp'; ?></p>
      <?php } ?>
      </div>
    </div>
</div>
<script type="text/javascript">
$('#button-search').bind('click', function() { // Khi nhấp chuột vào nút tìm kiếm ... 

	// ...thì điều hướng sang trang sau...
	url = '/search-post.php';

	// ...với các tham số :
	// từ khóa tìm kiếm (để so sánh với tựa đề bài viết)
	var search = $('#content input[name=\'search\']').prop('value');
	
	if (search) {
		url += '?search=' + encodeURIComponent(search);
	}

	var category_id = $('#content select[name=\'category_id\']').prop('value');
	
	if (category_id > 0) {
		url += '&category_id=' + encodeURIComponent(category_id);
	}
	
	var sub_category = $('#content input[name=\'sub_category\']:checked').prop('value');
	
	if (sub_category) {
		url += '&sub_category=true';
	}

	// nếu người dùng muốn tìm kiếm từ khóa cả ở trong nội dung của bài viết:
	var filter_content = $('#content input[name=\'content\']:checked').prop('value');
	
	if (filter_content) {
		url += '&content=true';
	}

	location = url;
});

$('#content input[name=\'search\']').bind('keydown', function(e) {
	if (e.keyCode == 13) {
		$('#button-search').trigger('click');
	}
});

$('select[name=\'category_id\']').on('change', function() {
	if (this.value == '0') {
		$('input[name=\'sub_category\']').prop('disabled', true);
	} else {
		$('input[name=\'sub_category\']').prop('disabled', false);
	}
});

$('select[name=\'category_id\']').trigger('change');

</script> 
