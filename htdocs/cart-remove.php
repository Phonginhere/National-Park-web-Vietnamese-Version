<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang ajax gỡ bỏ sản phẩm khỏi giỏ hàng
 * Chức năng này được hiển thị trên trang cart.php
 * cũng như trên giỏ hàng ajax
 * Dữ liệu gửi lên bởi cart.js
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.product.php';
include_once 'cart-session.php';

$json = array();

if (isset($_POST['product_id'])) 
{
	cartRemove($_POST['product_id']);

	$_SESSION['success'] = 'Đã xóa bỏ sản phẩm khỏi giỏ hàng';

	$json['total'] = cartGetTextCountAndTotal();
}	
		
header("Content-Type: application/json;charset=UTF-8");
echo json_encode($json);