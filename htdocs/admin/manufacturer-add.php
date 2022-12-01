<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang thêm mới nhà sản xuất
 */
// Cấu hình hệ thống
include_once '../configs.php';
// Thư viện hàm
include_once '../lib/table/table.manufacturer.php';
include_once 'manufacturer-validate.php';

// Nếu user gửi form lên
// toàn bộ dữ liệu thêm mới được lưu trong biến mảng $_POST
if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateForm())  
{
	// Thêm mới nhà sản xuất
	manufacturerAdd($_POST);
	
	// Thông báo thêm mới thành công
	$_SESSION['SUCCESS_TEXT'] = 'Đã thêm mới thành công nhà sản xuất !';
	
	// Điều hướng tới trang danh mục sản phẩm
	// có phân trang và sắp xếp
	$url = '';

     if (isset($_REQUEST['filter_name'])) {
          $url .= '&filter_name=' . urlencode(html_entity_decode($_REQUEST['filter_name'], ENT_QUOTES, 'UTF-8'));
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
     
	header ("location: /admin/manufacturer.php".$url);
}

$form_title = 'Thêm mới Nhà Sản Xuất';

include_once 'manufacturer-form.php';