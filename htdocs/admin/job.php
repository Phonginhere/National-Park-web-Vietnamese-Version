<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang quản lý nghề nghiệp
 */
// cấu hình hệ thống
include_once '../configs.php';
 
check_login(); // Phải đăng nhập và @todo phải có quyền

/* Gọi các thư viện cần thiết */
include_once '../lib/table/table.job.php';

/*
 Bắt các tham số phân trang và thứ tự sắp xếp yêu cầu từ phía trình duyệt (url),
 * Ví dụ:
 * 		http://localhost:82/admin/sales/job.php?sort=username&order=DESC&page=2
 * Mặc định, nếu không bắt được thì:
 * Sắp xếp theo cột sort = title
 * Trật tự sắp xếp order = ASC (tăng dần)
 * Trang hiện thời = 1 (trang đầu tiên trong phân trang)
 */
$sort  = isset($_GET['sort'])  ? $_GET['sort']  : 'title';
$order = isset($_GET['order']) ? $_GET['order'] : "ASC";
$page  = isset($_GET['page'])  ? $_GET['page']  : 1;

$url='';
$url .= isset($_GET['sort'])  ? '&sort='  . $_GET['sort'] : "";
$url .= isset($_GET['order']) ? '&order=' . $_GET['order'] : "";
$url .= isset($_GET['page'])  ? '&page='  . $_GET['page'] : "";


/*
 Truy vấn cơ sở dữ liệu
 */
$jobs = array();
// Tiêu chí truy vấn sql
$filter_data = array(
	'sort'  => $sort,
	'order' => $order,
	'start' => ($page - 1) * settings('config_limit_admin'),
	'limit' => settings('config_limit_admin')
);

// Thực hiện truy vấn
$total_jobs = jobGetTotal();
$results = jobGetAll($filter_data);

// Thêm các thông tin cần thiết khác vào kết quả truy vấn
// Gán các đường link vào các nút edit, delete
// để khi bấm vào thì thao tác/can thiệp đúng item theo id
foreach ($results as $result) 
{
	$jobs[] = array(
		'job_id'     => $result['job_id'],
		'title'      => $result['title'],
		'code'       => $result['code'],
		'date_added' => date('d/m/Y', strtotime($result['date_added'])),
		'edit'       => "/admin/job-edit.php?job_id=".$result['job_id'].$url
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

$sort_title      = "/admin/job.php?sort=title".$url;
$sort_code     = "/admin/job.php?sort=code".$url;
$sort_date_added = "/admin/job.php?sort=date_added".$url;

/*
 Phân Trang
 Trong đường link phân trang phải có tham số:
 - page: trang hiện tại
 có thể có:
 - sort: sắp xếp theo cột nào (mặc định = name)
 - order: trật tự sắp xếp là gì (mặc định = ASC)
 Ví dụ:
 	http://localhost:82/admin/job?sort=sort_order&order=DESC&page=2
 	http://localhost:82/admin/job?sort=name&order=ASC&page=2
 	http://localhost:82/admin/job?
 	&page=2
 */
$url  = '?';
$url .= isset($_GET['sort'])  ? '&sort='  . $_GET['sort']  : "";
$url .= isset($_GET['order']) ? '&order=' . $_GET['order'] : "";
// Không thêm thông tin phân trang vào $url vì việc này 
// được thực hiện bởi đối tượng thuộc lớp Pagination

paginate($total_jobs, $page,settings('config_limit_admin'), "/admin/job.php".$url);

// Nội dung riêng của trang ...
$web_title = 'Nghề Nghiệp';
$web_content = "../ui/admin/view/view-job-list.php";
$active_page_admin = ACTIVE_PAGE_ADMIN_JOB;

check_file_layout($web_layout_admin, $web_content);

// ...được đặt vào bố cục chung của toàn website:
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;
