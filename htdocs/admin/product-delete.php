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
if ( isset($_POST['selected']) && validateDelete())  
{
	// Xóa sản phẩm
	foreach ($_POST['selected'] as $product_id) 
	{
		productDelete($product_id);
	}
	
	$_SESSION['SUCCESS_TEXT'] = "Đã xóa sản phẩm thành công !";
	
	// Nếu như trong quá trình xóa mà có lỗi thì chỉ hiện lỗi
	// còn những sản phẩm xóa thành công thì bỏ đi thông báo thành công.
	if($_SESSION['ERROR_TEXT'] != null) 
	{
		$_SESSION['SUCCESS_TEXT'] = null;
	}
}		

// Nếu xóa một sản phẩm:
if (isset($_GET['product_id'])) 
{
	productDelete($_GET['product_id']);
	$_SESSION['SUCCESS_TEXT'] = "Đã xóa sản phẩm thành công !";
}
	
// Điều hướng tới trang danh mục sản phẩm
// có phân trang và sắp xếp
$url = '?';

if (isset($_REQUEST['filter_name'])) 
{
	$url .= '&filter_name=' . urlencode(html_entity_decode($_REQUEST['filter_name'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_REQUEST['filter_model'])) 
{
	$url .= '&filter_model=' . urlencode(html_entity_decode($_REQUEST['filter_model'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_REQUEST['filter_price'])) 
{
    $url .= '&filter_price=' . $_REQUEST['filter_price'];
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
     
if($url=='?') $url = '';     

// điều hướng về trang danh mục sản phẩm
header ("location: /admin/product.php".$url);
die();
