<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang xóa nghề nghiệp/vị trí/chức danh
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.job.php';
include_once 'job-validate.php';

check_login(); // quản trị viên phải đăng nhập !

if (isset($_POST['selected']) && validateDelete()) 
{
	foreach ($_POST['selected'] as $job_id) 
	{
		jobDelete($job_id);
	}
	
	$_SESSION['SUCCESS_TEXT'] = 'Đã xóa thành công job!';

	header ("location: /admin/job.php");
	die();
}

// Nếu không thể xóa (không có quyền) thì điều hướng sang trang 
// danh sách và hiển thị lỗi.
header ("location: /admin/job.php");
die();
