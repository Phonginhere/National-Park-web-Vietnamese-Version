<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang thông tin đơn hàng
 */
// Cấu hình hệ thống
include_once '../configs.php';
// Thư viện hàm
include_once '../lib/table/table.order.php';

check_login();

$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : 0;
	
$order_info = orderGetById($order_id);
	
/*
 Điều hướng ruột bánh mỳ (Breadcrumbs Navigation)
 Gán các đường dẫn bán tuyệt đối vào điều hướng.
 */
			$url = '?';

			if (isset($_GET['filter_order_id'])) {
				$url .= '&filter_order_id=' . $_GET['filter_order_id'];
			}

			if (isset($_GET['filter_customer'])) {
				$url .= '&filter_customer=' . urlencode(html_entity_decode($_GET['filter_customer'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($_GET['filter_total'])) {
				$url .= '&filter_total=' . $_GET['filter_total'];
			}

			if (isset($_GET['filter_date_added'])) {
				$url .= '&filter_date_added=' . $_GET['filter_date_added'];
			}

			if (isset($_GET['sort'])) {
				$url .= '&sort=' . $_GET['sort'];
			}

			if (isset($_GET['order'])) {
				$url .= '&order=' . $_GET['order'];
			}

			if (isset($_GET['page'])) {
				$url .= '&page=' . $_GET['page'];
			}
			
/*
 Các đường dẫn gửi sang bên view được cấu hình
 một chỗ ở đây nhằm tránh bị trùng lặp bên view
 */			
$url_invoice  = '/admin/order-invoice.php?order_id=' . (int)$_GET['order_id'];
$url_cancel   = '/admin/order.php' . $url;

// Các sản phẩm của đơn hàng
$products = array();

foreach (orderGetProducts($_GET['order_id']) as $product) 
{
	// Tinh chỉnh dữ liệu trước khi gửi sang view
	$products[] = array(
		'product_id'       => $product['product_id'],
		'name'    	 	   => $product['name'],
		'model'    		   => $product['model'],
		'quantity'		   => $product['quantity'],
		'price'    		   => number_format($product['price'],0,'.',',').' ₫', 
		'total'    		   => number_format($product['total'],0,'.',',').' ₫',
		'href'     		   => '/admin/product-edit.php?product_id=' . $product['product_id']
	);
}// end foreach
		
$web_title = 'Đơn hàng';

// Nội dung riêng của trang:
$web_content = "../ui/admin/view/view-order-info.php";

check_file_layout($web_layout_admin, $web_content);

// được đặt vào bố cục chung của toàn site:
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;
