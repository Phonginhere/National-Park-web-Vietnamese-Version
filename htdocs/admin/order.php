<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang quản lý đơn hàng
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.order.php';

/*
 Bắt các tham số lọc kết quả tìm kiếm yêu cầu từ phía trình duyệt,
 các tham số này có thể nằm trong url hoặc form gửi lên.
 */
$filter_order_id     = isset($_GET['filter_order_id']) ? $_GET['filter_order_id'] : null;
$filter_customer     = isset($_GET['filter_customer']) ? $_GET['filter_customer'] : null;
$filter_total        = isset($_GET['filter_total']) ? $_GET['filter_total'] : null;
$filter_date_added   = isset($_GET['filter_date_added']) ? $_GET['filter_date_added'] : null;

/*
 Bắt các tham số phân trang và thứ tự sắp xếp yêu cầu từ phía trình duyệt,
 các tham số này có thể nằm trong url hoặc form gửi lên.
 * Ví dụ:
 * 		http://localhost:82/admin/catalog/category?sort=sort_order&order=DESC&page=2
 * Mặc định, nếu không bắt được thì:
 * Sắp xếp theo cột sort = name
 * Trật tự sắp xếp order = ASC (tăng dần)
 * Trang hiện thời = 1 (trang đầu tiên trong phân trang)
 */
$sort  = isset($_GET['sort'])  ? $_GET['sort']  : "o.order_id"; 
$order = isset($_GET['order']) ? $_GET['order'] : "DESC";
$page  = isset($_GET['page'])  ? $_GET['page']  : 1;

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

if($url=='?') $url = '';		

// Truy vấn cơ sở dữ liệu để phân trang
$orders = array();

$filter_data = array(
			'filter_order_id'      => $filter_order_id,
			'filter_customer'	   => $filter_customer,
			'filter_total'         => $filter_total,
			'filter_date_added'    => $filter_date_added,
			'sort'                 => $sort,
			'order'                => $order,
			'start'                => ($page - 1) * settings('config_limit_admin'),
			'limit'                => settings('config_limit_admin')
);

$order_total = orderGetTotal($filter_data);
$results     = orderGetAll($filter_data);

foreach ($results as $result) 
{
			$orders[] = array(
				'order_id'      => $result['order_id'],
				'fullname'      => $result['fullname'],
				'total'         => number_format($result['total'],0,'.',',').' ₫',
				'date_added'    => date("d/m/Y", strtotime($result['date_added'])),
				'view'          => '/admin/order-info.php?order_id=' . $result['order_id'] . $url,
				'delete'        => '/admin/order-delete.php?order_id=' . $result['order_id'] . $url
			);
}

// Các mục được chọn để xóa
// Khi việc xóa gặp trục trặc (ví dụ: ko có quyền, v.v..), thì các
// ô checkbox được giữ nguyên, người dùng không phải tích lại
if (isset($_POST['selected'])) 
{
	$selected = (array)$_POST['selected'];
} 
else 
{
	$selected = array();
}

/*
 Tạo đường link cho các cột kết quả ở phía view
 Mỗi đường link chứa tham số về trật tự và lọc khi truy vấn,
 vì vậy khi user bấm vào tên cột, kiểu sắp xếp khác sẽ được thực hiện
 Nếu url mà user đang xem là ASC(tăng) thì sẽ bị đổi lại thành DESC (giảm)
 và ngược lại.
 @todo Add session token like OpenCart
 */
		$url = '';

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

		$url .= ($order == 'ASC') ? '&order=DESC' : '&order=ASC';
		$url .= isset($_GET['page']) ? '&page=' . $_GET['page'] : "";

/*
 Bấm vào đường link nào thì sắp xếp theo cột đấy.
 */		
$sort_order         = '/admin/order.php?sort=o.order_id' . $url;
$sort_customer      = '/admin/order.php?sort=customer_id' . $url;
$sort_status        = '/admin/order.php?sort=status' . $url;
$sort_total         = '/admin/order.php?sort=o.total' . $url;
$sort_date_added    = '/admin/order.php?sort=o.date_added' . $url;

		// Phân Trang
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

		$url .= isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : "";
		$url .= isset($_GET['order']) ? '&order=' . $_GET['order'] : "";

paginate($order_total, $page,settings('config_limit_admin'), "/admin/order.php".$url);
		
// Nội dung riêng của trang...
$web_title = 'Đơn hàng';
$web_content = "../ui/admin/view/view-order-list.php";
$active_page_admin = ACTIVE_PAGE_ADMIN_ORDER;

check_file_layout($web_layout_admin, $web_content);

// ...được đặt vào bố cục chung của website.
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;
