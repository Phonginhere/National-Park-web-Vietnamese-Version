<?php 
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Form thêm/sửa phòng ban
 */

include_once '../configs.php';

include_once '../lib/table/table.department.php';
include_once '../lib/tool.image.php';

// form action
if (!isset($_GET['department_id'])) {	
	$url_action = "/admin/department-add.php";
} else {	
	$url_action = '/admin/department-edit.php?department_id='.$_GET['department_id'];
}

// edit
if ( isset($_GET['department_id']) && $_SERVER['REQUEST_METHOD'] != "POST" )  
{ 
	$department_info = departmentGetById($_GET['department_id']);
}

if (isset($_POST['department_name']))	// form submitted (add/edit) 
{ 
	$department_name = $_POST['department_name'];
} elseif (isset($_GET['department_id'])) {	// edit
	$department_name = $department_info['name'];
} else {	// add
	$department_name = "";
}

if (isset($_POST['description']))	// form submitted (add/edit) 
{ 
	$department_description = $_POST['description'];
} elseif (isset($_GET['department_id'])) {	// edit
	$department_description = $department_info['description'];
} else {	// add
	$department_description = "";
}

if (isset($_POST['department_featured']))	// form submitted (add/edit)
{
	$department_featured = $_POST['department_featured'];
} elseif (isset($_GET['department_id'])) {	// edit
	$department_featured = $department_info['featured'];
} else {	// add
	$department_featured = "";
}

if (isset($_POST['path'])) {
	$department_path = $_POST['path'];
} elseif (!empty($department_info)) {
	$department_path = $department_info['path'];
} else {
	$department_path = '';
}

if (isset($_POST['parent_id'])) {
	$department_parent_id = $_POST['parent_id'];
} elseif (!empty($department_info)) {
	$department_parent_id = $department_info['parent_id'];
} else {
	$department_parent_id = 0;
}


// @todo department_filters here if needed

// @todo department stores here if needed

if (isset($_POST['keyword'])) {
	$department_keyword = $_POST['keyword'];
} elseif (!empty($department_info)) {
	$department_keyword = $department_info['keyword'];
} else {
	$department_keyword = '';
}

if (isset($_POST['image'])) {
	$department_image = $_POST['image'];
} elseif (!empty($department_info)) {
	$department_image = $department_info['image'];
} else {
	$department_image = null;
}

// department Image

if (isset($_POST['image']) && is_file(DIR_IMAGE . $_POST['image'])) {
	$department_thumb = img_resize($_POST['image'], 100, 100);
} elseif (!empty($department_info) && is_file(DIR_IMAGE . $department_info['image'])) {
	$department_thumb = img_resize($department_info['image'], 100, 100);
} else {
	$department_thumb = img_resize('no_image.png', 100, 100);
}

$department_placeholder = img_resize('no_image.png', 100, 100); // trÆ°á»�ng há»£p khÃ´ng cÃ³ áº£nh Ä‘áº¡i diá»‡n

if (isset($_POST['top'])) {
	$department_top = $_POST['top'];
} elseif (!empty($department_info)) {
	$department_top = $department_info['top'];
} else {
	$department_top = 0;
}

if (isset($_POST['column'])) {
	$department_column = $_POST['column'];
} elseif (!empty($department_info)) {
	$department_column = $department_info['column'];
} else {
	$department_column = 1;
}

if (isset($_POST['sort_order'])) {
	$department_sort_order = $_POST['sort_order'];
} elseif (!empty($department_info)) {
	$department_sort_order = $department_info['sort_order'];
} else {
	$department_sort_order = 0;
}

if (isset($_POST['status'])) {
	$department_status = $_POST['status'];
} elseif (!empty($department_info)) {
	$department_status = $department_info['status'];
} else {
	$department_status = true;
}

// mở rộng thêm một số trường thông tin liên hệ
if (isset($_POST['email'])) {
     $email = $_POST['email'];
} elseif (!empty($department_info)) {
     $email = $department_info['email'];
} else {
     $email = '';
}

if (isset($_POST['website'])) {
     $website = $_POST['website'];
} elseif (!empty($department_info)) {
     $website = $department_info['website'];
} else {
     $website = '';
}

if (isset($_POST['phone'])) {
	$phone = $_POST['phone'];
} elseif (!empty($department_info)) {
	$phone = $department_info['phone'];
} else {
	$phone = '';
}

if (isset($_POST['address'])) {
	$address = $_POST['address'];
} elseif (!empty($department_info)) {
	$address = $department_info['address'];
} else {
	$address = '';
}

if (isset($_POST['html_google_map'])) {
	$html_google_map = $_POST['html_google_map'];
} elseif (!empty($department_info)) {
	$html_google_map = $department_info['html_google_map'];
} else {
	$html_google_map = '';
}

// @todo department layouts here if needed

// Nội dung riêng của trang:
$web_content = "../ui/admin/view/view-department-form.php";

check_file_layout($web_layout_admin, $web_content);

// được đặt vào bố cục chung của toàn site:
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;