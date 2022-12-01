<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang sửa loại sản phẩm
 */
include_once '../configs.php';
include_once '../lib/table/table.department.php';
include_once 'department-validate.php';

check_login();

// Nếu user gửi form lên và dữ liệu trên form là hợp lệ thì mới tiến hành sửa bản ghi trong db.
// toàn bộ dữ liệu chỉnh sửa được lưu trong biến mảng $_POST
if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateForm())  
{ 
	
	// Sửa loại sản phẩm
	departmentEdit($_GET['department_id'], $_POST);
	
	// Thông báo sửa mới thành công
	$_SESSION['SUCCESS_TEXT'] = "Đã hoàn tất việc sửa phòng ban";
	
	// Điều hướng tới trang danh sách phòng ban
	header ("location: /admin/department.php");
}

$web_title = "Sửa Phòng Ban";
$form_title = "Sửa Thông Tin Phòng Ban";

// Hiển thị form
include_once "department-form.php";