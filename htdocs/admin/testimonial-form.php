<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Form thông tin lời chứng thực
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.testimonial.php';
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
if (!isset($_GET['testimonial_id'])) 
{
	$url_action = "/admin/testimonial-add.php";
} 
else 
{
	$url_action = "/admin/testimonial-edit.php?testimonial_id=".$_GET['testimonial_id'];
}

/*
 Đường link cho nút Cancel
 */
$url_cancel = "/admin/testimonial.php";

/*
 Lấy thông tin bản ghi (dựa trên id) và gửi sang bên view
 */
if (isset($_GET['testimonial_id']) && $_SERVER['REQUEST_METHOD'] != "POST") 
{
	$testimonial_info = testimonialGetById($_GET['testimonial_id']);
}

// Tên khách hàng nói lời chứng thực
if (isset($_POST['input_name'])) 
{
     $name = $_POST['input_name'];  // form submit(add/edit) but data invalid !
} 
elseif (!empty($testimonial_info)) 
{
     $name = $testimonial_info['name']; // sửa thì tải dữ liệu lên view html
} 
else 
{
     $name = '';    // Thêm mới thì trống rỗng.
}

// Tuổi
if (isset($_POST['input_age'])) 
{
     $age = $_POST['input_age'];  
} 
elseif (!empty($testimonial_info)) 
{
     $age = $testimonial_info['age']; 
} 
else 
{
     $age = '';    // Thêm mới thì trống rỗng.
}

// Địa chỉ
if (isset($_POST['input_address'])) 
{
     $address = $_POST['input_address'];  
} 
elseif (!empty($testimonial_info)) 
{
     $address = $testimonial_info['address']; 
} 
else 
{
     $address = '';    
}

// Nghề nghiệp khách hàng
if (isset($_POST['input_job'])) 
{
     $job = $_POST['input_job'];
} 
elseif (!empty($testimonial_info)) 
{
     $job = $testimonial_info['job']; 
} 
else 
{
     $job = '';   
}

// Tiêu đề lời chứng thực
if (isset($_POST['input_title'])) 
{
     $title = $_POST['input_title'];
} 
elseif (!empty($testimonial_info)) 
{
     $title = $testimonial_info['title']; 
} 
else 
{
     $title = '';   
}

// Nội dung lời chứng thực
if (isset($_POST['input_content'])) 
{
     $content = $_POST['input_content'];
} 
elseif (!empty($testimonial_info)) 
{
     $content = $testimonial_info['content']; 
} 
else 
{
     $content = '';   
}

// Ảnh đại diện khách hàng nói lời chứng thực
// (giá trị gán cho thẻ input hidden)
if (isset($_POST['input_image'])) 
{
     $image = $_POST['input_image'];
} 
elseif (!empty($testimonial_info)) 
{
     $image = $testimonial_info['image'];
} 
else 
{
     $image = '';
}

if (isset($_POST['input_image']) && is_file(DIR_IMAGE . $_POST['input_image'])) 
{
     $thumb = img_resize($_POST['input_image'], 100, 100);  // Nếu ảnh mới được submit lên
} 
elseif (!empty($testimonial_info) && $testimonial_info['image'] && is_file(DIR_IMAGE . $testimonial_info['image'])) 
{
     $thumb = img_resize($testimonial_info['image'], 100, 100); // Nếu đang là sửa bản ghi
} 
else 
{
     $thumb = img_resize('no_image.png', 100, 100); // Nếu đang là thêm mới bản ghi
}
		
$placeholder = img_resize('no_image.png', 100, 100);

// Trạng thái của lời chứng thực
// (cho phép hoặc không cho phép hiện lên ở trang chủ Home-Front End)
if (isset($_POST['input_status'])) 
{
     $status = $_POST['input_status'];
} 
elseif (!empty($testimonial_info)) 
{
     $status = $testimonial_info['status'];
} 
else 
{
     $status = 0;
}		

// Trật tự của lời chứng thực
// (thứ tự xuất hiện lên ở trang chủ Home-Front End)
if (isset($_POST['input_sort_order'])) 
{
     $sort_order = $_POST['input_sort_order'];
} 
elseif (!empty($testimonial_info)) 
{
     $sort_order = $testimonial_info['sort_order'];
} 
else 
{
     $sort_order = 0;
}	

// Nội dung riêng của trang:
$web_content = "../ui/admin/view/view-testimonial-form.php";

check_file_layout($web_layout_admin, $web_content);

// được đặt vào bố cục chung của toàn site:
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;
