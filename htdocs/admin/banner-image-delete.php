<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang xóa ảnh banner
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
	// Thêm mới anh banner
	foreach ($_POST['selected'] as $banner_id) 
	{
		banner_imageDelete($banner_id);
	}
	
	// Thông báo thêm mới thành công
	$_SESSION['SUCCESS_TEXT'] = 'Đã xóa thành công anh banner !';
	
	// Điều hướng tới trang danh mục anh banner
	// có phân trang và sắp xếp
	$url = '?';

     if (isset($_REQUEST['filter_title'])) {
          $url .= '&filter_title=' . urlencode(html_entity_decode($_REQUEST['filter_title'], ENT_QUOTES, 'UTF-8'));
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
     
     if($url=='?') $url = '';
     
    // điều hướng về trang danh mục anh banner
	header ("location: /admin/banner-image.php".$url);
	die();
}

// Hien lai form 
include_once 'banner-image-form.php';