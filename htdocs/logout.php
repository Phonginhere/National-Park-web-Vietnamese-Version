<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang đăng thoát dành cho khách hàng
 */
include_once 'configs.php';

ob_start();
	
// Xóa dữ liệu phiên kết nối thuộc về khách hàng vừa đăng thoát.
unset($_SESSION['CUS_LOGGED']);
unset($_SESSION['CUS_EMAIL']);
unset($_SESSION['CUS_FULLNAME']);
//unset($_SESSION['CUS_IMG']);	// @TODO
	
// Điều hướng sang trang chủ
header("location: /home-blog.php");


