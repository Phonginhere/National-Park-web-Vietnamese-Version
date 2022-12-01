<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang hiển thị danh sách loại sản phẩm
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.category.php';
include_once 'lib/table/table.product.php';
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

		$category_info = categoryGetById($path_id);

		if ($category_info) 
		{
			$breadcrumbs[] = array(
				'text' => $category_info['name'],
				'href' => '/product-category.php?path=' . $path . $url
			);
		}
	}
} 
else 
{
	$category_id = 0;
}
		
$category_info = categoryGetById($category_id);
		
$category_name = $category_info['name'];

$category_href = '/product-category.php?path='.$_REQUEST['path'];
			
// Set the last category breadcrumb
$breadcrumbs[] = array(
	'text' => $category_info['name'],
	'href' => '/product-category.php?path='.$_REQUEST['path']
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

$results = categoryGetAllByParent($category_id);

foreach ($results as $result) 
{
	$sub_categories[] = array(
		'name'  => $result['name'] . (settings('config_product_count') ? ' (' . productGetTotalForCategory($result['category_id']) . ')' : ''),
		'href'  => '/product-category.php?path='.$result['category_id'],
		'category_id' => $result['category_id']
	);
}
			
$productsByCategory = array();

$filter_data = array(
	'filter_category_id' => $category_id,
	'filter_filter'      => $filter,
	'sort'               => $sort,
	'order'              => $order,
	'start'              => ($page - 1) * $limit,
	'limit'              => $limit
);

// @todo tính toán lại vì khi xem tất cả các sản phẩm của một category
// thì phải tính cả các category con của nó nữa.
$product_total = productGetTotalForCategory($category_id);

$results = productGetAllForCategory($filter_data);
			
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
				

	$productsByCategory[] = array(
		'product_id'  => $result['product_id'],
		'thumb'       => $image,
		'name'        => $result['name'],
		'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, settings('config_product_description_length')) . '..',
		'price'       => $price,
		'href'        => '/product-info.php?product_id=' . $result['product_id'] . $url  
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

$product_sorts = array();

$product_sorts[] = array(
	'text'  => "Mặc định",
	'value' => 'p.sort_order-ASC',
	'href'  => '/product-category.php?path=' . $_REQUEST['path'] . '&sort=p.sort_order&order=ASC' . $url
);

$product_sorts[] = array(
	'text'  => "Tên (A - Z)",
	'value' => 'p.name-ASC',
	'href'  => '/product-category.php?path=' . $_REQUEST['path'] . '&sort=p.name&order=ASC' . $url
);

$product_sorts[] = array(
	'text'  => "Tên (Z - A)",
	'value' => 'p.name-DESC',
	'href'  => '/product-category.php?path=' . $_REQUEST['path'] . '&sort=p.name&order=DESC' . $url
);

$product_sorts[] = array(
	'text'  => "Giá (Thấp &gt; Cao)",
	'value' => 'p.price-ASC',
	'href'  => '/product-category.php?path=' . $_REQUEST['path'] . '&sort=p.price&order=ASC' . $url
);

$product_sorts[] = array(
	'text'  => "Giá (Cao &gt; Thấp)",
	'value' => 'p.price-DESC',
	'href'  => '/product-category.php?path=' . $_REQUEST['path'] . '&sort=p.price&order=DESC' . $url
);

$product_sorts[] = array(
	'text'  => "Model (A - Z)",
	'value' => 'p.model-ASC',
	'href'  => '/product-category.php?path=' . $_REQUEST['path'] . '&sort=p.model&order=ASC' . $url
);

$product_sorts[] = array(
	'text'  => "Model (Z - A)",
	'value' => 'p.model-DESC',
	'href'  => '/product-category.php?path=' . $_REQUEST['path'] . '&sort=p.model&order=DESC' . $url
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

$limits = array();

//$_limits = array_unique(array(settings('config_product_limit'), 25, 50, 75, 100));
$_limits = array_unique(array(5, 10, 15, 20, 25, 30, 35, 40));

sort($_limits);

foreach($_limits as $value) 
{
	$limits[] = array(
		'text'  => $value,
		'value' => $value,
		'href'  => '/product-category.php?path=' . $_REQUEST['path'] . $url . '&limit=' . $value
	);
}
			
// Phân trang
$url = '/product-category.php?path=' . $_REQUEST['path'];

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
			
paginate($product_total, $page,$limit, $url);

// Nội dung riêng của trang...
$web_title = 'Loại Sản Phẩm';
$web_content = "view/view-category.php";

// ...được đặt vào bố cục chung của toàn site.
include_once $web_layout;	
					
