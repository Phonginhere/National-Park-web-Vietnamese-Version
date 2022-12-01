<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Form sửa/xóa sản phẩm
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.product.php';
include_once '../lib/table/table.category.php';
include_once '../lib/table/table.manufacturer.php';

include_once '../lib/tool.image.php';

$url = '';

if (isset($_REQUEST['filter_name'])) 
{
     $url .= '&filter_name=' . urlencode(html_entity_decode($_REQUEST['filter_name'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_REQUEST['filter_model'])) 
{
     $url .= '&filter_model=' . urlencode(html_entity_decode($_REQUEST['filter_model'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_REQUEST['filter_price'])) 
{
     $url .= '&filter_price=' . $_REQUEST['filter_price'];
}

if (isset($_REQUEST['filter_status'])) 
{
     $url .= '&filter_status=' . $_REQUEST['filter_status'];
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

// form action:
if (!isset($_GET['product_id'])) 
{
	// Thêm mới
	$url_action = "/admin/product-add.php";
} 
else 
{
	// Sửa
	$url_action = "/admin/product-edit.php?product_id=".$_GET['product_id'].$url;
}

// Nếu đang là sửa thông tin trên form:
// truy vấn thông tin bản ghi từ id và gửi sang giao diện
if (isset($_GET['product_id']) && $_SERVER['REQUEST_METHOD'] != "POST") 
{
	$product_info = productById($_REQUEST['product_id']);
}

// Tên sản phẩm
if (isset($_POST['product_name'])) // form submitted (add/edit)
{
	$product_name = $_POST['product_name'];
} 
elseif (isset($_GET['product_id'])) 
{	// Sửa
	$product_name = $product_info['name'];
} 
else 
{	// Thêm mới
	$product_name = '';	
}

// Mô tả sản phẩm (Product Description)
if (isset($_POST['product_description'])) // form submitted (add/edit)
{
	$product_description = $_POST['product_description'];
} 
elseif (isset($_GET['product_id'])) 
{	// Sửa
	$product_description = $product_info['description'];
} 
else 
{	// Thêm mới
	$product_description = '';	
}

// Tags
if (isset($_POST['product_tag'])) // form submitted (add/edit)
{
	$product_tag = $_POST['product_tag'];
} 
elseif (isset($_GET['product_id'])) 
{	// Sá»­a
	$product_tag = $product_info['tag'];
} 
else 
{	// Thêm mới
	$product_tag = '...';	
}
// ảnh chi tiết sản phẩm
if (isset($_POST['image'])) 
{
     $product_image = $_POST['image'];
} 
elseif (!empty($product_info)) 
{	// Sửa
     $product_image = $product_info['image'];
} 
else 
{	// Thêm mới
     $product_image = '';	
}

// Product Thumb Image
if (isset($_POST['image']) && is_file(DIR_IMAGE . $_POST['image'])) 
{
     $product_thumb = img_resize($_POST['image'], 100, 100);
} 
elseif (!empty($product_info) && is_file(DIR_IMAGE . $product_info['image'])) 
{
     $product_thumb = img_resize($product_info['image'], 100, 100);
} 
else 
{
     $product_thumb = img_resize('no_image.png', 100, 100);
}
$product_image_placeholder = img_resize('no_image.png', 100, 100); 

if (isset($_POST['model'])) 
{
     $product_model = $_POST['model'];
} 
elseif (!empty($product_info)) 
{
     $product_model = $product_info['model'];
} 
else 
{
     $product_model = '';
}

if (isset($_POST['price'])) 
{
     $product_price = $_POST['price'];
} 
elseif (!empty($product_info)) 
{
     $product_price = $product_info['price'];
} 
else 
{
     $product_price = '';
}

if (isset($_POST['sort_order'])) 
{
     $product_sort_order = $_POST['sort_order'];
} 
elseif (!empty($product_info)) 
{
     $product_sort_order = $product_info['sort_order'];
} 
else 
{
     $product_sort_order = 1;
}

// Sản phẩm nổi bật
if (isset($_POST['featured']))
{
	$product_featured = $_POST['featured'];
}
elseif (!empty($product_info))
{
	$product_featured = $product_info['featured'];
}
else
{
	$product_featured= true;
}

// San pham ban chay
if (isset($_POST['best_seller']))
{
	$product_best_seller= $_POST['best_seller'];
}
elseif (!empty($product_info))
{
	$product_best_seller= $product_info['best_seller'];
}
else
{
	$product_best_seller= false;
}

if (isset($_POST['status'])) 
{
     $product_status = $_POST['status'];
} 
elseif (!empty($product_info)) 
{
     $product_status = $product_info['status'];
} 
else 
{
     $product_status = true;
}

if (isset($_POST['manufacturer_id'])) 
{
     $manufacturer_id = $_POST['manufacturer_id'];
} 
elseif (!empty($product_info)) 
{
     $manufacturer_id = $product_info['manufacturer_id'];
} 
else 
{
     $manufacturer_id = 0;
}
		
if (isset($_POST['manufacturer'])) 
{
    $manufacturer = $_POST['manufacturer'];
} 
elseif (!empty($product_info)) 
{
	$manufacturer_info = manufacturerGetById($product_info['manufacturer_id']);

	if ($manufacturer_info) 
	{
		 $manufacturer = $manufacturer_info['name'];
	} 
	else 
	{
		 $manufacturer = '';
	}
} 
else 
{
     $manufacturer = '';
}

if (isset($_POST['product_category'])) 
{
	$categories = $_POST['product_category'];
} 
elseif (isset($_GET['product_id'])) 
{
	$categories = productCategories($_GET['product_id']);
} 
else 
{
	$categories = array();
}

$product_categories = array();
foreach ($categories as $category_id) 
{
	$category_info = categoryGetById($category_id);

	if ($category_info) 
	{
		$product_categories[] = array(
			'category_id' => $category_info['category_id'],
			'name' => ($category_info['path']) ? $category_info['path'] . ' &gt; ' . $category_info['name'] : $category_info['name']
		);
	}
}

if (isset($_POST['product_image'])) 
{
	$images = $_POST['product_image'];
} 
elseif (isset($_GET['product_id'])) 
{	
	$images = productGetImages($_GET['product_id']);
} 
else {	
	$images = array();
}

$product_images = array();
foreach ($images as $item) 
{
	if (is_file(DIR_IMAGE . $item['image'])) 
	{
		$image = $item['image'];
		$thumb = $item['image'];
	} 
	else 
	{
		$image = '';
		$thumb = 'no_image.png';
	}

	$product_images[] = array(
		'image'      => $image,
		'thumb'      => img_resize($thumb, 100, 100),
		'sort_order' => $item['sort_order']
	);
}

// Nội dung riêng của trang
$web_content = "../ui/admin/view/view-product-form.php";

check_file_layout($web_layout_admin, $web_content);

// Được đặt trong bố cục chung của toàn site
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;