<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-department" data-toggle="tooltip" title="Lưu" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="/admin/department.php" data-toggle="tooltip" title="Hủy" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <ul class="breadcrumb">
        <li><a href="/admin.php"><i class="fa fa-home"></i>Quản Trị</a></li>
        <li><a href="/admin/department.php">Phòng Ban</a></li>
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
        <form action="<?php echo $url_action; ?>" method="post" enctype="multipart/form-data" id="form-department" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">Thông Tin Chung</a></li>
            <li class=""><a href="#tab-data" data-toggle="tab">Liên Kết</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active in" id="tab-general">
                <div class="tab-pane" id="language">
				
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name">Tên</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" value="<?php echo isset($department_name) ? $department_name : ''; ?>" placeholder="Phòng Ban, Viện, Trung Tâm, v.v..." id="input-name" class="form-control" />
                      <?php if (isset($error_name)) { ?>
                      <div class="text-danger"><?php echo $error_name; ?></div>
                      <?php } ?>
                    </div>
                  </div>
				  
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description">Mô tả</label>
                    <div class="col-sm-10">
                      <textarea name="description" placeholder="Mô tả" id="input-description" class="form-control"><?php echo $department_description; ?></textarea>
                    </div>
                  </div>
				  
                  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-top">Nổi Bật</label>
					<div class="col-sm-10">
					  <div class="checkbox">
						<label>
						  <?php if ($department_featured) { ?>
						  <input type="checkbox" name="featured" value="1" checked="checked" id="input-top" />
						  <?php } else { ?>
						  <input type="checkbox" name="featured" value="1" id="input-top" />
						  <?php } ?>
						  &nbsp; </label>
					  </div>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-phone">Điện thoại</label>
					<div class="col-sm-10">
					  <input name="phone" value="<?php echo $phone;?>" placeholder="Điện thoại" id="input-phone" class="form-control" type="tel" />
					  <?php if ($error_phone) { ?>
					  <div class="text-danger"><?php echo $error_phone; ?></div>
					  <?php } ?>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-email">Email</label>
					<div class="col-sm-10">
					  <input type="text" name="email" value="<?php echo $email; ?>" placeholder="Email" id="input-email" class="form-control" />
					  <?php if ($error_email) { ?>
					  <div class="text-danger"><?php echo $error_email; ?></div>
					  <?php } ?>
					</div>
				  </div>				  
				  
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-website">Websie</label>
					<div class="col-sm-10">
					  <input name="website" value="<?php echo $website;?>" placeholder="Website" id="website" class="form-control" type="text" />
					  <?php if ($website) { ?>
					  <div class="text-danger"><?php echo $error_website; ?></div>
					  <?php } ?>
					</div>
				  </div>					  
				  
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-address">Địa chỉ</label>
					<div class="col-sm-10">
					  <input name="address" value="<?php echo $address;?>" placeholder="Địa chỉ" id="input-address" class="form-control" type="text" />
					  <?php if ($error_address) { ?>
					  <div class="text-danger"><?php echo $error_address; ?></div>
					  <?php } ?>
					</div>
				  </div>		

				  <div class="form-group required">
					<label class="col-sm-2 control-label" for="input-html_google_map">HTML Google Map</label>
					<div class="col-sm-10">
					  <textarea name="html_google_map" placeholder="Mã html Bản Đồ Google Map" id="input-html_google_map" rows="10" class="form-control"><?php echo $html_google_map; ?></textarea>
					</div>
				  </div>				  
				  
                </div>
            </div>
            <div class="tab-pane fade" id="tab-data">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-parent">Phòng Ban Cha</label>
                <div class="col-sm-10">
                  <input type="text" name="path" value="<?php echo $department_path; ?>" placeholder="Loại cha" id="input-parent" class="form-control" />
                  <input type="hidden" name="parent_id" value="<?php echo $department_parent_id; ?>" />
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
                  <input type="text" name="keyword" value="<?php echo $department_keyword; ?>" placeholder="SEO Keywords" id="input-keyword" class="form-control" />
                  <?php if ($error_keyword) { ?>
                  <div class="text-danger"><?php echo $error_keyword; ?></div>
                  <?php } ?>                
                </div>
              </div>
              -->
              <div class="form-group">
                <label class="col-sm-2 control-label">Ảnh</label>
                <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $department_thumb; ?>" alt="" title="" data-placeholder="<?php echo $department_placeholder; ?>" /></a>
                  <input type="hidden" name="image" value="<?php echo $department_image; ?>" id="input-image" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-top"><span data-toggle="tooltip" title="Hiển thị trên thanh menu top. Chỉ phù hợp cho loại cha ở trên cùng.">Top</span></label>
                <div class="col-sm-10">
                  <div class="checkbox">
                    <label>
                      <?php if ($department_top) { ?>
                      <input type="checkbox" name="top" value="1" checked="checked" id="input-top" />
                      <?php } else { ?>
                      <input type="checkbox" name="top" value="1" id="input-top" />
                      <?php } ?>
                      &nbsp; </label>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order">Thứ Tự Tìm Kiếm</label>
                <div class="col-sm-10">
                  <input type="text" name="sort_order" value="<?php echo $department_sort_order; ?>" placeholder="Thứ Tự Tìm Kiếm" id="input-sort-order" class="form-control" />
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status">Trạng Thái</label>
                <div class="col-sm-10">
                  <select name="status" id="input-status" class="form-control">
                    <?php if ($department_status) { ?>
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
			url: '/admin/department-autocomplete.php?filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					department_id: 0,
					name: '---Không---'
				});

				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['department_id']
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
</script> 
  <script type="text/javascript"><!--
// filter here if needed
//--></script> 
