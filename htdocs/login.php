<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang đăng nhập dành cho khách hàng
 */
include_once 'configs.php';

// Nếu như khách hàng đã đăng nhập vào rồi
// thì điều hướng sang trang chủ
if (isset ($_SESSION['CUS_LOGGED'])) 
{
	$app = APP;
	header("location: /home-blog.php");
	
}	// Nếu khách hàng đăng nhập (submit login form)
else if ( $_SERVER['REQUEST_METHOD'] == "POST" )  
{ 
	
	// Mở sesion mới
	@session_destroy();
    session_start();
    session_regenerate_id();
    
    // Xác thực tài khoản khách hàng
	include_once "account-authenticate.php";
	die();
} // end login

$error_text = $_SESSION['ERROR_TEXT']; //thông báo lỗi 

// Nội dung riêng của trang...
$web_title = "Đăng Nhập";
$web_content = "view/view-login.php";

// ...được đặt vào bố cục chung của toàn site.
$web_layout = "ui/home/{$home_themes}/layout-blog.php";
include_once $web_layout;
