<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Form sửa/xóa khách hàng
 */
// Cấu hình hệ thống
include_once '../configs.php';
// Thư viện hàm
include_once '../lib/table/table.customer.php';
include_once '../lib/tool.image.php';

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

// Form Action
if (!isset($_GET['customer_id'])) {
	$url_action = "/admin/customer-add.php";
	$disabled = "";
	$readonly = "";
} else {
	$url_action = "/admin/customer-edit.php?customer_id=".$_GET['customer_id'];
	$disabled = "disabled";
	$readonly = "readonly";
}

$url_cancel = "/admin/customer.php";


if (isset($_GET['customer_id']) && $_SERVER['REQUEST_METHOD'] != "POST") 
{
	$customer_info = customerGetById($_GET['customer_id']);
}


if (isset($_POST['fullname'])) {
     $fullname = $_POST['fullname'];
} elseif (!empty($customer_info)) {
     $fullname = $customer_info['fullname'];
} else {
     $fullname = '';
}

if (isset($_POST['email'])) {
     $email = $_POST['email'];
} elseif (!empty($customer_info)) {
     $email = $customer_info['email'];
} else {
     $email = '';
}

if (isset($_POST['telephone'])) {
	$telephone = $_POST['telephone'];
} elseif (!empty($customer_info)) {
	$telephone = $customer_info['telephone'];
} else {
	$telephone = '';
}

if (isset($_POST['address'])) {
	$address = $_POST['address'];
} elseif (!empty($customer_info)) {
	$address = $customer_info['address'];
} else {
	$address = '';
}

if (isset($_POST['password'])) {
	$password = $_POST['password'];
} else {
	$password = '';
}

if (isset($_POST['confirm_password'])) {
	$confirm_password = $_POST['confirm_password'];
} else {
	$confirm_password = '';
}


if (isset($_POST['image'])) {
     $customer_image = $_POST['image'];
} elseif (!empty($customer_info)) {
     $customer_image = $customer_info['image'];
} else {
     $customer_image = '';
}

if (isset($_POST['image']) && is_file(DIR_IMAGE . $_POST['image'])) {
     $customer_thumb = img_resize($_POST['image'], 100, 100);
} elseif (!empty($customer_info) && $customer_info['image'] && is_file(DIR_IMAGE . $customer_info['image'])) {
     $customer_thumb = img_resize($customer_info['image'], 100, 100);
} else {
     $customer_thumb = img_resize('no_image.png', 100, 100);
}
		
$customer_placeholder = img_resize('no_image.png', 100, 100);

if (isset($_POST['status'])) {
     $customer_status = $_POST['status'];
} elseif (!empty($customer_info)) {
     $customer_status = $customer_info['status'];
} else {
     $customer_status = 0;
}		

// Nội dung riêng của trang:
$web_title = "Thông Tin Khách Hàng";
$web_content = "../ui/admin/view/view-customer-form.php";

check_file_layout($web_layout_admin, $web_content);

// được đặt vào bố cục chung của toàn site:
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;
