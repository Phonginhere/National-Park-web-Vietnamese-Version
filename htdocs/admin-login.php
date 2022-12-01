<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang đăng nhập quản trị
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Nếu người dùng điền thông tin đăng nhập vào form và đẩy lên
if ( $_SERVER['REQUEST_METHOD'] == "POST" )  
{ 
	// Mở phiên kết nối mới
	@session_destroy();
    session_start();
    session_regenerate_id();
    
    // Xác thực định danh của user
	include_once 'admin-authenticate.php';
	die();
} // end login

// Hiển thị màn hình đăng nhập
$web_title  = "Quản trị";

check_file_layout($web_layout_adminlogin);

include_once $web_layout_adminlogin;
