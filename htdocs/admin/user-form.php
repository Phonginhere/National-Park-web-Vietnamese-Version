<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Form thông tin nhân viên quản trị
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.user.php';
include_once '../lib/table/table.job.php';  // bảng ngoại
include_once '../lib/table/table.department.php';   // bảng ngoại
include_once '../lib/tool.image.php';

$url = '?';

if (isset($_GET['sort'])) {
     $url .= '&sort=' . $_GET['sort'];
}

if (isset($_GET['order'])) {
     $url .= '&order=' . $_GET['order'];
}

if (isset($_GET['page'])) {
     $url .= '&page=' . $_GET['page'];
}

/*
 Form Action
 */
if (!isset($_GET['user_id'])) {
	$url_action = "/admin/user-add.php";
} else {
	$url_action = "/admin/user-edit.php?user_id=".$_GET['user_id'];
}

/*
 Đường link cho nút Cancel
 */
$url_cancel = "/admin/user.php";

/*
 Lấy thông tin bản ghi (dựa trên id) và gửi sang bên view
 */
if (isset($_GET['user_id']) && $_SERVER['REQUEST_METHOD'] != "POST") 
{
	$user_info = userGetById($_GET['user_id']);
}

// Tên đăng nhập
if (isset($_POST['username'])) {
     $username = $_POST['username'];
} elseif (!empty($user_info)) {
     $username = $user_info['username'];
} else {
     $username = '';
}

// Mật khẩu
if (isset($_POST['password'])) {
     $password = $_POST['password'];
} else {
     $password = '';
}

// Xác nhận mật khẩu
if (isset($_POST['confirm'])) {
     $confirm_password = $_POST['confirm_password'];
} else {
     $confirm_password = '';
}

// Tên đầy đủ
if (isset($_POST['fullname'])) {
     $fullname = $_POST['fullname'];
} elseif (!empty($user_info)) {
     $fullname = $user_info['fullname'];
} else {
     $fullname = '';
}

// Thư điện tử
if (isset($_POST['email'])) {
     $email = $_POST['email'];
} elseif (!empty($user_info)) {
     $email = $user_info['email'];
} else {
     $email = '';
}

// Điện thoại
if (isset($_POST['phone'])) 
{
     $input_phone = $_POST['phone'];  // Form submit lên nhưng có lỗi kiểm duyệt(validation error).
} 
elseif (!empty($user_info)) 
{
     $input_phone = $user_info['phone'];  // Form Edit (khi sửa thì dữ liệu của bản ghi được tải lên giao diện html).
} 
else 
{
     $input_phone = '';   // Form Add (Thêm Mới) được mở ra.
}

// Mã phòng ban
if (isset($_POST['department_id'])) 
{
     $department_id = $_POST['department_id'];
} 
elseif (!empty($user_info)) 
{
     $department_id = $user_info['department_id'];
} 
else 
{
     $department_id = 0;
}

// Tên phòng ban
if (isset($_POST['department_name'])) 
{
    $department_name = $_POST['department_name'];
} 
elseif (!empty($user_info)) 
{
	$department_info = departmentGetById($user_info['department_id']);

	if ($department_info) 
	{
		 $department_name = $department_info['name'];
	} 
	else 
	{
		 $department_name = '';
	}
} 
else 
{
     $department_name = '';
}


// Mã chức danh, công việc
if (isset($_POST['job_id'])) 
{
     $job_id = $_POST['job_id'];
} 
elseif (!empty($user_info)) 
{
     $job_id = $user_info['job_id'];
} 
else 
{
     $job_id = 0;
}

// Có phải là nhân sự chuyên gia
if (isset($_POST['specialist']))	// form submitted (add/edit) but invalid data
{
	$specialist = $_POST['specialist'];
} 
elseif (!empty($user_info))     // edit
{	
	$specialist = $user_info['specialist'];
} 
else    // add
{	
	$specialist = "";
}

// Tên chức danh
if (isset($_POST['job_title'])) 
{
    $job_title = $_POST['job_title'];
} 
elseif (!empty($user_info)) 
{
	$job_info = jobGetById($user_info['job_id']);

	if ($job_info) 
	{
		 $job_title = $job_info['title'];
	} 
	else 
	{
		 $job_title = '';
	}
} 
else 
{
     $job_title = '';
}

// Ảnh đại diện
if (isset($_POST['image'])) {
     $user_image = $_POST['image'];
} elseif (!empty($user_info)) {
     $user_image = $user_info['image'];
} else {
     $user_image = '';
}

if (isset($_POST['image']) && is_file(DIR_IMAGE . $_POST['image'])) {
     $user_thumb = img_resize($_POST['image'], 100, 100);
} elseif (!empty($user_info) && $user_info['image'] && is_file(DIR_IMAGE . $user_info['image'])) {
     $user_thumb = img_resize($user_info['image'], 100, 100);
} else {
     $user_thumb = img_resize('no_image.png', 100, 100);
}
		
$user_placeholder = img_resize('no_image.png', 100, 100);

// Trật tự sắp xếp
if (isset($_POST['sort_order'])) {
	$sort_order = $_POST['sort_order'];
} elseif (!empty($user_info)) {
	$sort_order = $user_info['sort_order'];
} else {
	$sort_order = 0;
}

// TRạng thái
if (isset($_POST['status'])) {
     $user_status = $_POST['status'];
} elseif (!empty($user_info)) {
     $user_status = $user_info['status'];
} else {
     $user_status = 0;
}		

// Mô tả
if (isset($_POST['description']))	// form submitted (add/edit)
{
	$description = $_POST['description'];
} 
elseif (isset($_GET['user_id'])) 
{	// edit form opens
	$description = $user_info['description'];
} 
else 
{	// add form opens
	$description = "";
}

// Nội dung riêng của trang:
$web_content = "../ui/admin/view/view-user-form.php";

check_file_layout($web_layout_admin, $web_content);

// được đặt vào bố cục chung của toàn site:
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;
