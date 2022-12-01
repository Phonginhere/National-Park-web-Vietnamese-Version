<?php 
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang sửa tài khoản khách hàng
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.product.php';
include_once 'lib/table/table.customer.php';
include_once 'account-validate.php';

// Nếu khách hàng chưa đăng nhập thì điều hướng sang trang login
check_login_home();

if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateForm())  
{ 
	
	// sửa tài khoản khách hàng
	customerEdit($_GET['cid'], $_POST);
	
	customer_info_reset();
	
	// Thông báo sửa thành công
	$_SESSION['SUCCESS_TEXT'] = 'Bạn đã sửa tài khoản thành công !';
	
	// Điều hướng sang trang đăng nhập
	header ("location: /account.php");
}
$error_text = $_SESSION['ERROR_TEXT']; //thông báo lỗi 

// Nội dung riêng của trang...
$web_title = "Sửa Tài Khoản";
$form_title = 'Sửa Tài Khoản';

include_once 'account-form.php';





