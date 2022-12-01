<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Các hàm xác thực tính hợp lệ của dữ liệu khách hàng
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.job.php';

/*
 Kiểm duyệt dữ liệu form. Nếu dữ liệu gửi lên không thỏa mãn
 các yêu cầu / tiêu chí đề ra thì gửi các thông báo lỗi sang
 View để người dùng biết và tuân theo.
 */
function validateForm()
{
	// global $error_fullname;
	// global $error_email;
	// global $error_phone;
	// global $error_address;
	// global $error_password;
	// global $error_confirm_password;
	
	// // Nếu user không có quyền xóa
	// // gửi lỗi sang view
	// // $error_permission = 'Không có quyền sửa';
	// // return false;
	
	// // Xác thực tính hợp lệ của họ tên
	// if ((utf8_strlen(trim($_POST['fullname'])) < 1) || (utf8_strlen(trim($_POST['fullname'])) > 32))
	// {
		// $error_name = 'Tên phải có độ dài từ 1 kí tự trở lên và không quá 32 kí tự';
		// return false;
	// }
	
	// if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		// $error_email = 'eMail phải hợp lệ !';
	// }
	

		
	return true;
}

function validateAdd()
{
	// Chỉ được thêm mới nếu bạn là user=admin
	if ($_SESSION['USR_USERNAME'] != "admin")
	{
		$_SESSION['ERROR_TEXT'] = "Bạn không có quyền thêm mới job ! (chỉ admin mới có quyền)";
		return false;
	}
		
	
	return true;
}

function validateEdit()
{
	
	// Không được sửa thông tin của người khác nếu bạn không phải admin
	if ($_SESSION['USR_USERNAME'] != "admin")
	{
		$_SESSION['ERROR_TEXT'] = "Bạn không có quyền sửa job ! (chỉ admin mới có quyền)";
		return false;
	}
	
	return true;
}

function validateDelete()
{
	// Chỉ có user=admin mới được xóa
	if ($_SESSION['USR_USERNAME'] != "admin")
	{
		$_SESSION['ERROR_TEXT'] = "Bạn không có quyền xóa job ! (chỉ admin mới có quyền)";
		return false;
	}
	
	return true;
}

function validateCopy()
{
	return true;
}