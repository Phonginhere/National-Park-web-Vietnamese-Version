<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-product" data-toggle="tooltip" title="<?php echo 'Lưu'; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="/admin/product.php"" data-toggle="tooltip" title="<?php echo 'Hủy'; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      
      <ul class="breadcrumb">
        <li><a href="/admin.php">Quản Trị</a></li>
        <li><a href="/admin/product.php"">Sản Phẩm</a></li>
        <li><a href="/admin/product-add.php">Thêm Mới</a></li>
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
        <form action="<?php echo $url_action; ?>" method="post" enctype="multipart/form-data" id="form-product" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">Thông Tin Sản Phẩm</a></li>
            <li><a href="#tab-links" data-toggle="tab">Liên Kết</a></li>
            <li><a href="#tab-image" data-toggle="tab">Ảnh Gallery</a></li>
          </ul>
          
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              
                <div class="tab-pane" id="language">
                  <div class="form-group">
	                <label class="col-sm-2 control-label" for="input-image">Ảnh Đại Diện</label>
	                <div class="col-sm-10"><!-- @see admin/src/js/common.js để xem cách quản lý file ảnh:  -->
	                  <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $product_thumb; ?>" alt="" title="" data-placeholder="<?php echo $product_image_placeholder; ?>" /></a>
	                  <input type="hidden" name="image" value="<?php echo $product_image; ?>" id="input-image" />
	                </div>
	              </div> 
	              
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name">Tên</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" value="<?php echo $product_name; ?>" placeholder="Tên sản phẩm" id="input-name" class="form-control" />
                      <?php if (isset($error_name)) { ?>
                      <div class="text-danger"><?php echo $error_name; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
	                <label class="col-sm-2 control-label" for="input-model">Model</label>
	                <div class="col-sm-10">
	                  <input type="text" name="model" value="<?php echo $product_model; ?>" placeholder="Model" id="input-model" class="form-control" />
	                  <?php if ($error_model) { ?>
	                  <div class="text-danger"><?php echo $error_model; ?></div>
	                  <?php } ?>
	                </div>
	              </div>
	              
	              <div class="form-group">
	                <label class="col-sm-2 control-label" for="input-price">Giá</label>
	                <div class="col-sm-10">
	                  <input type="text" name="price" value="<?php echo $product_price; ?>" placeholder="Giá" id="input-price" class="form-control" />
	                </div>
	              </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description">Mô tả</label>
                    <div class="col-sm-10">
                      <textarea name="description" placeholder="Mô tả" id="input-description"><?php echo $product_description; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-tag"><span data-toggle="tooltip" title="Dùng dấu phẩy để ngăn cách">Tags</span></label>
                    <div class="col-sm-10">
                      <input type="text" name="tag" value="<?php echo $product_tag; ?>" placeholder="Tags" id="input-tag" class="form-control" />
                    </div>
                  </div>
                             
              
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status">Xuất Hiện Trên Trang Chủ</label>
                <div class="col-sm-10">
                  <select name="status" id="input-status" class="form-control">
                    <?php if ($product_status) { ?>
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
                <label class="col-sm-2 control-label" for="input-top">Sản Phẩm Bán Chạy</label>
                <div class="col-sm-10">
                  <div class="checkbox">
                    <label>
                      <?php if ($product_best_seller) { ?>
                      <input type="checkbox" name="best_seller" value="1" checked="checked" id="input-top" class="custom-control-input"/>
                      <?php } else { ?>
                      <input type="checkbox" name="best_seller" value="0" id="input-top" class="custom-control-input"/>
                      <?php } ?>
                      &nbsp; </label>
                  </div>
                </div>
              </div>
			  
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-top">Sản Phẩm Nổi Bật</label>
                <div class="col-sm-10">
                  <div class="checkbox">
                    <label>
                      <?php if ($product_featured) { ?>
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
                  <input type="text" name="sort_order" value="<?php echo $product_sort_order; ?>" placeholder="Sort Order" id="input-sort-order" class="form-control" />
                </div>
              </div>
                  
                  
                </div>
              
            </div>
            
            <div class="tab-pane" id="tab-links">
              
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-manufacturer"><span data-toggle="tooltip" title="(Autocomplete)">Nhà sản xuất</span></label>
                <div class="col-sm-10">
                  <input type="text" name="manufacturer" value="<?php echo $manufacturer ?>" placeholder="Nhà sản xuất" id="input-manufacturer" class="form-control" />
                  <input type="hidden" name="manufacturer_id" value="<?php echo $manufacturer_id; ?>" />
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-category"><span data-toggle="tooltip" title="(Autocomplete)">Loại sản phẩm</span></label>
                <div class="col-sm-10">
                  <input type="text" name="category" value="" placeholder="Loại sản phẩm" id="input-category" class="form-control" />
                  <div id="product-category" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php foreach ($product_categories as $product_category) { ?>
                    <div id="product-category<?php echo $product_category['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_category['name']; ?>
                      <input type="hidden" name="product_category[]" value="<?php echo $product_category['category_id']; ?>" />
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
                    <?php foreach ($product_images as $product_image) { ?>
                    <tr id="image-row<?php echo $image_row; ?>">
                      <td class="text-left"><a href="" id="thumb-image<?php echo $image_row; ?>" data-toggle="image" class="img-thumbnail">
						<img src="<?php echo $product_image['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $product_image_placeholder; ?>" /></a>
						<input type="hidden" name="product_image[<?php echo $image_row; ?>][image]" value="<?php echo $product_image['image']; ?>" id="input-image<?php echo $image_row; ?>" />
					  </td>
                      <td class="text-right">
						<input type="text" name="product_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $product_image['sort_order']; ?>" placeholder="Trật tự sắp xếp" class="form-control"/>
						
						<!--
						<label>Tiêu Đề </label>
						<input type="text" name="product_image[<?php echo $image_row; ?>][title]" value="<?php echo $product_image['title']; ?>" placeholder="Tiêu đề" class="form-control" />
						<label>Phụ Đề</label>
						<input type="text" name="product_image[<?php echo $image_row; ?>][title]" value="<?php echo $product_image['title']; ?>" placeholder="Tiêu đề" class="form-control" />
						<label>Mô Tả</label>
						<textarea rows="3" class="form-control"></textarea>
						-->
					  </td>
					  
					  <!--
					  <td class="text-right" style="padding: 0 1%;">
						
						<label>Tiêu Đề </label>
						<input type="text" name="product_image[<?php echo $image_row; ?>][title]" value="<?php echo $product_image['title']; ?>" placeholder="Tiêu đề" class="form-control" />
						<label>Phụ Đề</label>
						<input type="text" name="product_image[<?php echo $image_row; ?>][title]" value="<?php echo $product_image['title']; ?>" placeholder="Tiêu đề" class="form-control" />
						<label>Mô Tả</label>
						<textarea rows="3" class="form-control"></textarea>
						
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
$('#input-description').summernote({height: 300});
//--></script> 
  <script type="text/javascript">
// Nhà sản xuất / Manufacturer
$('input[name=\'manufacturer\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: '/admin/manufacturer-autocomplete.php?filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				json.unshift({
					manufacturer_id: 0,
					name: '---Không---'
				});
				
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['manufacturer_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'manufacturer\']').val(item['label']);
		$('input[name=\'manufacturer_id\']').val(item['value']);
	}	
});

// Loại sản phẩm / Category
$('input[name=\'category\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: '/admin/category-autocomplete.php?filter_name=' +  encodeURIComponent(request),
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
		
		$('#product-category' + item['value']).remove();
		
		$('#product-category').append('<div id="product-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_category[]" value="' + item['value'] + '" /></div>');	
	}
});

$('#product-category').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

</script> 

  <script type="text/javascript">
var image_row = <?php echo $image_row; ?>;

function addImage() {
	html  = '<tr id="image-row' + image_row + '">';
	html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '"data-toggle="image" class="img-thumbnail"><img src="<?php echo $product_image_placeholder; ?>" alt="" title="" data-placeholder="<?php echo $product_image_placeholder; ?>" /><input type="hidden" name="product_image[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
	html += '  <td class="text-right"><input type="text" name="product_image[' + image_row + '][sort_order]" value="" placeholder="Trật tự sắp xếp" class="form-control" /></td>';
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
