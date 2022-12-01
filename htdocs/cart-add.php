<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang ajax thêm mới sản phẩm vào giỏ hàng
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.product.php';
include_once 'cart-session.php';

/*
 Luồng chương trình: user bấm vào nút 'Thêm vào giỏ hàng' trên giao diện html
 --> cart.js 
 --> cart {add: }
 --> /cart-add.php
 */

// dữ liệu json hất về phía trình duyệt khách.
$json = array();

// Bắt id của sản phẩm mới thêm vào giỏ hàng
// (gửi lên từ ajax post)
if (isset($_POST['product_id'])) 
{
	$product_id = (int)$_POST['product_id'];
} 
else 
{
	$product_id = 0;
}
	
$product_info = productById($product_id);

if ($product_info) 
{
	// Số lượng sản phẩm thêm vào giỏ hàng
	if (isset($_POST['quantity'])) 
	{
		$quantity = (int)$_POST['quantity'];
	} 
	else 
	{
		$quantity = 1;
	}
		
	if (!$json) 
	{
		// Thêm mới sản phẩm vào giỏ hàng với số lượng cụ thể.
		cartAdd($_POST['product_id'], $_POST['quantity']);
			
		// Gửi thông báo thành công sang bên view
		$json['success'] = sprintf("Bạn đã thêm thành công %s vào giỏ hàng", $product_info['name']);
				
		// đoạn text hiển thị số sản phẩm trong giỏ hàng và tổng giá trị của chúng
		$json['total'] = cartGetTextCountAndTotal();
				
	} 
	else 
	{
		$json['redirect'] = "/product-info.php?product_id={$_POST['product_id']}"; 
	}
}	
	
header("Content-Type: application/json;charset=UTF-8");
echo json_encode($json);