<?php 
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang chủ
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.product.php';
include_once 'lib/table/table.manufacturer.php';
include_once 'lib/table/table.banner_image.php';

// Nội dung riêng của trang...
$web_title = "Trang Tin";
$web_content = "view/view-home-post.php";

// ...được đặt vào bố cục chung của toàn site.
$web_layout = "ui/home/{$home_themes}/layout-post.php";
include_once $web_layout;

