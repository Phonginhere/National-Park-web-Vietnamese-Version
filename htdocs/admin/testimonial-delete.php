<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang xóa lời chứng thực
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.testimonial.php';
//include_once 'testimonial-validate.php';

check_login();

//if (isset($_POST['selected']) && validateDelete()) 
if (isset($_POST['selected'])) 
{
	foreach ($_POST['selected'] as $testimonial_id) 
	{
		testimonialDelete($testimonial_id);
	}
	
	$_SESSION['SUCCESS_TEXT'] = 'Đã hoàn tất việc xóa !';
	
	// điều hướng sang trang danh sách nhân viên
	header ("location: /admin/testimonial.php");
	die();
}

include_once 'testimonial.php';
