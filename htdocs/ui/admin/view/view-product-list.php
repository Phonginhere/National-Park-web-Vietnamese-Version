<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="/admin/product-add.php" data-toggle="tooltip" title="Thêm mới" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="submit" form="form-product" formaction="/admin/product-copy.php" data-toggle="tooltip" title="Sao chép" class="btn btn-default"><i class="fa fa-copy"></i></button>
        <button type="button" data-toggle="tooltip" title="Xóa" class="btn btn-danger" onclick="confirm('<?php echo 'Bạn có chắc là muốn xóa'; ?>') ? $('#form-product').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <!-- <h1>Sản Phẩm</h1>-->
      <ul class="breadcrumb">
          <li><a href="/admin.php"><?php echo 'Quản Trị'?></a></li> 
          <li><a href="/admin/product.php"><?php echo 'Sản Phẩm'?></a></li>
      </ul>
    </div>
  </div>
  <div class="container-fluid"> 
    <?php if ($_SESSION['ERROR_TEXT']) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION['ERROR_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php $_SESSION['ERROR_TEXT']=NULL;?>
    	
    <?php if ($_SESSION['SUCCESS_TEXT']) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $_SESSION['SUCCESS_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } $_SESSION['SUCCESS_TEXT']=NULL;?>
    
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Danh Sách Sản Phẩm</h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-name"><?php echo 'Tên Sản Phẩm'; ?></label>
                <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo 'Tên Sản Phẩm'; ?>" id="input-name" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-model"><?php echo 'Model'; ?></label>
                <input type="text" name="filter_model" value="<?php echo $filter_model; ?>" placeholder="Model" id="input-model" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-price"><?php echo "Giá"; ?></label>
                <input type="text" name="filter_price" value="<?php echo $filter_price; ?>" placeholder="<?php echo 'Giá'; ?>" id="input-price" class="form-control" />
              </div>
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
            </div>
            <div class="col-sm-4">
            	<div class="form-group">&nbsp;</div>
            	<div class="form-group">&nbsp;</div>
            	<div class="form-group">&nbsp;</div>
              <button type="button" id="button-filter" class="btn btn-primary pull-left"><i class="fa fa-search"></i> <?php echo 'Lọc'; ?></button>
            </div>
          </div>
        </div>
        <form action="/admin/product-delete.php" method="post" enctype="multipart/form-data" id="form-product">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-center">
                  	<a href="<?php echo $sort_product_id;?>" class="<?php if ($sort == 'product_id') {echo strtolower($order);} ?>">Id</a>
                  </td>
                  <td class="text-center"><?php echo 'Ảnh'; ?></td>
                  <td class="text-left">
                    <a href="<?php echo $sort_name; ?>" class="<?php if ($sort == 'name') {echo strtolower($order);} ?>"><?php echo 'Tên Sản Phẩm'; ?></a>
                  </td>
                  <td class="text-left">
                    <a href="<?php echo $sort_model; ?>" class="<?php if ($sort == 'model') {echo strtolower($order);} ?>"><?php echo 'Model'; ?></a>
                  </td>
                  <td class="text-left">
                    <a href="<?php echo $sort_price; ?>" class="<?php if ($sort == 'price') {echo strtolower($order);} ?>"><?php echo 'Giá'; ?></a>
                  </td>
                  <td class="text-left"><?php  ?>
                    <a href="<?php echo $sort_status; ?>" class="<?php if ($sort == 'status') {echo strtolower($order);} ?>"><?php echo 'Trạng thái'; ?></a>
                  </td>
                  <td class="text-right"><?php echo 'Hành động'; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($products) { ?>
                <?php foreach ($products as $product) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($product['product_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" />
                    <?php } ?>
                  </td>
                  <td>
                  	<?php echo $product['product_id'] ?>
                  </td>
                  <td class="text-center"><?php if ($product['image']) { ?>
                    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="img-thumbnail" />
                    <?php } else { ?>
                    <span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
                    <?php } ?>
                  </td>
                  <td class="text-left"><?php echo $product['name']; ?></td>
                  <td class="text-left"><?php echo $product['model']; ?></td>
                  <td class="text-left"><?php echo $product['price']; ?></td>
                  <td class="text-left"><?php echo $product['status']; ?></td>
                  <td class="text-right">
                  	<a href="<?php echo $product['edit']; ?>" data-toggle="tooltip" title="<?php echo 'Sửa';?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                  	
                  	<!-- 
                  	Sau khi bấm vào nút xóa thì tích chọn tự động vào checkbox của bản ghi này, 
                  	rồi yêu cầu user xác nhận lại một lần nữa trước khi thực hiện xóa thực sự.
                  	Nếu user không muốn xóa nữa thì bỏ tích trên các hộp checkbox
                  	Sử dụng kĩ thuật: multiple attribute selector (jQuery) và hàm hệ thống confirm()
                  	 -->
                  	<button type="button" data-toggle="tooltip" title="Xóa" class="btn btn-danger" onclick="$('input[name*=\'selected\'][value=\'<?php echo $product['product_id'];?>\']').prop('checked', true);confirm('<?php echo 'Bạn có chắc là muốn xóa'; ?>') ? $('#form-product').submit() : false;$('input[name*=\'selected\']').prop('checked', false);"><i class="fa fa-trash-o"></i></button>
                  </td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8"><?php echo 'Không tìm thấy kết quả nào'; ?></td>
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
  <script type="text/javascript">
$('#button-filter').on('click', function() {
	var url = '/admin/product.php?';

	var filter_name = $('input[name=\'filter_name\']').val();

	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}

	var filter_model = $('input[name=\'filter_model\']').val();

	if (filter_model) {
		url += '&filter_model=' + encodeURIComponent(filter_model);
	}

	var filter_price = $('input[name=\'filter_price\']').val();

	if (filter_price) {
		url += '&filter_price=' + encodeURIComponent(filter_price);
	}

	var filter_quantity = $('input[name=\'filter_quantity\']').val();

	if (filter_quantity) {
		url += '&filter_quantity=' + encodeURIComponent(filter_quantity);
	}

	var filter_status = $('select[name=\'filter_status\']').val();

	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}

	location = url;
});
</script> 
  <script type="text/javascript">
$('input[name=\'filter_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: '/admin/product-autocomplete.php?filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_name\']').val(item['label']);
	}
});

$('input[name=\'filter_model\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: '/admin/product-autocomplete.php?filter_model=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['model'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_model\']').val(item['label']);
	}
});

//input-name, input-model, input-price, input-quantity
// Sau khi người dùng nhập dữ liệu lọc trên form và ấn
// Enter thì thực thi ajax:
$("[id^='input-']").on('keydown', function(e) {
	if (e.keyCode == 13) {
		$('#button-filter').trigger('click');
	}
});
</script>
</div>
