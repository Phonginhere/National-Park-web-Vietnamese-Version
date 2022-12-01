<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang quản lý sản phẩm
 */
// Cấu hình hệ thống
include_once '../configs.php';

// Thư viện hàm
include_once '../lib/tool.image.php';
include_once '../lib/table/table.product.php';


/* Hiển Thị Danh Mục Sản Phẩm. (làm mẫu cho các phần khác)
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
$filter_name     = isset($_GET['filter_name'])   ? $_GET['filter_name']   : null;
$filter_model    = isset($_GET['filter_model'])  ? $_GET['filter_model']  : null;
$filter_price    = isset($_GET['filter_price'])  ? $_GET['filter_price']  : null;
$filter_status   = isset($_GET['filter_status']) ? $_GET['filter_status'] : null;

// (Bắt)Tiếp nhận các tham số 'cột sắp xếp', 'thứ tự sắp xếp', 'phân trang' được yêu cầu từ phía trình duyệt,
// các tham số này có thể nằm trong url hoặc form gửi lên.
// Các tham số này sẽ được dùng để nhúng vào các câu sql truy vấn,
// đồng thời cũng được gửi ngược sang view html để làm một số việc như là so sánh hoặc gán đường link vào tên cột của bảng.
//  Ví dụ:
//   		http://localhost:82/admin/category?sort=sort_order&order=DESC&page=2
// Nếu phía trình duyệt không chỉ rõ thì gán giá trị mặc định cho các tham số đó:
// ví dụ:
// sort = name (sắp xếp theo cột: 'tên sản phẩm')
// order = ASC (thứ tự sắp xếp: tăng dần)
// page = 1 (Trang hiện thời, trang đầu tiên trong phân trang)
$sort  = isset($_GET['sort'])  ? $_GET['sort']  : "name";
$order = isset($_GET['order']) ? $_GET['order'] : "ASC";
$page  = isset($_GET['page'])  ? $_GET['page']  : 1;

$url = '?';

if (isset($_GET['filter_name'])) 
{
	// Giải mã thực thể html,
	// tiếp tục mã hóa lại lần nữa theo lược đồ mã hóa
	// giành cho địa chỉ web url, tránh vi phạm từ khóa của
	// một url
	$url .= '&filter_name=' . urlencode(html_entity_decode($_GET['filter_name'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_GET['filter_model'])) 
{
	$url .= '&filter_model=' . urlencode(html_entity_decode($_GET['filter_model'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_GET['filter_price'])) 
{
	$url .= '&filter_price=' . $_GET['filter_price'];
}

if (isset($_GET['filter_status'])) 
{
	$url .= '&filter_status=' . $_GET['filter_status'];
}

$url .= isset($_GET['sort'])  ? '&sort=' . $_GET['sort']   : "";
$url .= isset($_GET['order']) ? '&order=' . $_GET['order'] : "";
$url .= isset($_GET['page'])  ? '&page=' . $_GET['page']   : "";

if($url=='?') $url = '';

// có gửi các tham số sort, order, page vào các đường link delete, copy ?

// Truy vấn cơ sở dữ liệu để phân trang, biến mảng này sẽ được sử dụng bên view-html (đầu vào cho vòng lặp foreach)
$products = array();

// tiêu chí truy vấn
$filter_data = array(
	'filter_name'	  => $filter_name,
	'filter_model'	  => $filter_model,
	'filter_price'	  => $filter_price,
	'filter_status'   => $filter_status,
	'sort'            => $sort,
	'order'           => $order,
	'start'           => ($page - 1) * settings('config_limit_admin'), 
	'limit'           => settings('config_limit_admin')	// 15-20 sản phẩm trên một trang
);

// đếm tổng số bản ghi phù hợp tiêu chí tìm kiếm
$product_total = productGetTotal($filter_data);

// lấy ra dữ liệu của tất cả các bản ghi phù hợp tiêu chí tìm kiếm
$results = productGetAll($filter_data);

// Thêm các thông tin cần thiết khác vào kết quả truy vấn
// Gán các đường link vào các nút edit, delete
// để khi bấm vào thì thao tác/can thiệp đúng item theo id
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

	$products[] = array(
		'product_id' => $result['product_id'],
		'image'      => $image,
		'name'       => $result['name'],
		'model'      => $result['model'],
		'price'      => $price = number_format($result['price'],0,'.',',').' đ',
		'status'     => ($result['status']) ? "Cho Phép" : "Không Cho Phép",
		'edit'       => '/admin/product-edit.php?product_id='.$result['product_id'],
		'delete'     => '/admin/product-delete.php?product_id='.$result['product_id']
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
$url = '';

if (isset($_GET['filter_name'])) 
{
     $url .= '&filter_name=' . urlencode(html_entity_decode($_GET['filter_name'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_GET['filter_model'])) 
{
     $url .= '&filter_model=' . urlencode(html_entity_decode($_GET['filter_model'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_GET['filter_price'])) 
{
     $url .= '&filter_price=' . $_GET['filter_price'];
}

if (isset($_GET['filter_status'])) 
{
     $url .= '&filter_status=' . $_GET['filter_status'];
}

$url .= ($order == 'ASC') ? '&order=DESC' : '&order=ASC';
$url .= isset($_GET['page']) ? '&page=' . $_GET['page'] : '';

//  Các đường link gắn vào cột giao diện html
//  Bấm vào đường link nào thì sắp xếp theo cột đấy.
//  Ví dụ: sắp xếp theo name, model, price, ...
$sort_product_id = '/admin/product.php?sort=p.product_id' . $url;
$sort_name       = '/admin/product.php?sort=p.name' . $url;
$sort_model      = '/admin/product.php?sort=p.model' . $url;
$sort_price      = '/admin/product.php?sort=p.price' . $url;
$sort_status     = '/admin/product.php?sort=p.status' . $url;
$sort_order      = '/admin/product.php?sort=p.sort_order' . $url;

//  Khởi tạo đối tượng phân trang (Pagination Object).
//  Trong đường link phân trang phải có tham số:
//  - page: trang hiện tại
//  có thể có:
//  - sort: sắp xếp theo cột nào (mặc định = name)
//  - order: trật tự sắp xếp là gì (mặc định = ASC)
//  Exam:
$url = '?';

if (isset($_GET['filter_name'])) 
{
     $url .= '&filter_name=' . urlencode(html_entity_decode($_GET['filter_name'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_GET['filter_model'])) 
{
     $url .= '&filter_model=' . urlencode(html_entity_decode($_GET['filter_model'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_GET['filter_price'])) 
{
     $url .= '&filter_price=' . $_GET['filter_price'];
}

if (isset($_GET['filter_status'])) 
{
     $url .= '&filter_status=' . $_GET['filter_status'];
}

$url .= isset($_GET['sort'])  ? '&sort=' . $_GET['sort']   : "";
$url .= isset($_GET['order']) ? '&order=' . $_GET['order'] : "";
// Không thêm thông tin phân trang vào $url vì việc này
// được thực hiện bởi hàm phân trang paginate()

paginate($product_total, $page,settings('config_limit_admin'), "/admin/product.php".$url);


// Nội dung riêng của trang:
$web_title = "Sản Phẩm";
$web_content = "../ui/admin/view/view-product-list.php";
$active_page_admin = ACTIVE_PAGE_ADMIN_PRODUCT;



check_file_layout($web_layout_admin, $web_content);

// được đặt vào bố cục chung của toàn site:
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;
