<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang thêm mới lời chứng thực từ khách hàng
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.testimonial.php';
//include_once 'testimonial-validate.php'; // @todo

check_login(); // quản trị viên phải đăng nhập !


// Nếu user gửi form lên
// toàn bộ dữ liệu thêm mới được lưu trong biến mảng $_POST
//if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateAdd() && validateForm())  
if ( $_SERVER['REQUEST_METHOD'] == "POST")  
{ 
	// Thêm mới user
	testimonialAdd($_POST);
	
	// Thông báo thêm mới thành công
	$_SESSION['SUCCESS_TEXT'] = 'Đã hoàn tất việc thêm mới lời chứng thực !';
		
	// Điều hướng tới trang danh sách lời chứng thực

	header ("location: /admin/testimonial.php");
	die();
} 


$form_title = 'Thêm Mới Lời Chứng Thực';
$web_title = 'Sửa Lời Chứng Thực';
include_once 'testimonial-form.php';