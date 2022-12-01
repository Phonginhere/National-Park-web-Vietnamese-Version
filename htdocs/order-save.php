<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang lưu đơn hàng vào cơ sở dữ liệu
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.order.php';
include_once 'lib/tool.image.php';
include_once 'cart-session.php';


	$order_data = array();
	$order_data['totals'] = array();
	
	// vẫn phải lưu thông tin khách hàng trong đơn hàng
	// để lưu vết lịch sử. Đề phòng trong tương lai thông tin khách hàng bị thay đổi
	// hoặc khách hàng muốn nhập thông tin không giống với thông tin tài khoản
	// lưu trên hệ thống.
	$order_data['customer_id']       = isset($_SESSION['CUS_LOGGED']) ? $_SESSION['CUS_LOGGED'] : 0;
	$order_data['email']             = $_POST['email']; 
	$order_data['telephone']         = $_POST['telephone']; 
	
	// shipping
	// @todo: chỉ sử dụng fullname thôi, bởi vì site này là cho thị trường Việt Nam
	$order_data['fullname'] = $_POST['fullname']; // tạm dùng luôn cho fullname 
	$order_data['address']   = $_POST['address']; 
	
	$order_data['comment'] = $_POST['comment'];
	$order_data['total']   = cartGetTotal() ;//$total;
	
	$order_data['products'] = array();

	foreach (cartGetProducts() as $product) 
	{
		$order_data['products'][] = array(
			'product_id' => $product['product_id'],
			'name'       => $product['name'],
			'model'      => $product['model'],
			'quantity'   => $product['quantity'],
			'price'      => $product['price'],
			'total'      => $product['total'],
		);
	}
	
	// add order history
	// clear cart tooo
	//$_SESSION['order_id'] = orderAdd($order_data);
	$order_id = orderAdd($order_data);
	cartClear();
	