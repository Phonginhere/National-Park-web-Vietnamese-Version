<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang xóa sản phẩm
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.product.php';
include_once 'product-validate.php';

// Nếu xóa nhiều sản phẩm cùng lúc:
// (các id sản phẩm được lưu trong biến mảng $_POST
//if ( isset($_POST['selected']) && validateDelete())  
if ( isset($_POST['selected']) )  
{
	// Xóa bài viết
	foreach ($_POST['selected'] as $post_id) 
	{
		postDelete($post_id);
	}
	
	$_SESSION['SUCCESS_TEXT'] = "Đã xóa bài viết thành công !";
	
	// Nếu như trong quá trình xóa mà có lỗi thì chỉ hiện lỗi
	// còn những sản phẩm xóa thành công thì bỏ đi thông báo thành công.
	if($_SESSION['ERROR_TEXT'] != null) 
	{
		$_SESSION['SUCCESS_TEXT'] = null;
	}
}		

// Nếu xóa một sản phẩm:
// if (isset($_GET['post_id'])) 
// {
// 	postDelete($_GET['post_id']);
// 	$_SESSION['SUCCESS_TEXT'] = "Đã xóa bài viết thành công !";
// }
	

// điều hướng về trang danh sách bài viết
header ("location: /admin/post.php");
die();
