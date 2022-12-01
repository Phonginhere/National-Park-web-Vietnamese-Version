<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang thêm mới sản phẩm
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.product.php';

include_once 'product-validate.php';

// Nếu user gửi form lên
// toàn bộ dữ liệu thêm mới được lưu trong biến mảng $_POST
if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateForm())  
{
	// Thêm mới sản phẩm
	productAdd($_POST);
	
	// Thông báo thêm mới thành công
	$_SESSION['SUCCESS_TEXT'] = 'Đã thêm mới sản phẩm thành công !';
	
	// Điều hướng tới trang danh mục sản phẩm
	// có phân trang và sắp xếp
	$url = '?';

     if (isset($_REQUEST['filter_name'])) {
          $url .= '&filter_name=' . urlencode(html_entity_decode($_REQUEST['filter_name'], ENT_QUOTES, 'UTF-8'));
     }

     if (isset($_REQUEST['filter_model'])) {
          $url .= '&filter_model=' . urlencode(html_entity_decode($_REQUEST['filter_model'], ENT_QUOTES, 'UTF-8'));
     }

     if (isset($_REQUEST['filter_price'])) {
          $url .= '&filter_price=' . $_REQUEST['filter_price'];
     }

     if (isset($_REQUEST['filter_status'])) {
          $url .= '&filter_status=' . $_REQUEST['filter_status'];
     }

     if (isset($_REQUEST['sort'])) {
          $url .= '&sort=' . $_REQUEST['sort'];
     }

     if (isset($_REQUEST['order'])) {
          $url .= '&order=' . $_REQUEST['order'];
     }

     if (isset($_REQUEST['page'])) {
          $url .= '&page=' . $_REQUEST['page'];
     }
     
	header ("location: /admin/product.php".$url);
}

$web_title = 'Sản Phẩm';
$form_title = 'Thêm Mới Sản Phẩm';

include_once 'product-form.php';