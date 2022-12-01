<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang so sánh sản phẩm
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.category.php';
include_once 'lib/table/table.product.php';
include_once 'lib/tool.image.php';
include_once 'product-compare-session.php';


//echo 'hello boy';
if (isset($_REQUEST['remove'])) {
    productCompareRemove($_REQUEST['remove']);
}

$compared_products = productCompareGetProductsWithFormat();

// Nội dung riêng của trang...
$web_title = 'So Sánh Sản Phẩm';
$web_content = "view/view-product-compare.php";

// ...được đặt vào bố cục chung của toàn site.
include_once $web_layout;	
					
