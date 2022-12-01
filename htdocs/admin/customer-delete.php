<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang xóa khách hàng
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.customer.php';
include_once 'customer-validate.php';

check_login();

if (isset($_POST['selected']) && validateDelete()) 
{
	foreach ($_POST['selected'] as $customer_id) 
	{
		customerDelete($customer_id);
	}
	
	$_SESSION['SUCCESS_TEXT'] = 'Đã xóa thành công tài khoản khách hàng!';

	$url = '?';

    if (isset($_GET['sort'])) {
		$url .= '&sort=' . $_GET['sort'];
	}

    if (isset($_GET['order'])) {
		$url .= '&order=' . $_GET['order'];
	}

    if (isset($_GET['page'])) {
		$url .= '&page=' . $_GET['page'];
	}

	header ("location: /admin/customer.php".$url);
	die();
}

// Nếu không thể xóa thì điều hướng sang trang 
// danh sách khách hàng và hiển thị lỗi.
header ("location: /admin/customer.php");
die();
