<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Các hàm quản lý bài viết
 */

// Thư viện hàm
include_once 'tool.image.php';
	
/**
 * @param array $data Mảng dữ liệu bài viết
 * @return int Mã bài viết
 * 
 * @abstractThêm mới bài viết
 */
function postAdd($data)
{
			// Thông tin chính của bài viết
			$title     = db_escape($data['title']);    // tựa đề bài viết
			$content   = db_escape($data['content']);  // nội dung bài viết
			$tag       = db_escape($data['tag']);      // các từ khóa liên quan
            $link      = db_escape($data['link']);     // đường dẫn riêng (nếu có)
            $menu      = db_escape($data['menu']);     // Menu trên trang chủ Home

            // Khóa ngoại trỏ sang bảng khác
            $author_id = (int)$data['author_id']; // tham chiếu sang bảng `user`

            // Thông tin để sắp xếp, tìm kiếm
            $featured   = (int)$data['featured'];       // tính chất nổi bật hay không
			$sort_order = (int)$data['sort_order'];    // trật tự sắp xếp
            $status     = (int)$data['status'];        // trạng thái: cho phép hay không cho phép nhìn thấy trên trang chủ

            $parent_id = (int)$data['parent_id'];
            $top = (isset($data['top']) ? (int)$data['top'] : 0);
			
			$sql = " 
				INSERT INTO `post`
				SET title = '{$title}',
                    content = '{$content}',
                    menu = '{$menu}',
                    `parent_id` = '{$parent_id}', 
                    `top` = '{$top}', 
					tag = '{$tag}', 
                    link = '{$link}',
                    author_id = '{$author_id}',
                    featured = '{$featured}',
                    sort_order = '{$sort_order}',
                    status = '{$status}',
					date_added = NOW(),
                    date_modified = NOW()
			";

			// Thực thi câu lệnh INSERT để thêm mới bản ghi
			db_q($sql);
			
			// Lấy lại khóa chính của bản ghi vừa thêm mới
			$post_id = (int)db_lastId();
			
			// Ảnh đại diện (Thumbnail Image)
			if (isset($data['image'])) 
            {
				$img = db_escape($data['image']);
				db_q("UPDATE `post` SET `image` = '{$img}' WHERE `post_id` = '{$post_id}'");
			}
			
			// Cách mà PHP xử lý một mảng các thẻ input phía giao diện html gửi lên
			// https://stackoverflow.com/questions/1010941/html-input-arrays
			// <input name="post_image[0][image]" value="apple" />
			// <input name="post_image[0][sort_order]" value="1" />
			
            // <input name="post_image[1][image]" value="pear" />
			// <input name="post_image[1][sort_order]" value="3" />
			
			// <input name="post_image[2][image]" value="bannana" />
			// <input name="post_image[2][sort_order]" value="5" />
			
			// Khi mảng các thẻ <input> đó gửi lên thì PHP sẽ hứng : $_POST['post_image']
			// và biến $_POST này được truyền như là đối số cho tham số $data của hàm này postAdd($data)
			
			// Bộ sưu tập ảnh của riêng bài viết này (post Image Collection/Gallery)
			if (isset($data['post_image'])) 
			{
				foreach ($data['post_image'] as $post_image) 
				{
					$image       = db_escape($post_image['image']);
                    $title       = db_escape($post_image['title']);
                    $description = db_escape($post_image['description']);

                    $sort_order  = (int)$post_image['sort_order'];
					
					// Nếu ảnh này đã được liên kết với bài viết rồi thì thôi, bỏ qua
					// và chuyển sang ảnh tiếp theo của bài viết.
					if(in_array($image, postImages($post_id)))
						continue;
					
					$sql = "
						INSERT INTO `post_image` 
						SET `post_id` = '{$post_id}', 
						    `image` = '{$image}', 
                            `title` = '{$title}', 
                            `description` = '{$description}', 
						    `sort_order` = {$sort_order}";

                    db_q($sql);
				}
			}
			
			// Loại bài viết: do post<--->category là mối quan hệ nhiều-nhiều
            // nên thông tin về phân loại của bài viết được đặt trong một bảng khác `post_category`
            // chứ không phải là đặt trong `post`
			if (isset($data['post_category'])) 
			{
				foreach ($data['post_category'] as $category_id) 
				{
					db_q("
						INSERT INTO `post_to_category` 
						SET `post_id` = '{$post_id}', 
						    `category_id` = '{$category_id}'"
					);
				}
			}

			// Thêm mới dữ liệu liên quan đến đường dẫn của bài viết.
			// MySQL Hierarchical Data Closure Table Pattern
			$level = 0;
			$parent_id = (int)$data['parent_id'];

            // Truy cập vào các bản ghi đường dẫn (post_id | path_id | level)
			// mà rễ của nó là bài viết cha
			$sql = " 
				SELECT * FROM `post_path` 
				WHERE `post_id` = {$parent_id}
				ORDER BY `level` ASC
			";

            $rs = db_q($sql);	// Truy vấn các bản ghi là cấp cha của bài viết vừa thêm vào

			// Bổ sung các đường dẫn cho bài viết vừa thêm vào
			foreach ($rs as $result) 
			{
				$path_id = (int)$result['path_id'];
				$sql = " 
					INSERT INTO `post_path` 
					SET `post_id` = {$post_id},
					    `path_id` = {$path_id},
						`level` = {$level}
				";
				db_q($sql);
				
				$level++;
			}

			$sql = " 
				INSERT INTO `post_path` 
				SET `post_id` = {$post_id},
				    `path_id` = {$post_id},
				    `level` = {$level}
			";
			db_q($sql);
			
			return $post_id;

} // kết thúc hàm postAdd($data)
	
/**
 * @param int $post_id Mã bài viết
 * @param array $data Mảng dữ liệu bài viết
 * @return int Mã bài viết bị chỉnh sửa
 * 
 * @abstract Hàm sửa thông tin bài viết
 */
function postEdit($post_id, $data)
{
    // Tinh chỉnh dữ liệu trước khi cập nhật

    // Thông tin chính của bài viết
	$title     = db_escape($data['title']);    // tựa đề bài viết
	$content   = db_escape($data['content']);  // nội dung bài viết
	$tag       = db_escape($data['tag']);      // các từ khóa liên quan
    $link      = db_escape($data['link']);     // đường dẫn riêng (nếu có)
    $menu      = db_escape($data['menu']);     // Menu trên trang chủ Home

    // Khóa ngoại trỏ sang bảng khác
    $author_id = (int)$data['author_id']; // tham chiếu sang bảng `user`

	$featured        = (int)$data['featured'];
	$sort_order      = (int)$data['sort_order'];
    $status          = (int)$data['status'];

    $parent_id = (int)$data['parent_id'];
    $top = (isset($data['top']) ? (int)$data['top'] : 0);

	// Nhúng thông tin cập nhật vào câu sql		
    $sql = " 
	    UPDATE post
		SET title = '{$title}',
            content = '{$content}',
            menu = '{$menu}',
            `parent_id` = '{$parent_id}', 
            `top` = '{$top}', 
			tag = '{$tag}', 
            link = '{$link}',
            author_id = '{$author_id}',
		    status = '{$status}',
			featured = '{$featured}',
			sort_order = '{$sort_order}',
			date_modified = NOW()
		WHERE post_id = '{$post_id}'";
	
    // Yêu cầu máy chủ dữ liệu cập nhật:
	db_q($sql);
			
	// Ảnh đại diện (Thumbnail Image)
	if (isset($data['image'])) 
    {
	    $image = db_escape($data['image']);
				
		$sql = "UPDATE `post` SET `image` = '{$image}' WHERE `post_id` = '{$post_id}'";
		db_q($sql);
	}
			
	
	

    // Bộ sưu tập ảnh cho bài viết này (Image Collection for this post)
	if (isset($data['post_image'])) 
	{

        // Nếu phía người dùng yêu cầu cập nhật các ảnh mới cho bài viết
        // thì trước hết phải xóa đi những ảnh cũ...
        db_q("DELETE FROM `post_image` WHERE `post_id` = '{$post_id}'");

        // ...sau đó mới cập nhật những ảnh mới
		foreach ($data['post_image'] as $post_image) 
		{
		    $image       = db_escape($post_image['image']);
            $title       = db_escape($post_image['title']);
            $description = db_escape($post_image['description']);

            $sort_order  = (int)$post_image['sort_order']; // (int) để tránh lỗi Incorrect integer value: '' for column 'sort_order' at row 1
					
			// Nếu ảnh này đã được liên kết với bài viết rồi thì thôi, bỏ qua
			// và chuyển sang ảnh tiếp theo của bài viết.
			if(in_array($image, postImages($post_id)))
			    continue;
					
					
				$sql = "
				    INSERT INTO `post_image` 
					SET `post_id` = '{$post_id}',
						`image` = '{$image}', 
                        `title` = '{$title}', 
                        `description` = '{$description}', 
						`sort_order` = '{$sort_order}'";

                db_q($sql);
		}
	}
			
	// Những loại bài viết liên quan / post To Category
	if (isset($data['post_category'])) 
    {
        // Nếu phía người dùng yêu cầu cập nhật phân loại của bài viết
        // thì trước hết phải xóa đi những loại cũ ...
        db_q("DELETE FROM `post_to_category` WHERE `post_id` = '{$post_id}'");

        // ...sau đó mới cập nhật những loại mới cho bài viết này
	    foreach ($data['post_category'] as $category_id) 
        {
		    db_q("INSERT INTO `post_to_category` SET `post_id` = '{$post_id}', `category_id` = '{$category_id}'");
		}
	}
	
    // Cập nhật đường dẫn của bài viết so với các bài viết cha
    // MySQL Hierarchical Data Closure Table Pattern
	$sql = " 
	    SELECT * FROM `post_path`  
		WHERE `path_id` = '{$post_id}'
		ORDER BY level ASC
	";
	$rs = db_q($sql);

    if ( is_array($rs) && !empty($rs) ) {
				foreach ( $rs as $post_path ) {
       				// Delete the path below the current one
       				$cid = (int)$post_path['post_id'];
       				$level = (int)$post_path['level'];
       				$sql = " 
						DELETE FROM `post_path`  
						WHERE `post_id` = '{$cid}' AND level < {$level}
					";
					db_q($sql);
					
					$path = array();
					
					// Get the nodes new parents
					$parent_id = (int)$data['parent_id'];
					$sql = " 
						SELECT * FROM `post_path`  
						WHERE `post_id` = '{$parent_id}'
						ORDER BY level ASC
					";
					$rs = db_q($sql);
					
					foreach ($rs as $result) {
						$path[] = $result['path_id'];
					}
					
					// Get whats left of the nodes current path
					$cid = (int)$post_path['post_id'];
					$sql = " 
						SELECT * FROM `post_path`  
						WHERE `post_id` = '{$cid}'
						ORDER BY `level` ASC
					";
					$rs = db_q($sql);
					
					foreach ($rs as $result) {
						$path[] = $result['path_id'];
					}
					
					// Combine the paths with a new level
					$level = 0;
					
					foreach ($path as $path_id) {
						$cid = (int)$post_path['post_id'];
						$sql = " 
							REPLACE INTO `post_path` 
							SET `post_id` = {$cid}, 
							    `path_id` = '{$path_id}', 
							    `level` = {$level}
						";
						db_q($sql);
						
						$level++;
					}
				}
	} 
	else {
				// Delete the path below the current one
				$sql = " 
					DELETE FROM `post_path` 
					WHERE `post_id` = '{$post_id}'
				";
				db_q($sql);
				
				// Fix for records with no paths
				$level = 0;
				$cid = (int)$data['parent_id'];
				$sql = " 
					SELECT * FROM `post_path`
					WHERE `post_id` = '$cid' 
					ORDER BY level ASC 
				";
				$rs = db_q($sql);
				
				foreach ($rs as $result) 
				{
					$pid = (int)$result['path_id'];
					$sql = "
						INSERT INTO `post_path` 
						SET `post_id` = '{$post_id}',
							`path_id` = {$pid},
							`level` = {$level}
					";
					db_q($sql);
					
					$level++;
				}
				
				$sql = " 
					REPLACE INTO `post_path`
					SET `post_id` = '{$post_id}',
						`path_id` = '{$post_id}',
						`level` = {$level}
				";
				db_q($sql);
	}
			
	db_q($sql);

    // Trả về khóa chính của bản ghi vừa sửa
	return $post_id;
}
	
/**
 * Sao chép thông tin bài viết sang một bản ghi mới.
 * Tiện cho việc thêm mới một bài viết có nhiều thông tin trùng với một bài viết đã có sẵn.
 * 
 * @return an indexed array of associative arrays
 */
function postCopy($post_id)
{
		// Lấy ra dữ liệu của bản ghi gốc
		$sql = " 
			SELECT DISTINCT * 
			FROM `post`
			WHERE `post_id` = '{$post_id}'
		";
		$rs = db_row($sql);
		
		
		if ( is_array($rs) && !empty($rs) ) 
		{
				$data = array();

				$data = $rs;
				
				// Tinh chỉnh một vài điểm
				$data['status'] = '0';
	
				$data = array_merge($data, array('post_image' => postGetImages($post_id)));
				$data = array_merge($data, array('post_category' => postCategories($post_id)));
				
				// Tiến hành copy (thêm mới bản ghi với nội dung giống bản ghi gốc)
				postAdd($data);
		}

			return true;
}	// end function
	
/**
 * Xóa bài viết dựa trên mã
 * 
 * @return post_id if successfully deleted
 * @return false if failed to delete
 */
function postDelete($post_id)
{
	// Đếm xem có bao nhiêu đơn hàng đặt bài viết này
	//$count = (int)db_one("SELECT COUNT(post_id) FROM `order_details` WHERE `post_id`='{$post_id}'");
// 	$_SESSION['ERROR_TEXT'] = null;
	
	// Nếu như có đơn hàng đặt bài viết này thì không thể xóa nó đi khỏi
	// bảng `post` được !!!
// 	if ($count > 0) 
// 	{
// 		$_SESSION['ERROR_TEXT'] = "Không thể xóa bài viết id={$post_id} vì tồn tại trong đơn hàng!";
// 		return false;
// 	}
	
	// Xóa dữ liệu ở các bảng liên quan
	db_q("DELETE FROM `post_image` WHERE `post_id` = '{$post_id}'");
	db_q("DELETE FROM `post_to_category` WHERE `post_id` = '{$post_id}'");
			
	// sau đó xóa bản ghi cần xóa.
	db_q("DELETE FROM `post` WHERE `post_id` = '{$post_id}'");
	
	return $post_id;
} // end function
	
/**
 * @deprecated
 * @param int $post_id
 */
function postGetById($post_id)
{
	return postById($post_id);
}

/**
 * @param int $post_id Mã bài viết
 * @return array Mảng kết hợp chứa dữ liệu bài viết lấy ra từ bảng `post`
 * @abstract Lấy ra thông tin một bài viết dựa trên mã
 */
function postById($post_id)
{
		$sql = " 
			SELECT DISTINCT *
			FROM `post` AS p 
			WHERE p.post_id = {$post_id}  
		";
		
		$rs = db_row($sql);
		
		if ( is_array($rs) && !empty($rs) ) 
		{
				return $rs;
		}

		return false;
} // end function
	
/**
 * @deprecated
 * @param int $post_id
 */
function postGetCategories($post_id){
	return postCategories($post_id);
}

/**
 * @param $post_id Mã bài viết
 * @return array Một mảng đánh chỉ số, mỗi phần tử là một mã loại
 * 
 * @abstract Lấy ra các loại bài viết mà bài viết này thuộc về
 */
function postCategories($post_id)
{
		$post_category_data = array();
		
		$sql = " 
			SELECT *
			FROM `post_to_category`
			WHERE post_id = {$post_id}
		";

		$rs = db_q($sql);
		if ( is_array($rs) && !empty($rs) ) 
		{
				foreach ($rs as $result) {
					$post_category_data[] = $result['category_id'];
				}
		
				return $post_category_data;
		}

		return false;
} // end function
	
	
/**
 * Lấy ra các ảnh của một bài viết
 * @returns an indexed array of associative arrays
 */
function postGetImages($post_id)
{
		$sql = " 
			SELECT *
			FROM `post_image`
			WHERE post_id = {$post_id}
			ORDER BY sort_order ASC
		";
		
		$rs = db_q($sql);
		if ( is_array($rs) && !empty($rs) )
		{
			return $rs;
		}

		return false;
} // end function
	

//function postGetRelatedposts($post_id)

/**
 * @param $post_id mã bài viết
 * @return an associative array
 * @abstract Lấy ra dữ liệu chi tiết(dạng thô) của một bài viết (có tính cả các thông tin nằm trong các bảng khác).
 *           Hàm này chạy nhanh hơn hàm postInfo() do nó không phải xử lý ảnh nhiều.
 *           ĐỪNG bắt hàm này phải xử lý ảnh, nếu không nó sẽ gây chậm giống như hàm postInfo().
 *           Xử lý ảnh (thumb, popup, images) là việc của chương trình khách. 
 */

function postDetails($post_id)
{
		$sql = " 
			SELECT DISTINCT *, 
				p.name AS name, 
				p.image, 
				m.name AS manufacturer, 
				p.sort_order 
		    FROM post p
		    LEFT JOIN manufacturer m ON (p.manufacturer_id = m.manufacturer_id) 
			WHERE p.post_id = '$post_id' AND p.status = '1'
		";
		$rs = db_row($sql);

		return $rs;
}// end function

/**
 * @param int $post_id Mã bài viết
 * @return array Mảng kết hợp chứa thông tin bài viết lấy ra từ các bảng `post`, `user`
 *
 * @abstract Lấy ra thông tin một bài viết dựa trên mã. Chú ý là chỉ nên gọi hàm này ở trang post-info.php
 *           Đừng gọi hàm này khi duyệt một mảng các bài viết vì nó sẽ gây chậm hệ thống, do bản 
 *           thân hàm này có rất nhiều đoạn mã xử lý dữ liệu thô bên trong (xử lý ảnh)
 * @note     Chú Ý: khi các bảng `post` và `user` có các cột trùng tên `date_added`, `date_modified` 
 *           thì phải select theo kiểu chỉ định và có bí danh bảng ở đầu.
 */
function postInfo($post_id)
{
	// Câu truy vấn
	$sql = "
	 SELECT DISTINCT *,
	  p.title AS title,
      p.content AS content,
	  p.image,
	  u.fullname AS author,
	  p.sort_order,
      p.date_added as date_added,
      p.date_modified as date_modified
	 FROM `post` AS p
	 LEFT JOIN `user` AS u ON (p.author_id = u.user_id)
	 WHERE p.post_id = '{$post_id}' AND p.status = '1'
	";
	
	// Thực thi truy vấn
	$rs = db_row($sql);
	
	// Nếu kết quả truy vấn là mảng không rỗng
	if ( is_array($rs) && !empty($rs) )
	{
		// Ảnh bài viết
		if (is_file(DIR_IMAGE . $rs['image'])) // Nếu bài viết này có ảnh 
		{
			$image = img_resize($rs['image'], $setting['width'], $setting['height']);
		} 
		else	// Nếu bài viết này không có ảnh thì lấy ảnh chờ để thay thế 
		{
			$image = img_resize('placeholder.png', $setting['width'], $setting['height']);
		}
		
		// Hình đại diện bài viết trên gallery ảnh bài viết (xem /post-info.php)
		if (is_file(DIR_IMAGE . $rs['image']))
		{
			$thumb = img_resize($rs['image'], settings('config_image_thumb_width'), settings('config_image_thumb_height'));
		}
		else
		{
			$thumb = img_resize('placeholder.png', settings('config_image_thumb_width'), settings('config_image_thumb_height'));
		}
		
		// Hình ảnh phóng to (zoom-in) bài viết trên gallery ảnh bài viết (xem /post-info.php)
		if (is_file(DIR_IMAGE . $rs['image']))
		{
			$popup = img_resize($rs['image'], settings('config_image_popup_width'), settings('config_image_popup_height'));
		}
		else
		{
			$popup = img_resize('placeholder.png', settings('config_image_popup_width'), settings('config_image_popup_height'));
		}
		
		// Các ảnh bài viết
		$post_images = array();
		
		$results = postGetImages($post_id);
		
		foreach ($results as $result)
		{
			if (is_file(DIR_IMAGE . $result['image']))
			{
				$post_images[] = array(
						'popup' => img_resize($result['image'], settings('config_image_popup_width'), settings('config_image_popup_height')),
						'thumb' => img_resize($result['image'], settings('config_image_additional_width'), settings('config_image_additional_height'))
				);
			}
			else
			{
				$post_images[] = array(
						'popup' => img_resize('placeholder.png', settings('config_image_popup_width'), settings('config_image_popup_height')),
						'thumb' => img_resize('placeholder.png', settings('config_image_additional_width'), settings('config_image_additional_height'))
				);
			}
		
		
		}
		
		return array(
				'post_id'           => $rs['post_id'],
				'title'             => $rs['title'],
				'content'           => html_entity_decode($rs['content'], ENT_QUOTES, 'UTF-8'),
				'content_short'     => utf8_substr(strip_tags(html_entity_decode($rs['content'], ENT_QUOTES, 'UTF-8')), 0, settings('config_post_description_length')) . '..',
                'menu'              => $rs['menu'],
				'tag'               => $rs['tag'],
				'model'             => $rs['model'],
				'thumb'		        => $thumb,
				'image'             => URL_IMAGE.$rs['image'], //$image,
		        'popup'             => $popup,
				'post_images'       => $post_images,
				'href'              => "/post-info.php?post_id={$rs['post_id']}",
				'link'              => $rs['link'],
				'author_id'         => $rs['author_id'],
				'author'            => $rs['author'],
				'author_href'       => '/author-info.php?author_id=' . $rs['author_id'],
				//'price'             => number_format($rs['price'],0,'.',',').' ₫',
				//'rating'            => settings('config_review_status') ? $rs['rating'] : false,
				'sort_order'        => $rs['sort_order'],
				'status'            => $rs['status'],
				//'availability'      => ((int)$rs['status'] == 1) ? 'Còn hàng' : 'Hết hàng',
                'date_published'    => date('d/m/Y', strtotime($rs['date_added'])),
				'date_added'        => $rs['date_added'],
				'date_modified'     => $rs['date_modified']
		);
	}
		
	return $rs;
}


/**
 * @param int $post_id Mã bài viết
 * @return array Mảng chỉ số. Mỗi phần tử là một mảng kết hợp biểu diễn bài viết liên quan.
 * @abstract Lấy ra các bài viết liên quan đến bài viết này.
 *           ĐỪNG gọi hàm postInfo($post_id) ở đây vì nó sẽ gây chậm !!!
 */
function postsRelated($post_id)
{
	// Khởi tạo danh sách các bài viết liên quan
	$relateds = array();
		
	// Lấy ra dữ liệu thô trong db của các bài viết liên quan
	$sql = " 
		SELECT * 
		FROM post_related pr 
		LEFT JOIN post p ON (pr.related_id = p.post_id) 
		WHERE pr.post_id = '{$post_id}'
			AND p.status = '1' 
	";
	$rs = db_q($sql);
		
	if ( is_array($rs) && !empty($rs) )
	{
		foreach ($rs as $result) 
		{
			
			if ($result['image'])
			{
				$image = img_resize($result['image'], settings('config_image_related_width'), settings('config_image_related_height'));
			}
			else
			{
				$image = img_resize('placeholder.png', settings('config_image_related_width'), settings('config_image_related_height'));
			}
			
			$relateds[] = array(
					'post_id'  => $result['post_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, settings('config_post_description_length')) . '..',
					'price'       => number_format($result['price'],0,'.',',').' ₫',
					'href'        => "/post-info.php?post_id={$result['post_id']}"
			);
			
		}

	}

	return $relateds;
} // end getpostRelated($post_id)

/**
 * @param array $data Mảng các tiêu chí
 * @return string
 *
 * @abstract Đếm tổng số bài viết dựa theo một tập các tiêu chí nhất định.
 *           Đồng bộ với hàm getposts()
 *           Ví dụ:
 SELECT COUNT(DISTINCT p.post_id) AS total
 FROM `post` AS p
 WHERE p.name LIKE '%%' AND p.model LIKE '%%' AND p.price LIKE '%%' ;
 *
 */
function postGetTotal($data=array())
{
	$filter_title = "%".db_escape($data['filter_title']) . "%";

	$sql = "
	 SELECT COUNT(DISTINCT `post_id`) AS total
	 FROM `post` AS p
	 WHERE `title` LIKE '{$filter_title}'
	";

	if (isset($data['filter_status']) && !is_null($data['filter_status'])) 
	{
		$sql .= " AND `status` = '" . (int)$data['filter_status'] . "'";
	}
	
	if (isset($data['filter_featured']) && !is_null($data['filter_featured']))
	{
		$sql .= " AND `featured` = '" . (int)$data['filter_featured'] . "'";
	}
	
	if (isset($data['filter_top']) && !is_null($data['filter_top']))
	{
		$sql .= " AND `top` = '" . (int)$data['filter_top'] . "'";
	}
	
	// Khi đếm tổng số bài viết thì không cần quan tâm đến thứ tự sắp xếp
		//echo $sql; // testing only
	$rs = db_one($sql);
	if ( !is_null($rs) )
	{
		return $rs;
	}

	return false;
} // end postGetTotal()

/**
 * Lấy ra tất cả các bài viết dựa trên một tập các tiêu chí nhất định,
 * đồng bộ với hàm: getTotalposts()
 *
 * Ví dụ:
 SELECT * FROM `post`
 WHERE `name` LIKE '%%'
 AND `model` LIKE '%%' AND `price` LIKE '%%'
 ORDER BY `name` ASC
 LIMIT 0,20;

 * @param array $data Mảng các tiêu chí truy vấn bài viết
 * @return an indexed array of associative arrays

 */
function postGetAll($data = array())
{
	$filter_title = "%".db_escape($data['filter_title']) . "%";

    // Câu truy vấn bài viết theo tựa đề
	$sql = "
	    SELECT *
	    FROM `post` AS p
	    WHERE `title` LIKE '{$filter_title}'
	";

    // Nếu yêu cầu lọc theo trạng thái của bài viết thì tiếp tục bổ sung
    // nội dung truy vấn cho sql
	if (isset($data['filter_status']) && !is_null($data['filter_status'])) 
    {
		$sql .= " AND `status` = '" . (int)$data['filter_status'] . "'";
	}
	
	if (isset($data['filter_featured']) && !is_null($data['filter_featured']))
	{
		$sql .= " AND `featured` = '" . (int)$data['filter_featured'] . "'";
	}
	
	if (isset($data['filter_top']) && !is_null($data['filter_top']))
	{
		$sql .= " AND `top` = '" . (int)$data['filter_top'] . "'";
	}

	//$sql .= " GROUP BY p.post_id";

    // Các cột được phép sắp xếp.
    // Vì sao lại phải có bí danh 'p' trước tên các cột, để đề phòng về sau nâng cấp nó lên thành phép nối bảng !!!
    // Mà khi nối bảng thì 2 bảng hay có các cột giống tên nhau, dễ gây lỗi Ambiguous.
	$sort_data = array(
			'p.post_id',
			'p.title',
			'p.status',
			'p.featured',
			'p.top',
			'p.sort_order',
			'p.date_added'
	);

    // Nếu phía giao diện chỉ định cột sắp xếp
	if (isset($data['sort']) && in_array($data['sort'], $sort_data)) 
    {
		$sql .= " ORDER BY " . $data['sort'];
	} 
    else // mặc định, nếu không nói gì thì sắp xếp theo tựa đề bài viết:
    {
		$sql .= " ORDER BY `title`";
	}

    // Nếu phía giao diện chỉ định chiều sắp xếp giảm dần
	if (isset($data['order']) && ($data['order'] == 'DESC')) 
    {
		$sql .= " DESC";
	} 
    else // ngược lại thì:
    {
		$sql .= " ASC";
	}

    $start = 0;
	$limit = settings('config_limit_admin');
	// Nhúng thông tin phân trang vào trong $sql
	if (isset($data['start']) || isset($data['limit'])) 
    {
        if (isset($data['start']) && (int)$data['start'] >= 0)
		    $start = (int)$data['start'];
			
	    if (isset($data['limit']) && (int)$data['limit'] >= 1)
		    $limit = (int)$data['limit'];

		$sql .= " LIMIT {$start},{$limit}";
	}

    


	$rs = db_q($sql);
	if ( is_array($rs) && !empty($rs) )
	{
		return $rs;
	}

	return false;

} // end function

/**
 * Đếm tổng số bài viết dựa theo tiêu chí tìm kiếm.
 * 
 * @todo Đồng nhất hàm này với hàm postGetAllForSearch()
 */
function postGetTotalForSearch($data = array())
{
	$sql = " 
		SELECT COUNT(DISTINCT p.post_id) AS total
		FROM `post` AS p
		WHERE p.status = '1'
	";
			
			
	if (!empty($data['filter_title']) || !empty($data['filter_tag'])) 
	{
		$sql .= " AND (";
	
		if (!empty($data['filter_title'])) 
		{
			$implode = array();
					
			// Bẻ nhỏ các từ khóa trong chuỗi kí tự tìm kiếm
			$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_title'])));
					
			// so sánh mỗi từ đó với tựa đề bài viết
			foreach ($words as $word) 
			{
				$implode[] = "p.title LIKE '%" . db_escape($word) . "%'";
			}
	
			if ($implode) 
			{
				$sql .= " " . implode(" AND ", $implode) . "";
			}
					
			// Nếu như tìm kiếm cả trong phần nội dung bài viết
			if (!empty($data['filter_content'])) 
			{
						//$sql .= " OR p.content LIKE '%" . db_escape($data['filter_title']) . "%'"; // kiểu làm cũ
						$sql .= " OR ";
						
						$implode_content = array();
						
						// so sánh mỗi từ đó với tựa đề bài viết
						foreach ($words as $word)
						{
							$implode_content[] = "p.content LIKE '%" . db_escape($word) . "%'";
						}
						
						if ($implode_content)
						{
							$sql .= " " . implode(" AND ", $implode_content) . "";
						}
			}
		}
	
		if (!empty($data['filter_title']) && !empty($data['filter_tag'])) 
		{
			$sql .= " OR ";
		}
	
		if (!empty($data['filter_tag'])) 
		{
			$sql .= "p.tag LIKE '%" . db_escape(utf8_strtolower($data['filter_tag'])) . "%'";
		}
	
		if (!empty($data['filter_title'])) 
		{
			$sql .= " OR LCASE(p.menu) = '" . db_escape(utf8_strtolower($data['filter_title'])) . "'";
		}
	
		$sql .= ")";
	}
			//echo $sql; // test only !
	$rs = db_one($sql);
	
	return $rs;
}	

/**
 * Lấy ra tất cả các bài viết phù hợp với tiêu chí tìm kiếm.
 * Tìm theo tựa đề (title), nội dung (content), từ khóa (tag).
 * 
 * Có phân trang, sắp xếp
 * 
 * Đồng nhất hàm này với hàm postGetTotalForSearch()
 */
function postGetAllForSearch($data = array())
{
	$sql = " 
		SELECT *
		FROM `post` AS p
		WHERE p.status = '1' 
	";
			
			
	if (!empty($data['filter_title']) || !empty($data['filter_tag'])) 
	{
		$sql .= " AND (";
	
		if (!empty($data['filter_title'])) 
		{
			$implode = array();
					
			// Bẻ nhỏ các từ khóa trong chuỗi kí tự tìm kiếm
			$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_title'])));
					
			// so sánh mỗi từ đó với tựa đề bài viết
			foreach ($words as $word) 
			{
				$implode[] = "p.title LIKE '%" . db_escape($word) . "%'";
			}
	
			if ($implode) 
			{
				$sql .= " " . implode(" AND ", $implode) . "";
			}
					
			// Nếu như tìm kiếm cả trong phần mô tả bài viết
			if (!empty($data['filter_content'])) 
			{
				//$sql .= " OR p.content LIKE '%" . db_escape($data['filter_title']) . "%'"; // kiểu làm cũ
				$sql .= " OR ";
				
				$implode_content = array();
				
				// so sánh mỗi từ đó với tựa đề bài viết
				foreach ($words as $word)
				{
					$implode_content[] = "p.content LIKE '%" . db_escape($word) . "%'";
				}
				
				if ($implode_content)
				{
					$sql .= " " . implode(" AND ", $implode_content) . "";
				}
			}
		}
	
		if (!empty($data['filter_title']) && !empty($data['filter_tag'])) 
		{
					$sql .= " OR ";
		}
	
		if (!empty($data['filter_tag'])) 
		{
					$sql .= "p.tag LIKE '%" . db_escape(utf8_strtolower($data['filter_tag'])) . "%'";
		}
	
		if (!empty($data['filter_title'])) 
		{
					$sql .= " OR LCASE(p.menu) = '" . db_escape(utf8_strtolower($data['filter_title'])) . "'";
		}
	
		$sql .= ")";
	}
	
	// cột sắp xếp (cũ: 'p.model', 'p.price')
	$sort_data = array(
			'p.title',
			'p.sort_order',
			'p.date_added'
	);

	// Nếu phía giao diện chỉ định cột sắp xếp và cột này nằm trong danh sách cho phép
	if (isset($data['sort']) && in_array($data['sort'], $sort_data)) 
	{
		if ($data['sort'] == 'p.title' || $data['sort'] == 'p.menu') 
		{
			$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
		} 
// 		elseif ($data['sort'] == 'p.price') 
// 		{
// 			$sql .= " ORDER BY " . $data['sort'];
// 		} 
		else 
		{
			$sql .= " ORDER BY " . $data['sort'];
		}
	} 
	else // Mặc định, phía giao diện không nói gì thì sắp xếp theo cột `sort_order`
	{
			$sql .= " ORDER BY p.sort_order";
	}

	// Nếu phía giao diện yêu cầu chiều sắp xếp: Giảm
	if (isset($data['order']) && ($data['order'] == 'DESC')) 
	{
			$sql .= " DESC, LCASE(p.title) DESC";
	} 
	else 	// Mặc định, không nói gì thì sắp xếp: Tăng
	{
			$sql .= " ASC, LCASE(p.title) ASC";
	}
	
	// Nếu phía giao diện chỉ định rõ tham số phân trang: Chỉ Số Bắt Đầu, Giới Hạn
	// thì tiến hành chuẩn hóa chúng, ngược lại không nói gì thì các tham số này
	// sẽ được ấn định tự động bởi MySQL Server
	if (isset($data['start']) || isset($data['limit'])) 
	{
		// Chuẩn hóa chỉ số của bản ghi đầu 
		if ($data['start'] < 0) 
		{
			$data['start'] = 0;
		}

		// Chuẩn hóa số bản ghi trên trang (được phép hiện)
		if ($data['limit'] < 1) 
		{
			$data['limit'] = 20;
		}

		$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
	}
	
		//echo $sql; // test only !
	$rs = db_q($sql);
	
	return $rs;
}	

/**
 * Đếm tất cả các bài viết thuộc về cùng một nhà sản xuất.
 * @param array $data
 */
function postGetTotalForManufacturer($data = array())
{
	$sql = " 
		SELECT COUNT(DISTINCT p.post_id) AS total
		FROM `post` p
		WHERE p.status = '1' 
		
	";
			
	if (!empty($data['filter_manufacturer_id'])) 
	{
		$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
	}
	
	$rs = db_one($sql);
	
	return $rs;
}

/**
 * Lấy ra tất cả các bài viết thuộc về cùng một nhà sản xuất.
 * @param array $data
 * @return array();
 */
function postGetAllForManufacturer($data = array())
{
	$sql = " 
		SELECT *
		FROM `post` p
		WHERE p.status = '1' 
	";
	
	if (!empty($data['filter_manufacturer_id'])) 
	{
		$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
	}

    // Nếu phía giao diện yêu cầu lọc bài viết theo khoảng giá
    if (!empty($data['price_min']) && !empty($data['price_max'])) 
	{
		$sql .= " AND p.price BETWEEN " . (int)$data['price_min'] . " AND ".(int)$data['price_max'];
	}
			
	// Trật tự sắp xếp
	$sort_data = array(
			'p.title',
			'p.model',
			'p.price',
			'p.sort_order',
			'p.date_added'
	);

	if (isset($data['sort']) && in_array($data['sort'], $sort_data)) 
	{
			if ($data['sort'] == 'p.title' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} elseif ($data['sort'] == 'p.price') {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
	} else {
			$sql .= " ORDER BY p.sort_order";
	}

	if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(p.title) DESC";
	} else {
			$sql .= " ASC, LCASE(p.title) ASC";
	}
	
	// Phân trang
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
			
	$rs = db_q($sql);
	
	return $rs;
}	

/**
 @description Tính tổng số bài viết thuộc về loại bài viết này
 
 @param $category_id int Id loại bài viết
 @return int tổng số bài viết
 */
function postGetTotalForCategory($category_id)
{
	$sql = " 
		SELECT COUNT(DISTINCT p.post_id) AS total
		FROM `post_to_category` AS p2c
		LEFT JOIN `post` AS p ON (p2c.post_id = p.post_id)
		WHERE p.status = '1' 
				AND p2c.category_id = '{$category_id}'
    ";
			
	return (int)db_one($sql);
	
}

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
function postGetAllForCategory($data = array()) 
{
	$category_id = (int)$data['filter_category_id'];
	$sql = " 
		SELECT *,
          p.date_added as date_added
		FROM `post_to_category` AS p2c
		LEFT JOIN `post` AS p ON (p2c.post_id = p.post_id)
		WHERE p.status = '1' 
			AND p2c.category_id = '{$category_id}'
		GROUP BY p.post_id
	";

	// 'p.name', 'p.model', 'p.price',
	$sort_data = array(
		'p.title',
		'p.sort_order',
		'p.date_added'
	);
	
	// Sắp xếp theo cột nào ?
	if (isset($data['sort']) && in_array($data['sort'], $sort_data)) 
	{
			if ($data['sort'] == 'p.title' || $data['sort'] == 'p.menu') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} elseif ($data['sort'] == 'p.price') {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
	} else {
			$sql .= " ORDER BY p.sort_order";
	}

	// Sắp xếp tăng hay giảm ?
	if (isset($data['order']) && ($data['order'] == 'DESC')) 
	{
			$sql .= " DESC, LCASE(p.title) DESC";
	} else {
			$sql .= " ASC, LCASE(p.title) ASC";
	}
	
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
 * 
 * @return array Mảng chỉ số. Mỗi phần tử là một mảng kết hợp biểu diễn bài viết nổi bật.
 * @abstract Lấy ra danh sách các bài viết nổi bật. Danh sách này được ấn định một cách
 			tùy ý từ màn hình quản trị.
 			ĐỪNG dùng hàm postInfo() ở đây vì nó sẽ gây chậm, do hàm này có nhiều
 			tác vụ con bên trong. hàm postDetails() chạy nhanh hơn.
 */
function postFeatureds()
{
	
	$sql = "
		SELECT DISTINCT *,
			p.title AS title,
		 	p.image,
         	p.sort_order,
		 	u.fullname AS author 
		FROM post AS p
		LEFT JOIN user AS u ON (p.author_id = u.user_id)
		WHERE p.status = '1' AND p.featured = '1'
	";
	
	// Lấy ra danh sách các bài viết nổi bật
	// và giới hạn số lượng hiển thị trên html.
	$rs = db_q($sql);

	$featured_posts = array();

	foreach ($rs as $post) 
	{
			
		//if ($post_info) {
		// Nếu file ảnh tồn tại trên máy chủ
		if (is_file(DIR_IMAGE . $post['image'])) 
		{
			$image = img_resize($post['image'], 200, 200);
		} 
		else // Nếu file ảnh không tồn tại thì dùng ảnh rỗng
		{
			$image = img_resize('placeholder.png', 200, 200);
		}
	
// 		$price = number_format($post['price'],0,'.',',').' ₫';
	
	
// 		if (settings('config_review_status')) 
// 		{
// 			$rating = $post['rating'];
// 		} 
// 		else 
// 		{
// 			$rating = false;
// 		}
	
		$featured_posts[] = array(
			'post_id'     => $post['post_id'],
			'thumb'       => $image,
			'image'		  => URL_IMAGE.$post['image'], // ảnh gốc không bị chỉnh kích thước !
			'title'       => $post['title'],
			'title_substr'     => utf8_substr(strip_tags(html_entity_decode($post['title'], ENT_QUOTES, 'UTF-8')), 0, settings('post_title_length')) . '..',
			'content_substr'     => utf8_substr(strip_tags(html_entity_decode($post['content'], ENT_QUOTES, 'UTF-8')), 0, settings('post_content_length')) . '..',
			'content_short'     => utf8_substr(strip_tags(html_entity_decode($post['content'], ENT_QUOTES, 'UTF-8')), 0, settings('post_content_length')) . '..',
			//'price'       => $price,
			//'href'        => "/post-info.php?post_id=" . $post['post_id'],
			'href'        => "/blog-post.php?post_id=" . $post['post_id'],
			'href_author' => '/author-info.php?author_id=' . $post['author_id'],
			'author_href' => '/author-info.php?author_id=' . $post['author_id'],
			'author'      => $post['author'],
			'author_id'   => $post['user_id'],
			'menu'        => $post['menu'],
			'date_published'    => date('d/m/Y', strtotime($post['date_added']))
		);
				//}
	}
	//var_dump($featured_posts); // testing only
	$featured_posts = array_slice($featured_posts, 0, settings('posts_featured_limit'));
	
	return $featured_posts;
}// end function


/**
 *
 * @return array Mảng chỉ số. Mỗi phần tử là một mảng kết hợp biểu diễn bài viết bán chạy.
 * @abstract Lấy ra danh sách các bài viết nổi bật. Danh sách này được ấn định một cách
 tùy ý từ màn hình quản trị.
 ĐỪNG dùng hàm postInfo() ở đây vì nó sẽ gây chậm, do hàm này có nhiều
 tác vụ con bên trong. hàm postDetails() chạy nhanh hơn.
 */
function postBestSellers()
{
    
    $sql = "
		SELECT DISTINCT *,
		 p.name AS name,
		 p.image,
         p.sort_order,
		 m.name AS manufacturer
		FROM post p
		LEFT JOIN manufacturer m ON (p.manufacturer_id = m.manufacturer_id)
		WHERE p.status = '1' AND p.best_seller = '1'
	";
    
    // Lấy ra danh sách các bài viết bán chạy
    // và giới hạn số lượng hiển thị trên html.
    $rs = db_q($sql);
    
    $bestSellerposts = array();
    
    foreach ($rs as $post)
    {
        
        //if ($post_info) {
        if (is_file(DIR_IMAGE . $post['image'])) {
            $image = img_resize($post['image'], 200, 200);
        } else {
            $image = img_resize('placeholder.png', 200, 200);
        }
        
        $price = number_format($post['price'],0,'.',',').' ₫';
        
        
        if (settings('config_review_status')) {
            $rating = $post['rating'];
        } else {
            $rating = false;
        }
        
        $bestSellerposts[] = array(
            'post_id'  => $post['post_id'],
            'thumb'       => $image,
            'name'        => $post['name'],
            'description' => utf8_substr(strip_tags(html_entity_decode($post['description'], ENT_QUOTES, 'UTF-8')), 0, settings('config_post_description_length')) . '..',
            'price'       => $price,
            'href'        => "/post-info.php?post_id=" . $post['post_id'],
            'href_man'    => '/manufacturer-info.php?manufacturer_id=' . $post['manufacturer_id'],
            'manufacturer_href'    => '/manufacturer-info.php?manufacturer_id=' . $post['manufacturer_id'],
            'manufacturer' => $post['manufacturer'],
            'manufacturer_id' => $post['manufacturer_id'],
            'model' => $post['model']
        );
        //}
    }
    $bestSellerposts = array_slice($bestSellerposts, 0, settings('posts_best_seller_limit'));
    
    return $bestSellerposts;
}// end function


/*
 Lấy ra danh sách các đường dẫn ảnh của một bài viết
 @return indexed array
 */
function postImages($post_id)
{
	// Nhặt ra các bản ghi trong bảng
	$temp = db_q("SELECT `image` FROM `post_image` WHERE `post_id`='{$post_id}'");
	
	// sau đó copy các đường dẫn ảnh vào trong một mảng:
	$images = array();
	
	if(is_array($temp) && !empty($temp))
	{
		foreach($temp as $img)
		{
			$images[] = $img['image'];
		}
	}
	
	return $images;
		
	
}// end function

/**
 @description Tính tổng số bài viết con
 
 @param $post_id int Id loại sản phẩm
 @return int tổng số bài viết con
 */
function postGetTotalChildren($post_id)
{
	$sql = " 
		SELECT COUNT(DISTINCT `post_id`) AS total
		FROM `post` 
		WHERE `parent_id` = '{$post_id}'
          AND `status` = '1' 
    ";
			
	return (int)db_one($sql);
	
}

// Hàm này cũng không thực sự cần phải gọi đến
// khi đưa các bài post lên Menu Top HomePage
function postGetAllByParent($parent_id = 0)
{
	$sql = " 
		SELECT * FROM `post`
		WHERE `parent_id` = '{$parent_id}' 
				AND `status` = '1' 
		ORDER BY `sort_order`, LCASE(title)
	";

	$rs = db_q($sql);
	
	if ( is_array($rs) && !empty($rs) )
	{
		return $rs;
	}

	return false;
} // en

/* Những bài viết được đưa lên menu top Home phải có: parent_id=0, status=1, top=1 */
function postGetAllForMenuHomePage($limit = 10)
{
	$postsMenu = array();

	$posts = postGetAllByParent(0);

	foreach ($posts as $post) 
	{
				if ($post['top']) 
				{
					// Level 2
					$children_data = array();
	
					$children = $posts = postGetAllByParent($post['post_id']);
	
					foreach ($children as $child) 
					{
	
						$children_data[] = array(
							//'title'  => $child['title'] . ' ('. productGetTotalForCategory($child['category_id']) . ')',
                            //'title'  => $child['title'] . ' ('. postGetTotalChildren($child['post_id']) . ')',
                            'title'  => $child['title'],
                            'menu'     => $child['menu'],
							//'href'  => '/post-info.php?post_id=' . $child['post_id']
							'href'     => '/blog-post.php?post_id=' . $post['post_id']
						);
					}
	
					// Level 1
					$postsMenu[] = array(
						'title'    => $post['title'],
                        'menu'     => $post['menu'],
						'children' => $children_data,
						'column'   => $post['column'] ? $post['column'] : 1,
						//'href'     => '/post-info.php?post_id=' . $post['post_id']
						'href'     => '/blog-post.php?post_id=' . $post['post_id']
					);
				}
	}
	
	// Nhiều giao diện có menu rất hẹp, không đủ chỗ cho tất cả các mục
	// vì vậy phải giới hạn và đặt ra độ ưu tiên (trật tự sắp xếp giữa các menu)
	// thì mới đủ
	if ($limit < count($postsMenu)) 
    {
		return array_slice($postsMenu, 0, $limit);
	}
	
	return $postsMenu;
}

/**
 * @abstract Lấy ra các bài viết Top
 * @param array $data
 * @return array
 * 
 * @todo Liệu $limit có thể được cấu hình từ màn hình Admin Settings
 */
function postTops($data=array('limit'=>10))
{
	$sql = "
		SELECT DISTINCT *,
			p.title AS title,
		 	p.image,
         	p.sort_order,
			p.date_added as date_added,
		 	u.fullname AS author
		FROM `post` AS p
		LEFT JOIN `user` AS u ON (p.author_id = u.user_id)
		WHERE p.status = '1' AND p.top = '1'
	";
	
	// Lấy ra danh sách các bài viết nổi bật
	// và giới hạn số lượng hiển thị trên html.
	$rs = db_q($sql);
	
	$top_posts = array();
	
	foreach ($rs as $post)
	{
		
		// Nếu file ảnh tồn tại trên máy chủ
		if (is_file(DIR_IMAGE . $post['image']))
		{
			$image = img_resize($post['image'], 200, 200);
		}
		else // Nếu file ảnh không tồn tại thì dùng ảnh rỗng
		{
			$image = img_resize('placeholder.png', 200, 200);
		}
		
		$top_posts[] = array(
				'post_id'     => $post['post_id'],
				'thumb'       => $image,
				'image'		  => URL_IMAGE.$post['image'], // ảnh gốc không bị chỉnh kích thước !
				'title'       => $post['title'],
				'title_short'   => utf8_substr(strip_tags(html_entity_decode($post['title'], ENT_QUOTES, 'UTF-8')), 0, settings('post_title_length')) . '..',
				'content_short' => utf8_substr(strip_tags(html_entity_decode($post['content'], ENT_QUOTES, 'UTF-8')), 0, settings('post_content_length')) . '..',
				'href'        => "/blog-post.php?post_id=" . $post['post_id'],
				'href_author' => '/author-info.php?author_id=' . $post['author_id'],
				'author_href' => '/author-info.php?author_id=' . $post['author_id'],
				'author'      => $post['author'],
				'author_id'   => $post['user_id'],
				'menu'        => $post['menu'],
				'date_published'    => date('d/m/Y', strtotime($post['date_added']))
		);
	}
	
	$top_posts = array_slice($top_posts, 0, $data['limit']);
	
	return $top_posts;
}

/**
 * @abstract Lấy ra những bài viết mới nhất.
 * Phía chương trình khách khi gọi hàm này có thể tùy chỉnh số lượng bài (limit)
 * lấy ra, kích thước ảnh (dài x rộng) của bài viết.
 * Trong mảng $data đừng viết cái này: $data['content_length'] => settings('post_content_length')
 * sẽ gây chết chương trình. PHP có vẻ không cho làm vậy giống JavaScript.
 *
 * @param int $limit Giới hạn số bài viết mới nhất lấy ra.
 * @param int $img_w Độ rộng ảnh bài viết
 * @param int $img_h Độ cao ảnh bài viết
 * @return indexed_array Mảng các bài viết mới nhất
 */

//function postLatests($limit = 5, $img_w=200, $img_h=200)
function postLatests( $data = array('limit'=>5,'img_w'=>170,'img_h'=>126) )
{
	// Cách làm này không ổn vì thiếu thông tin
	// 	$filter_data = array(
	// 		'sort'            => 'p.date_added',
	// 		'order'           => 'DESC',
	// 		'start'           => 0,
	// 		'limit'           => $limit
	// 	);
	
	
	// 	return postGetAll($filter_data);
	
	$sql = "
		SELECT DISTINCT *,
			p.title AS title,
		 	p.image,
         	p.sort_order,
            p.date_added AS date_added,
		 	u.fullname AS author
		FROM post AS p
		LEFT JOIN user AS u ON (p.author_id = u.user_id)
		WHERE p.status = '1'
        ORDER BY p.date_added DESC
	";
	
	// Lấy ra danh sách các bài viết mới nhất
	// và giới hạn số lượng hiển thị trên html.
	$rs = db_q($sql);
	
	$latest_posts = array();
	
	foreach ($rs as $post)
	{
		
		// Tạo file ảnh với kích thước yêu cầu rồi trả lại
		// đường dẫn tương đối của ảnh.
		if (is_file(DIR_IMAGE . $post['image']))
		{
			//$image = img_resize($post['image'], $img_w, $img_h);
			$image = img_resize($post['image'], $data['img_w'], $data['img_h']);
		}
		else // Nếu file ảnh không tồn tại thì dùng ảnh rỗng
		{
			$image = img_resize('placeholder.png', $data['img_w'], $data['img_h']);
		}
		
		// Tinh chỉnh lại độ dài nội dung bài viết
		if (!isset($data['content_length']))
			$data['content_length'] = settings('post_content_length');
			
			if (!isset($data['title_length']))
				$data['title_length'] = settings('post_title_length');
				
				$latest_posts[] = array(
					'post_id'     => $post['post_id'],
					'thumb'       => $image,
					'image'       => URL_IMAGE.$post['image'],
					'title'       => $post['title'],
					'title_short'     => utf8_substr(strip_tags(html_entity_decode($post['title'], ENT_QUOTES, 'UTF-8')), 0, $data['title_length']) . '..',
					'content_short'     => utf8_substr(strip_tags(html_entity_decode($post['content'], ENT_QUOTES, 'UTF-8')), 0, $data['content_length']) . '..',
					'href'        => "/blog-post.php?post_id=" . $post['post_id'],
					'href_author' => '/author-info.php?author_id=' . $post['author_id'],
					'author_href' => '/author-info.php?author_id=' . $post['author_id'],
					'author'      => $post['author'],
					'author_id'   => $post['user_id'],
					'menu'        => $post['menu'],
					'date_published'    => date('d/m/Y', strtotime($post['date_added']))
				);
	}
	
	//$latest_posts = array_slice($latest_posts, 0, settings('posts_featured_limit'));
	//$latest_posts = array_slice($latest_posts, 0, $limit);
	$latest_posts = array_slice($latest_posts, 0, $data['limit']);
	
	return $latest_posts;
}
