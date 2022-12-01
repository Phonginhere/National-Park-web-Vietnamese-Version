<?php 
/**
 * Copyright Le Minh Hoa
 *
 * Trang thêm mới bình luận cho bài viết
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.comment.php';
include_once 'lib/table/table.customer.php';

// Nếu khách hàng chưa đăng nhập thì điều hướng sang trang login
check_login_home();
	
if ( $_SERVER['REQUEST_METHOD'] == "POST")
{
	// @todo Thông báo thêm bình luận thành công, đang chờ duyệt !
	if (isset($_POST['content']) && $_POST['content']!=null)
		commentAdd($_POST);
	
	// Điều hướng tới bài viết đó
	header ("location: /blog-post.php?post_id=".$_POST['post_id']);
}

	

