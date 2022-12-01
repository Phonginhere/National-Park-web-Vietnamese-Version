<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang thêm mới loại bài viết
 */
// Cấu hình hệ thống:
include_once '../configs.php';
// Thư viện hàm:
include_once '../lib/table/table.post_category.php';

check_login();

include_once "post_category-validate.php";

// Nếu user gửi dữ liệu hợp lệ thì mới tiến hành thêm mới bản ghi.
// Toàn bộ dữ liệu thêm mới được lưu trong biến mảng $_POST
if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateForm())  
{ 

	// Thêm mới loại bài viết
	post_categoryAdd($_POST);
	
	// Thông báo thêm mới thành công
	$_SESSION['SUCCESS_TEXT'] = "Đã thêm mới thành công loại bài viết";
	
	// Điều hướng tới trang danh mục loại 
	header ("location: /admin/post_category.php");
	die();
} 

// Thông tin riêng của trang
$web_title = "Phân Loại Bài Viết";
$form_title = "Thêm Mới Loại Bài Viết";

include_once 'post_category-form.php'; 