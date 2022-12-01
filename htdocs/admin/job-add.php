<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang thêm mới nghề nghiệp
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.job.php';
//include_once 'testimonial-validate.php'; // @todo

check_login(); // quản trị viên phải đăng nhập !


// Nếu user gửi form lên
// toàn bộ dữ liệu thêm mới được lưu trong biến mảng $_POST
//if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateAdd() && validateForm())  
if ( $_SERVER['REQUEST_METHOD'] == "POST")  
{ 
	// Thêm mới user
	jobAdd($_POST);
	
	// Thông báo thêm mới thành công
	$_SESSION['SUCCESS_TEXT'] = 'Đã hoàn tất việc thêm mới vị trí chức danh nghề nghiệp !';
		
	// Điều hướng tới trang danh sách lời chứng thực

	header ("location: /admin/job.php");
	die();
} 

$web_title = 'Thêm Mới Nghề Nghiệp';
include_once 'job-form.php';