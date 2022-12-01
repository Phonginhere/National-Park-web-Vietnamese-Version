<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Các hàm quản lý đơn hàng
 */

function orderAdd($data) 
{
	// Xử lý dữ liệu thô trước khi chèn vào db:
	// đổi kiểu dữ liệu string ->int, float
	// xử lý kí tự đặc biệt, kí tự thoát.
	$customer_id  = (int)$data['customer_id'];
	$email        = db_escape($data['email']);
	$telephone    = db_escape($data['telephone']);
	$fullname     = db_escape($data['fullname']); 
	$address      = db_escape($data['address']); 
	$comment      = db_escape($data['comment']);
	$total        = (float)$data['total'];
		
	$sql = " 
		 INSERT INTO `order` 
		 SET  
		 	 customer_id = '{$customer_id}', 
		 	 email = '{$email}', 
		 	 telephone = '{$telephone}', 
		 	 fullname = '{$fullname}', 
		 	 address = '{$address}', 
		 	 comment = '{$comment}',
		 	 total = '{$total}', 
		 	 date_added = NOW() 
	";
		
	db_q($sql);
		
	$order_id = db_lastId();

	// Thêm các sản phẩm của đơn hàng mới vào bảng chi tiết đơn hàng
	if (isset($data['products'])) 
	{
			foreach ($data['products'] as $product) 
			{
				$oid        = (int)$order_id;
				$product_id = (int)$product['product_id']; 
				$name       = db_escape($product['name']); 
				$model      = db_escape($product['model']); 
				$quantity   = (int)$product['quantity']; 
				$price      = (float)$product['price']; 
				$total      = (float)$product['total']; 
				 	 
				$sql2= " 
					INSERT INTO `order_details` 
				 	SET `order_id` = '{$oid}', 
				 		`product_id` = '{$product_id}', 
				 	 	`name` = '{$name}', 
				 	 	`model` = '{$model}', 
				 	 	`quantity` = '{$quantity}', 
				 	 	`price` = '{$price}', 
				 	 	`total` = '{$total}' 
				";
				db_q($sql2);
	
			}
	}
		
	// Totals
	if (isset($data['totals'])) 
	{
			foreach ($data['totals'] as $total) 
			{
				$code       = db_escape($total['code']);
				$title      = db_escape($total['title']);
				$value      = (float)$total['value'];
				$sort_order = (int)$total['sort_order'];
				
				$sql = " 
					INSERT INTO `order_total` 
					SET `order_id` = '{$order_id}', 
						`code` = '{$code}', 
						`title` = '{$title}', 
						`value` = '{$value}', 
						`sort_order` = '{$sort_order}'
				";
				db_query($sql);
			}
	}
		
	return $order_id;
}// end function


/**
 * @param string $order_id
 */
function orderDelete($order_id) 
{
	// Xóa các bảng liên quan ...
	db_q("DELETE FROM `order_details` WHERE order_id = '" . (int)$order_id . "'");
    
	// ...trước khi xóa đơn hàng.
	db_q("DELETE FROM `order` WHERE order_id = '" . (int)$order_id . "'");
}



/*
 Tính tổng số lượng đơn hàng hiện có
 */
function orderGetTotal($data = array()) 
{
		$sql = "SELECT COUNT(*) AS total FROM `order` WHERE 1=1";

		if (!empty($data['filter_order_id'])) {
			$sql .= " AND order_id = '" . (int)$data['filter_order_id'] . "'";
		}

		if (!empty($data['filter_customer'])) {
			$sql .= " AND fullname LIKE '%" . db_escape($data['filter_customer']) . "%'";
		}
		
		if (!empty($data['filter_customer_id'])) {
			$sql .= " AND o.customer_id = '" . (int)($data['filter_customer_id']) . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(date_added) = DATE('" . db_escape($data['filter_date_added']) . "')";
		}

		if (!empty($data['filter_total'])) {
			$sql .= " AND total = '" . (float)$data['filter_total'] . "'";
		}
		
		//echo $sql; die();
		
		return db_one($sql);
}// end function

/*
 Lấy ra các đơn hàng
 @return indexed array
 */
function orderGetAll($data = array()) 
{
	$sql = " 
		SELECT 
			o.order_id, 
			o.fullname, 
			o.total, 
			o.date_added 
		FROM `order` AS o
		WHERE 1=1
	";

	

		if (!empty($data['filter_order_id'])) {
			$sql .= " AND o.order_id = '" . (int)$data['filter_order_id'] . "'";
		}

		if (!empty($data['filter_customer'])) {
			$sql .= " AND o.fullname LIKE '%" . db_escape($data['filter_customer']) . "%'";
		}
		
		if (!empty($data['filter_customer_id'])) {
			$sql .= " AND o.customer_id = '" . (int)($data['filter_customer_id']) . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(o.date_added) = DATE('" . db_escape($data['filter_date_added']) . "')";
		}

		if (!empty($data['filter_total'])) {
			$sql .= " AND o.total = '" . (float)$data['filter_total'] . "'";
		}

		$sort_data = array(
			'o.order_id',
			'customer',
			'status',
			'o.date_added',
			'o.total'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY o.order_id";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		
		//echo $sql; die();

		return db_query($sql);
}// end function

// Lấy ra dữ liệu thô chi tiết đơn hàng 
function orderDetails($order_id)
{
	$sql = "
		SELECT *,
			(SELECT c.fullname FROM `customer` c WHERE c.customer_id = o.customer_id) AS customer
		FROM `order` o WHERE o.order_id = '" . (int)$order_id . "'
	";
	$order_query = db_row($sql);
	
	if (is_array($order_query) && !empty($order_query))
	{
		return array(
				'order_id'    => $order_query['order_id'],
				'customer_id' => $order_query['customer_id'],
				'customer'    => $order_query['customer'],
				'fullname'    => $order_query['fullname'],
				'email'       => $order_query['email'],
				'telephone'   => $order_query['telephone'],
				'fullname'    => $order_query['fullname'],
				'address'     => $order_query['address'],
				'comment'     => $order_query['comment'],
				'total'       => $order_query['total'],
				'user_agent'  => $order_query['user_agent'],
				'date_added'  => $order_query['date_added']
		);
	}
	
	
	return false;
}

function orderGetById($order_id) 
{
	return orderDetails($order_id);
} // end function

// Tinh chỉnh (định dạng) dữ liệu thô của chi tiết đơn hàng 
// để gửi sang giao diện html
function orderDetailsWithFormat($order_id)
{
	$order = orderDetails($order_id);
	
	if (is_array($order)) 
	{
		$order['date_added'] = date("d/m/Y", strtotime($order['date_added']));
		$order['address']    = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim($order['address'])));
		$order['total']      = number_format($order['total'],0,'.',',').' ₫';
		$order['comment']    = nl2br($order['comment']);
		$order['products']   = array();
		
		// danh sách sản phẩm của đơn hàng này:
		foreach (orderGetProducts($order_id) as $product)
		{
		
			$order['products'][] = array(
					'name'     => $product['name'],
					'model'    => $product['model'],
					'quantity' => $product['quantity'],
					'price'    => $product_price = number_format($product['price'],0,'.',',').' ₫',
					'total'    => $product_price = number_format($product['total'],0,'.',',').' ₫'
			);
		}
	}
	
	return $order;
}

function orderGetProducts($order_id) 
{
	$sql = "SELECT * FROM `order_details` WHERE order_id = '" . (int)$order_id . "'";
	
	return db_q($sql);
}

/**
 * @description Tính tổng doanh số các đơn hàng (tổng của các tổng giá trị từng đơn hàng)
 */
function orderGetTotalSales()
{
	$sql = "SELECT SUM(total) FROM `order`;";
	return (int)db_one($sql);
}

function orderGetTotalSalesWithFormat()
{
	
	$totalSales = (int)orderGetTotalSales();
	
	if (1000 <= $totalSales && $totalSales < 1000000)
		return (int)($totalSales / 1000000).' nghìn'; //' triệu ₫';
		
	// from one million to one billion
	if (1000000 <= $totalSales && $totalSales < 1000000000)
		return (int)($totalSales / 1000000).' triệu'; //' triệu ₫';
		
	if (1000000000 <= $totalSales && $totalSales < 1000000000000)
		return (int)($totalSales / 1000000).' tỷ'; //' triệu ₫';
}

function orderGetLatestForDashboard()
{
	$orders = array();

	$filter_data = array(
				'sort'                 => "o.date_added",
				'order'                => "DESC",
				'start'                => 0,
				'limit'                => 5
	);

	$results     = orderGetAll($filter_data);

	foreach ($results as $result) 
	{
				$orders[] = array(
					'order_id'      => $result['order_id'],
					'customer'      => $result['customer'],
					'status'        => $result['status'],
					'total'         => number_format($result['total'],0,'.',',').' ₫',
					'date_added'    => date("d/m/Y", strtotime($result['date_added'])),
					'view'          => '/admin/order-info.php?order_id=' . $result['order_id']
				);
	}
	
	if (empty($orders))
		return false;
		
	return $orders;
}