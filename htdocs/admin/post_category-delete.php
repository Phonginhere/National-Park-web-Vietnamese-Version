<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang xóa loại sản phẩm
 */
include_once '../configs.php';
include_once '../lib/table/table.post_category.php';
include_once 'category-validate.php';

//if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateDelete())  
if ( $_SERVER['REQUEST_METHOD'] == "POST")  
{
	// Xóa loại sản phẩm
	foreach ($_POST['selected'] as $category_id) 
	{
		post_categoryDelete($category_id);
	}
	
	// Thông báo xóa thành công
	$_SESSION['SUCCESS_TEXT'] = "Đã xóa thành công loại bài viết.";
       	
	// điều hướng về trang danh mục loại sản phẩm 
	header ("location: /admin/post_category.php".$url);
	die();
}

// Trong tình huống có lỗi khi xóa, thì hiển thị lỗi.
include_once 'category.php';
