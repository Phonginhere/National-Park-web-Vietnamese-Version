<?php 
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang chi tiết đơn hàng
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.order.php';

// Nếu khách hàng chưa đăng nhập thì điều hướng sang trang login
check_login_home();

// Lấy ra chi tiết đơn hàng theo id
$order = orderDetailsWithFormat($_GET['order_id']);

// Nội dung riêng của trang...
$web_title = "Chi Tiết Đơn Hàng";
$web_content = "view/view-order-details.php";

// ...được đặt vào bố cục chung của toàn site.
include_once $web_layout;	

