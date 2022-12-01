<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang sao chép thông tin bài viết cũ sang bài viết mới.
 * Ví dụ: khi thêm mới bài viết cho mục Rock mà cần lấy content của bài cũ
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.post.php';

include_once "post-validate.php";

if ( isset($_POST['selected']) && validateCopy())  
{
	// Copy bài viết
	foreach ($_POST['selected'] as $post_id) 
	{
		postCopy($post_id);
	}
	
	// Thông báo sao chép thành công
	$_SESSION['SUCCESS_TEXT'] = 'Đã sao chép bài viết thành công !';
	
	header ("location: /admin/post.php");
	die();
}

// dòng này dễ gây chết chương trình
include_once 'post.php';
