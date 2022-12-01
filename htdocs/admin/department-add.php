<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang thêm mới phòng ban
 */
include_once '../configs.php';
include_once '../lib/table/table.department.php';

check_login();

include_once "department-validate.php";

// Nếu user gửi dữ liệu hợp lệ thì mới tiến hành thêm mới bản ghi.
// Toàn bộ dữ liệu thêm mới được lưu trong biến mảng $_POST
if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateForm())  
{ 
	// Thêm mới phòng ban
	departmentAdd($_POST);
	
	// Thông báo thêm mới thành công
	$_SESSION['SUCCESS_TEXT'] = "Đã hoàn tất việc thêm mới phòng ban.";
	
	// Điều hướng tới trang danh sách phòng ban
	header ("location: /admin/department.php");
	die();
} 

// Thông tin riêng của trang
$web_title = "Thêm Mới Phòng Ban";
$form_title = "Thêm Mới Phòng Ban";

include_once 'department-form.php'; 