<?php 
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Form sửa/xóa loại bài viết
 */

include_once '../configs.php';

include_once '../lib/table/table.post_category.php';
include_once '../lib/tool.image.php';

// form action
if (!isset($_GET['category_id'])) {	
	$url_action = "/admin/post_category-add.php";
} else {	
	$url_action = '/admin/post_category-edit.php?category_id='.$_GET['category_id'];
}

// edit
if ( isset($_GET['category_id']) && $_SERVER['REQUEST_METHOD'] != "POST" )  
{ 
	$post_category_info = post_categoryGetById($_GET['category_id']);
}

if (isset($_POST['post_category_name']))	// form submitted (add/edit) 
{ 
	$post_category_name = $_POST['post_category_name'];
} elseif (isset($_GET['category_id'])) {	// edit
	$post_category_name = $post_category_info['name'];
} else {	// add
	$post_category_name = "";
}

if (isset($_POST['post_category_description']))	// form submitted (add/edit) 
{ 
	$post_category_description = $_POST['post_category_description'];
} elseif (isset($_GET['category_id'])) {	// edit
	$post_category_description = $post_category_info['description'];
} else {	// add
	$post_category_description = "";
}

if (isset($_POST['post_category_featured']))	// form submitted (add/edit)
{
	$post_category_featured = $_POST['post_category_featured'];
} elseif (isset($_GET['category_id'])) {	// edit
	$post_category_featured = $post_category_info['featured'];
} else {	// add
	$post_category_featured = "";
}

if (isset($_POST['path'])) {
	$post_category_path = $_POST['path'];
} elseif (!empty($post_category_info)) {
	$post_category_path = $post_category_info['path'];
} else {
	$post_category_path = '';
}

if (isset($_POST['parent_id'])) {
	$post_category_parent_id = $_POST['parent_id'];
} elseif (!empty($post_category_info)) {
	$post_category_parent_id = $post_category_info['parent_id'];
} else {
	$post_category_parent_id = 0;
}


// @todo post_category_filters here if needed

// @todo post_category stores here if needed

if (isset($_POST['keyword'])) {
	$post_category_keyword = $_POST['keyword'];
} elseif (!empty($post_category_info)) {
	$post_category_keyword = $post_category_info['keyword'];
} else {
	$post_category_keyword = '';
}

if (isset($_POST['image'])) {
	$post_category_image = $_POST['image'];
} elseif (!empty($post_category_info)) {
	$post_category_image = $post_category_info['image'];
} else {
	$post_category_image = null;
}

// post_category Image

if (isset($_POST['image']) && is_file(DIR_IMAGE . $_POST['image'])) {
	$post_category_thumb = img_resize($_POST['image'], 100, 100);
} elseif (!empty($post_category_info) && is_file(DIR_IMAGE . $post_category_info['image'])) {
	$post_category_thumb = img_resize($post_category_info['image'], 100, 100);
} else {
	$post_category_thumb = img_resize('no_image.png', 100, 100);
}

$post_category_placeholder = img_resize('no_image.png', 100, 100); // trÆ°á»�ng há»£p khÃ´ng cÃ³ áº£nh Ä‘áº¡i diá»‡n

if (isset($_POST['top'])) {
	$post_category_top = $_POST['top'];
} elseif (!empty($post_category_info)) {
	$post_category_top = $post_category_info['top'];
} else {
	$post_category_top = 0;
}

if (isset($_POST['column'])) {
	$post_category_column = $_POST['column'];
} elseif (!empty($post_category_info)) {
	$post_category_column = $post_category_info['column'];
} else {
	$post_category_column = 1;
}

if (isset($_POST['sort_order'])) {
	$post_category_sort_order = $_POST['sort_order'];
} elseif (!empty($post_category_info)) {
	$post_category_sort_order = $post_category_info['sort_order'];
} else {
	$post_category_sort_order = 0;
}

if (isset($_POST['status'])) {
	$post_category_status = $_POST['status'];
} elseif (!empty($post_category_info)) {
	$post_category_status = $post_category_info['status'];
} else {
	$post_category_status = true;
}

// @todo post_category layouts here if needed

// Nội dung riêng của trang:
$web_content = "../ui/admin/view/view-post_category-form.php";

check_file_layout($web_layout_admin, $web_content);

// được đặt vào bố cục chung của toàn site:
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;