<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Form sửa/xóa bài viết
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.post.php';
include_once '../lib/table/table.post_category.php';
include_once '../lib/table/table.user.php';

include_once '../lib/tool.image.php';

$url = ''; // lưu các tham số phân trang, sắp xếp, tìm kiếm để gắn vào link add, edit

if (isset($_REQUEST['filter_title'])) 
{
     $url .= '&filter_title=' . urlencode(html_entity_decode($_REQUEST['filter_title'], ENT_QUOTES, 'UTF-8'));
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
if (!isset($_GET['post_id'])) 
{
	// Thêm mới
	$url_action = "/admin/post-add.php?".$url;
} 
else 
{
	// Sửa
	$url_action = "/admin/post-edit.php?post_id=".$_GET['post_id'].$url;
}

// Nếu giao diện Form được mở ra để sửa:
if ( $_SERVER['REQUEST_METHOD'] != "POST" && isset($_GET['post_id']) ) 
{
	$post_info = postById($_REQUEST['post_id']);
}
        // Các biến dưới đây được xử lý trước khi gửi sang view
// Tựa đề bài viết
if (isset($_POST['title'])) // form submitted (add/edit)
{
	$post_title = $_POST['title'];
} 
elseif (isset($_GET['post_id'])) 
{	// Sửa
	$post_title = $post_info['title'];
} 
else 
{	// Thêm mới
	$post_title = '';	
}

// Nội dung bài viết 
if (isset($_POST['content'])) // form submitted but error of invalid data
{
	$content = $_POST['content'];
} 
elseif (isset($_GET['post_id'])) 
{	// Sửa
	$content = $post_info['content']; // form open to edit
} 
else 
{	// Thêm mới
	$content = '';	// form open to add new
}

// Menu bài viết
if (isset($_POST['menu'])) // form submitted (add/edit)
{
	$post_menu = $_POST['menu'];
} 
elseif (isset($_GET['post_id'])) 
{	// Sửa
	$post_menu = $post_info['menu'];
} 
else 
{	// Thêm mới
	$post_menu = '';	
}

// Tags
if (isset($_POST['tag'])) // form submitted (add/edit)
{
	$post_tag = $_POST['tag'];
} 
elseif (isset($_GET['post_id'])) 
{	// Sá»­a
	$post_tag = $post_info['tag'];
} 
else 
{	// Thêm mới
	$post_tag = '...';	
}

// Link
if (isset($_POST['link'])) // form submitted (add/edit)
{
	$post_link = $_POST['link'];
} 
elseif (isset($_GET['post_id'])) 
{	// Sá»­a
	$post_link = $post_info['link'];
} 
else 
{	// Thêm mới
	$post_link = '...';	
}

// ảnh chi tiết bài viết
if (isset($_POST['image'])) 
{
    // Có lỗi form
     $post_image = $_POST['image'];
} 
elseif (!empty($post_info)) 
{	// Sửa
     $post_image = $post_info['image'];
} 
else 
{	// Thêm mới
     $post_image = '';	
}

if (isset($_POST['top'])) 
{
    // Có lỗi form
	$post_top = $_POST['top'];
} 
elseif (!empty($post_info)) 
{
    // Sửa
	$post_top = $post_info['top'];
} 
else 
{
    // Thêm mới
	$post_top = 0;
}

// post Thumb Image
if (isset($_POST['image']) && is_file(DIR_IMAGE . $_POST['image'])) 
{
     $post_thumb = img_resize($_POST['image'], 100, 100);
} 
elseif (!empty($post_info) && is_file(DIR_IMAGE . $post_info['image'])) 
{
     $post_thumb = img_resize($post_info['image'], 100, 100);
} 
else 
{
     $post_thumb = img_resize('no_image.png', 100, 100);
}

$post_image_placeholder = img_resize('no_image.png', 100, 100); 


if (isset($_POST['sort_order'])) 
{
     $post_sort_order = $_POST['sort_order'];
} 
elseif (!empty($post_info)) 
{
     $post_sort_order = $post_info['sort_order'];
} 
else 
{
     $post_sort_order = 1;
}

// bài viết nổi bật
if (isset($_POST['featured']))
{
	$post_featured = $_POST['featured'];
}
elseif (!empty($post_info))
{
	$post_featured = $post_info['featured'];
}
else
{
	$post_featured= false;
}

// Trạng thái của bài viết: cho phép xuất hiện/ không cho 
if (isset($_POST['status'])) 
{
     $post_status = $_POST['status'];
} 
elseif (!empty($post_info)) 
{
     $post_status = $post_info['status'];
} 
else 
{
     $post_status = true;
}

// Tên bài viết cha
if (isset($_POST['path'])) 
{
	$post_path = $_POST['path'];
} 
elseif (!empty($post_info)) 
{
	$post_path = $post_info['path'];
} 
else 
{
	$post_path = '';
}

// Mã bài viết cha
if (isset($_POST['parent_id'])) 
{
	$post_parent_id = $_POST['parent_id'];
} 
elseif (!empty($post_info)) 
{
	$post_parent_id = $post_info['parent_id'];
} 
else 
{
	$post_parent_id = 0;
}

// Tác giả bài viết
if (isset($_POST['author_id'])) 
{
     $author_id = $_POST['author_id'];
} 
elseif (!empty($post_info)) 
{
     $author_id = $post_info['author_id'];
} 
else 
{
     $author_id = 0;
}
		
if (isset($_POST['author'])) 
{
    $author = $_POST['author']; // form gửi lên nhưng bị lỗi !
} 
elseif (!empty($post_info)) 
{
	$author_info = userGetById($post_info['author_id']); // form mở ra để sửa

	if ($author_info) 
	{
		 $author = $author_info['fullname'];
	} 
	else 
	{
		 $author = '';
	}
} 
else 
{
     $author = '';
}

// Phía giao diện gửi lên 1 mảng các thẻ
// <input type="hidden" name="post_category[]" />
// ---> Nhận lấy một mảng chỉ số, mỗi phần tử là giá trị của một `category_id`
if (isset($_POST['post_category'])) 
{
	$categories = $_POST['post_category']; // form gửi lên nhưng lỗi
} 
elseif (isset($_GET['post_id'])) 
{
	$categories = postCategories($_GET['post_id']); // form mở ra để sửa
} 
else 
{
	$categories = array();
}

// Với mỗi `category_id` thì lấy ra đầy đủ thông tin về Phân Loại của bài viết này
// và gửi sang bên view html để duyệt mảng này
$post_categories = array();
foreach ($categories as $category_id) 
{
	$category_info = post_categoryGetById($category_id); // phân biệt với hàm categoryGetById($id) của table.category.php

	if ($category_info) 
	{
		$post_categories[] = array(
			'category_id' => $category_info['category_id'],
			'name' => ($category_info['path']) ? $category_info['path'] . ' &gt; ' . $category_info['name'] : $category_info['name']
		);
	}
}

if (isset($_POST['post_image'])) 
{
	$images = $_POST['post_image']; // form gửi lên bị lỗi dữ liệu
} 
elseif (isset($_GET['post_id'])) 
{	
	$images = postGetImages($_GET['post_id']); // form mở ra để sửa
} 
else {	
	$images = array();  // form mở ra để thêm mới
}

$post_images = array();

// Với mỗi ảnh của bài viết thì cần tinh chỉnh, định dạng lại
// trước khi gửi sang view html
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

	$post_images[] = array(
		'image'      => $image,
		'thumb'      => img_resize($thumb, 100, 100),
		'sort_order' => $item['sort_order'],
        'title'      => $item['title'],
        'description' => $item['description'],
	);
}

// Nội dung riêng của trang
$web_content = "../ui/admin/view/view-post-form.php";

check_file_layout($web_layout_admin, $web_content);

// Được đặt trong bố cục chung của toàn site
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;