<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
      	<a href="/admin/post_category-add.php" data-toggle="tooltip" title="Thêm Mới" class="btn btn-primary"><i class="fa fa-plus"></i></a> 
        <button type="button" data-toggle="tooltip" title="Xóa" class="btn btn-danger" onclick="confirm('Bạn có chắc là muốn xóa ?') ? $('#form-category').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      
      <!-- 
      <h1>Danh Mục Sản Phẩm</h1>
      <ul class="breadcrumb">
        <li><a href="/admin.php">Quản Trị</a></li>
        <li><a href="/admin/post_category.php">Loại Bài Viết</a></li>
      </ul>
      -->
      
      <!-- HTML5 cho phép 1 button nằm ngoài form mà vẫn submit được, miễn là button đó chỉ rõ form nào qua id và action là gì ? -->
    <!--  <div class="pull-left">
        <a disabled href="#đang_chờ" data-toggle="tooltip" title="đang_chờ" class="btn btn-primary"><i class="fa fa-question"></i></a>
        <button disabled type="submit" form="form-product" formaction="#đang_chờ" data-toggle="tooltip" title="đang-chờ" class="btn btn-default"><i class="fa fa-question"></i></button>
        <button disabled type="button" data-toggle="tooltip" title="đang_chờ" class="btn btn-danger" onclick="confirm('<?php echo 'đang chờ'; ?>');"><i class="fa fa-question"></i></button>
      </div> -->
	   <ul class="breadcrumb">
          <li><a href="/admin.php"><?php echo 'Quản Trị'?></a></li> 
          <li><a href="/admin/post.php"><?php echo 'Phân Loại Tin'?></a></li>
      </ul>
      
    </div>
  </div>
  <div class="container-fluid">
  	<?php if ($_SESSION['ERROR_TEXT']) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION['ERROR_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } $_SESSION['ERROR_TEXT'] = null;?>
    
    <?php if ($_SESSION['SUCCESS_TEXT']) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $_SESSION['SUCCESS_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } $_SESSION['SUCCESS_TEXT'] = null;?>
    
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i>Danh Mục Loại Bài Viết</h3>
      </div>
      <div class="panel-body">
      
        <div class="well"><!-- Tính năng lọc được thực thi chỉ bởi các Input Controls và JavaScript, GET Method; Không sử dụng Form Post Submit ở đây  -->
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-name">Tên Loại Tin</label>
                <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="Tên Loại" id="input-name" class="form-control" />
              </div>
              <div class="form-group">
	                <label class="control-label" for="input-featured">Loại Top</label>
	                <select name="filter_top" id="input-top" class="form-control">
	                  <option value="*">--Không chọn--</option>
	                  <option value="1" <?php if($filter_top) echo 'selected="selected"' ?> >Top</option>
	                  <option value="0" <?php if(!$filter_top && !is_null($filter_top)) echo 'selected="selected"' ?> >Không phải Top</option>
	                  
	                </select>
	          </div>
            </div>
            <div class="col-sm-4">

              <div class="form-group">
                <label class="control-label" for="input-status"><?php echo 'Trạng thái'; ?></label>
                <select name="filter_status" id="input-status" class="form-control">
                  <option value="*">--Không chọn--</option>
                  <?php if ($filter_status) { ?>
                  <option value="1" selected="selected"><?php echo 'Cho phép'; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo 'Cho phép'; ?></option>
                  <?php } ?>
                  <?php if (!$filter_status && !is_null($filter_status)) { ?>
                  <option value="0" selected="selected"><?php echo 'Không cho phép'; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo 'Không cho phép'; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
	                <label class="control-label" for="input-featured">Tính Nổi Bật</label>
	                <select name="filter_featured" id="input-featured" class="form-control">
	                  <option value="*">--Không chọn--</option>
	                  <?php if ($filter_featured) { ?>
	                  <option value="1" selected="selected">Nổi Bật</option>
	                  <?php } else { ?>
	                  <option value="1">Nổi Bật</option>
	                  <?php } ?>
	                  <?php if (!$filter_featured && !is_null($filter_featured)) { ?>
	                  <option value="0" selected="selected">Không nổi bật</option>
	                  <?php } else { ?>
	                  <option value="0">Không nổi bật</option>
	                  <?php } ?>
	                </select>
	          </div>
              
            </div><!-- end col-sm-4 -->
            <div class="col-sm-4">
            	<div class="form-group">
	                <label class="control-label" for="input-limit">Phân Trang</label>
	                <select name="filter_limit" id="input-limit" class="form-control">
	                  <option value="*">--Không chọn--</option>
	                  <option value="5"  <?php if ($limit==5)  echo 'selected="selected"';?>>05</option>
	                  <option value="10" <?php if ($limit==10) echo 'selected="selected"';?>>10</option>
	                  <option value="15" <?php if ($limit==15) echo 'selected="selected"';?>>15</option>
	                  <option value="20" <?php if ($limit==20) echo 'selected="selected"';?>>20</option>
	                  <option value="25" <?php if ($limit==25) echo 'selected="selected"';?>>25</option>
	                </select>
	            </div>
            	<div class="form-group">&nbsp;</div>
                <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo 'Lọc'; ?></button>
            </div>
          </div>
        </div><!-- end .well -->
      
        <form action="/admin/post_category-delete.php" method="post" enctype="multipart/form-data" id="form-post_category">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
            
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" type="checkbox"></td>
                  <td class="text-center">
                  	<a href="<?php echo $sort_category_id;?>" class="<?php if ($sort == 'cd.category_id') {echo strtolower($order);} ?>">Id</a>
                  </td>
                  <td class="text-center"><?php echo 'Ảnh'; ?></td>
                  <td class="text-left">                    
                     <a href="<?php echo $sort_name; ?>" class="<?php if ($sort == 'cd.name') { echo strtolower($order); }?>">Loại Bài Viết</a>
                  </td>
                  
                  <td class="text-left"><?php  ?>
                    <a href="<?php echo $sort_status; ?>" class="<?php if ($sort == 'cd.status') {echo strtolower($order);} ?>"><?php echo 'Trạng Thái'; ?></a>
                  </td>
                  <td class="text-left">
                    <a href="<?php echo $sort_featured; ?>" class="<?php if ($sort == 'cd.featured') echo strtolower($order); ?>">Tính Nổi Bật</a>
                  </td>
                  <td class="text-left">
                    <a href="<?php echo $sort_top; ?>" class="<?php if ($sort == 'cd.top') echo strtolower($order); ?>">Tính Top</a>
                  </td>
                  
                  <td class="text-right"><?php  ?>
                     <a href="<?php echo $sort_order; ?>" class="<?php if ($sort == 'cd.sort_order') { echo strtolower($order); } ?>">Trật Tự Sắp Xếp</a>
                  </td>
                  <td class="text-left">
                    <a href="<?php echo $sort_date_added; ?>" class="<?php if ($sort == 'cd.date_added') echo strtolower($order); ?>">Ngày tạo</a>
                  </td>
                  <td class="text-right">Hành Động</td>
                </tr>
              </thead>
              
              <tbody>
                <?php if ($post_categories) {?>
                <?php foreach ($post_categories as $post_category) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($post_category['category_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $post_category['category_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $post_category['category_id']; ?>" />
                    <?php } ?>
                  </td>
                  
                   <td><?php echo $post_category['category_id'] ?></td>
                  
                  <td class="text-center"><?php if ($post_category['image']) { ?>
                    <img src="<?php echo $post_category['image']; ?>" alt="<?php echo $post_category['name']; ?>" class="img-thumbnail" />
                    <?php } else { ?>
                    <span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
                    <?php } ?>
                  </td>
                  
                  <td class="text-left"><?php  echo $post_category['name']; ?></td>
                  
                  <td class="text-left"><?php  echo $post_category['status_text']; ?></td>
                  <td class="text-left"><?php  echo $post_category['featured_text']; ?></td>
                  <td class="text-left"><?php  echo $post_category['top_text']; ?></td>
                  <td class="text-right"><?php echo $post_category['sort_order']; ?></td>
                  <td class="text-right"><?php echo $post_category['date_added_text']; ?></td>
                  <td class="text-right">
                  	<a href="<?php echo $post_category['edit']; ?>" data-toggle="tooltip" title="Sửa" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                  	<button type="button" data-toggle="tooltip" title="Xóa" class="btn btn-danger" onclick="$('input[name*=\'selected\'][value=\'<?php echo $post_category['category_id'];?>\']').prop('checked', true);confirm('Bạn có chắc là muốn xóa ?') ? $('#form-post_category').submit() : false;$('input[name*=\'selected\']').prop('checked', false);"><i class="fa fa-trash-o"></i></button>
                  </td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="10">Không tìm thấy kết quả nào</td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row"><!-- Phân Trang, xem class.Paginator.php, sys.functions.php - paginate() -->
          <div class="col-sm-6 text-left"><?php echo $web_pagination_controls; ?></div>
          <div class="col-sm-6 text-right"><?php echo $web_pagination_results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript"><!-- Kịch bản cho sự kiện bấm nút Lọc Filter -->
$('#button-filter').on('click', function() {
	var url = '/admin/post_category.php?';

	// Tìm kiếm theo tên loại tin
	var filter_name = $('input[name=\'filter_name\']').val();

	if (filter_name) 
    {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}

	// Tìm kiếm theo trạng thái của loại tin
	var filter_status = $('select[name=\'filter_status\']').val();

	if (filter_status != '*') 
    {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}

	// Tìm kiếm theo tính nổi bật (có/không) của loại tin
	var filter_featured = $('select[name=\'filter_featured\']').val();

	// Nếu người dùng không chọn thẻ select thì thôi, còn nếu chọn Nổi bật/Không nổi bật
	// thì gắn vào url
	if (filter_featured != '*') 
	{
		url += '&filter_featured=' + encodeURIComponent(filter_featured);
	}

	// Tìm kiếm các loại tin thuộc dạng Top (được đưa thẳng lên Menu Top nằm ngang của trang chủ)
	var filter_top = $('select[name=\'filter_top\']').val();

	if (filter_top != '*') 
    {
		url += '&filter_top=' + encodeURIComponent(filter_top);
	}

	// Nếu chỉ định giới hạn phân trang khác so với mặc định (config_limit_admin)
	//var filter_limit = $('select[name=\'filter_limit\']').val();
	var limit = $('select[name=\'filter_limit\']').val();

	if (limit != '*') 
	{
		url += '&limit=' + encodeURIComponent(limit);
	}	

	// Không duy trì số thứ tự trang ở đây vì limit thay đổi thì tổng số trang sẽ không còn như cũ !!!

	// Duy trì các tham số sắp xếp trên url
	url += '&sort=<?php echo $sort; ?>';
	url += '&order=<?php echo $order; ?>';

	// Điều hướng sang chính trang này nhưng với bộ tham số mới trên URL
	location = url;
});
</script> 

<script type="text/javascript"> <!-- Kịch bản cho sự kiện người dùng gõ từ khóa vào input name -->
$('input[name=\'filter_name\']').autocomplete({
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
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_name\']').val(item['label']);
	}
});


//input-name, input-model, input-price, input-quantity
// Sau khi người dùng nhập dữ liệu lọc trên form và ấn
// Enter thì kích hoạt sự kiện 'click' trên nút #button-filter
$("[id^='input-']").on('keydown', function(e) {
	if (e.keyCode == 13) {
		$('#button-filter').trigger('click');
	}
});
</script>