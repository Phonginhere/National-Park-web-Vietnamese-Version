<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Form thông tin lời chứng thực
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.job.php';
include_once '../lib/tool.image.php';

$url = '?';

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

/*
 Form Action
 */
if (!isset($_GET['job_id'])) 
{
	$url_action = "/admin/job-add.php";
} 
else 
{
	$url_action = "/admin/job-edit.php?job_id=".$_GET['job_id'];
}

/*
 Đường link cho nút Cancel
 */
$url_cancel = "/admin/job.php";

/*
 Lấy thông tin bản ghi (dựa trên id) và gửi sang bên view
 */
if (isset($_GET['job_id']) && $_SERVER['REQUEST_METHOD'] != "POST") 
{
	$job_info = jobGetById($_GET['job_id']);
}

// Tên nghề nghiệp
if (isset($_POST['title'])) 
{
     $title = $_POST['title'];  // form submit thì cập nhật lại giá trị của biến trước khi lưu vào db
} 
elseif (!empty($job_info)) 
{
     $title = $job_info['title']; // sửa thì tải dữ liệu lên view html
} 
else 
{
     $title = '';    // Thêm mới thì trống rỗng.
}

// Mã nghề nghiệp 
if (isset($_POST['code'])) 
{
     $code = $_POST['code'];
} 
elseif (!empty($job_info)) 
{
     $code = $job_info['code']; 
} 
else 
{
     $code = '';   
}


// Lương Tối Thiểu
if (isset($_POST['min_salary'])) 
{
     $min_salary = $_POST['min_salary'];
} 
elseif (!empty($job_info)) 
{
     $min_salary = $job_info['min_salary']; 
} 
else 
{
     $min_salary = '3500000';   // 3,500,000 vnd
}

// Lương Tối Đa
if (isset($_POST['max_salary'])) 
{
     $max_salary = $_POST['max_salary'];
} 
elseif (!empty($job_info)) 
{
     $max_salary = $job_info['max_salary']; 
} 
else 
{
     $max_salary = '35000000';   // 35,000,000 vnd
}

//// Trạng thái của lời chứng thực
//// (cho phép hoặc không cho phép hiện lên ở trang chủ Home-Front End)
//if (isset($_POST['status'])) 
//{
//     $status = $_POST['status'];
//} 
//elseif (!empty($job_info)) 
//{
//     $status = $job_info['status'];
//} 
//else 
//{
//     $status = 0;
//}		

//// Trật tự của bản ghi
//// (thứ tự xuất hiện lên ở trang chủ Home-Front End)
//if (isset($_POST['sort_order'])) 
//{
//     $sort_order = $_POST['sort_order'];
//} 
//elseif (!empty($job_info)) 
//{
//     $sort_order = $job_info['sort_order'];
//} 
//else 
//{
//     $sort_order = 0;
//}

// Nội dung riêng của trang:
$web_content = "../ui/admin/view/view-job-form.php";

check_file_layout($web_layout_admin, $web_content);

// được đặt vào bố cục chung của toàn site:
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;
