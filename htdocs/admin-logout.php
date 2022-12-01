<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang đăng thoát quản trị
 */
// cấu hình hệ thống
include_once 'configs.php';

// bật bộ nhớ đệm đầu ra
// liên quan đến cơ chế lưu tạm dữ liệu caching
// giúp giảm tải truy vấn db, giúp site chạy nhanh
// @source http://www.vietnoiviet.com/content/cac-ham-obstart-obgetcontents-obclean-obendflush-la-gi-dung-de-lam-gi
ob_start();
	
// Xóa dữ liệu phiên kết nối thuộc về user vừa đăng thoát.
// @see admin-authentication.php
unset($_SESSION['USER_LOGGED']);
unset($_SESSION['USR_USERNAME']);
unset($_SESSION['USR_FULLNAME']);
unset($_SESSION['USR_IMG']);
	
// Điều hướng sang trang đăng nhập của phần quản trị
header("location: /admin.php");


