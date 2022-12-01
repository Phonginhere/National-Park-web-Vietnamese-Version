<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang xóa dữ liệu giỏ hàng
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'cart-session.php';

cartClear();

echo 'Giỏ hàng đã được xóa';