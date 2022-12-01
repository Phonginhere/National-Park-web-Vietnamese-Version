<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang thêm sản phẩm vào mục so sánh
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.product.php';
include_once 'product-compare-session.php';

/*
 Luồng chương trình: user bấm vào nút 'So Sánh Sản Phẩm' trên giao diện html
 --> class.cart.js
 --> compare {add: }
 --> product-compare-add.php ---> cart.php, view-cart.php
 */

// dữ liệu json hất về phía trình duyệt khách.
$json = array();

// Bắt id của sản phẩm mới thêm vào giỏ hàng
// (gửi lên từ ajax post)
if (isset($_POST['product_id']))
{
    $product_id = (int)$_POST['product_id'];
}
else
{
    $product_id = 0;
}

$product_info = productById($product_id);

if ($product_info)
{
    
    if (!$json)
    {
        // Thêm mới sản phẩm vào mục so sánh.
        productCompareAdd($product_id);
        
        // Gửi thông báo thành công sang bên view
        $json['success'] = sprintf("Bạn đã thêm thành công %s vào mục <a href=\"/product-compare.php\">So Sánh Sản Phẩm</a>.", $product_info['name']);
        
        // đoạn text hiển thị số sản phẩm trong giỏ hàng và tổng giá trị của chúng
        $json['total'] = productCompareCountProducts();
        
    }
    else
    {
        $json['redirect'] = '/product-info.php?product_id='.$_POST['product_id'];
    }
}

header("Content-Type: application/json;charset=UTF-8");
echo json_encode($json);