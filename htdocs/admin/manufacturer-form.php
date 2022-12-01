<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Form sửa/xóa nhà sản xuất
 */
// Cấu hình hệ thống
include_once '../configs.php';
// Thư viện hàm
include_once '../lib/table/table.manufacturer.php';
include_once '../lib/tool.image.php';

$url = '';

		if (isset($_GET['sort'])) {
			$url .= '&sort=' . $_GET['sort'];
		}

		if (isset($_GET['order'])) {
			$url .= '&order=' . $_GET['order'];
		}

		if (isset($_GET['page'])) {
			$url .= '&page=' . $_GET['page'];
		}

// form action
if (!isset($_GET['manufacturer_id'])) {
	$url_action = "/admin/manufacturer-add.php";
} else {
	$url_action = '/admin/manufacturer-edit.php?manufacturer_id=' . $_GET['manufacturer_id'];
}

$url_cancel = "/admin/manufacturer.php";

// Náº¿u Ä‘ang lÃ  edit thÃ¬ láº¥y thÃ´ng tin báº£n ghi theo id vÃ  gá»­i sang view
if (isset($_GET['manufacturer_id']) && ($_SERVER['REQUEST_METHOD'] != 'POST')) {
	$manufacturer_info = manufacturerGetById($_GET['manufacturer_id']);
}

if (isset($_POST['name'])) 
{
	$manufacturer_name = $_POST['name'];
} elseif (!empty($manufacturer_info)) {
	$manufacturer_name = $manufacturer_info['name'];
} else {
	$manufacturer_name = '';
}

if (isset($_POST['keyword'])) 
{
	$manufacturer_keyword = $_POST['keyword'];
} elseif (!empty($manufacturer_info)) {
	$manufacturer_keyword = $manufacturer_info['keyword'];
} else {
	$manufacturer_keyword = '';
}

if (isset($_POST['image'])) {
	$manufacturer_image = $_POST['image'];
} elseif (!empty($manufacturer_info)) {
	$manufacturer_image = $manufacturer_info['image'];
} else {
	$manufacturer_image = '';
}

if (isset($_POST['image']) && is_file(DIR_IMAGE . $_POST['image'])) {
	$manufacturer_thumb = img_resize($_POST['image'], 100, 100);
} elseif (!empty($manufacturer_info) && is_file(DIR_IMAGE . $manufacturer_info['image'])) {
	$manufacturer_thumb = img_resize($manufacturer_info['image'], 100, 100);
} else {
	$manufacturer_thumb = img_resize('no_image.png', 100, 100);
}

$manufacturer_placeholder = img_resize('no_image.png', 100, 100);

if (isset($_POST['sort_order'])) {
	$sort_order = $_POST['sort_order'];
} elseif (!empty($manufacturer_info)) {
	$sort_order = $manufacturer_info['sort_order'];
} else {
	$sort_order = '';
}

// Nhà sản xuất nổi bật
if (isset($_POST['featured']))
{
	$manufacturer_featured = $_POST['featured'];
}
elseif (!empty($manufacturer_info))
{
	$manufacturer_featured = $manufacturer_info['featured'];
}
else
{
	$manufacturer_featured= true;
}

// Nội dung riêng của trang
$web_title = 'Nhà Sản Xuất';
$web_content = "../ui/admin/view/view-manufacturer-form.php";

check_file_layout($web_layout_admin, $web_content);

// Được đặt vào bố cục chung của toàn site:
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;