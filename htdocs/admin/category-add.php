<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang thêm mới loại sản phẩm
 */
include_once '../configs.php';
include_once '../lib/table/table.category.php';

check_login();

include_once "category-validate.php";

// Nếu user gửi dữ liệu hợp lệ thì mới tiến hành thêm mới bản ghi.
// Toàn bộ dữ liệu thêm mới được lưu trong biến mảng $_POST
if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateForm())  
{ 
	// Thêm mới loại sản phẩm
	categoryAdd($_POST);
	
	// Thông báo thêm mới thành công
	$_SESSION['SUCCESS_TEXT'] = "Đã thêm mới thành công loại sản phẩm";
	
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

	header ("location: /admin/category.php".$url);
	die();
} 

// Thông tin riêng của trang
$web_title = "Loại Sản Phẩm";
$form_title = "Thêm Mới Loại Sản Phẩm";

include_once 'category-form.php'; 