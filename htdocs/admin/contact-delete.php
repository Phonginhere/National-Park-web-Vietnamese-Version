<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang xóa phản hồi từ khách hàng
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.contact.php';
include_once 'contact-validate.php';

check_login(); // quản trị viên phải đăng nhập !

if (isset($_POST['selected']) && validateDelete()) 
{
	foreach ($_POST['selected'] as $contact_id) 
	{
		contactDelete($contact_id);
	}
	
	$_SESSION['SUCCESS_TEXT'] = 'Đã xóa thành công phản hồi khách hàng!';

	header ("location: /admin/contact.php");
	die();
}

// Nếu không thể xóa (không có quyền) thì điều hướng sang trang 
// danh sách và hiển thị lỗi.
header ("location: /admin/contact.php");
die();
