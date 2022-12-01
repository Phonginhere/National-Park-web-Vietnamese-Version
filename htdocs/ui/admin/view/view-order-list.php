<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
      	<button type="button" data-toggle="tooltip" title="Xóa" class="btn btn-danger" onclick="confirm('Bạn có chắc muốn xóa') ? $('#form-order').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <ul class="breadcrumb">
        <li><a href="/admin.php">Quản Trị</a></li>
        <li><a href="/admin/order.php">Đơn Hàng</a></li>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($_SESSION['ERROR_TEXT']) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php $_SESSION['ERROR_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } unset($_SESSION['ERROR_TEXT']);?>
    <?php if ($_SESSION['SUCCESS_TEXT']) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $_SESSION['SUCCESS_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php unset($_SESSION['SUCCESS_TEXT']);?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Danh Sách Đơn Hàng</h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-order-id">ID Đơn hàng</label>
                <input type="text" name="filter_order_id" value="<?php echo $filter_order_id; ?>" placeholder="ID Đơn hàng" id="input-order-id" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-customer">Khách hàng</label>
                <input type="text" name="filter_customer" value="<?php echo $filter_customer; ?>" placeholder="Khách hàng" id="input-customer" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-total">Tổng giá trị</label>
                <input type="text" name="filter_total" value="<?php echo $filter_total; ?>" placeholder="Tổng giá trị" id="input-total" class="form-control" />
              </div>
               <div class="form-group">
                <label class="control-label" for="input-date-added">Ngày tạo</label>
                <div class="input-group date">
                  <input type="text" name="filter_date_added" value="<?php echo $filter_date_added;?>" placeholder="Ngày tạo" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>
            </div>
            <div class="col-sm-4">
             
              <div class="form-group">&nbsp;</div>
              <div class="form-group">&nbsp;</div>
              <div class="form-group">&nbsp;</div>
              <button type="button" id="button-filter" class="btn btn-primary pull-left"><i class="fa fa-search"></i> Lọc</button>
            </div>
          </div>
        </div>
        <form action="/admin/order-delete.php" method="post" enctype="multipart/form-data" id="form-order">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-leflt"><?php if ($sort == 'o.order_id') { ?>
                    <a href="<?php echo $sort_order; ?>" class="<?php echo strtolower($order); ?>">ID Đơn Hàng</a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_order; ?>">ID Đơn hàng</a>
                    <?php } ?>
                  </td>
                  <td class="text-left"><?php if ($view->sort == 'customer') { ?>
                    <a href="<?php echo $sort_customer; ?>" class="<?php echo strtolower($order); ?>">Khách Hàng</a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_customer; ?>">Khách hàng</a>
                    <?php } ?>
                  </td>
                  <td class="text-right"><?php if ($sort == 'o.total') { ?>
                    <a href="<?php echo $sort_total; ?>" class="<?php echo strtolower($order); ?>">Tổng Giá Trị</a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_total; ?>">Tổng giá trị</a>
                    <?php } ?>
                  </td>
                  <td class="text-left"><?php if ($sort == 'o.date_added') { ?>
                    <a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>">Ngày Tạo</a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_date_added; ?>">Ngày tạo</a>
                    <?php } ?>
                  </td>
                  <td class="text-right">Hành động</td>
                </tr>
              </thead>
              <tbody>
                <?php if ($orders) { ?>
                <?php foreach ($orders as $order) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($order['order_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $order['order_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $order['order_id']; ?>" />
                    <?php } ?>
                    <input type="hidden" name="shipping_code[]" value="<?php echo $order['shipping_code']; ?>" />
                  </td>
                  <td class="text-left"><?php echo $order['order_id']; ?></td>
                  <td class="text-left"><?php echo $order['fullname']; ?></td>
                  <td class="text-right"><?php echo $order['total']; ?></td>
                  <td class="text-left"><?php echo $order['date_added']; ?></td>
                  <td class="text-right">
                  	<a href="<?php echo $order['view']; ?>" data-toggle="tooltip" title="Xem" class="btn btn-info"><i class="fa fa-eye"></i></a>
                  	<button type="button" data-toggle="tooltip" title="Xóa" class="btn btn-danger" onclick="$('input[name*=\'selected\'][value=\'<?php echo $order['order_id'];?>\']').prop('checked', true);confirm('Bạn có chắc muốn xóa') ? $('#form-order').submit() : false;$('input[name*=\'selected\']').prop('checked', false);"><i class="fa fa-trash-o"></i></button>
                  </td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8">Không tìm thấy kết quả nào</td>
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
  <script type="text/javascript">
$('#button-filter').on('click', function() {
	url = '/admin/order.php?';
	
	var filter_order_id = $('input[name=\'filter_order_id\']').val();
	
	if (filter_order_id) {
		url += '&filter_order_id=' + encodeURIComponent(filter_order_id);
	}
	
	var filter_customer = $('input[name=\'filter_customer\']').val();
	
	if (filter_customer) {
		url += '&filter_customer=' + encodeURIComponent(filter_customer);
	}
	
	var filter_total = $('input[name=\'filter_total\']').val();

	if (filter_total) {
		url += '&filter_total=' + encodeURIComponent(filter_total);
	}	
	
	var filter_date_added = $('input[name=\'filter_date_added\']').val();
	
	if (filter_date_added) {
		url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
	}
	
	var filter_date_modified = $('input[name=\'filter_date_modified\']').val();
	
	if (filter_date_modified) {
		url += '&filter_date_modified=' + encodeURIComponent(filter_date_modified);
	}
				
	location = url;
});
</script> 
  <script type="text/javascript">
$('input[name=\'filter_customer\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: '/admin/customer-autocomplete.php?filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['customer_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_customer\']').val(item['label']);
	}	
});
</script> 
  <script type="text/javascript"><!--
$('input[name^=\'selected\']').on('change', function() {
	// Nếu như user nhấp chuột vào checkbox trên danh sách
	// thì kích hoạt các nút Print Shipping
	$('#button-shipping, #button-invoice').prop('disabled', true);
	
	var selected = $('input[name^=\'selected\']:checked');
	
	// và nút Print Invoice
	if (selected.length) {
		$('#button-invoice').prop('disabled', false);
	}
	
	// Tuy nhiên nếu có một đơn hàng không có phương thức vận chuyển
	// thì lại tắt nút Print Shipping
	for (i = 0; i < selected.length; i++) {
		if ($(selected[i]).parent().find('input[name^=\'shipping_code\']').val()) {
			$('#button-shipping').prop('disabled', false);
			
			break;
		}
	}
});

$('input[name^=\'selected\']:first').trigger('change');

$('a[id^=\'button-delete\']').on('click', function(e) {
	e.preventDefault();
	
	if (confirm('Bạn có chắc là muốn xóa')) {
		location = $(this).attr('href');
	}
});
//--></script> 
  <script src="/ui/src/js/jquery/1.8.2/plugins/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
  <link href="/ui/src/js/jquery/1.8.2/plugins/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
  <script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script></div>
