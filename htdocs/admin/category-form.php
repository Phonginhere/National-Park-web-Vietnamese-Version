<?php 
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Form sửa/xóa loại sản phẩm
 */

include_once '../configs.php';

include_once '../lib/table/table.category.php';
include_once '../lib/tool.image.php';

// form action
if (!isset($_GET['category_id'])) {	
	$url_action = "/admin/category-add.php";
} else {	
	$url_action = '/admin/category-edit.php?category_id='.$_GET['category_id'];
}

// edit
if ( isset($_GET['category_id']) && $_SERVER['REQUEST_METHOD'] != "POST" )  
{ 
	$category_info = categoryGetById($_GET['category_id']);
}

if (isset($_POST['category_name']))	// form submitted (add/edit) 
{ 
	$category_name = $_POST['category_name'];
} elseif (isset($_GET['category_id'])) {	// edit
	$category_name = $category_info['name'];
} else {	// add
	$category_name = "";
}

if (isset($_POST['category_description']))	// form submitted (add/edit) 
{ 
	$category_description = $_POST['category_description'];
} elseif (isset($_GET['category_id'])) {	// edit
	$category_description = $category_info['description'];
} else {	// add
	$category_description = "";
}

if (isset($_POST['category_featured']))	// form submitted (add/edit)
{
	$category_featured = $_POST['category_featured'];
} elseif (isset($_GET['category_id'])) {	// edit
	$category_featured = $category_info['featured'];
} else {	// add
	$category_featured = "";
}

if (isset($_POST['path'])) {
	$category_path = $_POST['path'];
} elseif (!empty($category_info)) {
	$category_path = $category_info['path'];
} else {
	$category_path = '';
}

if (isset($_POST['parent_id'])) {
	$category_parent_id = $_POST['parent_id'];
} elseif (!empty($category_info)) {
	$category_parent_id = $category_info['parent_id'];
} else {
	$category_parent_id = 0;
}


// @todo category_filters here if needed

// @todo category stores here if needed

if (isset($_POST['keyword'])) {
	$category_keyword = $_POST['keyword'];
} elseif (!empty($category_info)) {
	$category_keyword = $category_info['keyword'];
} else {
	$category_keyword = '';
}

if (isset($_POST['image'])) {
	$category_image = $_POST['image'];
} elseif (!empty($category_info)) {
	$category_image = $category_info['image'];
} else {
	$category_image = null;
}

// Category Image

if (isset($_POST['image']) && is_file(DIR_IMAGE . $_POST['image'])) {
	$category_thumb = img_resize($_POST['image'], 100, 100);
} elseif (!empty($category_info) && is_file(DIR_IMAGE . $category_info['image'])) {
	$category_thumb = img_resize($category_info['image'], 100, 100);
} else {
	$category_thumb = img_resize('no_image.png', 100, 100);
}

$category_placeholder = img_resize('no_image.png', 100, 100); // trÆ°á»�ng há»£p khÃ´ng cÃ³ áº£nh Ä‘áº¡i diá»‡n

if (isset($_POST['top'])) {
	$category_top = $_POST['top'];
} elseif (!empty($category_info)) {
	$category_top = $category_info['top'];
} else {
	$category_top = 0;
}

if (isset($_POST['column'])) {
	$category_column = $_POST['column'];
} elseif (!empty($category_info)) {
	$category_column = $category_info['column'];
} else {
	$category_column = 1;
}

if (isset($_POST['sort_order'])) {
	$category_sort_order = $_POST['sort_order'];
} elseif (!empty($category_info)) {
	$category_sort_order = $category_info['sort_order'];
} else {
	$category_sort_order = 0;
}

if (isset($_POST['status'])) {
	$category_status = $_POST['status'];
} elseif (!empty($category_info)) {
	$category_status = $category_info['status'];
} else {
	$category_status = true;
}

// @todo category layouts here if needed

// Nội dung riêng của trang:
$web_content = "../ui/admin/view/view-category-form.php";

check_file_layout($web_layout_admin, $web_content);

// được đặt vào bố cục chung của toàn site:
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;