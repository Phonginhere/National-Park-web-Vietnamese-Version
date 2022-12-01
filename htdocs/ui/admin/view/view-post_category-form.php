
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-category" data-toggle="tooltip" title="Lưu" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="/admin/post_category.php" data-toggle="tooltip" title="Hủy" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <ul class="breadcrumb">
        <li><a href="/admin.php"><i class="fa fa-home"></i>Quản Trị</a></li>
        <li><a href="/admin/post_category.php">Phân Loại Bài Viết</a></li>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
     <?php if ($_SESSION['ERROR_TEXT']) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION['ERROR_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } $_SESSION['ERROR_TEXT'] = NULL;?>
        <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $form_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $url_action; ?>" method="post" enctype="multipart/form-data" id="form-category" class="form-horizontal">
          
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">Thông Tin Chung</a></li>
            <li class=""><a href="#tab-link" data-toggle="tab">Liên Kết</a></li>
          </ul>
          
          <div class="tab-content">
            <div class="tab-pane active in" id="tab-general">
                <div class="tab-pane" id="language">
                
                 <div class="form-group">
	                <label class="col-sm-2 control-label">Ảnh</label>
	                <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $post_category_thumb; ?>" alt="" title="" data-placeholder="<?php echo $post_category_placeholder; ?>" /></a>
	                  <input type="hidden" name="image" value="<?php echo $post_category_image; ?>" id="input-image" />
	                </div>
	              </div>
                
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name">Tên Loại</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" value="<?php echo isset($post_category_name) ? $post_category_name : ''; ?>" placeholder="Tên loại bài viết" id="input-name" class="form-control" />
                      <?php if (isset($error_name)) { ?>
                      <div class="text-danger"><?php echo $error_name; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description">Mô tả</label>
                    <div class="col-sm-10">
                      <textarea name="description" placeholder="Mô tả" id="input-description" class="form-control"><?php echo $post_category_description; ?></textarea>
                    </div>
                  </div>
                  
                  
                </div>
            </div>
            
            <div class="tab-pane fade" id="tab-link">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-parent">Loại cha</label>
                <div class="col-sm-10">
                  <input type="text" name="path" value="<?php echo $post_category_path; ?>" placeholder="Loại cha" id="input-parent" class="form-control" />
                  <input type="hidden" name="parent_id" value="<?php echo $post_category_parent_id; ?>" />
                </div>
              </div>
              <!--
              implement filter form group if needed
              -->
             <!--
             	implement store form group here if needed
             -->
              <!--  
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-keyword"><span data-toggle="tooltip" title="Do not use spaces, instead replace spaces with - and make sure the keyword is globally unique.">SEO Keywords</span></label>
                <div class="col-sm-10">
                  <input type="text" name="keyword" value="<?php echo $post_category_keyword; ?>" placeholder="SEO Keywords" id="input-keyword" class="form-control" />
                  <?php if ($error_keyword) { ?>
                  <div class="text-danger"><?php echo $error_keyword; ?></div>
                  <?php } ?>                
                </div>
              </div>
              -->
             
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-top"><span data-toggle="tooltip" title="Hiển thị trên thanh menu top. Chỉ phù hợp cho loại cha ở trên cùng.">Top</span></label>
                <div class="col-sm-10">
                  <div class="checkbox">
                    <label>
                      <?php if ($post_category_top) { ?>
                      <input type="checkbox" name="top" value="1" checked="checked" id="input-top" />
                      <?php } else { ?>
                      <input type="checkbox" name="top" value="1" id="input-top" />
                      <?php } ?>
                      &nbsp; </label>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                	<label class="col-sm-2 control-label" for="input-top">Loại Nổi Bật</label>
	                <div class="col-sm-10">
	                  <div class="checkbox">
	                    <label>
	                      <?php if ($post_category_featured) { ?>
	                      <input type="checkbox" name="featured" value="1" checked="checked" id="input-top" />
	                      <?php } else { ?>
	                      <input type="checkbox" name="featured" value="1" id="input-top" />
	                      <?php } ?>
	                      &nbsp; </label>
	                  </div>
	                </div>
              	  </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order">Thứ Tự Tìm Kiếm</label>
                <div class="col-sm-10">
                  <input type="text" name="sort_order" value="<?php echo $post_category_sort_order; ?>" placeholder="Thứ Tự Tìm Kiếm" id="input-sort-order" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status">Trạng Thái</label>
                <div class="col-sm-10">
                  <select name="status" id="input-status" class="form-control">
                    <?php if ($post_category_status) { ?>
                    <option value="1" selected="selected">Cho phép</option>
                    <option value="0">Không cho phép</option>
                    <?php } else { ?>
                    <option value="1">Cho Phép</option>
                    <option value="0" selected="selected">Không cho phép</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-design">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<script type="text/javascript">
$('#input-description').summernote({
	height: 300
});
</script> 
  <script type="text/javascript">
$('input[name=\'path\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: '/admin/post_category-autocomplete.php?filter_name=' +  encodeURIComponent(request),
            //url: '/admin/test-json.php?filter_name=' +  encodeURIComponent(request), // ok
			dataType: 'json',
			success: function(json) {
				json.unshift({
					category_id: 0,
					name: '---Không---'
				});

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
		        alert(text+xhr.responseText);
		    }
		});
	},
	'select': function(item) {
		$('input[name=\'path\']').val(item['label']);
		$('input[name=\'parent_id\']').val(item['value']);
	}
});
</script> 
  <script type="text/javascript"><!--
// filter here if needed
//--></script> 
