<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang hiển thị bài viết, tin tức ở trang chủ
 *
 * Không thể dùng trang 'search-post.php' cho tính năng này vì nó có nhiều điểm khác biệt.
 * Học theo post_category.php (view) và search-post.php (controller)
 * 
 * @see /admin/user.php
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/tool.image.php';
include_once 'lib/table/table.user.php';
include_once 'lib/table/table.job.php'; // bảng ngoại

/*
 Bắt các tham số phân trang và thứ tự sắp xếp yêu cầu từ phía trình duyệt (url),
 * Ví dụ:
 * 		http://localhost:82/admin/user?sort=username&order=DESC&page=2
 * Mặc định, nếu không bắt được thì:
 * Sắp xếp theo cột sort = name
 * Trật tự sắp xếp order = ASC (tăng dần)
 * Trang hiện thời = 1 (trang đầu tiên trong phân trang)
 */
$sort  = isset($_GET['sort'])  ? $_GET['sort']  : 'sort_order';
$order = isset($_GET['order']) ? $_GET['order'] : "ASC";
$page  = isset($_GET['page'])  ? $_GET['page']  : 1;


/*
 Truy vấn cơ sở dữ liệu
 */
$users = array();

$limit = 4; // //settings('config_limit_admin'); //giới hạn số nhân viên
// Tiêu chí truy vấn sql
$filter_data = array(
		'sort'  => $sort,
		'order' => $order,
		'start' => ($page - 1) * $limit, 
		'limit' => $limit,
);

// Thực hiện truy vấn
$total_user = userGetTotal();
$results = userGetAll($filter_data);

// Thêm các thông tin cần thiết khác vào kết quả truy vấn
// Gán các đường link vào các nút edit, delete
// để khi bấm vào thì thao tác/can thiệp đúng item theo id
foreach ($results as $result)
{
	// Xử lý đường dẫn ảnh đại diện trước khi gửi sang view html
	if (is_file(DIR_IMAGE . $result['image']))
	{
		$user_thumb = img_resize($result['image'], 100, 100);
	}
	else
	{
		$user_thumb = img_resize('no_image.png', 100, 100);
	}
	
	$job_info = jobGetById($result['job_id']);
	
	// @todo: lấy thêm job_title vì trong bảng user chỉ có job_id
	// @todo: có nên lấy thêm fullname ?
	$users[] = array(
			'user_id'    => $result['user_id'],
			'username'   => $result['username'],
			'fullname'   => $result['fullname'],
			'email'      => $result['email'],
			'description'   => $result['description'],
			'thumb'      => $user_thumb,
			'job_title'  => $job_info['title'],
	);
}




// Nội dung riêng của trang...
$web_title = 'Giới Thiệu';
$web_content = "view/view-about.php";

// ...được đặt vào bố cục chung của toàn site.
$web_layout = "ui/home/{$home_themes}/layout-blog.php";
include_once $web_layout;

