<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-post" data-toggle="tooltip" title="<?php echo 'Lưu'; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="/admin/post.php"" data-toggle="tooltip" title="<?php echo 'Hủy'; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      
      <ul class="breadcrumb">
        <li><a href="/admin.php">Quản Trị</a></li>
        <li><a href="/admin/post.php"">Bài Viết</a></li>
        <li><a href="/admin/post-add.php">Thêm Mới</a></li>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($_SESSION['ERROR_TEXT']) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION['ERROR_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php unset($_SESSION['ERROR_TEXT']);?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $form_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $url_action; ?>" method="post" enctype="multipart/form-data" id="form-post" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">Nội Dung Bài Viết</a></li>
            <li><a href="#tab-links" data-toggle="tab">Liên Kết</a></li>
            <li><a href="#tab-image" data-toggle="tab">Ảnh Gallery</a></li>
          </ul>
          
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              
                
                  <div class="form-group">
	                <label class="col-sm-2 control-label" for="input-image">Ảnh Đại Diện</label>
	                <div class="col-sm-10"><!-- @see admin/src/js/common.js để xem cách quản lý file ảnh:  -->
	                  <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $post_thumb; ?>" alt="" title="" data-placeholder="<?php echo $post_image_placeholder; ?>" /></a>
	                  <input type="hidden" name="image" value="<?php echo $post_image; ?>" id="input-image" />
	                </div>
	              </div> 

                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-top"><span data-toggle="tooltip" title="Hiển thị trên menu top.">Top</span></label>
                    <div class="col-sm-10">
                      <div class="checkbox">
                        <label>
                          <?php if ($post_top) { ?>
                          <input type="checkbox" name="top" value="1" checked="checked" id="input-top" />
                          <?php } else { ?>
                          <input type="checkbox" name="top" value="1" id="input-top" />
                          <?php } ?>
                          &nbsp; </label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-menu">Menu</label>
                    <div class="col-sm-10">
                      <input type="text" name="menu" value="<?php echo $post_menu; ?>" placeholder="Menu Text" id="input-menu" class="form-control" />
                      <?php if (isset($error_menu)) { ?>
                      <div class="text-danger"><?php echo $error_menu; ?></div>
                      <?php } ?>
                    </div>
                  </div>
	              
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title">Tựa Đề</label>
                    <div class="col-sm-10">
                      <input type="text" name="title" value="<?php echo $post_title; ?>" placeholder="Tên bài viết" id="input-title" class="form-control" />
                      <?php if (isset($error_title)) { ?>
                      <div class="text-danger"><?php echo $error_title; ?></div>
                      <?php } ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-content">Nội Dung</label>
                    <div class="col-sm-10">
                      <textarea name="content" placeholder="Mô tả" id="input-content"><?php echo $content; ?></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-tag"><span data-toggle="tooltip" title="Dùng dấu phẩy để ngăn cách">Tags</span></label>
                    <div class="col-sm-10">
                      <input type="text" name="tag" value="<?php echo $post_tag; ?>" placeholder="Tags" id="input-tag" class="form-control" />
                    </div>
                  </div>

                  <div class="form-group">
	                <label class="col-sm-2 control-label" for="input-link">Link</label>
	                <div class="col-sm-10">
	                  <input type="text" name="link" value="<?php echo $post_link; ?>" placeholder="Link" id="input-link" class="form-control" />
	                </div>
	              </div>

              
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status">Xuất Hiện Trên Trang Chủ</label>
                <div class="col-sm-10">
                  <select name="status" id="input-status" class="form-control">
                    <?php if ($post_status) { ?>
                    <option value="1" selected="selected">Cho phép</option>
                    <option value="0">Không cho phép</option>
                    <?php } else { ?>
                    <option value="1">Cho phép</option>
                    <option value="0" selected="selected">Không cho phép</option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              

              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-top">Bài Viết Nổi Bật</label>
                <div class="col-sm-10">
                  <div class="checkbox">
                    <label>
                      <?php if ($post_featured) { ?>
                      <input type="checkbox" name="featured" value="1" checked="checked" id="input-top" />
                      <?php } else { ?>
                      <input type="checkbox" name="featured" value="1" id="input-top" />
                      <?php } ?>
                      &nbsp; </label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order">Thứ Tự Sắp Xếp</label>
                <div class="col-sm-10">
                  <input type="text" name="sort_order" value="<?php echo $post_sort_order; ?>" placeholder="Sort Order" id="input-sort-order" class="form-control" />
                </div>
              </div>
              
            </div><!-- end tab-pane: general -->
            
            <div class="tab-pane" id="tab-links">

              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-parent">Bài viết cha</label>
                <div class="col-sm-10">
                  <input type="text" name="path" value="<?php echo $post_path; ?>" placeholder="Bài viết cha" id="input-parent" class="form-control" />
                  <input type="hidden" name="parent_id" value="<?php echo $post_parent_id; ?>" />
                </div>
              </div>
              
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-author"><span data-toggle="tooltip" title="(Autocomplete)">Tác Giả</span></label>
                <div class="col-sm-10">
                  <input type="text" name="author" value="<?php echo $author ?>" placeholder="Tác giả bài viết" id="input-author" class="form-control" />
                  <input type="hidden" name="author_id" value="<?php echo $author_id; ?>" />
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-category"><span data-toggle="tooltip" title="(Autocomplete)">Phân Loại</span></label>
                <div class="col-sm-10">
                  <input type="text" name="category" value="" placeholder="Loại bài viết" id="input-category" class="form-control" />
                  <div id="post-category" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php foreach ($post_categories as $post_category) { ?>
                    <div id="post-category<?php echo $post_category['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $post_category['name']; ?>
                      <input type="hidden" name="post_category[]" value="<?php echo $post_category['category_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
             
            </div>
            
            
            <div class="tab-pane" id="tab-image">
              <div class="table-responsive">
                <table id="images" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left">Ảnh</td> <!--style="width: 20%"-->
                      <td class="text-right">Thứ tự sắp xếp</td><!-- style="width: 10%" -->
					  <!--td class="text-right">Nội Dung Khác</td -->
                      <td>Action</td>
                    </tr>
                  </thead>
                  <tbody> <!-- https://stackoverflow.com/questions/1010941/html-input-arrays -->
                    <?php $image_row = 0; ?>
                    <?php foreach ($post_images as $post_image) { ?>
                    <tr id="image-row<?php echo $image_row; ?>">
                      <td class="text-left"><a href="" id="thumb-image<?php echo $image_row; ?>" data-toggle="image" class="img-thumbnail">
						<img src="<?php echo $post_image['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $post_image_placeholder; ?>" /></a>
						<input type="hidden" name="post_image[<?php echo $image_row; ?>][image]" value="<?php echo $post_image['image']; ?>" id="input-image<?php echo $image_row; ?>" />
					  </td>
                      <td class="text-right">
						<input type="text" name="post_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $post_image['sort_order']; ?>" placeholder="Trật tự sắp xếp" class="form-control"/>
						
						
						<label>Tựa đề ảnh</label>
						<input name="post_image[<?php echo $image_row; ?>][title]" value="<?php echo $post_image['title']; ?>" placeholder="Tựa đề ảnh" class="form-control" type="text" />
						<label>Mô tả ảnh</label>
						<textarea name="post_image[<?php echo $image_row; ?>][description]" rows="3" class="form-control" ><?php echo $post_image['description']; ?></textarea>

                        <!-- Test Only !!!
                        <label>Phụ Đề</label>
						<input type="text" name="post_image[<?php echo $image_row; ?>][sub_title]" value="<?php echo $post_image['title']; ?>" placeholder="Tiêu đề" class="form-control" />
						-->
					  </td>
					  
					  <!-- Test only !!!
					  <td class="text-right" style="padding: 0 1%;">
						
						<label>Tiêu Đề </label>
						<input type="text" name="post_image[<?php echo $image_row; ?>][title]" value="<?php echo $post_image['title']; ?>" placeholder="Tiêu đề" class="form-control" />
						<label>Phụ Đề</label>
						<input type="text" name="post_image[<?php echo $image_row; ?>][sub_title]" value="<?php echo $post_image['title']; ?>" placeholder="Tiêu đề" class="form-control" />
						<label>Mô Tả</label>
						<textarea name="post_image[<?php echo $image_row; ?>][description]" rows="3" class="form-control"></textarea>
						
					  </td>
					  -->
                      <td class="text-left"><button type="button" onclick="$('#image-row<?php echo $image_row; ?>').remove();" data-toggle="tooltip" title="Gỡ bỏ" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                    </tr>
                    <?php $image_row++; ?>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="2"></td>
                      <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="Thêm mới" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
// Rich Text Editor
$('#input-content').summernote({height: 300});
//--></script> 
<script type="text/javascript">

// Bài viết cha
$('input[name=\'path\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: '/admin/post-autocomplete.php?filter_title=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					post_id: 0,
					title: '---Không---'
				});

				response($.map(json, function(item) {
					return {
						label: item['title'],
						value: item['post_id']
					}
				}));
			},
			error: function(xhr, status, text) {
		        //alert(status);
		        //alert(text)
		        alert(xhr.responseText);
		    }
		});
	},
	'select': function(item) {
		$('input[name=\'path\']').val(item['label']);
		$('input[name=\'parent_id\']').val(item['value']);
	}
});

// Tác giả / author
$('input[name=\'author\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: '/admin/user-autocomplete.php?filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				json.unshift({
					user_id: 0,
					fullname: '---Không---'
				});
				
				response($.map(json, function(item) {
					return {
						label: item['fullname'],
						value: item['user_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'author\']').val(item['label']);
		$('input[name=\'author_id\']').val(item['value']);
	}	
});

// Loại bài viết / Category
$('input[name=\'category\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: '/admin/post_category-autocomplete.php?filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['category_id']
					}
				}));
			},
			error: function(xhr, status, text) {
		        //alert(status);
		        //alert(text)
		        alert(xhr.responseText);
		    }
		});
	},
	'select': function(item) {
		$('input[name=\'category\']').val('');
		
		$('#post-category' + item['value']).remove();
		
		$('#post-category').append('<div id="post-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="post_category[]" value="' + item['value'] + '" /></div>');	
	}
});

$('#post-category').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

</script> 

<!-- Mỗi lần bấm nút dấu cộng thì chèn thêm một hàng tr vào bảng liệt kê
các ảnh của bài viết, cho phép thêm mới 1 ảnh nữa -->
<script type="text/javascript">
var image_row = <?php echo $image_row; ?>;

function addImage() 
{
	html  = '<tr id="image-row' + image_row + '">';
	html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '"data-toggle="image" class="img-thumbnail"><img src="<?php echo $post_image_placeholder; ?>" alt="" title="" data-placeholder="<?php echo $post_image_placeholder; ?>" /><input type="hidden" name="post_image[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';

	html += '  <td class="text-right"><input type="text" name="post_image[' + image_row + '][sort_order]" value="" placeholder="Trật tự sắp xếp" class="form-control" />';
    html +=       '<label>Tựa đề ảnh</label>';
	html +=       '<input name="post_image['+image_row + '][title]" value="" placeholder="Tựa đề ảnh" class="form-control" type="text" />';
	html +=       '<label>Mô tả ảnh</label>';
	html +=		  '<textarea name="post_image[' + image_row + '][description]" rows="3" class="form-control"></textarea>';
    html +=  ' </td>'

	html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="Gỡ bỏ" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';
	
	$('#images tbody').append(html);
	
	image_row++;
}

</script> 

<script type="text/javascript">
$('.date').datetimepicker({
	pickTime: false
});

$('.time').datetimepicker({
	pickDate: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});
</script> 

<script type="text/javascript"><!--
$('#language a:first').tab('show');
$('#option a:first').tab('show');
//--></script></div>
