<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang quản lý bài viết
 */
// Cấu hình hệ thống
include_once '../configs.php';

// Thư viện hàm
include_once '../lib/tool.image.php';
include_once '../lib/table/table.post.php';


/* Hiển Thị Danh Mục Bài Viết. (làm mẫu cho các phần khác)
- Kiểm tra đăng nhập và quyền
- Tạo điều hướng ruột bánh mỳ.
- Tạo các đường link liên quan đến các hành động Add, Delete, Copy, Repair.
- Truy vấn các bản ghi trong tầng cơ sở dữ liệu để gửi sang tầng giao diện html.
 (Có thể tinh chỉnh dữ liệu thô, thêm bớt các cột của bản ghi)
- Có thể thêm đường link Edit để khi bấm vào thì chỉnh sửa bản ghi theo id.
- Phân Trang.
- Gửi dữ liệu sang tầng giao diện.
- Hiển thị toàn trang (tựa đề, nội dung riêng, menu hiện thời, bố cục toàn trang).
 */
 
check_login();


// Bắt các tham số lọc kết quả tìm kiếm yêu cầu từ phía trình duyệt,
// các tham số này có thể nằm trong url hoặc form gửi lên.
// $_REQUEST có thể bắt các tham số theo cả 2 phương thức GET và POST.
$filter_title    = isset($_GET['filter_title'])    ? $_GET['filter_title']  : null;   // Tìm theo tựa đề
$filter_status   = isset($_GET['filter_status'])   ? $_GET['filter_status'] : null;   // Tìm theo trạng thái (duyệt/không duyệt)
$filter_top      = isset($_GET['filter_top'])      ? $_GET['filter_top']    : null;   // Tìm những bản ghi Top (hiện lên menu top trang chủ)
$filter_featured = isset($_GET['filter_featured']) ? $_GET['filter_featured'] : null; // Tìm theo tính nổi bật 

// (Bắt)Tiếp nhận các tham số 'cột sắp xếp', 'thứ tự sắp xếp', 'phân trang' được yêu cầu từ phía trình duyệt,
// các tham số này có thể nằm trong url hoặc form gửi lên.
// Các tham số này sẽ được dùng để nhúng vào các câu sql truy vấn,
// đồng thời cũng được gửi ngược sang view html để làm một số việc như là so sánh hoặc gán đường link vào tên cột của bảng.
//  Ví dụ:
//   		http://localhost:82/admin/category?sort=sort_order&order=DESC&page=2
// Nếu phía trình duyệt không chỉ rõ thì gán giá trị mặc định cho các tham số đó:
// ví dụ:
// sort = name (sắp xếp theo cột: 'tên Bài Viết')
// order = ASC (thứ tự sắp xếp: tăng dần)
// page = 1 (Trang hiện thời, trang đầu tiên trong phân trang)
$sort  = isset($_GET['sort'])  ? $_GET['sort']  : "title";
$order = isset($_GET['order']) ? $_GET['order'] : "ASC";

// Giới hạn phân trang mặc định:
$limit = ( settings('config_limit_admin') !== null ) ? settings('config_limit_admin') : 5;
// Giới hạn phân trang yêu cầu bởi phía máy khách: 
$limit = isset($_GET['limit']) ? $_GET['limit']  : $limit;
// Số thứ tự của trang yêu cầu bởi máy khách:
$page  = isset($_GET['page'])  ? $_GET['page']  : 1;	// không nói gì thì hiện trang đầu tiên.

$url = ''; // Lưu các tham số sắp xếp, phân trang, tìm kiếm vào link edit, delete
           // để sau khi edit, delete xong thì chúng vẫn còn trên trang list

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

// có gửi các tham số sort, order, page vào các đường link delete, copy ?

// Truy vấn cơ sở dữ liệu để phân trang, biến mảng này sẽ được sử dụng bên view-html (đầu vào cho vòng lặp foreach)
$posts = array();

// tiêu chí truy vấn
$filter_data = array(
	// tìm kiếm:
	'filter_title'	  => $filter_title,
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

// Đếm tổng số bản ghi tìm thấy
$post_total = postGetTotal($filter_data);

// lấy ra dữ liệu của tất cả các bản ghi phù hợp tiêu chí tìm kiếm
$results = postGetAll($filter_data);

// Thêm các thông tin cần thiết khác vào kết quả truy vấn
// Gán các đường link vào các nút edit, delete
// để khi bấm vào thì thao tác/can thiệp đúng item theo id
foreach ($results as $result) 
{
	if (is_file(DIR_IMAGE . $result['image'])) 
	{
		// Nếu Bài Viết không có hình đại diện...
		$image = img_resize($result['image'], 40, 40);
	} 
	else 
	{
		// ...thì dùng hình rỗng đã được đặt sẵn trong thư mục ảnh DIR_IMAGE
		$image = img_resize('no_image.png', 40, 40);
	}

	$posts[] = array(
		// Thông tin từ dữ liệu gốc (được định dạng lại):
		'post_id'  => $result['post_id'],
		'image'    => $image,
		'title'    => $result['title'],
		'status'   => ($result['status']) ? "Cho Phép" : "Không Cho Phép",	// @deprecated: biến chứa dữ liệu được định dạng phải khác tên cột gốc.
		'status_text'   => ($result['status']) ? "Cho Phép" : '<span class="badge badge-danger">Không cho phép</span>',
		'featured_text'   => $result['featured'] ? '<span class="badge badge-success">Nổi Bật</span>' : "Không nổi bật",
		'top_text' => $result['top'] ? '<span class="badge badge-success">Top</span>': "Không phải top",
		'sort_order' => $result['sort_order'],
		'date_added_text' => date('d/m/Y', strtotime($result['date_added'])),
		// Thông tin phái sinh thêm:
		'edit'     => '/admin/post-edit.php?post_id='.$result['post_id'].$url,
		'delete'   => '/admin/post-delete.php?post_id='.$result['post_id'].$url
	);
}

// Các mục được chọn để xóa
// Khi việc xóa gặp trục trặc (ví dụ: ko có quyền, v.v..), thì các
// ô checkbox được giữ nguyên, người dùng không phải tích lại
if ( isset($_POST['selected']))  
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

//  Các đường link gắn vào cột giao diện html
//  Bấm vào đường link nào thì sắp xếp theo cột đấy.
//  Ví dụ: sắp xếp theo name, model, price, ...
$sort_post_id  = '/admin/post.php?sort=p.post_id' . $url;
$sort_title    = '/admin/post.php?sort=p.title' . $url;
$sort_status   = '/admin/post.php?sort=p.status' . $url;
$sort_featured = '/admin/post.php?sort=p.featured' . $url;	// link sắp xếp theo tính nổi bật của bài viết
$sort_top      = '/admin/post.php?sort=p.top' . $url;	// link sắp xếp theo tính Top của bài viết
$sort_order    = '/admin/post.php?sort=p.sort_order' . $url;
$sort_date_added  = '/admin/post.php?sort=p.date_added' . $url;

//  Khởi tạo đối tượng phân trang (Pagination Object).
//  Trong đường link phân trang phải có tham số:
//  - page: trang hiện tại
//  có thể có:
//  - sort: sắp xếp theo cột nào (mặc định = name)
//  - order: trật tự sắp xếp là gì (mặc định = ASC)
//  Exam:
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

//if($url=='?') $url = '';	// gây lỗi khi chỉ có 1 tham số page

// Không thêm thông tin phân trang vào $url vì việc này
// được thực hiện bởi hàm phân trang paginate()

paginate($post_total, $page, $limit, "/admin/post.php".$url);


// Nội dung riêng của trang:
$web_title = "Bài Viết";
$web_content = "../ui/admin/view/view-post-list.php";
$active_page_admin = ACTIVE_PAGE_ADMIN_POST;



check_file_layout($web_layout_admin, $web_content);

// được đặt vào bố cục chung của toàn site:
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;
