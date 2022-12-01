<div class="container">
  <ul class="breadcrumb">
    <li><a href="/home.php"><i class="fa fa-home"></i>Trang Chủ</a></li>
    <li><a href="/product-info.php?product_id=<?php echo $_GET['product_id']; ?>"><?php echo $product_name;?></a></li>
  </ul>
  <div class="row">
    <div id="content" class="col-sm-12">
      <div class="row">
        <div class="col-sm-8">
          <?php if ($thumb || $product_images) { ?>
          <ul class="thumbnails">
            <?php if ($thumb) { ?>
            <li><a class="thumbnail" href="<?php echo $popup; ?>" title="<?php echo $product_name;?>"><img src="<?php echo $thumb; ?>" title="<?php echo $product_name; ?>" alt="<?php echo $product_name; ?>" /></a></li>
            <?php } ?>
            <?php if ($product_images) { ?>
            <?php foreach ($product_images as $image) { ?>
            <li class="image-additional">
            	<a class="thumbnail" rel="fancybox" href="<?php echo $image['popup']; ?>" title="<?php echo $product_name; ?>"> <img src="<?php echo $image['thumb']; ?>" title="<?php echo $product_name; ?>" alt="<?php echo $product_name; ?>" /></a>
            </li>
            <?php } ?>
            <?php } ?>
          </ul>
          <?php } ?>
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-description" data-toggle="tab">Mô tả</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-description"><?php echo $description; ?></div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="btn-group">
            <button type="button" data-toggle="tooltip" class="btn btn-default" title="Wishlist" onclick="wishlist.add('<?php echo $product_id; ?>');"><i class="fa fa-heart"></i></button>
            <button type="button" data-toggle="tooltip" class="btn btn-default" title="So sánh sản phẩm" onclick="compare.add('<?php echo $product_id; ?>');"><i class="fa fa-exchange"></i></button>
          </div>
          <h1><?php echo $product_name; ?></h1>
          <ul class="list-unstyled">
            <?php if ($manufacturer) { ?>
            <li>Nhà sản xuất <a href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a></li>
            <?php } ?>
            <li>Model <?php echo $model; ?></li>
            <li>Tình trạng <?php echo $stock; ?></li>
          </ul>
          <ul class="list-unstyled">
            <li>
              <h2><?php echo $product_price; ?></h2>
            </li>
          </ul>
          <div id="product">
            <div class="form-group">
              <label class="control-label" for="input-quantity">Số lượng</label>
              <input type="text" name="quantity" value="<?php echo $minimum; ?>" size="2" id="input-quantity" class="form-control" />
              <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
              <br />
              <button type="button" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary btn-lg btn-block">Thêm vào giỏ hàng</button>
            </div>
          </div>
        </div>
      </div>
      <?php if (productsRelated($_GET['product_id'])) { ?>
      <h3>Sản phẩm liên quan</h3>
      <div class="row">
        <?php $i = 0; ?>
        <?php foreach (productsRelated($_GET['product_id']) as $product) { ?>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="product-thumb transition">
            <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
            <div class="caption">
              <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
              <p><?php echo $product['description']; ?></p>
              <?php if ($product['rating']) { ?>
              <div class="rating">
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                <?php if ($product['rating'] < $i) { ?>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <?php } else { ?>
                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                <?php } ?>
                <?php } ?>
              </div>
              <?php } ?>
              <?php if ($product['price']) { ?>
              <p class="price">
                <?php echo $product['price']; ?>
              </p>
              <?php } ?>
            </div>
            <div class="button-group">
              <button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><span class="hidden-xs hidden-sm hidden-md">Giỏ hàng</span> <i class="fa fa-shopping-cart"></i></button>
              <button type="button" data-toggle="tooltip" title="Wishlist" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
              <button type="button" data-toggle="tooltip" title="So sánh sản phẩm" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
            </div>
          </div>
        </div>
        <?php if (($column_left && $column_right) && ($i % 2 == 0)) { ?>
        <div class="clearfix visible-md visible-sm"></div>
        <?php } elseif (($column_left || $column_right) && ($i % 3 == 0)) { ?>
        <div class="clearfix visible-md"></div>
        <?php } elseif ($i % 4 == 0) { ?>
        <div class="clearfix visible-md"></div>
        <?php } ?>
        <?php $i++; ?>
        <?php } ?>
      </div>
      <?php } ?>
      <?php if ($tags) { ?>
      <p><?php echo $text_tags; ?>
        <?php for ($i = 0; $i < count($tags); $i++) { ?>
        <?php if ($i < (count($tags) - 1)) { ?>
        <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
        <?php } else { ?>
        <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
        <?php } ?>
        <?php } ?>
      </p>
      <?php } ?>
      </div>
    </div>
</div>

<script type="text/javascript">
$('#button-cart').on('click', function() {
	$.ajax({
		url: '/cart-add.php',
		type: 'post',
		data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-cart').button('loading');
		},
		complete: function() {
			$('#button-cart').button('reset');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				
				// Highlight any found errors
				$('.text-danger').parent().addClass('has-error');
			}
			
			if (json['success']) {
				$('.breadcrumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				
				$('#cart-total').html(json['total']);
				
				$('html, body').animate({ scrollTop: 0 }, 'slow');
				
				$('#cart > ul').load('/cart-ajax.php ul li');
			}
		}
	});
});

</script> 

<script type="text/javascript">
$(function(){
	$('.date').datetimepicker({
		pickTime: false
	});

	$('.datetime').datetimepicker({
		pickDate: true,
		pickTime: true
	});

	$('.time').datetimepicker({
		pickDate: false
	});
});


</script> 

<script type="text/javascript">
//Slideshow ảnh sản phẩm
// $(document).ready(function() { // không chạy !!!

// 	$('.thumbnails').magnificPopup({
// 		type:'image',
// 		delegate: 'li > a',
// 		gallery: {
// 			enabled:true
// 		}
// 	});
	
// });

	$('.thumbnails').magnificPopup({ // chạy ngon (: >
		type:'image',
		delegate: 'li > a',
		gallery: {
			enabled:true
		}
	});
	
</script>
