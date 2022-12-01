<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang xóa đơn hàng
 */
// Cấu hình hệ thống
include_once '../configs.php';
// Thư viện hàm
include_once '../lib/table/table.order.php';

check_login();

// Nếu xóa nhiều đơn hàng cùng lúc:
// (các id được lưu trong biến mảng $_POST
if ( isset($_POST['selected']))
{
	// Xóa sản phẩm
	foreach ($_POST['selected'] as $order_id)
	{
		orderDelete($order_id);
	}

	$_SESSION['SUCCESS_TEXT'] = "Đã xóa đơn hàng thành công !";

	// Nếu như trong quá trình xóa mà có lỗi thì chỉ hiện lỗi
	// còn những bản ghi xóa thành công thì bỏ đi thông báo thành công.
	if($_SESSION['ERROR_TEXT'] != null)
	{
		$_SESSION['SUCCESS_TEXT'] = null;
	}
}

header("location: /admin/order.php");
die();


