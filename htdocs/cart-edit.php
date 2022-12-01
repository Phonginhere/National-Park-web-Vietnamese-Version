<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang ajax cập nhật dữ liệu giỏ hàng
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.product.php';
include_once 'cart-session.php';

$json = array();

// Dữ liệu cập nhật giỏ hàng gửi lên bởi cart.js
// Luồng xử lý:
// cart.php ---> view-checkout-cart.php ---> form submit ---> cart.edit.php
// Dữ liệu cập nhật của mỗi sản phẩm được chứa trong thẻ html <input name="quantity[]"/>
// Toàn bộ dữ  liệu này khi gửi lên máy chủ sẽ có cấu trúc mảng
if (!empty($_POST['quantity'])) 
{
	// Cập nhật giỏ hàng
	foreach ($_POST['quantity'] as $product_id => $new_quantity) 
	{
	    cartUpdate($product_id, $new_quantity);
	}
			
	$_SESSION['success'] = 'Đã cập nhật giỏ hàng thành công !';

	// Điều hướng
	header ("location: /cart.php");
}

header("Content-Type: application/json;charset=UTF-8");
echo json_encode($json);
