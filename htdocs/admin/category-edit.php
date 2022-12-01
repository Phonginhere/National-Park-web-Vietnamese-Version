<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang sửa loại sản phẩm
 */
include_once '../configs.php';
include_once '../lib/table/table.category.php';
include_once 'category-validate.php';

check_login();

// Nếu user gửi form lên và dữ liệu trên form là hợp lệ thì mới tiến hành sửa bản ghi trong db.
// toàn bộ dữ liệu chỉnh sửa được lưu trong biến mảng $_POST
if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateForm())  
{ 
	
	// Sửa loại sản phẩm
	categoryEdit($_GET['category_id'], $_POST);
	
	// Thông báo sửa mới thành công
	$_SESSION['SUCCESS_TEXT'] = "Đã sửa thành công loại bài viết";
	
	// Điều hướng tới trang danh mục loại sản phẩm
	// có phân trang và sắp xếp
	$url = '?';
	if ( isset($_REQUEST['sort']) ) 
	{
		$url .= '&sort=' . $_REQUEST['sort'];
	}
	if ( isset($_REQUEST['order']) ) 
	{
		$url .= '&order=' . $_REQUEST['order'];
	}
	if ( isset($_REQUEST['page']) ) 
	{
		$url .= '&page=' . $_REQUEST['page'];
	}

	// Điều hướng sang danh mục loại bài viết
	header ("location: /admin/category.php".$url);
}

$web_title = "Loại Bài Viết";
$form_title = "Sửa Loại Bài Viết";

// Hiển thị form
include_once "category-form.php";