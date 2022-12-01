<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang sửa ảnh banner
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.banner_image.php';
include_once 'banner-image-validate.php';

// Nếu user gửi form lên
// toàn bộ dữ liệu thêm mới được lưu trong biến mảng $_POST
if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateForm())  
{
	// Sửa ảnh banner
	banner_imageEdit($_GET['banner_id'],$_POST);
	
	// Thông báo gửi sang trang html
	$_SESSION['SUCCESS_TEXT'] = 'Đã sửa thành công ảnh banner !';
	
	// Điều hướng tới trang danh mục sản phẩm
	// có phân trang và sắp xếp
	$url = '';

     if (isset($_REQUEST['filter_title'])) {
          $url .= '&filter_title=' . urlencode(html_entity_decode($_REQUEST['filter_name'], ENT_QUOTES, 'UTF-8'));
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
     
	header ("location: /admin/banner-image.php".$url);
}

$web_title = $form_title = 'Sửa Ảnh Banner';
include_once 'banner-image-form.php';