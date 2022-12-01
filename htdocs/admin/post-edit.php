<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang sửa bài viết
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.post.php';

include_once 'post-validate.php';

// Nếu user gửi form lên
// toàn bộ dữ liệu thêm mới được lưu trong biến mảng $_POST
if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateForm())  
{ 
	// Sửa bài viết
	postEdit($_REQUEST['post_id'], $_POST);
	
	// Thông báo sửa thành công
	$_SESSION['SUCCESS_TEXT'] = "Đã sửa thành công bài viết";
	
	// Điều hướng tới trang danh mục bài viết
	// có phân trang, sắp xếp và tìm kiếm
	$url = '?';

     if (isset($_REQUEST['filter_title'])) 
     {
          $url .= '&filter_name=' . urlencode(html_entity_decode($_REQUEST['filter_name'], ENT_QUOTES, 'UTF-8'));
     }

     if (isset($_REQUEST['filter_status'])) 
     {
          $url .= '&filter_status=' . $_REQUEST['filter_status'];
     }

     if (isset($_REQUEST['sort'])) 
     {
          $url .= '&sort=' . $_REQUEST['sort'];
     }

     if (isset($_REQUEST['order'])) 
     {
          $url .= '&order=' . $_REQUEST['order'];
     }

     if (isset($_REQUEST['page'])) 
     {
          $url .= '&page=' . $_REQUEST['page'];
     }
     
	header ("location: /admin/post.php".$url);
}

// Thông tin riêng của trang
$web_title = 'Bài Viết';
$form_title = 'Sửa Bài Viết';

include_once 'post-form.php';