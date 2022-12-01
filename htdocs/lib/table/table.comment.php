<?php
/**
 * Copyright Le Minh Hoa
 *
 * Các hàm quản lý bình luận bài viết
 */

/**
 * @abstract Thêm mới bình luận cho bài viết.
 * @todo Ban đầu status nên bằng 0 (không duyệt, không cho phép).
 *       Chỉ khi nào admin duyệt thì comment đó mới được hiện lên.
 *       Ở đây để cho status=1 luôn ngay sau khi thêm comment là để test cho nhanh
 *       trên trang /blog-post.php?post_id=3
 * 
 * @param array $data Mảng dữ liệu gửi lên từ $_POST
 * @return number Trả về khóa chính của bản ghi vừa thêm vào.
 */
function commentAdd($data)
{
	// Tinh chỉnh dữ liệu thô
	$content = db_escape($data['content']); 
	
    $customer_id = (int)$data['customer_id'];
    $post_id = (int)$data['post_id'];

	// Nhúng dữ liệu vào câu sql
	$sql = " 
		INSERT INTO `comment`
		SET content = '{$content}',
			customer_id = '{$customer_id}',
            post_id = '{$post_id}', 
		    status = '1',
			date_added = NOW(),
			date_modified = NOW()
	";
		
	// Thêm mới bản ghi
	db_q($sql);
			
	// Lấy lại id của bản ghi vừa chèn vào
	$comment_id = (int)db_lastId();
			
	return $comment_id;
		
}	// kết thúc hàm thêm mới 'Liên Hệ'

/**
 @description Lấy ra toàn bộ các bản ghi bài viết (có phân trang) của loại bài viết truyền vào
 @return array Mảng chỉ số, mỗi phần tử là mảng kết hợp biểu diễn một bản ghi bài viết
 $filter_data = array(
 'filter_category_id' => $category_id,
 'filter_filter'      => $filter,
 'sort'               => $sort,
 'order'              => $order,
 'start'              => ($page - 1) * $limit,
 'limit'              => $limit
 );
 */
function commentGetAllForPost($data = array())
{
	$post_id = (int)$data['filter_post_id'];
	$sql = "
		SELECT 
			co.content,
			cu.fullname,
			co.date_added
		FROM `comment` AS co
		LEFT JOIN `customer` AS cu ON (co.customer_id = cu.customer_id)
		WHERE co.status = '1' AND co.post_id = '{$post_id}'
		ORDER BY co.date_added DESC
	";
	
	// Phân trang
	if (isset($data['start']) || isset($data['limit']))
	{
		if ($data['start'] < 0)
		{
			$data['start'] = 0;
		}
		
		if ($data['limit'] < 1)
		{
			$data['limit'] = 20;
		}
		
		$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
	}
	
	//echo $sql;
	return db_q($sql);
}

/**
 * @abstract Đếm tổng số bình luận của 1 bài viết.
 * @param array $data Dữ liệu đẩy lên từ $_POST
 * @return number Trả về tổng số comment.
 */
function commentGetTotalForPost($data = array())
{
	$post_id = (int)$data['filter_post_id'];
	
	$sql = "
		SELECT COUNT(DISTINCT co.comment_id) AS total
		FROM `comment` AS co
		WHERE co.status = '1' AND co.post_id = '{$post_id}'
	";
	
	return (int)db_one($sql);
	
}
