<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang quản lý phản hồi từ khách hàng
 */
// cấu hình hệ thống
include_once '../configs.php';
 
check_login(); // Phải đăng nhập và @todo phải có quyền

/* Gọi các thư viện cần thiết */
include_once '../lib/table/table.contact.php';

/*
 Bắt các tham số phân trang và thứ tự sắp xếp yêu cầu từ phía trình duyệt (url),
 * Ví dụ:
 * 		http://localhost:82/admin/sales/contact.php?sort=username&order=DESC&page=2
 * Mặc định, nếu không bắt được thì:
 * Sắp xếp theo cột sort = name
 * Trật tự sắp xếp order = ASC (tăng dần)
 * Trang hiện thời = 1 (trang đầu tiên trong phân trang)
 */
$sort  = isset($_GET['sort'])  ? $_GET['sort']  : 'email';
$order = isset($_GET['order']) ? $_GET['order'] : "ASC";
$page  = isset($_GET['page'])  ? $_GET['page']  : 1;

$url='';
$url .= isset($_GET['sort'])  ? '&sort='  . $_GET['sort'] : "";
$url .= isset($_GET['order']) ? '&order=' . $_GET['order'] : "";
$url .= isset($_GET['page'])  ? '&page='  . $_GET['page'] : "";


/*
 Truy vấn cơ sở dữ liệu
 */
$contacts = array();
// Tiêu chí truy vấn sql
$filter_data = array(
	'sort'  => $sort,
	'order' => $order,
	'start' => ($page - 1) * settings('config_limit_admin'),
	'limit' => settings('config_limit_admin')
);

// Thực hiện truy vấn
$total_contacts = contactGetTotal();
$results = contactGetAll($filter_data);

// Thêm các thông tin cần thiết khác vào kết quả truy vấn
// Gán các đường link vào các nút edit, delete
// để khi bấm vào thì thao tác/can thiệp đúng item theo id
foreach ($results as $result) 
{
	$contacts[] = array(
		'contact_id'  => $result['contact_id'],
		'name'        => $result['name'],
		'email'       => $result['email'],
		'subject'       => $result['subject'],
		'date_added'  => date('d/m/Y', strtotime($result['date_added'])),
		'edit'        => "/admin/contact-edit.php?contact_id=".$result['contact_id'].$url
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
 Tạo đường link cho các cột kết quả ở phía view. Bấm vào đường link nào thì sắp xếp theo cột đấy.
 Mỗi đường link chứa tham số về trật tự và lọc khi truy vấn,
 vì vậy khi user bấm vào tên cột, kiểu sắp xếp khác sẽ được thực hiện
 Nếu url mà user đang xem là ASC(tăng) thì sẽ bị đổi lại thành DESC (giảm)
 và ngược lại.
 */
$url  = '';
$url .= ($order == 'ASC') ? '&order=DESC' : '&order=ASC';
$url .= isset($_GET['page']) ? '&page=' . $_GET['page'] : "";

$sort_email      = "/admin/contact.php?sort=email".$url;
$sort_subject     = "/admin/contact.php?sort=subject".$url;
$sort_date_added = "/admin/contact.php?sort=date_added".$url;

/*
 Phân Trang
 Trong đường link phân trang phải có tham số:
 - page: trang hiện tại
 có thể có:
 - sort: sắp xếp theo cột nào (mặc định = name)
 - order: trật tự sắp xếp là gì (mặc định = ASC)
 Ví dụ:
 	http://localhost:82/admin/contact?sort=sort_order&order=DESC&page=2
 	http://localhost:82/admin/contact?sort=name&order=ASC&page=2
 	http://localhost:82/admin/contact?
 	&page=2
 */
$url  = '?';
$url .= isset($_GET['sort'])  ? '&sort='  . $_GET['sort']  : "";
$url .= isset($_GET['order']) ? '&order=' . $_GET['order'] : "";
// Không thêm thông tin phân trang vào $url vì việc này 
// được thực hiện bởi đối tượng thuộc lớp Pagination

paginate($total_contacts, $page,settings('config_limit_admin'), "/admin/contact.php".$url);

// Nội dung riêng của trang ...
$web_title = 'Phản Hồi Khách Hàng';
$web_content = "../ui/admin/view/view-contact-list.php";
$active_page_admin = ACTIVE_PAGE_ADMIN_CONTACT;

check_file_layout($web_layout_admin, $web_content);

// ...được đặt vào bố cục chung của toàn website:
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;
