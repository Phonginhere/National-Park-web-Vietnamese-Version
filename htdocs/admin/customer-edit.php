<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang sửa khách hàng
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.customer.php';
include_once 'customer-validate.php';

check_login();

// Nếu user gửi form lên
// toàn bộ dữ liệu chỉnh sửa được lưu trong biến mảng $_POST
// nếu username và password để trống thì giá trị cũ được giữ nguyên !!!
//if ($_SERVER['REQUEST_METHOD'] == "POST" && validateEdit() && validateForm()) {
if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
	// Sửa user
	customerEdit($_GET['customer_id'], $_POST);
	
	// Thông báo sửa thành công
	$_SESSION['SUCCESS_TEXT'] = 'Đã sửa thành công thông tin khách hàng !';

	// Điều hướng tới trang danh mục DANH_MUC
	// có phân trang và sắp xếp
	$url = '?';
	if (isset ($_GET['sort'])) {
		$url .= '&sort=' . $_GET['sort'];
	}

	if (isset ($_GET['order'])) {
		$url .= '&order=' . $_GET['order'];
	}

	if (isset ($_GET['page'])) {
		$url .= '&page=' . $_GET['page'];
	}

	header("location: /admin/customer.php" . $url);
	die();
}

$form_title = 'Sửa thông tin khách hàng';
include_once 'customer-form.php';