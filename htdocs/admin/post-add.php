<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang thêm mới bài viết
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.post.php';

include_once 'post-validate.php';

// Nếu user gửi form lên, toàn bộ dữ liệu form được lưu trong biến mảng $_POST
if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateForm())  
{
	// Thêm mới bài viết
	postAdd($_POST);
	
	// Thông báo thêm mới thành công
	$_SESSION['SUCCESS_TEXT'] = 'Đã hoàn tất việc thêm mới bài viết!';
	
	
    // Lấy lại các tham số liên quan đến phân trang, sắp xếp, tìm kiếm, lọc
    // mà phía giao diện chỉ định trước khi submit form
	$url = '?';

     if (isset($_REQUEST['filter_title'])) 
     {
          $url .= '&filter_title=' . urlencode(html_entity_decode($_REQUEST['filter_title'], ENT_QUOTES, 'UTF-8'));
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
     
     // Điều hướng tới trang danh mục có phân trang, sắp xếp, tìm kiếm, lọc
	header ("location: /admin/post.php".$url);
}

$web_title  = 'Thêm Mới Bài Viết';
$form_title = 'Thêm Mới Bài Viết';

include_once 'post-form.php';