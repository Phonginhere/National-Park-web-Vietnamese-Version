<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang hiển thị loại bài viết
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.post_category.php';
//include_once 'lib/table/table.product.php';
include_once 'lib/tool.image.php';

// Bắt các tham số trên url
if (isset($_REQUEST['filter'])) 
{
	$filter = $_REQUEST['filter'];
} 
else 
{
	$filter = '';
}

if (isset($_REQUEST['sort'])) 
{
	$sort = $_REQUEST['sort'];
} 
else 
{
	$sort = 'p.sort_order';
}

if (isset($_REQUEST['order'])) 
{
	$order = $_REQUEST['order'];
} 
else 
{
	$order = 'ASC';
}

if (isset($_REQUEST['page'])) 
{
	$page = $_REQUEST['page'];
} 
else 
{
	$page = 1;
}

if (isset($_REQUEST['limit'])) 
{
	$limit = $_REQUEST['limit'];
} 
else 
{
	$limit = settings('config_product_limit');
}
		
// Điều hướng ruột bánh mì
$breadcrumbs = array();

$breadcrumbs[] = array(
	'text' => '<i class="fa fa-home"></i> Trang Chủ',
	'href' => "/home.php"
);
		
if (isset($_REQUEST['path'])) 
{
	$url = '';

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

	$path = '';

	$parts = explode('_', (string)$_REQUEST['path']);

	$category_id = (int)array_pop($parts);

	foreach ($parts as $path_id) 
	{
		if (!$path) 
		{
			$path = (int)$path_id;
		} 
		else 
		{
			$path .= '_' . (int)$path_id;
		}

		$category_info = post_categoryGetById($path_id);

		if ($category_info) 
		{
			$breadcrumbs[] = array(
				'text' => $category_info['name'],
				'href' => '/post-category.php?path=' . $path . $url
			);
		}
	}
} 
else 
{
	$category_id = 0;
}
		
$category_info = post_categoryGetById($category_id);
		
$category_name = $category_info['name'];

$category_href = '/post-category.php?path='.$_REQUEST['path'];
			
// Set the last category breadcrumb
$breadcrumbs[] = array(
	'text' => $category_info['name'],
	'href' => '/post-category.php?path='.$_REQUEST['path']
);

if ($category_info['image']) 
{
	$category_thumb = img_resize($category_info['image'], settings('config_image_category_width'), settings('config_image_category_height'));
} 
else 
{
	$category_thumb = '';
}

$category_description = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
			
$url = '';

if (isset($_['filter'])) 
{
	$url .= '&filter=' . $_REQUEST['filter'];
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
			
$sub_categories = array();

$results = post_categoryGetAllByParent($category_id);

foreach ($results as $result) 
{
	$sub_categories[] = array(
		'name'  => $result['name'] . (settings('config_product_count') ? ' (' . postGetTotalForCategory($result['category_id']) . ')' : ''),
		'href'  => '/post_category.php?path='.$result['category_id'],
		'category_id' => $result['category_id']
	);
}
			
$postsByCategory = array();

$filter_data = array(
	'filter_category_id' => $category_id,
	'filter_filter'      => $filter,
	'sort'               => $sort,
	'order'              => $order,
	'start'              => ($page - 1) * $limit,
	'limit'              => $limit
);

// @todo tính toán lại vì khi xem tất cả các bài viết của một category
// thì phải tính cả các category con của nó nữa.
$post_total = postGetTotalForCategory($category_id);

$results = postGetAllForCategory($filter_data);
			
foreach ($results as $result) 
{
	//if ($result['image']) 
	if (is_file(DIR_IMAGE . $result['image'])) 
	{
		$image = img_resize($result['image'], settings('config_image_product_width'), settings('config_image_product_height'));
	} 
	else 
	{
		$image = img_resize('placeholder.png', settings('config_image_product_width'), settings('config_image_product_height'));
	}

	$price = number_format($result['price'],0,'.',',').' ₫';
				

	$postsByCategory[] = array(
		'post_id'  => $result['post_id'],
		'thumb'       => $image,
		'title'        => $result['title'],
		'content' => utf8_substr(strip_tags(html_entity_decode($result['content'], ENT_QUOTES, 'UTF-8')), 0, settings('config_product_description_length')) . '..',
		'price'       => $price,
		'href'        => '/blog-post.php?post_id=' . $result['post_id'] . $url,
		'date_published' => date('d/m/Y', strtotime($result['date_added'])),
	);
}
			
$url = '';

if (isset($_REQUEST['filter'])) 
{
	$url .= '&filter=' . $_REQUEST['filter'];
}

if (isset($_REQUEST['limit'])) 
{
	$url .= '&limit=' . $_REQUEST['limit'];
}

// Phần sắp xếp học từ `post`
$post_sorts = array();

$post_sorts[] = array(
	'text'  => "Mặc định",
	'value' => 'p.sort_order-ASC',
	'href'  => '/post_category.php?path=' . $_REQUEST['path'] . '&sort=p.sort_order&order=ASC' . $url
);

$post_sorts[] = array(
	'text'  => "Tiêu Đề (A - Z)",
	'value' => 'p.title-ASC',
	'href'  => '/post_category.php?path=' . $_REQUEST['path'] . '&sort=p.title&order=ASC' . $url
);

$post_sorts[] = array(
	'text'  => "Tiêu Đề (Z - A)",
	'value' => 'p.title-DESC',
	'href'  => '/post_category.php?path=' . $_REQUEST['path'] . '&sort=p.title&order=DESC' . $url
);

			
$url = '';

if (isset($_REQUEST['filter'])) 
{
	$url .= '&filter=' . $_REQUEST['filter'];
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
$limits = array();

//$_limits = array_unique(array(settings('config_product_limit'), 25, 50, 75, 100));
$_limits = array_unique(array(5, 10, 15, 20, 25, 30, 35, 40));

sort($_limits);

foreach($_limits as $value) 
{
	$limits[] = array(
		'text'  => $value,
		'value' => $value,
		'href'  => '/post-category.php?path=' . $_REQUEST['path'] . $url . '&limit=' . $value
	);
}
			
// Phân trang
$url = '/post-category.php?path=' . $_REQUEST['path']; // có vấn đề 

if (isset($_REQUEST['filter'])) 
{
	$url .= '&filter=' . $_REQUEST['filter'];
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
$web_title = 'Loại Bài Viết';
$web_content = "view/view-post_category.php";

// ...được đặt vào bố cục chung của toàn site.
$web_layout = "ui/home/{$home_themes}/layout-blog.php";
include_once $web_layout;	
					
