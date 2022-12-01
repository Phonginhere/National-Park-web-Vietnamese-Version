<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Form sửa/xóa ảnh banner
 */
// Cấu hình hệ thống
include_once '../configs.php';
// Thư viện hàm
include_once '../lib/table/table.banner_image.php';
include_once '../lib/tool.image.php';

$url = '';

if (isset($_GET['sort'])) 
{
	$url .= '&sort=' . $_GET['sort'];
}

if (isset($_GET['order'])) 
{
	$url .= '&order=' . $_GET['order'];
}

if (isset($_GET['page'])) 
{
	$url .= '&page=' . $_GET['page'];
}

// form action
if (!isset($_GET['banner_id'])) {
	$url_action = "/admin/banner-image-add.php";
} else {
	$url_action = '/admin/banner-image-edit.php?banner_id=' . $_GET['banner_id'];
}

$url_cancel = "/admin/banner-image.php";

if (isset($_GET['banner_id']) && ($_SERVER['REQUEST_METHOD'] != 'POST')) 
{
	$banner_image_info = banner_imageById($_GET['banner_id']);
}

if (isset($_POST['title'])) 
{
	$banner_image_title = $_POST['title'];
} elseif (!empty($banner_image_info)) {
	$banner_image_title = $banner_image_info['title'];
} else {
	$banner_image_title = '';
}

if (isset($_POST['sub_title']))
{
	$banner_image_sub_title = $_POST['sub_title'];
} elseif (!empty($banner_image_info)) {
	$banner_image_sub_title = $banner_image_info['sub_title'];
} else {
	$banner_image_sub_title = '';
}

if (isset($_POST['description']))
{
	$banner_image_description = $_POST['description'];
} elseif (!empty($banner_image_info)) {
	$banner_image_description = $banner_image_info['description'];
} else {
	$banner_image_description = '';
}

if (isset($_POST['link']))
{
	$banner_image_link = $_POST['link'];
} elseif (!empty($banner_image_info)) {
	$banner_image_link = $banner_image_info['link'];
} else {
	$banner_image_link = '';
}

if (isset($_POST['image'])) {
	$banner_image = $_POST['image'];
} elseif (!empty($banner_image_info)) {
	$banner_image = $banner_image_info['image'];
} else {
	$banner_image = '';
}

if (isset($_POST['image']) && is_file(DIR_IMAGE . $_POST['image'])) {
	$banner_thumb = img_resize($_POST['image'], 100, 100);
} elseif (!empty($banner_image_info) && is_file(DIR_IMAGE . $banner_image_info['image'])) {
	$banner_thumb = img_resize($banner_image_info['image'], 100, 100);
} else {
	$banner_thumb = img_resize('no_image.png', 100, 100);
}

$banner_placeholder = img_resize('no_image.png', 100, 100);

if (isset($_POST['sort_order'])) {
	$sort_order = $_POST['sort_order'];
} elseif (!empty($banner_image_info)) {
	$sort_order = $banner_image_info['sort_order'];
} else {
	$sort_order = '';
}

// Trạng thái banner
if (isset($_POST['status']))
{
	$banner_image_status = $_POST['status'];
}
elseif (!empty($banner_image_info))
{
	$banner_image_status = $banner_image_info['status'];
}
else
{
	$banner_image_status = true;
}

// Nội dung riêng của trang
$web_content = "../ui/admin/view/view-banner-image-form.php";

check_file_layout($web_layout_admin, $web_content);

// Được đặt vào bố cục chung của toàn site:
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;