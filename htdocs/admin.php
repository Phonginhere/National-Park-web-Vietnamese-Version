<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 * 
 * Trang quản trị 
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Nếu như user đã đăng nhập vào rồi
// thì điều hướng vào phần quản trị
// (@todo: điều hướng vào url mà họ yêu cầu trước đó)
$url_redirect = isset ($_SESSION['USER_LOGGED']) ? "/admin/post.php" : "/admin-login.php"; 


// Nếu như đăng nhập vào rồi thì điều hướng
// sang trang dashboard
// còn không thì điều hướng sang
header ("location: ".$url_redirect);
die();
