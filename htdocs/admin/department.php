<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang quản lý loại sản phẩm
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.department.php';

check_login();

/*
 Hiển thị danh mục loại sản phẩm.
 File getList.php được gọi (chia sẻ chung) bởi nhiều trang khác,
 ví dụ: /admin/catalog/department.php
 		/admin/catalog/department/add.php
 @todo error with url: localhost:82/admin/dashboard
 @todo config url_main_part: /en/admin/catalog/department to avoid redendancy
 @todo put view-abc.php files in Templates folder
 so that we can switch between themes easily
 */
/*
 Bắt các tham số phân trang và thứ tự sắp xếp yêu cầu từ phía trình duyệt,
 các tham số này có thể nằm trong url hoặc form gửi lên.
 * Ví dụ:
 * 		http://localhost:82/admin/catalog/department?sort=sort_order&order=DESC&page=2
 * Mặc định, nếu không bắt được thì:
 * Sắp xếp theo cột sort = name
 * Trật tự sắp xếp order = ASC (tăng dần)
 * Trang hiện thời = 1 (trang đầu tiên trong phân trang)
 */
$sort  = isset($_GET['sort'])  ? $_GET['sort']  : "name"; 
$order = isset($_GET['order']) ? $_GET['order'] : "ASC";
$page  = isset($_GET['page'])  ? $_GET['page']  : 1;

$url = '';

$url .= isset($_GET['sort'])  ? '&sort=' . $_GET['sort']   : "";
$url .= isset($_GET['order']) ? '&order=' . $_GET['order'] : "";
$url .= isset($_GET['page'])  ? '&page=' . $_GET['page']   : "";

/*
 Truy vấn cơ sở dữ liệu để phân trang
 */
$departments = array();

// Tiêu chí truy vấn sql
$filter_data = array(
	'sort'  => $sort,
	'order' => $order,
	'start' => ($page - 1) * settings('config_limit_admin'),
	'limit' => settings('config_limit_admin')		// 20 phần tử trên trang, xem file sys.functions.php
);

// Thực hiện truy vấn
$department_total = departmentGetTotal();
$results          = departmentGetAll($filter_data);

// Thêm các thông tin cần thiết khác vào kết quả truy vấn
// Gán các đường link vào các nút edit, delete
// để khi bấm vào thì thao tác/can thiệp đúng item theo id
foreach ($results as $result) 
{
	$departments[] = array(
		'department_id' => $result['department_id'],
		'name'        => $result['name'],
		'sort_order'  => $result['sort_order'],
		'edit'        => "/admin/department-edit.php?department_id=" . $result['department_id'] . $url,
		'delete'      => "/admin/department-delete.php?department_id=" . $result['department_id'] . $url
	);
}

// Các mục được chọn để xóa
// Khi việc xóa gặp trục trặc (ví dụ: ko có quyền, v.v..), thì các
// ô checkbox được giữ nguyên, người dùng không phải tích lại
if (isset($_POST['selected'])) {
	$selected = (array)$_POST['selected'];
} else {
	$selected = array();
}

/*
 Tạo đường link cho các cột kết quả ở phía view
 Mỗi đường link chứa tham số về trật tự và lọc khi truy vấn,
 vì vậy khi user bấm vào tên cột, kiểu sắp xếp khác sẽ được thực hiện
 Nếu url mà user đang xem là ASC(tăng) thì sẽ bị đổi lại thành DESC (giảm)
 và ngược lại.
 */
$url = '';
$url .= ($order == 'ASC') ? '&order=DESC' : '&order=ASC';
$url .= isset($_GET['page']) ? '&page=' . $_GET['page'] : "";

// Sắp xếp theo cột khóa chính
$sort_department_id = "/admin/department.php?sort=department_id".$url;
// Sắp xếp theo cột name
$sort_name = "/admin/department.php?sort=name".$url;
// Sắp xếp theo cột sort_order
$sort_sort_order = "/admin/department.php?sort=sort_order".$url;

/*
 Phân Trang
 Trong đường link phân trang phải có tham số:
 - page: trang hiện tại
 có thể có:
 - sort: sắp xếp theo cột nào (mặc định = name)
 - order: trật tự sắp xếp là gì (mặc định = ASC)
 Exam:
 	http://localhost:82/admin/catalog/department?sort=sort_order&order=DESC&page=2
 	http://localhost:82/admin/catalog/department?sort=name&order=ASC&page=2
 	http://localhost:82/admin/catalog/department?&page=2
 */
$url = '?';
$url .= isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : "";
$url .= isset($_GET['order']) ? '&order=' . $_GET['order'] : "";

paginate($department_total, $page,$settings['config_limit_admin'], "/admin/department.php".$url);

// Nội dung riêng của trang:
$web_title = "Phòng Ban";
$web_content = "../ui/admin/view/view-department-list.php";
$active_page_admin = ACTIVE_PAGE_ADMIN_DEPARTMENT;

check_file_layout($web_layout_admin, $web_content);

// được đặt vào bố cục chung của toàn site:
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;
