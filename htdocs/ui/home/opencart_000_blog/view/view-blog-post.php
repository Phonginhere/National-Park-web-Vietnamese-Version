<div class="container">
  <ul class="breadcrumb">
    <li><a href="/home.php"><i class="fa fa-home"></i>Trang Chủ</a></li>
    <li><a href="/blog.php">Blog</a></li>
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
  	
  	<!--  tham khảo: https://www.foodgenuine.com/it/blog/intervista-al-produttore-vincenzo-zito -->
  	
     <div id="content" class="col-sm-9">
	    <!--  h2><?php echo $post_info['title']; ?></h2 -->
		<div class="row">
	        
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
	          
	          <!-- h2><?php echo $post_info['title']; ?></h2 -->
	          <header class="entry-header">
				   <h1 class="entry-title"><font style="vertical-align: inherit;"><?php echo $post_info['title']; ?></font>
				   </h1>
				   <div class="entry-meta">
				      <span class="posted-on">
				      <i class="fa fa-calendar"></i> 
				      <a rel="bookmark" href="#">
				      <time datetime="<?php echo $post_info['date_added']?>" class="entry-date published"><font style="vertical-align: inherit;"><?php echo $post_info['date_published']?></font></time>
				      </a>
				      </span>
				      <span class="byline"> 
				      <i class="fa fa-user"></i> 
				      <span class="author">
				      <cite class="vcard"><a class="name fn url" rel="bookmark" href="#"><font style="vertical-align: inherit;"><?php echo $post_info['author'];?></font></a><span class="title" style="display:none">Posted by Paolo Guizzo</span>
				      <span class="role" style="display:none">Author</span>
				      <img class="photo" src="#" style="display:none">
				      <span class="org" style="display:none">www.foodgenuine.com</span>
				      </cite>
				      </span>
				      </span>		
				      <span class="comments-link" data-show="1" style="display: visible;">
				      <i class="fa fa-comment-o"></i> <a rel="bookmark" href="#">0 Bình luận</a>
				      </span>
				      <span class="share-link" data-count="1">
				      <i class="fa fa-share"></i><font style="vertical-align: inherit;">1 Chia Sẻ</font></span>
				   </div>
				   <!-- .entry-meta -->
			 </header>
	          
	          <ul class="nav nav-tabs">
	            <li class="active"><a href="#tab-post-content" data-toggle="tab">Nội Dung</a></li>
	            <li class=""><a href="#tab-post-comment" data-toggle="tab">Bình Luận</a></li>
	          </ul>
	          <div class="tab-content">
	            <div class="tab-pane active" id="tab-post-content"><?php echo $post_info['content']; ?></div>
	            <div class="tab-pane" id="tab-post-comment">
	            	
	            	<form class="form-horizontal" id="form-review">
						<div id="review">
						   <p>Hãy để lại bình luận cho bài viết này.</p>
						</div>
						<h2>Viết bình luận</h2>
						<div class="form-group required">
						   <div class="col-sm-12">
						      <label class="control-label" for="input-name">Tên</label>
						      <input type="text" name="name" value="" id="input-name" class="form-control">
						   </div>
						</div>
						<div class="form-group required">
						   <div class="col-sm-12">
						      <label class="control-label" for="input-review">Bình Luận</label>
						      <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
						      <div class="help-block"><span class="text-danger">Note:</span> HTML is not translated!</div>
						   </div>
						</div>
						<div class="form-group required">
						   <div class="col-sm-12">
						      <label class="control-label">Rating</label>
						      &nbsp;&nbsp;&nbsp; Bad&nbsp;
						      <input type="radio" name="rating" value="1">
						      &nbsp;
						      <input type="radio" name="rating" value="2">
						      &nbsp;
						      <input type="radio" name="rating" value="3">
						      &nbsp;
						      <input type="radio" name="rating" value="4">
						      &nbsp;
						      <input type="radio" name="rating" value="5">
						      &nbsp;Good
						   </div>
						</div>
						<div class="buttons clearfix">
						   <div class="pull-right">
						      <button type="button" id="button-review" data-loading-text="Loading..." class="btn btn-primary">Bình Luận</button>
						   </div>
						</div>
					</form>
	            	
	            </div>
	          </div>
	        
	        
	        <!-- 
	        <div class="col-sm-4">
	          
	          <div class="btn-group">
	            <button type="button" data-toggle="tooltip" class="btn btn-default" title="Wishlist" onclick="wishlist.add('<?php echo $post_info['post_id']; ?>');"><i class="fa fa-heart"></i></button>
	            <button type="button" data-toggle="tooltip" class="btn btn-default" title="So sánh sản phẩm" onclick="compare.add('<?php echo $post_info['post_id']; ?>');"><i class="fa fa-exchange"></i></button>
	          </div>
	          
	          <h1><?php echo $post_info['title']; ?></h1>
	
	          <ul class="list-unstyled">
	            <li>Tác giả: <a href="<?php echo $post_info['author_href']; ?>"><?php echo $post_info['author']; ?></a></li>
	            <li>Ngày: <?php echo $post_info['date_published']; ?></li>
				<li>Menu Text: <?php echo $post_info['menu']; ?></li>
	            <li>Lượt xem: <?php echo '10'; //$post_info['views']; ?></li>
	          </ul>
	
	          <ul class="list-unstyled">
	            <li>
	              <h2><?php echo ''; ?></h2>
	            </li>
	          </ul>
	
				
	          <div id="product">
	            <div class="form-group">
	            </div>
	          </div>
			  
			  
	        </div>
	        -->
	        
	      </div>
	      
	      <!--  trước đây là sản phẩm nổi bật, có thể xem lại code trong view-post-info.php -->      
	      
	      <?php if ($tags) { ?>
	      <p><?php echo "Tags:"; ?>
	        <?php for ($i = 0; $i < count($tags); $i++) { ?>
	        <a class="label label-primary" href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
	        <?php } ?>
	      </p>
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