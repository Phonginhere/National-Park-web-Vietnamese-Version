<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang hiển thị bài viết, tin tức ở trang chủ
 *
 * Không thể dùng trang 'search-post.php' cho tính năng này vì nó có nhiều điểm khác biệt.
 * Học theo post_category.php (view) và search-post.php (controller)
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/tool.image.php';
include_once 'lib/table/table.post.php';
include_once 'lib/table/table.post_category.php';
include_once 'lib/table/table.user.php';
include_once 'lib/table/table.comment.php';

if (isset($_GET['post_id']))
{
	$post_id = (int)$_GET['post_id'];
}
else
{
	$post_id = 0;
}

// Thông tin bài viết gửi sang giao diện (view) html
$post_info = postInfo($post_id);

// Khi người dùng bấm vào một tag thì điều hướng sang
// trang tìm kiếm theo tag
$tags = array();
$tag_arr = explode(',', $post_info['tag']);
foreach($tag_arr as $item)
{
	$tags[] = array('tag'=>trim($item), 'href'=>'/blog.php?tag='.urlencode($item));
}

$filter_data = array('filter_post_id' => $_GET['post_id']);
// Tổng số comment:
$comment_total = commentGetTotalForPost($filter_data);
$comments = commentGetAllForPost($filter_data);


// Nội dung riêng của trang...
$web_title = $post_info['title'];
$web_content = "view/view-blog-post.php";

// ...được đặt vào bố cục chung của toàn site.
$web_layout = "ui/home/{$home_themes}/layout-blog.php";
include_once $web_layout;

