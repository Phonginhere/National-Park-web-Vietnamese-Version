<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang xóa loại sản phẩm
 */
include_once '../configs.php';
include_once '../lib/table/table.category.php';
include_once 'category-validate.php';

if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateDelete())  
{
	// Xóa loại sản phẩm
	foreach ($_POST['selected'] as $category_id) {
		categoryDelete($category_id);
	}
	
	// Thông báo xóa thành công
	$_SESSION['SUCCESS_TEXT'] = "Đã xóa thành công loại sản phẩm";
       	
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

	if($url=='?') $url = '';
	 
	// điều hướng về trang danh mục loại sản phẩm 
	header ("location: /admin/category.php".$url);
	die();
}

// Trong tình huống có lỗi khi xóa, thì hiển thị lỗi.
include_once 'category.php';
