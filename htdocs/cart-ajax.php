<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Khung nhìn giỏ hàng
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'cart-session.php';

/*
 Phần cart-info.php là cần thiết để trả lại nội dung cho ajax request.
 Nó khác so với shopping-cart.php là toàn bộ trang giỏ hàng
 */

if (!is_ajax())
    header("location: /home.php");

// Nếu giỏ hàng có sản phẩm:
if (cartHasProducts()) 
{
	include_once "ui/home/{$home_themes}/view/view-cart-products.php" ;
	die();
} 

// Nếu giỏ hàng không có sản phẩm
include_once "ui/home/{$home_themes}/view/view-cart-empty.php";

