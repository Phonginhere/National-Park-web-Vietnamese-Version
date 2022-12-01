<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 * 
 * Các hàm quản lý loại bài viết.

 * Chú ý khi sao chép từ bảng `category` sang `post_category`
 * KHi thay thế từ khóa 'category' bằng 'post_category' thì nảy sinh vấn đề: category_id ---> post_category_id
 * trong khi tên cột ở db vẫn giữ nguyên là 'category_id'
 * vì vậy phải replace một lần nữa: 'post_category_id' ---> 'category_id' cho khớp với db.
 */

// Cấu hình hệ thống
include_once '../../configs.php';
// Thư viện cần thiết
include_once 'table.post.php';

/**
 * Thêm mới loại bài viết
 * 
 * @param array $data (Mảng kết hợp chứa dữ liệu gửi lên từ form)
 * 
 * @return void
 */
function post_categoryAdd($data)
{
		
			// Dữ liệu của loại bài viết mới
			$parent_id = (int)$data['parent_id'];
			$top = (isset($data['top']) ? (int)$data['top'] : 0);
			$column = (int)$data['column'];
			$sort_order = (int)$data['sort_order'];
			$status = (int)$data['status'];
			$featured = (int)$data['featured'];
			
			$name = db_escape($data['name']); 
			$description = db_escape($data['description']);
			
			// Sử dụng cú pháp INSERT INTO ... SET
			// để không phải viết các tên cột trên một hàng dài.
			$sql = " 
				INSERT INTO `post_category` 
				SET `parent_id` = {$parent_id}, 
					`top` = {$top}, 
				    `column` = {$column}, 
				    `sort_order` = {$sort_order}, 
				    `status` = {$status}, 
				    `featured` = {$featured}, 
				    `date_modified` = NOW(), 
				    `date_added` = NOW(),
				    `name` = '{$name}',
					`description` = '{$description}'
			";
			db_q($sql);
			
			// Lấy lại id của bản ghi vừa thêm mới
			$category_id = (int)db_lastId();
			
			// Cập nhật ảnh đại diện cho loại bài viết vừa thêm mới.
			if (isset($data['image']))
			{	
				$image = db_escape($data['image']);
				$sql = " 
					UPDATE `post_category` 
					SET `image` = '{$image}' 
					WHERE `category_id` = {$category_id}
				";
				db_q($sql);
			}
				
			// Thêm mới dữ liệu liên quan đến đường dẫn của loại bài viết.
			// MySQL Hierarchical Data Closure Table Pattern
			$level = 0;
			$parent_id = (int)$data['parent_id'];
			
			// Truy cập vào các bản ghi đường dẫn (category_id | path_id | level)
			// mà gốc là loại cha
			$sql = " 
				SELECT * FROM `post_category_path` 
				WHERE `category_id` = $parent_id
				ORDER BY `level` ASC
			";
				
			$rs = db_q($sql);	// Truy vấn các bản ghi là cấp cha của loại bài viết vừa thêm vào
			
			foreach ($rs as $result) 
			{
				$path_id = (int)$result['path_id'];
				$sql = " 
					INSERT INTO `post_category_path` 
					SET `category_id` = {$category_id},
					    `path_id` = {$path_id},
						`level` = {$level}
				";
				db_q($sql);
				
				$level++;
			}
			
			$sql = " 
				INSERT INTO `post_category_path` 
				SET `category_id` = {$category_id},
				    `path_id` = {$category_id},
				    `level` = {$level}
			";
			db_q($sql);
			
			return $category_id;
} // end function 
	
/**
 * Sửa thông tin loại bài viết
 * 
 * @param $category_id mã loại bài viết
 * @param $data mảng thông tin mới của loại bài viết
 * 
 * @return void
 */
function post_categoryEdit($category_id, $data)
{	
		
			// Dữ liệu chỉnh sửa của loại bài viết cũ		
			$parent_id = (int)$data['parent_id'];
			$top = (isset($data['top']) ? (int)$data['top'] : 0);
			$column = (int)$data['column'];
			$sort_order = (int)$data['sort_order'];
			$status = (int)$data['status'];
			$featured = (int)$data['featured'];
			
			$name = db_escape($data['name']); 
			$description = db_escape($data['description']);
			
			$sql = " 
				UPDATE `post_category`
				SET `parent_id` = {$parent_id}, 
					`top` = {$top}, 
					`column` = {$column}, 
					`sort_order` = {$sort_order}, 
					`status` = {$status}, 
					`featured` = {$featured}, 
					`date_modified` = NOW(),
					`name` = '{$name}',
					`description` = '{$description}'
				WHERE category_id = '{$category_id}'
			";
			db_q($sql);
			
			// Cập nhật ảnh nếu có mới
			if (isset($data['image']))
			{	
				$image = db_escape($data['image']);
				$sql = " 
					UPDATE post_category 
					SET image = '{$image}' 
					WHERE category_id = '{$category_id}'
				";
				db_q($sql);
			}
			
			// MySQL Hierarchical Data Closure Table Pattern
			$sql = " 
				SELECT * FROM `post_category_path`  
				WHERE `path_id` = '{$category_id}'
				ORDER BY level ASC
			";
			$rs = db_q($sql);
			
			if ( is_array($rs) && !empty($rs) ) {
				foreach ( $rs as $post_category_path ) {
       				// Delete the path below the current one
       				$cid = (int)$post_category_path['category_id'];
       				$level = (int)$post_category_path['level'];
       				$sql = " 
						DELETE FROM `post_category_path`  
						WHERE `category_id` = '{$cid}' AND level < {$level}
					";
					db_q($sql);
					
					$path = array();
					
					// Get the nodes new parents
					$parent_id = (int)$data['parent_id'];
					$sql = " 
						SELECT * FROM `post_category_path`  
						WHERE `category_id` = '{$parent_id}'
						ORDER BY level ASC
					";
					$rs = db_q($sql);
					
					foreach ($rs as $result) {
						$path[] = $result['path_id'];
					}
					
					// Get whats left of the nodes current path
					$cid = (int)$post_category_path['category_id'];
					$sql = " 
						SELECT * FROM `post_category_path`  
						WHERE `category_id` = '{$cid}'
						ORDER BY `level` ASC
					";
					$rs = db_q($sql);
					
					foreach ($rs as $result) {
						$path[] = $result['path_id'];
					}
					
					// Combine the paths with a new level
					$level = 0;
					
					foreach ($path as $path_id) {
						$cid = (int)$post_category_path['category_id'];
						$sql = " 
							REPLACE INTO `post_category_path` 
							SET `category_id` = {$cid}, 
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
					DELETE FROM `post_category_path` 
					WHERE `category_id` = '{$category_id}'
				";
				db_q($sql);
				
				// Fix for records with no paths
				$level = 0;
				$cid = (int)$data['parent_id'];
				$sql = " 
					SELECT * FROM `post_category_path`
					WHERE `category_id` = '$cid' 
					ORDER BY level ASC 
				";
				$rs = db_q($sql);
				
				foreach ($rs as $result) 
				{
					$pid = (int)$result['path_id'];
					$sql = "
						INSERT INTO `post_category_path` 
						SET `category_id` = '{$category_id}',
							`path_id` = {$pid},
							`level` = {$level}
					";
					db_q($sql);
					
					$level++;
				}
				
				$sql = " 
					REPLACE INTO `post_category_path`
					SET `category_id` = '{$category_id}',
						`path_id` = '{$category_id}',
						`level` = {$level}
				";
				db_q($sql);
			}
			
			db_q($sql);
			
} // end function

/**
 * Xóa thông tin loại bài viết
 * @param int $category_id
 */
function post_categoryDelete($category_id) 
{
		
			// Xóa đi các loại bài viết con của loại bài viết cần xóa.
			$sql = " 
				DELETE FROM `post_category_path`
				WHERE `category_id` = {$category_id}
			";
			db_q($sql);
			
			$sql = " 
				SELECT * FROM `post_category_path`
				WHERE path_id = {$category_id}
			";
			$rs = db_q($sql);
			if ( is_array($rs) && !empty($rs) ) {
				foreach ($rs as $result) {
					post_categoryDelete($result['category_id']);
				}
			}
			
			// Xóa đi mối liên hệ giữa loại bài viết này 
			// và các bài viết, các thực thể khác đã từng được liên kết với nó ...
			db_q("DELETE FROM `post_to_category` WHERE `category_id` = {$category_id}");
			
			// ...sau đó mới chính thức xóa đi loại bài viết
			db_q("DELETE FROM `post_category` WHERE `category_id` = {$category_id}");
			
			
} // end function

/**
 * Sửa lại mối quan hệ phân cấp của các loại bài viết trong trường hợp bị sai hỏng
 * @param number $parent_id
 * @return void
 */
function post_categoryRepair($parent_id = 0)
{
			$sql = " 
				SELECT * FROM `post_category`
				WHERE `parent_id` = {$parent_id}
			";
			$rs = db_q($sql);
					
			if ( is_array($rs) && !empty($rs) ) {
				
				foreach ($rs as $post_category) {
					// Delete the path below the current one
					$cid = (int)$post_category['category_id'];
					$sql = " 
						DELETE FROM `post_category_path`
						WHERE `category_id` = {$cid}
					";
					db_q($sql);
//		
					// Fix for records with no paths
					$level = 0;
					
					$sql = " 
						SELECT * FROM `post_category_path`
						WHERE `category_id` = {$parent_id}
						ORDER BY `level` ASC
					";
					$rs2 = db_q($sql);
//		
					foreach ($rs2 as $result) {
						$cid = (int)$post_category['category_id'];
						$path_id = (int)$result['path_id'];
						$sql = " 
							INSERT INTO `post_category_path`
							SET `category_id` = {$cid},
								`path_id` = {$path_id},
								`level` = {$level}
						";
						db_q($sql);
		
						$level++;
					}
//					
					$cid = (int)$post_category['category_id'];
					$sql = " 
						REPLACE INTO `post_category_path`
						SET `category_id` = {$cid},
							`path_id` = {$cid},
							`level` = {$level}
					";
					db_q($sql);
					
					post_categoryRepair($post_category['category_id']);
				} // end foreach
			} // end if

}
	
/**
 * @description Lấy ra các bản ghi để phân trang loại bài viết
 * SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;'
 * 
 * @returns an indexed array of associative arrays
 */
function post_categoryGetAll($data = array())
{
	// phục vụ cho việc tìm kiếm sử dụng ajax để gợi nhắc tự động khi user gõ tên loại bài viết
	$filter_name = (empty($data['filter_name'])) ? '' : db_escape($data['filter_name']);
	
	$sql = "
		SELECT
            cd.name as name_no_path,
			cd.featured as featured,
			cd.status as status,
			cd.top as top,
			cd.image as image,
			cd.parent_id,
			cd.sort_order,
			cd.date_added,
			cp.category_id,
			GROUP_CONCAT(c.name ORDER BY cp.level SEPARATOR ' > ') AS name
		FROM `post_category_path` AS cp
		LEFT JOIN `post_category` AS c ON cp.path_id = c.category_id
		LEFT JOIN `post_category` AS cd ON cp.category_id = cd.category_id
		WHERE cd.name LIKE '%{$filter_name}%'
	";
	
	// Nếu yêu cầu lọc theo trạng thái của bài viết thì tiếp tục bổ sung
	// nội dung truy vấn cho sql
	if (isset($data['filter_status']) && !is_null($data['filter_status']))
	{
		$sql .= " AND cd.status = '" . (int)$data['filter_status'] . "'";
	}
	
	if (isset($data['filter_featured']) && !is_null($data['filter_featured']))
	{
		$sql .= " AND cd.featured = '" . (int)$data['filter_featured'] . "'";
	}
	
	if (isset($data['filter_top']) && !is_null($data['filter_top']))
	{
		$sql .= " AND cd.top = '" . (int)$data['filter_top'] . "'";
	}
	
	$sql .= " GROUP BY cp.category_id";
		
		
	// Trật tự sắp xếp và giới hạn phân trang mặc định.
	$sort = "sort_order";
	$order = "ASC";
	$start = 0;
	$limit = 20;
		
	// Tinh chỉnh trật tự sắp xếp và giới hạn phân trang
	// dựa theo truy vấn gửi đến từ phía máy khách.
	// Các cột được phép sắp xếp.
	// Vì sao lại phải có bí danh 'cd' trước tên các cột, để đề phòng về sau nâng cấp nó lên thành phép nối bảng !!!
	// Mà khi nối bảng thì 2 bảng hay có các cột giống tên nhau, dễ gây lỗi Ambiguous.
	$sort_data = array(
		'cd.category_id',
		'cd.name',
		'cd.status',
		'cd.featured',
		'cd.top',
		'cd.sort_order',
		'cd.date_added'
	);
	
	if (isset($data['sort']) && in_array($data['sort'], $sort_data))
	{
		$sort = $data['sort'];
	}
	if (isset($data['order']) && ($data['order'] == 'DESC'))
	{
		$order = "DESC";
	}
		
	// Những bước này chỉ mang tính chắc cú, chứ thực ra cũng không cần thiết
	if (isset($data['start']) && (int)$data['start'] >= 0)
		$start = (int)$data['start'];
		
	if (isset($data['limit']) && (int)$data['limit'] >= 1)
		$limit = (int)$data['limit'];
			
	$sql .= " ORDER BY {$sort} {$order}"; // ví dụ: ORDER BY name ASC
	$sql .= " LIMIT {$start},{$limit}";
	
		/*
		 MySQL Hierarchical Data Closure Table Pattern.
		 Nối bảng `post_category_path` và bảng `post_category` trên quan hệ post_category_path.path_id = post_category.category_id để lấy tên của path
		 Nối bảng `post_category_path` và bảng `post_category` trên quan hệ post_category_path.category_id = post_category.category_id để lấy thêm
		 	các thông tin khác của loại bài viết (post_category)
		 Ví dụ:
		 Để tạo nên đường dẫn phân cấp loại bài viết: 
		 		path name:  /Components/Monitors/Test1
		 		path id:    /25/28/35
		 		path level: /0/1/2
		 thì cần 3 bản ghi trong bảng post_category_path:
		 
		 path_id | category_id | level
		 -----------------------------
		 35      | 35          | 2
		 28      | 35          | 1
		 25      | 35          | 0
		 
		 tham khảo: https://bojanz.wordpress.com/2014/04/25/storing-hierarchical-data-materialized-path/
		 */
		/* old !!!
		$sql = " 
			SELECT 
				cd.parent_id,
				cp.category_id,
			    GROUP_CONCAT(c.name ORDER BY cp.level SEPARATOR ' > ') AS name,
			    cd.sort_order,
                cd.name AS name_no_path
			FROM `post_category_path` AS cp
			LEFT JOIN `post_category` AS c ON cp.path_id = c.category_id
			LEFT JOIN `post_category` AS cd ON cp.category_id = cd.category_id
			WHERE cd.name LIKE '%{$filter_name}%'
			GROUP BY cp.category_id
			ORDER BY {$sort} {$order}
			LIMIT {$start},{$limit}
		";
		*/
		
		//echo $sql; die(); // testing only
	$rs = db_q($sql);
			
	if ( is_array($rs) && !empty($rs) ) 
	{
		return $rs;
	}
			
	return false;
}// end function
	
/**
 * Đếm tổng số loại bài viết
 * 
 * @return number if successfully queried
 * @return 0 if there are no records
 * @return NULL if there is error with query (Ex: SELECT COUNT(*) FROM post_categoryXXX WHERE 3 < 1)
 */
function post_categoryGetTotal($data = array())
{
		
	$filter_name = "%".db_escape($data['filter_name']) . "%";
	
	$sql = "
		SELECT COUNT(*)
		FROM `post_category`
		WHERE `name` LIKE '{$filter_name}'
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
		
	$rs = db_one($sql);
			
	if ( !is_null($rs) ) 
	{
		return $rs;
	}

	return false;
}
	
/**
 * @return Mảng kết hợp biểu diễn thông tin của một loại bài viết
 */
function post_categoryGetById($category_id)
{
		$category_id = (int)$category_id;
		$sql = " 
			SELECT DISTINCT *, 
			 (
			  SELECT GROUP_CONCAT(cd1.name ORDER BY `level` SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') 
			  FROM `post_category_path` cp 
			  LEFT JOIN `post_category` cd1 ON (cp.path_id = cd1.category_id AND cp.category_id != cp.path_id) 
			  WHERE cp.category_id = c.category_id
			  GROUP BY cp.category_id
			 ) AS path 
			FROM `post_category` c
			WHERE c.category_id = {$category_id}
		";

		$rs = db_row($sql);
		if ( is_array($rs) && !empty($rs) ) 
		{
				return $rs;
		}

		return false;
}

/**
 * 
 * @param unknown $category_id
 * @return array();|boolean Mảng kết hợp thông tin của một loại bài viết
 */
function post_categoryGetByIdForPublic($category_id) 
{
	$sql = " 
		SELECT DISTINCT * FROM `post_category` 
		WHERE `category_id` = '" . (int)$category_id . "' AND `status` = '1'
    ";
	
	$rs =  db_row($sql);
	
	if ( is_array($rs) && !empty($rs) ) 
	{
		return $rs;
	}

	return false;
}

/**
 * @return một mảng kết hợp các loại bài viết con
 * @param number $parent_id
 */
function post_categoryGetAllForPublic($parent_id = 0)
{
	$sql = " 
			SELECT * FROM `post_category`
			WHERE `parent_id` = '{$parent_id}' 
				AND `status` = '1' 
			ORDER BY `sort_order`, LCASE(name)
	";

	$rs = db_q($sql);
	
	if ( is_array($rs) && !empty($rs) )
	{
		return $rs;
	}

	return false;
} // en

function post_categoryGetAllByParent($parent_id = 0)
{
	$sql = " 
		SELECT * FROM `post_category`
		WHERE `parent_id` = '{$parent_id}' 
				AND `status` = '1' 
		ORDER BY `sort_order`, LCASE(name)
	";

	$rs = db_q($sql);
	
	if ( is_array($rs) && !empty($rs) )
	{
		return $rs;
	}

	return false;
} // en

/**
 Những loại bài viết được đưa lên menu top trang chủ Home
 phải có: parent_id=0, status=1, top=1 
 (tức là không có loại cha, trạng thái: cho phép xuất hiện, vị trí top 1
 */
function post_categoryGetAllForMenuHomePage($limit = 10)
{
	$post_categoriesMenu = array();

	$post_categories = post_categoryGetAllByParent(0);

	foreach ($post_categories as $post_category) 
	{
		if ($post_category['top']) 
		{
			// Level 2
			$children_data = array();
	
			$children = $post_categories = post_categoryGetAllByParent($post_category['category_id']);
	
			foreach ($children as $child) 
			{
	        	// @todo sửa chỗ này đi
				$children_data[] = array(
					//'name'  => $child['name'] . ' ('. postGetTotalForpost_category($child['category_id']) . ')',
                    'name'  => $child['name'],
					'href'  => '/post_category.php?path=' . $post_category['category_id'] . '_' . $child['category_id']
				);
			}
	
			// Level 1
			$post_categoriesMenu[] = array(
				'category_id' => $post_category['category_id'],
				'name'     => $post_category['name'],
				'children' => $children_data,
				'column'   => $post_category['column'] ? $post_category['column'] : 1,
				'href'     => '/post_category.php?path=' . $post_category['category_id']
			);
		}
	}
	
	// Nhiều giao diện có menu rất hẹp, không đủ chỗ cho tất cả các mục
	// vì vậy phải giới hạn và đặt ra độ ưu tiên (trật tự sắp xếp giữa các menu)
	// thì mới đủ
	if ($limit < count($post_categoriesMenu)) {
		return array_slice($post_categoriesMenu, 0, $limit);
	}
	
	return $post_categoriesMenu;
}

/**
 * Trả về một mảng các Loại bài viết Nổi Bật
 * @return string[][]|unknown[][]|void[][]
 */
function post_categoryFeatureds()
{
	$sql = "
		SELECT DISTINCT *
		FROM `post_category` c
		WHERE c.status = 1 AND c.featured = 1
	";
	
	$rs = db_q($sql);
	
	$post_categories = array();
	
	foreach ($rs as $post_category)
	{
		if ($post_category['image']) 
		{
			$image = img_resize($post_category['image'], 370, 240);
		} 
		else 
		{
			$image = img_resize('placeholder.png', 370, 240);
		}
		
		$post_categories[] = array(
				'category_id'  => $post_category['category_id'],
				'thumb'       => $image,
				'image'       => URL_IMAGE.$post_category['image'],
				'name'        => $post_category['name'],
				'description' => utf8_substr(strip_tags(html_entity_decode($post_category['description'], ENT_QUOTES, 'UTF-8')), 0, settings('config_post_description_length')) . '..',
				'href'        => "/post_category.php?path=" . $post_category['category_id'],
				'width'       => 370,
				'height'      => 240,
		);
	}
	
	$post_categories = array_slice($post_categories,0,3);// limit  = 3
	
	return $post_categories;
}// end function

/**
 * @abstract Lấy ra các loại tin mà có ít nhất một bài viết liên quan đến chúng.
 *           Nghĩa là tồn tại ít nhất 1 bài viết về loại tin đó.
 * 
 * @param array $data Mảng tham số đầu vào.
 * @return indexed array
 *
 * Câu sql thống kê xem mỗi loại tin có những bài viết nào:
 * 
  SELECT 
       DISTINCT ptc.category_id,
       pc.name,
		pc.sort_order,
		pc.image,
		pc.description
	FROM `post_to_category` as ptc
	LEFT JOIN `post_category` as pc ON ptc.category_id = pc.category_id
	ORDER BY pc.sort_order ASC
 */
function post_categoryGetAllThatHavePost($data = array())
{
	// phục vụ cho việc tìm kiếm sử dụng ajax để gợi nhắc tự động khi user gõ tên loại bài viết
	//$filter_name = (empty($data['filter_name'])) ? '' : db_escape($data['filter_name']);
	
	// Trật tự sắp xếp và giới hạn phân trang mặc định.
	$sort = "sort_order";
	$order = "ASC";
	$start = 0;
	$limit = 20;
	
	// Tinh chỉnh trật tự sắp xếp và giới hạn phân trang
	// dựa theo truy vấn gửi đến từ phía máy khách.
	$sort_data = array(
		'name',
		'sort_order'
	);
	
	if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
		$sort = $data['sort'];
	}
	if (isset($data['order']) && ($data['order'] == 'DESC')) {
		$order = "DESC";
	}
	
	// Những bước này chỉ mang tính chắc cú, chứ thực ra cũng không cần thiết
	if (isset($data['start']) && (int)$data['start'] >= 0)
		$start = (int)$data['start'];
		
		if (isset($data['limit']) && (int)$data['limit'] >= 1)
			$limit = (int)$data['limit'];
			
		$sql = "
			SELECT DISTINCT
				ptc.category_id,
				pc.name,
				pc.sort_order,
				pc.image,
				pc.description
			FROM `post_to_category` as ptc
			LEFT JOIN `post_category` as pc ON ptc.category_id = pc.category_id
			ORDER BY {$sort} {$order}
			LIMIT {$start},{$limit}
			";
			
			//		echo $sql;
			$rs = db_q($sql);
			
			if ( is_array($rs) && !empty($rs) )
			{
				return $rs;
			}
			
			return false;
}// end function