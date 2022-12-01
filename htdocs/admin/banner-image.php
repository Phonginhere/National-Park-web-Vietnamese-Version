<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang quản lý ảnh banner
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.banner_image.php';

check_login();

/*
 Bắt các tham số lọc kết quả tìm kiếm yêu cầu từ phía trình duyệt,
 các tham số này có thể nằm trong url hoặc form gửi lên.
 */
//$filter_name     = isset($_REQUEST['filter_name']) ? $_REQUEST['filter_name'] : null;

/*
 Bắt các tham số phân trang và thứ tự sắp xếp yêu cầu từ phía trình duyệt,
 các tham số này có thể nằm trong url hoặc form gửi lên. 
 Ví dụ:
  		http://localhost:82/admin/catalog/category?sort=sort_order&order=DESC&page=2
  Mặc định, nếu không bắt được thì:
  Sắp xếp theo cột sort = name
  Trật tự sắp xếp order = ASC (tăng dần)
  Trang hiện thời = 1 (trang đầu tiên trong phân trang)
 */
$sort  = isset($_GET['sort'])  ? $_GET['sort']  : "";
$order = isset($_GET['order']) ? $_GET['order'] : "ASC";
$page  = isset($_GET['page'])  ? $_GET['page']  : 1;

$url = '?';

if (isset($_GET['filter_title'])) {
	$url .= '&filter_title=' . urlencode(html_entity_decode($_GET['filter_title'], ENT_QUOTES, 'UTF-8'));
}


$url .= isset($_GET['sort'])  ? '&sort=' . $_GET['sort']   : "";
$url .= isset($_GET['order']) ? '&order=' . $_GET['order'] : "";
$url .= isset($_GET['page'])  ? '&page=' . $_GET['page']   : "";

if($url=='?') $url = '';

/*
 Truy vấn cơ sở dữ liệu
 */
$banner_images = array();

// tiêu chí truy vấn
$filter_data = array(
	'sort'            => $sort,
	'order'           => $order,
	'start'           => ($page - 1) * settings('config_limit_admin'),
	'limit'           => settings('config_limit_admin')		// 20 phần tử trên trang, xem file sys.functions.php
);

$banner_images_total = banner_imageGetTotal();

$results = banner_imageGetAll($filter_data);

foreach ($results as $result) 
{
	if (is_file(DIR_IMAGE . $result['image']))
	{
		// Nếu sản phẩm không có hình đại diện...
		$image = img_resize($result['image'], 40, 40);
	}
	else
	{
		// ...thì dùng hình rỗng đã được đặt sẵn trong thư mục ảnh DIR_IMAGE
		$image = img_resize('no_image.png', 40, 40);
	}
	
	$banner_images[] = array(
		'banner_id'  => $result['banner_id'],
		'title'      => $result['title'],
		'image'      => $image,
		'sort_order' => $result['sort_order'],
		'edit'       => '/admin/banner-image-edit.php?banner_id=' . $result['banner_id']
	);
}

// Các mục được chọn để xóa
// Khi việc xóa gặp trục trặc (ví dụ: ko có quyền, v.v..), thì các
// ô checkbox được giữ nguyên, người dùng không phải tích lại
if ( isset($_POST['selected']))  
{ 
	$selected = (array)$_POST['selected'];
}
else {
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

if (isset($_GET['filter_name'])) {
     $url .= '&filter_name=' . urlencode(html_entity_decode($_GET['filter_name'], ENT_QUOTES, 'UTF-8'));
}

$url .= ($order == 'ASC') ? '&order=DESC' : '&order=ASC'; // the same as above if---else---if
$url .= isset($_GET['page']) ? '&page=' . $_GET['page'] : '';

/*
 Bấm vào đường link nào thì sắp xếp theo cột đấy.
 Ví dụ: sắp xếp theo name, model, price, ...
 */
$sort_banner_id       = '/admin/banner-image.php?sort=banner_id' . $url;
$sort_title       = '/admin/banner-image.php?sort=title' . $url;
$sort_sort_order = '/admin/banner-image.php?sort=sort_order' . $url;

/*
 Khởi tạo đối tượng phân trang (Pagination Object).
 Trong đường link phân trang phải có tham số:
 - page: trang hiện tại
 có thể có:
 - sort: sắp xếp theo cột nào (mặc định = name)
 - order: trật tự sắp xếp là gì (mặc định = ASC)
 Exam:
 */
$url = '?';

if (isset($_GET['filter_name'])) {
     $url .= '&filter_name=' . urlencode(html_entity_decode($_GET['filter_name'], ENT_QUOTES, 'UTF-8'));
}

$url .= isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : "";
$url .= isset($_GET['order']) ? '&order=' . $_GET['order'] : "";
// Không thêm thông tin phân trang vào $url vì việc này 
// được thực hiện bởi đối tượng thuộc lớp Pagination

paginate($banner_images_total, $page,settings('config_limit_admin'), "/admin/banner-image.php".$url);

// Nội dung riêng của trang...
$web_title = "Ảnh Banner";
$web_content = "../ui/admin/view/view-banner-image-list.php";
//$active_page_admin = ACTIVE_PAGE_ADMIN_BANNER_IMAGE; // ACTIVE_PAGE_ADMIN_BANNER_IMAGE

check_file_layout($web_layout_admin, $web_content);

// ...được đặt vào bố cục chung của toàn site:
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;
