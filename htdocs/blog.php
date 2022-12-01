<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang hiển thị bài viết, tin tức ở trang chủ
 * 
 * Không thể dùng trang 'search-post.php' cho tính năng này vì nó có nhiều điểm khác biệt. 
 * Học theo post_category.php (view) và search-post.php (controller)
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/tool.image.php';
include_once 'lib/table/table.post.php';
include_once 'lib/table/table.post_category.php';

// Bắt các tham số trên url: tìm kiếm/lọc, sắp xếp, phân trang
$filter   = isset($_REQUEST['filter'])  ? $_REQUEST['filter'] : '';
$search   = isset($_REQUEST['search'])  ? $_REQUEST['search'] : '';
$tag      = isset($_REQUEST['tag'])     ? $_REQUEST['tag']    : '';
$tag      = isset($_REQUEST['search'])  ? $_REQUEST['search'] : $tag;
$content  = isset($_REQUEST['content']) ? $_REQUEST['content'] : '';

$sort   = isset($_REQUEST['sort'])   ? $_REQUEST['sort']   : 'p.sort_order';
$order  = isset($_REQUEST['order'])  ? $_REQUEST['order']  : 'ASC';

$page   = isset($_REQUEST['page'])   ? $_REQUEST['page']   : 1;
$limit  = isset($_REQUEST['limit'])  ? $_REQUEST['limit']  : settings('config_product_limit'); // @todo replace product by post

// Tiêu đề tìm kiếm
if (isset($_REQUEST['search']))
{
	$search_title =  'Tìm theo tựa đề '.  ' - ' . $_REQUEST['search'];
}
elseif (isset($_REQUEST['tag']))
{
	$search_title =  'Tìm theo tag: '.$_REQUEST['tag'];
}
else
{
	$search_title = 'Tìm Kiếm';
}



// Điều hướng ruột bánh mì
// $breadcrumbs = array();

// $breadcrumbs[] = array(
// 		'text' => '<i class="fa fa-home"></i> Trang Chủ',
// 		'href' => "/home.php"
// );

// Duy trì trạng thái, giá trị của các tham số URL gửi sang bên view
$url = '?';

if (isset($_REQUEST['search']))
{
	$url .= '&search=' . urlencode(html_entity_decode($_REQUEST['search'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_REQUEST['tag']))
{
	$url .= '&tag=' . urlencode(html_entity_decode($_REQUEST['tag'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_REQUEST['content']))
{
	$url .= '&content=' . $_REQUEST['content'];
}

if (isset($_REQUEST['sort']))
{
	$url .= '&sort=' . $_REQUEST['sort'];
}

if (isset($_REQUEST['order']))
{
	$url .= '&order=' . $_REQUEST['order'];
}

if (isset($_REQUEST['page']))
{
	$url .= '&page=' . $_REQUEST['page'];
}

if (isset($_REQUEST['limit']))
{
	$url .= '&limit=' . $_REQUEST['limit'];
}

// $breadcrumbs[] = array(
// 		'text' => 'Blog',
// 		'href' => "/blog.php".$url
// );

// $url_search = "/blog.php".$url;
// $search_url = $url_search;

// Khởi tạo mảng chứa các bài viết tìm thấy trong db.
$postsSearched = array();

// Các tham số đầu vào cho quá trình tìm kiếm
$filter_data = array(
	'filter_title'   => $search,
	'filter_tag'     => $tag,
	'filter_content' => $content,
	'sort'           => $sort,
	'order'          => $order,
	'start'          => ($page - 1) * $limit,
	'limit'          => $limit
);

// Truy vấn dữ liệu các bài viết trong db
$post_total = postGetTotalForSearch($filter_data);
$results    = postGetAllForSearch($filter_data);

// Cập nhật, định dạng lại các bài viết trước khi gửi sang giao diện html
foreach ($results as $result)
{
	//if ($result['image'])
	if (is_file(DIR_IMAGE . $result['image']))
	{
		// Nếu tồn tại file ảnh của bài viết trên máy chủ ...
		$image = img_resize($result['image'], settings('config_image_product_width'), settings('config_image_product_height'));
	}
	else
	{
		// ...ngược lại thì dùng ảnh rỗng
		$image = img_resize('placeholder.png', settings('config_image_product_width'), settings('config_image_product_height'));
	}
	
	//$price = number_format($result['price'],0,'.',',').' ₫';
	
	$postsSearched[] = array(
		'post_id'  => $result['post_id'],
		'thumb'       => $image,
		'title'       => $result['title'],
		'date_published' => date('d/m/Y', strtotime($result['date_added'])),
		'content_short'     => utf8_substr(strip_tags(html_entity_decode($result['content'], ENT_QUOTES, 'UTF-8')), 0, 200) . '..',
		//'price'       => $price,
		//'href'        => "/post-info.php?post_id={$result['post_id']}"
		'href'        => "/blog-post.php?post_id={$result['post_id']}"
	);
}// end foreach

// URL cho tùy chọn sắp xếp trên giao diện html
$url = '';

if (isset($_REQUEST['search']))
{
	$url .= '&search=' . urlencode(html_entity_decode($_REQUEST['search'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_REQUEST['tag']))
{
	$url .= '&tag=' . urlencode(html_entity_decode($_REQUEST['tag'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_REQUEST['content']))
{
	$url .= '&content=' . $_REQUEST['content'];
}

if (isset($_REQUEST['limit']))
{
	$url .= '&limit=' . $_REQUEST['limit'];
}

// Tùy chọn sắp xếp trên giao diện html
$blog_sorts = array();

// 'value' bằng tên cột sắp xếp và chiều sắp xếp ghép lại
// để có thể bôi đen thẻ <option> trong <select> nhằm duy trì
// trạng thái ứng dụng trên giao diện. Tức là khi user nhấp chọn 
// thẻ <option> nào thì nó cần được giữ nguyên sau quá trình tìm kiếm.
$blog_sorts[] = array(
		'text'  => "Mặc định",
		'value' => 'p.sort_order-ASC',
		'href'  => '/blog.php?sort=p.sort_order&order=ASC' . $url
);

$blog_sorts[] = array(
		'text'  => "Tựa đề (A - Z)",
		'value' => 'p.title-ASC',
		'href'  => '/blog.php?sort=p.title&order=ASC' . $url
);

$blog_sorts[] = array(
		'text'  => "Tựa đề (Z - A)",
		'value' => 'p.title-DESC',
		'href'  => '/blog.php?sort=p.title&order=DESC' . $url
);

//$blog_sorts[] = array(
//    'text'  => "Giá (Thấp &gt; Cao)",
//    'value' => 'p.price-ASC',
//    'href'  => '/search-post.php?sort=p.price&order=ASC' . $url
//);

//$blog_sorts[] = array(
//    'text'  => "Giá (Cao &gt; Thấp)",
//    'value' => 'p.price-DESC',
//    'href'  => '/search-post.php?sort=p.price&order=DESC' . $url
//);

//$blog_sorts[] = array(
//    'text'  => "Model (A - Z)",
//    'value' => 'p.model-ASC',
//    'href'  => '/search.php?sort=p.model&order=ASC' . $url
//);

//$blog_sorts[] = array(
//    'text'  => "Model (Z - A)",
//    'value' => 'p.model-DESC',
//    'href'  => '/search.php?sort=p.model&order=DESC' . $url
//);

// Tùy chọn phân trang ----------------------------------
$url = '';

if (isset($_REQUEST['search']))
{
	$url .= '&search=' . urlencode(html_entity_decode($_REQUEST['search'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_REQUEST['tag']))
{
	$url .= '&tag=' . urlencode(html_entity_decode($_REQUEST['tag'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_REQUEST['content']))
{
	$url .= '&content=' . $_REQUEST['content'];
}

if (isset($_REQUEST['sort']))
{
	$url .= '&sort=' . $_REQUEST['sort'];
}

if (isset($_REQUEST['order']))
{
	$url .= '&order=' . $_REQUEST['order'];
}

// hiện lên bao nhiêu bài viết
$blog_limits = array();

//$_limits = array_unique(array(settings('config_product_limit'), 25, 50, 75, 100));
$_limits = array_unique(array(5, 10, 15, 20, 25, 30, 35, 40));

sort($_limits);

foreach($_limits as $value)
{
	$blog_limits[] = array(
			'text'  => $value,
			'value' => $value,
			'href'  => '/blog.php?limit='.$_REQUEST['path'] . $url . '&limit=' . $value
	);
}

// Phân trang
$url = '/blog.php?'; // đối chiếu post_category.php
//ko hiểu
if (isset($_REQUEST['search']))
{
	$url .= '&search=' . urlencode(html_entity_decode($_REQUEST['search'], ENT_QUOTES, 'UTF-8'));
}
// nhìn là b r
if (isset($_REQUEST['tag']))
{
	$url .= '&tag=' . urlencode(html_entity_decode($_REQUEST['tag'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_REQUEST['content']))
{
	$url .= '&content=' . $_REQUEST['content'];
}


if (isset($_REQUEST['sort']))
{
	$url .= '&sort=' . $_REQUEST['sort'];
}

if (isset($_REQUEST['order']))
{
	$url .= '&order=' . $_REQUEST['order'];
}

if (isset($_REQUEST['limit']))
{
	$url .= '&limit=' . $_REQUEST['limit'];
}

paginate($post_total, $page,$limit, $url);

// Nội dung riêng của trang...
$web_title = 'Blog';
$web_content = "view/view-blog.php";

// ...được đặt vào bố cục chung của toàn site.
$web_layout = "ui/home/{$home_themes}/layout-blog.php";
include_once $web_layout;

