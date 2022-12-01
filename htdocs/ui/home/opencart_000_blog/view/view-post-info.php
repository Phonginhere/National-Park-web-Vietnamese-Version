<div class="container">
  <ul class="breadcrumb">
    <li><a href="/home.php"><i class="fa fa-home"></i>Trang Chủ</a></li>
    <li><a href="/post-info.php?post_id=<?php echo $_GET['post_id']; ?>"><?php echo $post_info['title'];?></a></li>
  </ul>
  <div class="row">
    <div id="content" class="col-sm-12">
      <div class="row">
        <div class="col-sm-8">
          <?php if ($post_info['thumb'] || $post_info['post_images']) { ?>
          <ul class="thumbnails">
            <?php if ($post_info['thumb']) { ?>
            <li><a class="thumbnail" href="<?php echo $post_info['popup']; ?>" title="<?php echo $post_info['title'];?>"><img src="<?php echo $post_info['thumb']; ?>" title="<?php echo $post_info['title']; ?>" alt="<?php echo $post_info['title']; ?>" /></a></li>
            <?php } ?>
            <?php if ($post_info['post_images']) { ?>
            <?php foreach ($post_info['post_images'] as $image) { ?>
            <li class="image-additional">
            	<a class="thumbnail" rel="fancybox" href="<?php echo $image['popup']; ?>" title="<?php echo $post_info['title']; ?>"> <img src="<?php echo $image['thumb']; ?>" title="<?php echo $post_info['title']; ?>" alt="<?php echo $post_info['title']; ?>" /></a>
            </li>
            <?php } ?>
            <?php } ?>
          </ul>
          <?php } ?>
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-description" data-toggle="tab">Mô tả</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-description"><?php echo $post_info['content']; ?></div>
          </div>
        </div>
        <div class="col-sm-4">
          <!--
          <div class="btn-group">
            <button type="button" data-toggle="tooltip" class="btn btn-default" title="Wishlist" onclick="wishlist.add('<?php echo $post_info['post_id']; ?>');"><i class="fa fa-heart"></i></button>
            <button type="button" data-toggle="tooltip" class="btn btn-default" title="So sánh sản phẩm" onclick="compare.add('<?php echo $post_info['post_id']; ?>');"><i class="fa fa-exchange"></i></button>
          </div>
          -->
          <h1><?php echo $post_info['title']; ?></h1>

          <ul class="list-unstyled">
            <li>Tác giả: <a href="<?php echo $post_info['author_href']; ?>"><?php echo $post_info['author']; ?></a></li>
            <li>Ngày: <?php echo $post_info['date_published']; ?></li>
			<li>Menu Text: <?php echo $post_info['menu']; ?></li>
            <!-- li>Lượt xem: <?php echo '10'; //$post_info['views']; ?></li -->
          </ul>

          <ul class="list-unstyled">
            <li>
              <h2><?php echo ''; ?></h2>
            </li>
          </ul>

			<!--
          <div id="product">
            <div class="form-group">
              <label class="control-label" for="input-quantity">Số lượng</label>
              <input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control" />
              <input type="hidden" name="post_id" value="<?php echo $_GET['post_id']; ?>" />
              <br />
              <button onclick="" type="button" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary btn-lg btn-block">Thêm vào giỏ hàng</button>
            </div>
            <?php if ($minimum > 1) { ?>
            <div class="alert alert-info"><i class="fa fa-info-circle"></i> Tối thiểu</div>
            <?php } ?>
          </div>
		  -->
		  
        </div>
      </div>
      
      <!--  trước đây là sản phẩm nổi bật, có thể xem lại code trong view-post-info.php -->      
      
      <?php if ($tags) { ?>
      <p><?php echo "Tags:"; ?>
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
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						var element = $('#input-option' + i.replace('_', '-'));
						
						if (element.parent().hasClass('input-group')) {
							element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						} else {
							element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						}
					}
				}
				
				if (json['error']['recurring']) {
					$('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
				}
				
				// Highlight any found errors
				$('.text-danger').parent().addClass('has-error');
			}
			
			if (json['success']) {
				$('.breadcrumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				
				$('#cart-total').html(json['total']);
				
				$('html, body').animate({ scrollTop: 0 }, 'slow');
				
				//$('#cart > ul').load('index.php?route=common/cart/info ul li');
				// tải lại nội dung html của giỏ hàng bằng (ajax load) lấy từ nguồn: /common/cart-info.php
				// chỉ lấy phần nội dung bên trong phần tử html có id="cart" 
				// sau đó đắp phần html đó vào bên trong phần tử id="cart" của trang hiện tại.
				$('#cart').load('/cart-ajax.php#cart > *');
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
// đừng có cố đưa bxslider, elevatezoom vào đây
// vì mã html/css không tương thích tí nào.
// nếu thích thì tích hợp thêm một bản horizontal slide vào themes mẫu
// một bản vertical slide (khó) vào nữa.
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
