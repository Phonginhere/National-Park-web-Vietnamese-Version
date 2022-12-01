<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang thêm mới khách hàng
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.customer.php';
include_once 'customer-validate.php';

check_login();


// Nếu user gửi form lên
// toàn bộ dữ liệu thêm mới được lưu trong biến mảng $_POST
if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateAdd() && validateForm())  
{ 
	// Thêm mới user
	customerAdd($_POST);
	
	// Thông báo thêm mới thành công
	$_SESSION['SUCCESS_TEXT'] = 'Đã thêm mới khách hàng thành công !';
		
	// Điều hướng tới trang danh mục loại sản phẩm
	// có phân trang và sắp xếp
	$url = '?';
	if ( isset($_REQUEST['sort']) ) 
	{
		$url .= '&sort=' . $_REQUEST['sort'];
	}
	if ( isset($_REQUEST['order']) ) 
	{
		$url .= '&order=' . $_REQUEST['order'];
	}
	if ( isset($_REQUEST['page']) ) 
	{
		$url .= '&page=' . $_REQUEST['page'];
	}

	header ("location: /admin/customer.php".$url);
} 

$form_title = 'Thêm mới khách hàng';
include_once 'customer-form.php';