<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang thêm mới loại bài viết (hình như phải gọi cái này là trang chỉnh sửa bài viết chứ)
 */
// Cấu hình hệ thống:
include_once '../configs.php';
// Thư viện hàm:
include_once '../lib/table/table.post_category.php';

check_login();

include_once "post_category-validate.php";

// Nếu user gửi dữ liệu hợp lệ thì mới tiến hành thêm mới bản ghi.
// Toàn bộ dữ liệu thêm mới được lưu trong biến mảng $_POST
if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateForm())  
{ 

	// Sửa loại sản phẩm
	post_categoryEdit($_GET['category_id'], $_POST);
	
	// Thông báo sửa mới thành công
	$_SESSION['SUCCESS_TEXT'] = "Đã hoàn tất việc sửa loại bài viết";
	
	// Điều hướng tới trang danh mục 
	header ("location: /admin/post_category.php");
} 

// Thông tin riêng của trang
$web_title = "Phân Loại Bài Viết";
$form_title = "Sửa Loại Bài Viết";

include_once 'post_category-form.php'; 