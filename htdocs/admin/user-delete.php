<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang xóa nhân viên quản trị
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.user.php';
include_once 'user-validate.php';

check_login();

if (isset($_POST['selected']) && validateDelete()) 
{
	foreach ($_POST['selected'] as $user_id) 
	{
		userDelete($user_id);
	}
	
	$_SESSION['SUCCESS_TEXT'] = 'Đã xóa thành công tài khoản !';

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

	
	if($url='?') $url = '';
	
	// điều hướng sang trang danh sách nhân viên
	header ("location: /admin/user.php".$url);
	die();
}

include_once 'user.php';
