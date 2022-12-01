<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang quản lý loại bài viết
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.post_category.php';

check_login();

// Bắt các tham số lọc kết quả tìm kiếm yêu cầu từ phía trình duyệt,
// các tham số này có thể nằm trong url hoặc form gửi lên.
// $_REQUEST có thể bắt các tham số theo cả 2 phương thức GET và POST.
$filter_name     = isset($_GET['filter_name'])     ? $_GET['filter_name']  : null;   // Tìm theo tựa đề
$filter_status   = isset($_GET['filter_status'])   ? $_GET['filter_status'] : null;   // Tìm theo trạng thái (duyệt/không duyệt)
$filter_top      = isset($_GET['filter_top'])      ? $_GET['filter_top']    : null;   // Tìm những bản ghi Top (hiện lên menu top trang chủ)
$filter_featured = isset($_GET['filter_featured']) ? $_GET['filter_featured'] : null; // Tìm theo tính nổi bật 

// Mặc địn thì sắp xếp theo tên(name) tăng dần (ASC)
// Nhưng nếu phía máy khách chỉ định giá trị khác thì cập nhật.
$sort  = isset($_GET['sort'])  ? $_GET['sort']  : "name";
$order = isset($_GET['order']) ? $_GET['order'] : "ASC";

// Giới hạn phân trang mặc định:
$limit = ( settings('config_limit_admin') !== null ) ? settings('config_limit_admin') : 5;
// Giới hạn phân trang yêu cầu bởi phía máy khách:
$limit = isset($_GET['limit']) ? $_GET['limit']  : $limit;
// Số thứ tự của trang yêu cầu bởi máy khách:
$page  = isset($_GET['page'])  ? $_GET['page']  : 1;	// không nói gì thì hiện trang đầu tiên.

$url = '';  // Duy trì trạng thái ứng dụng (filter, sort, pagination) trên các đường link edit, delete, repair, copy

// Duy trì tiêu chí tìm kiếm/lọc trên URL
if (isset($_GET['filter_title']))
{
	// Giải mã thực thể html,
	// tiếp tục mã hóa lại lần nữa theo lược đồ mã hóa
	// giành cho địa chỉ web url, tránh vi phạm từ khóa của một url
	$url .= '&filter_title=' . urlencode(html_entity_decode($_GET['filter_title'], ENT_QUOTES, 'UTF-8'));
}


if (isset($_GET['filter_status']))
{
	$url .= '&filter_status=' . $_GET['filter_status'];
}


if (isset($_GET['filter_featured']))
{
	$url .= '&filter_featured=' . $_GET['filter_featured'];
}


if (isset($_GET['filter_top']))
{
	$url .= '&filter_top=' . $_GET['filter_top'];
}

$url .= "&sort={$sort}";
$url .= "&order={$order}";
$url .= "&limit={$limit}";
$url .= "&page={$page}";

/*
 Truy vấn cơ sở dữ liệu để phân trang
 */
$post_categories = array();

// Tiêu chí truy vấn sql
$filter_data = array(
		// tìm kiếm:
		'filter_name'	  => $filter_name,
		'filter_status'   => $filter_status,
		'filter_top'      => $filter_top,
		'filter_featured' => $filter_featured,
		// sắp xếp:
		'sort'            => $sort,
		'order'           => $order,
		// phân trang:
		'start'           => ($page - 1) * $limit,
		'limit'           => $limit
);

// Thực hiện truy vấn
$post_category_total = post_categoryGetTotal($filter_data);
$results = post_categoryGetAll($filter_data);

// Thêm các thông tin cần thiết khác vào kết quả truy vấn
// Gán các đường link vào các nút edit, delete
// để khi bấm vào thì thao tác/can thiệp đúng item theo id
foreach ($results as $result) 
{
	// Kích thước ảnh hiển thị trên danh sách quản trị. (nếu cấu hình hệ thống không có thì lấy một giá trị cụ thể)
	$img_w = ( settings('admin_list_image_width') !== null ) ? settings('admin_list_image_width') : 40;
	$img_h = ( settings('admin_list_image_height') !== null ) ? settings('admin_list_image_height') : 40;
	
	// Nếu ảnh đại diện sản phẩm tồn tại trên máy chủ web
	if (is_file(DIR_IMAGE . $result['image']))
	{
		$image = img_resize($result['image'], $img_w, $img_h);
	}
	else
	{
		// ngược lại không có thì dùng hình rỗng đã được đặt sẵn trong thư mục ảnh DIR_IMAGE
		$image = img_resize('no_image.png', $img_w, $img_h);
	}
	
	$post_categories[] = array(
		// Thông tin từ dữ liệu gốc (có định dạng):
		'category_id' => $result['category_id'],
		'image'      => $image,
		'name'        => $result['name'],
		'status_text'   => ($result['status']) ? "Cho Phép" : '<span class="badge badge-danger">Không cho phép</span>',
		'featured_text'   => $result['featured'] ? '<span class="badge badge-success">Nổi Bật</span>' : "Không nổi bật",
		'top_text' => $result['top'] ? '<span class="badge badge-info">Top</span>': "Không phải top",
		'sort_order' => $result['sort_order'],
		'date_added_text' => date('d/m/Y', strtotime($result['date_added'])),
		// Thông tin phái sinh thêm:
		'edit'        => "/admin/post_category-edit.php?category_id=" . $result['category_id'] . $url,
		'delete'      => "/admin/post_category-delete.php?category_id=" . $result['category_id'] . $url
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

//  Tạo đường link gắn vào các cột của bảng kết quả ở tầng giao diện html
//  Mỗi đường link chứa tham số về trật tự sắp xếp và lọc khi truy vấn,
//  vì vậy khi user bấm vào tên cột, kiểu sắp xếp khác sẽ được thực hiện
//  Nếu url mà user đang xem là ASC(tăng) thì sẽ bị đổi lại thành DESC (giảm)
//  và ngược lại.
$url = ''; // Lưu các tham số phân trang, sắp xếp, tìm kiếm vào link của các Table Head (tên cột của bảng)

if (isset($_GET['filter_title'])) 
{
     $url .= '&filter_title=' . urlencode(html_entity_decode($_GET['filter_title'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_GET['filter_status'])) 
{
     $url .= '&filter_status=' . $_GET['filter_status'];
}

if (isset($_GET['filter_featured']))
{
	$url .= '&filter_featured=' . $_GET['filter_featured'];
}


if (isset($_GET['filter_top']))
{
	$url .= '&filter_top=' . $_GET['filter_top'];
}

// Duy trì các tham số: chiều sắp xếp (ngược lại so với chiều của danh sách đang hiển thị)
// (để khi bấm vào đường link thì danh sách bị đảo chiều sắp xếp)
$url .= ($order == 'ASC') ? '&order=DESC' : '&order=ASC';

// Duy trì các tham số phân trang trên url
$url .= "&page={$page}";
$url .= "&limit={$limit}";

// Các đường link sắp xếp theo cột tên, mã, thứ tự, ngày tạo
// chỗ này phải đồng bộ với bên trong hàm post_categoryGetAll()
$sort_name        = "/admin/post_category.php?sort=cd.name".$url;
$sort_category_id = "/admin/post_category.php?sort=cd.category_id".$url;
$sort_status      = "/admin/post_category.php?sort=cd.status".$url; 
$sort_featured    = "/admin/post_category.php?sort=cd.featured".$url; 
$sort_top         = "/admin/post_category.php?sort=cd.top".$url; 
$sort_order       = "/admin/post_category.php?sort=cd.sort_order".$url; 
$sort_date_added  = "/admin/post_category.php?sort=cd.date_added".$url; 

/*
 Phân Trang
 Trong đường link phân trang phải có tham số:
 - page: trang hiện tại
 có thể có:
 - sort: sắp xếp theo cột nào (mặc định = name)
 - order: trật tự sắp xếp là gì (mặc định = ASC)
 Exam:
 	http://localhost:82/admin/post_category?sort=sort_order&order=DESC&page=2
 	http://localhost:82/admin/post_category?sort=name&order=ASC&page=2
 	http://localhost:82/admin/post_category?&page=2
 */
$url = '?';

if (isset($_GET['filter_title']))
{
	$url .= '&filter_title=' . urlencode(html_entity_decode($_GET['filter_title'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_GET['filter_status']))
{
	$url .= '&filter_status=' . $_GET['filter_status'];
}

if (isset($_GET['filter_featured']))
{
	$url .= '&filter_featured=' . $_GET['filter_featured'];
}


if (isset($_GET['filter_top']))
{
	$url .= '&filter_top=' . $_GET['filter_top'];
}


// Duy trì các tham số sắp xếp (một cách tường minh chứ không ngầm định)
$url .= "&sort={$sort}";
$url .= "&order={$order}";

// Duy trì các tham số phân trang
$url .= "&limit={$limit}";
// Không lưu số thứ tự trang vào $url vì việc này
// được thực hiện bởi hàm phân trang paginate()

paginate($post_category_total, $page,$limit, "/admin/post_category.php".$url);

// Nội dung riêng của trang:
$web_title = "Loại Bài Viết";
$web_content = "../ui/admin/view/view-post_category-list.php";
$active_page_admin = ACTIVE_PAGE_ADMIN_POST_CATEGORY;

check_file_layout($web_layout_admin, $web_content);

// được đặt vào bố cục chung của toàn site:
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;
