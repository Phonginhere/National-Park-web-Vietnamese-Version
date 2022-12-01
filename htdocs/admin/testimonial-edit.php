<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang sửa nhân viên quản trị
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.testimonial.php';
//include_once 'testimonial-validate.php'; // @todo

check_login();  // quản trị viên phải đăng nhập

// Nếu form gửi lên
// toàn bộ dữ liệu chỉnh sửa được lưu trong biến mảng $_POST
//if ($_SERVER['REQUEST_METHOD'] == "POST" && validateEdit() && validateForm()) {
if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
	// Sửa db
	testimonialEdit($_GET['testimonial_id'], $_POST);
	
	// Thông báo sửa thành công
	$_SESSION['SUCCESS_TEXT'] = 'Đã hoàn tất việc sửa lời chứng thực !';

	// Điều hướng tới trang danh sách lời chứng thực
	header("location: /admin/testimonial.php");
}

$form_title = 'Sửa Lời Chứng Thực';
$web_title = 'Sửa Lời Chứng Thực';
include_once 'testimonial-form.php';