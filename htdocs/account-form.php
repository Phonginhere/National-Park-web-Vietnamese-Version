<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Form thông tin tài khoản khách hàng
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.customer.php';
include_once 'lib/table/table.zone.php';
include_once 'lib/tool.image.php';

// Form Action
if (!isset($_GET['cid'])) 
{ 
    // Đăng kí mới tài khoản
	$url_action = "/register.php";
	$disabled = "";
	$readonly = "";
} 
else 
{
	// Sửa thông tin tài khoản
	$url_action = "/account-edit.php?cid=".$_GET['cid'];
	$disabled = "disabled";
	$readonly = "readonly";
}

// Lấy thông tin bản ghi (dựa trên id) và gửi sang bên view
if (isset($_GET['cid']) && $_SERVER['REQUEST_METHOD'] != "POST")
{
	$customer_info = customerGetById($_GET['cid']);
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

if (isset($_POST['fax'])) {
	$fax = $_POST['fax'];
} elseif (!empty($customer_info)) {
	$fax = $customer_info['fax'];
} else {
	$fax = '';
}

if (isset($_POST['address'])) {
	$address = $_POST['address'];
} elseif (!empty($customer_info)) {
	$address = $customer_info['address'];
} else {
	$address = '';
}

if (isset($_POST['city'])) {
	$city = $_POST['city'];
} elseif (!empty($customer_info)) {
	$city = $customer_info['city'];
} else {
	$city = '';
}

if (isset($_POST['password'])) {
	$password = $_POST['password'];
} else {
	$password = '';
}

if (isset($_POST['confirm'])) {
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

if (isset($_POST['image']) && is_file(DIR_IMAGE . $_POST['image'])) 
{
	$customer_thumb = img_resize($_POST['image'], 100, 100);
} 
elseif (!empty($customer_info) && $customer_info['image'] && is_file(DIR_IMAGE . $customer_info['image'])) 
{
	$customer_thumb = img_resize($customer_info['image'], 100, 100);
} 
else 
{
	$customer_thumb = img_resize('no_image.png', 100, 100);
}

$customer_placeholder = img_resize('no_image.png', 100, 100);

if (isset($_POST['status'])) 
{
	$customer_status = $_POST['status'];
} 
elseif (!empty($customer_info)) 
{
	$customer_status = $customer_info['status'];
} 
else 
{
	$customer_status = 0;
}

// Nội dung riêng của trang...
$web_content = "view/view-account-form.php";

// ...được đặt vào bố cục chung của toàn site
$web_layout = "ui/home/{$home_themes}/layout-blog.php";
include_once $web_layout;