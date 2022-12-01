<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 * 
 * Các hàm quản lý loại sản phẩm
 */

// Cấu hình hệ thống
include_once '../../configs.php';
// Thư viện cần thiết
include_once 'table.product.php';

/**
 * Thêm mới loại sản phẩm
 * 
 * @param array $data (Mảng kết hợp chứa dữ liệu gửi lên từ form)
 * 
 * @return void
 */
function categoryAdd($data)
{
		
			// Dữ liệu của loại sản phẩm mới
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
				INSERT INTO `category` 
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
			
			// Cập nhật ảnh đại diện cho loại sản phẩm vừa thêm mới.
			if (isset($data['image']))
			{	
				$image = db_escape($data['image']);
				$sql = " 
					UPDATE `category` 
					SET `image` = '{$image}' 
					WHERE `category_id` = {$category_id}
				";
				db_q($sql);
			}
				
			// Thêm mới dữ liệu liên quan đến đường dẫn của loại sản phẩm.
			// MySQL Hierarchical Data Closure Table Pattern
			$level = 0;
			$parent_id = (int)$data['parent_id'];
			
			// Truy cập vào các bản ghi đường dẫn (category_id | path_id | level)
			// mà rễ của nó là loại cha
			$sql = " 
				SELECT * FROM `category_path` 
				WHERE `category_id` = $parent_id
				ORDER BY `level` ASC
			";
				
			$rs = db_q($sql);	// Truy vấn các bản ghi là cấp cha của loại sản phẩm vừa thêm vào
			
			foreach ($rs as $result) 
			{
				$path_id = (int)$result['path_id'];
				$sql = " 
					INSERT INTO `category_path` 
					SET `category_id` = {$category_id},
					    `path_id` = {$path_id},
						`level` = {$level}
				";
				db_q($sql);
				
				$level++;
			}
			
			$sql = " 
				INSERT INTO `category_path` 
				SET `category_id` = {$category_id},
				    `path_id` = {$category_id},
				    `level` = {$level}
			";
			db_q($sql);
			
			return $category_id;
} // end function 
	
/**
 * Sửa thông tin loại sản phẩm
 * 
 * @param $category_id mã loại sản phẩm
 * @param $data mảng thông tin mới của loại sản phẩm
 * 
 * @return void
 */
function categoryEdit($category_id, $data)
{	
		
			// Dữ liệu chỉnh sửa của loại sản phẩm cũ		
			$parent_id = (int)$data['parent_id'];
			$top = (isset($data['top']) ? (int)$data['top'] : 0);
			$column = (int)$data['column'];
			$sort_order = (int)$data['sort_order'];
			$status = (int)$data['status'];
			$featured = (int)$data['featured'];
			
			$name = db_escape($data['name']); 
			$description = db_escape($data['description']);
			
			$sql = " 
				UPDATE `category`
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
					UPDATE category 
					SET image = '{$image}' 
					WHERE category_id = '{$category_id}'
				";
				db_q($sql);
			}
			
			// MySQL Hierarchical Data Closure Table Pattern
			$sql = " 
				SELECT * FROM `category_path`  
				WHERE `path_id` = '{$category_id}'
				ORDER BY level ASC
			";
			$rs = db_q($sql);
			
			if ( is_array($rs) && !empty($rs) ) {
				foreach ( $rs as $category_path ) {
       				// Delete the path below the current one
       				$cid = (int)$category_path['category_id'];
       				$level = (int)$category_path['level'];
       				$sql = " 
						DELETE FROM `category_path`  
						WHERE `category_id` = '{$cid}' AND level < {$level}
					";
					db_q($sql);
					
					$path = array();
					
					// Get the nodes new parents
					$parent_id = (int)$data['parent_id'];
					$sql = " 
						SELECT * FROM `category_path`  
						WHERE `category_id` = '{$parent_id}'
						ORDER BY level ASC
					";
					$rs = db_q($sql);
					
					foreach ($rs as $result) {
						$path[] = $result['path_id'];
					}
					
					// Get whats left of the nodes current path
					$cid = (int)$category_path['category_id'];
					$sql = " 
						SELECT * FROM `category_path`  
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
						$cid = (int)$category_path['category_id'];
						$sql = " 
							REPLACE INTO `category_path` 
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
					DELETE FROM `category_path` 
					WHERE `category_id` = '{$category_id}'
				";
				db_q($sql);
				
				// Fix for records with no paths
				$level = 0;
				$cid = (int)$data['parent_id'];
				$sql = " 
					SELECT * FROM `category_path`
					WHERE `category_id` = '$cid' 
					ORDER BY level ASC 
				";
				$rs = db_q($sql);
				
				foreach ($rs as $result) 
				{
					$pid = (int)$result['path_id'];
					$sql = "
						INSERT INTO `category_path` 
						SET `category_id` = '{$category_id}',
							`path_id` = {$pid},
							`level` = {$level}
					";
					db_q($sql);
					
					$level++;
				}
				
				$sql = " 
					REPLACE INTO `category_path`
					SET `category_id` = '{$category_id}',
						`path_id` = '{$category_id}',
						`level` = {$level}
				";
				db_q($sql);
			}
			
			db_q($sql);
			
} // end function

/**
 * Xóa thông tin loại sản phẩm
 * @param int $category_id
 */
function categoryDelete($category_id) 
{
		
			// Xóa đi các loại sản phẩm con của loại sản phẩm cần xóa.
			$sql = " 
				DELETE FROM `category_path`
				WHERE `category_id` = {$category_id}
			";
			db_q($sql);
			
			$sql = " 
				SELECT * FROM `category_path`
				WHERE path_id = {$category_id}
			";
			$rs = db_q($sql);
			if ( is_array($rs) && !empty($rs) ) {
				foreach ($rs as $result) {
					categoryDelete($result['category_id']);
				}
			}
			
			// Xóa đi mối liên hệ giữa loại sản phẩm này 
			// và các sản phẩm, các thực thể khác đã từng được liên kết với nó ...
			db_q("DELETE FROM `product_to_category` WHERE `category_id` = {$category_id}");
			
			// ...sau đó mới chính thức xóa đi loại sản phẩm
			db_q("DELETE FROM `category` WHERE `category_id` = {$category_id}");
			
			
} // end function

/**
 * Sửa lại mối quan hệ phân cấp của các loại sản phẩm trong trường hợp bị sai hỏng
 * @param number $parent_id
 * @return void
 */
function categoryRepair($parent_id = 0)
{
			$sql = " 
				SELECT * FROM `category`
				WHERE `parent_id` = {$parent_id}
			";
			$rs = db_q($sql);
					
			if ( is_array($rs) && !empty($rs) ) {
				
				foreach ($rs as $category) {
					// Delete the path below the current one
					$cid = (int)$category['category_id'];
					$sql = " 
						DELETE FROM `category_path`
						WHERE `category_id` = {$cid}
					";
					db_q($sql);
//		
					// Fix for records with no paths
					$level = 0;
					
					$sql = " 
						SELECT * FROM `category_path`
						WHERE `category_id` = {$parent_id}
						ORDER BY `level` ASC
					";
					$rs2 = db_q($sql);
//		
					foreach ($rs2 as $result) {
						$cid = (int)$category['category_id'];
						$path_id = (int)$result['path_id'];
						$sql = " 
							INSERT INTO `category_path`
							SET `category_id` = {$cid},
								`path_id` = {$path_id},
								`level` = {$level}
						";
						db_q($sql);
		
						$level++;
					}
//					
					$cid = (int)$category['category_id'];
					$sql = " 
						REPLACE INTO `category_path`
						SET `category_id` = {$cid},
							`path_id` = {$cid},
							`level` = {$level}
					";
					db_q($sql);
					
					categoryRepair($category['category_id']);
				} // end foreach
			} // end if

}
	
/**
 * @description Lấy ra các bản ghi để phân trang loại sản phẩm
 * SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;'
 * 
 * @returns an indexed array of associative arrays
 */
function categoryGetAll($data = array())
{
		// phục vụ cho việc tìm kiếm sử dụng ajax để gợi nhắc tự động khi user gõ tên loại sản phẩm
		$filter_name = (empty($data['filter_name'])) ? '' : db_escape($data['filter_name']);
		
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
			
		/*
		 MySQL Hierarchical Data Closure Table Pattern.
		 Nối bảng `category_path` và bảng `category` trên quan hệ category_path.path_id = category.category_id để lấy tên của path
		 Nối bảng `category_path` và bảng `category` trên quan hệ category_path.category_id = category.category_id để lấy thêm
		 	các thông tin khác của loại sản phẩm (category)
		 Ví dụ:
		 Để tạo nên đường dẫn phân cấp loại sản phẩm: 
		 		path name:  /Components/Monitors/Test1
		 		path id:    /25/28/35
		 		path level: /0/1/2
		 thì cần 3 bản ghi trong bảng category_path:
		 
		 path_id | category_id | level
		 -----------------------------
		 35      | 35          | 2
		 28      | 35          | 1
		 25      | 35          | 0
		 
		 tham khảo: https://bojanz.wordpress.com/2014/04/25/storing-hierarchical-data-materialized-path/
		 */
		$sql = " 
			SELECT 
				cd.parent_id,
				cp.category_id,
			    GROUP_CONCAT(c.name ORDER BY cp.level SEPARATOR ' > ') AS name,
			    cd.sort_order
			FROM `category_path` AS cp
			LEFT JOIN `category` AS c ON cp.path_id = c.category_id
			LEFT JOIN `category` AS cd ON cp.category_id = cd.category_id
			WHERE cd.name LIKE '%{$filter_name}%'
			GROUP BY cp.category_id
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
	
/**
 * Đếm tổng số loại sản phẩm
 * 
 * @return number if successfully queried
 * @return 0 if there are no records
 * @return NULL if there is error with query (Ex: SELECT COUNT(*) FROM categoryXXX WHERE 3 < 1)
 */
function categoryGetTotal()
{
		
		$sql = "SELECT COUNT(*) FROM `category`";
		
		$rs = db_one($sql);
			
		if ( !is_null($rs) ) 
		{
				return $rs;
		}

		return false;
}
	
/**
 * @return Mảng kết hợp biểu diễn thông tin của một loại sản phẩm
 */
function categoryGetById($category_id)
{
		$category_id = (int)$category_id;
		$sql = " 
			SELECT DISTINCT *, 
			 (
			  SELECT GROUP_CONCAT(cd1.name ORDER BY `level` SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') 
			  FROM `category_path` cp 
			  LEFT JOIN `category` cd1 ON (cp.path_id = cd1.category_id AND cp.category_id != cp.path_id) 
			  WHERE cp.category_id = c.category_id
			  GROUP BY cp.category_id
			 ) AS path 
			FROM `category` c
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
 * @return array();|boolean Mảng kết hợp thông tin của một loại sản phẩm
 */
function categoryGetByIdForPublic($category_id) 
{
	$sql = " 
		SELECT DISTINCT * FROM `category` 
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
 * @return một mảng kết hợp các loại sản phẩm con
 * @param number $parent_id
 */
function categoryGetAllForPublic($parent_id = 0)
{
	$sql = " 
			SELECT * FROM `category`
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

function categoryGetAllByParent($parent_id = 0)
{
	$sql = " 
		SELECT * FROM `category`
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

/* Những loại sản phẩm được đưa lên menu phải có: parent_id=0, status=1, top=1 */
function categoryGetAllForMenuHomePage($limit = 10)
{
	$categoriesMenu = array();

	$categories = categoryGetAllByParent(0);

	foreach ($categories as $category) 
	{
				if ($category['top']) 
				{
					// Level 2
					$children_data = array();
	
					$children = $categories = categoryGetAllByParent($category['category_id']);
	
					foreach ($children as $child) 
					{
	
						$children_data[] = array(
							'name'  => $child['name'] . ' ('. productGetTotalForCategory($child['category_id']) . ')',
							'href'  => '/product-category.php?path=' . $category['category_id'] . '_' . $child['category_id']
						);
					}
	
					// Level 1
					$categoriesMenu[] = array(
						'name'     => $category['name'],
						'children' => $children_data,
						'column'   => $category['column'] ? $category['column'] : 1,
						'href'     => '/product-category.php?path=' . $category['category_id']
					);
				}
	}
	
	// Nhiều giao diện có menu rất hẹp, không đủ chỗ cho tất cả các mục
	// vì vậy phải giới hạn và đặt ra độ ưu tiên (trật tự sắp xếp giữa các menu)
	// thì mới đủ
	if ($limit < count($categoriesMenu)) {
		return array_slice($categoriesMenu, 0, $limit);
	}
	
	return $categoriesMenu;
}

/**
 * Trả về một mảng các Loại Sản Phẩm Nổi Bật
 * @return string[][]|unknown[][]|void[][]
 */
function categoryFeatureds()
{
	$sql = "
		SELECT DISTINCT *
		FROM `category` c
		WHERE c.status = 1 AND c.featured = 1
	";
	
	$rs = db_q($sql);
	
	$categories = array();
	
	foreach ($rs as $category)
	{
		if ($category['image']) {
			$image = img_resize($category['image'], 370, 240);
		} else {
			$image = img_resize('placeholder.png', 370, 240);
		}
		
		$categories[] = array(
				'category_id'  => $category['category_id'],
				'thumb'       => $image,
				'name'        => $category['name'],
				'description' => utf8_substr(strip_tags(html_entity_decode($category['description'], ENT_QUOTES, 'UTF-8')), 0, settings('config_product_description_length')) . '..',
				'href'        => "/product-category.php?path=" . $category['category_id'],
				'width'       => 370,
				'height'      => 240,
		);
	}
	
	$categories = array_slice($categories,0,3);// limit  = 3
	
	return $categories;
}// end function