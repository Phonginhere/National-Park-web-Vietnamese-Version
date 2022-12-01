<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang sửa liên hệ khách hàng
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.contact.php';
include_once 'contact-validate.php';

check_login(); // quản trị viên phải đăng nhập !

// Nếu user gửi form lên
// toàn bộ dữ liệu chỉnh sửa được lưu trong biến mảng $_POST
// nếu username và password để trống thì giá trị cũ được giữ nguyên !!!
//if ($_SERVER['REQUEST_METHOD'] == "POST" && validateEdit() && validateForm()) {
if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
	// Sửa liên hệ khách hàng
	contactEdit($_GET['contact_id'], $_POST);
	
	// Thông báo sửa thành công
	$_SESSION['SUCCESS_TEXT'] = 'Đã hoàn tất việc sửa  ý kiến khách hàng !';

	// Điều hướng tới trang danh sách
	header("location: /admin/contact.php");
	die();
}

$form_title = 'Sửa Phản Hồi Khách Hàng';
include_once 'contact-form.php';