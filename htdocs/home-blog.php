<?php 
/**
 * Copyright A1908G1-Phong-CMinh-Nhi_Blog
 *
 * Trang chủ
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.post.php';
include_once 'lib/table/table.product.php';
include_once 'lib/table/table.manufacturer.php';
include_once 'lib/table/table.banner_image.php';

//$post_categories = post_categoryGetAll();

$post_categories = post_categoryGetAllThatHavePost();

// Nội dung riêng của trang...
$web_title = "Home Blog";
$web_content = "view/view-home-blog.php";

// ...được đặt vào bố cục chung của toàn site.
$web_layout = "ui/home/{$home_themes}/layout-blog.php";
include_once $web_layout;
