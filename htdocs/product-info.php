<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang thông tin sản phẩm
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.product.php';
include_once 'lib/tool.image.php';

if (isset($_GET['product_id'])) 
{
	$product_id = (int)$_GET['product_id'];
} 
else 
{
	$product_id = 0;
}

// Thông tin sản phẩm đổ vào view html
$product_info = productInfo($product_id);

// Nội dung riêng của trang...
$web_title = "Chi tiết sản phẩm";
$web_content = "view/view-product-info.php";

// ...được đặt vào bố cục chung của toàn site
include_once $web_layout;

// [Chú Ý] Vẫn nên triển khai controller cho các trang
// nếu viết tắt quá trong view bằng các hàm php thì e khi triển khai sang các
// theme mới sẽ không dễ.
// Hơn nữa, controller có nhiệm vụ làm những công việc chung nhau giữa các bộ themes.
