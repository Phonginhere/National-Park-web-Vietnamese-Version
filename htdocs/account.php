<?php 
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang thông tin tài khoản khách hàng
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.banner.php';
include_once 'lib/table/table.product.php';
include_once 'lib/table/table.customer.php';

// Nếu khách hàng chưa đăng nhập thì điều hướng sang trang login
check_login_home();
	
$customer_info = customerGetById($_SESSION['CUS_LOGGED']);

$fullname = $customer_info['fullname'];

$email = $customer_info['email'];

$telephone = $customer_info['telephone'];

$fax = $customer_info['fax'];

$address = $customer_info['address'];

$city = $customer_info['city'];

// Nội dung riêng của trang...
$web_title = "Tài khoản";
$web_content = "view/view-account.php";

// ...được đặt vào bố cục của toàn site.
$web_layout = "ui/home/{$home_themes}/layout-blog.php";
include_once $web_layout;

