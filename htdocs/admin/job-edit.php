<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang sửa nghề nghiệp
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.job.php';
//include_once 'testimonial-validate.php'; // @todo

check_login();  // quản trị viên phải đăng nhập

// Nếu form gửi lên
// toàn bộ dữ liệu chỉnh sửa được lưu trong biến mảng $_POST
//if ($_SERVER['REQUEST_METHOD'] == "POST" && validateEdit() && validateForm()) {
if ($_SERVER['REQUEST_METHOD'] == "POST") 
{

	// Sửa db
	jobEdit($_GET['job_id'], $_POST);
	
	// Thông báo sửa thành công
	$_SESSION['SUCCESS_TEXT'] = 'Đã hoàn tất việc sửa vị trí chức danh nghề nghiệp !';

	// Điều hướng tới trang danh sách lời chứng thực
	header("location: /admin/job.php");
}

$web_title = 'Sửa Nghề Nghiệp';
include_once 'job-form.php';