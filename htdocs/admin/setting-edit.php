<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang sửa thông tin cài đặt hệ thống
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.setting.php';
include_once 'setting-validate.php';

// Nếu user gửi form lên
// toàn bộ dữ liệu thêm mới được lưu trong biến mảng $_POST
if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateForm())  
{ 
	// Thêm mới setting
	settingEdit($_POST);
	
	// Thông báo sửa thành công
	$_SESSION['SUCCESS_TEXT'] = "Đã sửa setting thành công !";
	
	// Điều hướng tới trang danh mục loại sản phẩm
	// có phân trang và sắp xếp

	header ("location: /admin/setting-edit.php");
} 

// Nội dung riêng của trang
$web_title = 'Setting';
$active_page_admin = ACTIVE_PAGE_ADMIN_SETTINGS;
$text_form = 'Sửa Cài Đặt';

include_once "setting-form.php";
