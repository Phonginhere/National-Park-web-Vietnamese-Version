<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 * 
 * Các hàm quản lý phòng ban (viện, trung tâm, cơ quan, hội sở, chi nhánh, v.v...)
 */

// Cấu hình hệ thống
include_once '../../configs.php';
// Thư viện cần thiết
//include_once 'table.product.php';
include_once 'table.user.php';

/**
 * Thêm mới phòng ban
 * 
 * @param array $data (Mảng kết hợp chứa dữ liệu gửi lên từ form)
 * 
 * @return void
 */
function departmentAdd($data)
{
		
			// Tinh chỉnh dữ liệu thô của phòng ban mới
			$parent_id  = (int)$data['parent_id'];
			$top        = (isset($data['top']) ? (int)$data['top'] : 0);
			$column     = (int)$data['column'];
			$sort_order = (int)$data['sort_order'];
			$status     = (int)$data['status'];
			$featured   = (int)$data['featured'];
			
			$name = db_escape($data['name']); 
			$description = db_escape($data['description']);
			
			$email   = db_escape($data['email']);
			$website = db_escape($data['website']);
			$phone   = db_escape($data['phone']);
			$address = db_escape($data['address']);
			$html_google_map = db_escape($data['html_google_map']);
			
			// Sử dụng cú pháp INSERT INTO ... SET
			// để không phải viết các tên cột trên một hàng dài.
			$sql = " 
				INSERT INTO `department` 
				SET `parent_id` = {$parent_id}, 
					`top` = {$top}, 
				    `column` = {$column}, 
				    `sort_order` = {$sort_order}, 
				    `status` = {$status}, 
				    `featured` = {$featured}, 
				    `date_modified` = NOW(), 
				    `date_added` = NOW(),
				    `name` = '{$name}',
					`description` = '{$description}',
					`email`   = '{$email}',
			        `website` = '{$website}',
			        `phone`   = '{$phone}',
			        `address` = '{$address}',
					`html_google_map` = '{$html_google_map}'
			";
			db_q($sql);
			
			// Lấy lại id của bản ghi vừa thêm mới
			$department_id = (int)db_lastId();
			
			// Cập nhật ảnh đại diện cho phòng ban vừa thêm mới.
			if (isset($data['image']))
			{	
				$image = db_escape($data['image']);
				$sql = " 
					UPDATE `department` 
					SET `image` = '{$image}' 
					WHERE `department_id` = {$department_id}
				";
				db_q($sql);
			}
				
			// Thêm mới dữ liệu liên quan đến đường dẫn của phòng ban.
			// MySQL Hierarchical Data Closure Table Pattern
			$level = 0;
			$parent_id = (int)$data['parent_id'];
			
			// Truy cập vào các bản ghi đường dẫn (department_id | path_id | level)
			// mà gốc là loại cha
			$sql = " 
				SELECT * FROM `department_path` 
				WHERE `department_id` = $parent_id
				ORDER BY `level` ASC
			";
				
			$rs = db_q($sql);	// Truy vấn các bản ghi là cấp cha của phòng ban vừa thêm vào
			
			foreach ($rs as $result) 
			{
				$path_id = (int)$result['path_id'];
				$sql = " 
					INSERT INTO `department_path` 
					SET `department_id` = {$department_id},
					    `path_id` = {$path_id},
						`level` = {$level}
				";
				db_q($sql);
				
				$level++;
			}
			
			$sql = " 
				INSERT INTO `department_path` 
				SET `department_id` = {$department_id},
				    `path_id` = {$department_id},
				    `level` = {$level}
			";
			db_q($sql);
			
			return $department_id;
} // end function 
	
/**
 * Sửa thông tin phòng ban
 * 
 * @param $department_id Mã Phòng Ban
 * @param $data mảng thông tin mới của Phòng Ban
 * 
 * @return void
 */
function departmentEdit($department_id, $data)
{	
		
			// Dữ liệu chỉnh sửa của phòng ban cũ		
			$parent_id  = (int)$data['parent_id'];
			$top        = (isset($data['top']) ? (int)$data['top'] : 0);
			$column     = (int)$data['column'];
			$sort_order = (int)$data['sort_order'];
			$status     = (int)$data['status'];
			$featured   = (int)$data['featured'];
			
			$name        = db_escape($data['name']); 
			$description = db_escape($data['description']);
			
			$email   = db_escape($data['email']);
			$website = db_escape($data['website']);
			$phone   = db_escape($data['phone']);
			$address = db_escape($data['address']);
			$html_google_map = db_escape($data['html_google_map']);
			
			$sql = " 
				UPDATE `department`
				SET `parent_id` = {$parent_id}, 
					`top` = {$top}, 
					`column` = {$column}, 
					`sort_order` = {$sort_order}, 
					`status` = {$status}, 
					`featured` = {$featured}, 
					`date_modified` = NOW(),
					`name` = '{$name}',
					`description` = '{$description}',
					`email`   = '{$email}',
			        `website` = '{$website}',
			        `phone`   = '{$phone}',
			        `address` = '{$address}',
					`html_google_map` = '{$html_google_map}'
				WHERE `department_id` = '{$department_id}'
			";
			db_q($sql);
			
			// Cập nhật ảnh nếu có mới
			if (isset($data['image']))
			{	
				$image = db_escape($data['image']);
				$sql = " 
					UPDATE department 
					SET image = '{$image}' 
					WHERE department_id = '{$department_id}'
				";
				db_q($sql);
			}
			
			// MySQL Hierarchical Data Closure Table Pattern
			$sql = " 
				SELECT * FROM `department_path`  
				WHERE `path_id` = '{$department_id}'
				ORDER BY level ASC
			";
			$rs = db_q($sql);
			
			if ( is_array($rs) && !empty($rs) ) {
				foreach ( $rs as $department_path ) {
       				// Delete the path below the current one
       				$cid = (int)$department_path['department_id'];
       				$level = (int)$department_path['level'];
       				$sql = " 
						DELETE FROM `department_path`  
						WHERE `department_id` = '{$cid}' AND level < {$level}
					";
					db_q($sql);
					
					$path = array();
					
					// Get the nodes new parents
					$parent_id = (int)$data['parent_id'];
					$sql = " 
						SELECT * FROM `department_path`  
						WHERE `department_id` = '{$parent_id}'
						ORDER BY level ASC
					";
					$rs = db_q($sql);
					
					foreach ($rs as $result) {
						$path[] = $result['path_id'];
					}
					
					// Get whats left of the nodes current path
					$cid = (int)$department_path['department_id'];
					$sql = " 
						SELECT * FROM `department_path`  
						WHERE `department_id` = '{$cid}'
						ORDER BY `level` ASC
					";
					$rs = db_q($sql);
					
					foreach ($rs as $result) {
						$path[] = $result['path_id'];
					}
					
					// Combine the paths with a new level
					$level = 0;
					
					foreach ($path as $path_id) {
						$cid = (int)$department_path['department_id'];
						$sql = " 
							REPLACE INTO `department_path` 
							SET `department_id` = {$cid}, 
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
					DELETE FROM `department_path` 
					WHERE `department_id` = '{$department_id}'
				";
				db_q($sql);
				
				// Fix for records with no paths
				$level = 0;
				$cid = (int)$data['parent_id'];
				$sql = " 
					SELECT * FROM `department_path`
					WHERE `department_id` = '$cid' 
					ORDER BY level ASC 
				";
				$rs = db_q($sql);
				
				foreach ($rs as $result) 
				{
					$pid = (int)$result['path_id'];
					$sql = "
						INSERT INTO `department_path` 
						SET `department_id` = '{$department_id}',
							`path_id` = {$pid},
							`level` = {$level}
					";
					db_q($sql);
					
					$level++;
				}
				
				$sql = " 
					REPLACE INTO `department_path`
					SET `department_id` = '{$department_id}',
						`path_id` = '{$department_id}',
						`level` = {$level}
				";
				db_q($sql);
			}
			
			db_q($sql);
			
} // end function

/**
 * @description Xóa thông tin phòng ban
 * @param int $department_id
 */
function departmentDelete($department_id) 
{
		
			// Xóa đi các phòng ban con trước
			$sql = " 
				DELETE FROM `department_path`
				WHERE `department_id` = {$department_id}
			";
			db_q($sql);
			
			$sql = " 
				SELECT * FROM `department_path`
				WHERE path_id = {$department_id}
			";
			$rs = db_q($sql);
			if ( is_array($rs) && !empty($rs) ) 
            {
				foreach ($rs as $result) 
                {
					departmentDelete($result['department_id']);
				}
			}
			
            // @todo: Nếu xóa phòng ban mà có user chiếu sang thì sao ? Nên đặt trong validate !!!
			// Xóa đi mối liên hệ giữa phòng ban với các thực thể ở bảng khác (ví dụ: bảng nhân viên)
            // nếu là bảng `user` thì quan hệ giữa `user` và `department` phải là nhiều<----->nhiều, lúc đó mới cần 
            // có bảng user_to_department và cần phải xóa, còn 1 user thuộc về 1 phòng ban duy nhất thì phải xử lý khác.
			//db_q("DELETE FROM `user_to_department` WHERE `department_id` = {$department_id}");
			
			// ...sau đó mới chính thức xóa đi phòng ban
			db_q("DELETE FROM `department` WHERE `department_id` = {$department_id}");
			
			
} // end function

/**
 * Sửa lại mối quan hệ phân cấp của các phòng ban trong trường hợp bị sai hỏng
 * @param number $parent_id
 * @return void
 */
function departmentRepair($parent_id = 0)
{
			$sql = " 
				SELECT * FROM `department`
				WHERE `parent_id` = {$parent_id}
			";
			$rs = db_q($sql);
					
			if ( is_array($rs) && !empty($rs) ) {
				
				foreach ($rs as $department) {
					// Delete the path below the current one
					$cid = (int)$department['department_id'];
					$sql = " 
						DELETE FROM `department_path`
						WHERE `department_id` = {$cid}
					";
					db_q($sql);
//		
					// Fix for records with no paths
					$level = 0;
					
					$sql = " 
						SELECT * FROM `department_path`
						WHERE `department_id` = {$parent_id}
						ORDER BY `level` ASC
					";
					$rs2 = db_q($sql);
//		
					foreach ($rs2 as $result) {
						$cid = (int)$department['department_id'];
						$path_id = (int)$result['path_id'];
						$sql = " 
							INSERT INTO `department_path`
							SET `department_id` = {$cid},
								`path_id` = {$path_id},
								`level` = {$level}
						";
						db_q($sql);
		
						$level++;
					}
//					
					$cid = (int)$department['department_id'];
					$sql = " 
						REPLACE INTO `department_path`
						SET `department_id` = {$cid},
							`path_id` = {$cid},
							`level` = {$level}
					";
					db_q($sql);
					
					departmentRepair($department['department_id']);
				} // end foreach
			} // end if

}
	
/**
 * @description Lấy ra các bản ghi để phân trang phòng ban
 * SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;'
 * 
 * @returns an indexed array of associative arrays
 */
function departmentGetAll($data = array())
{
		// phục vụ cho việc tìm kiếm sử dụng ajax để gợi nhắc tự động khi user gõ tên phòng ban
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
            'department_id',
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
		 Nối bảng `department_path` và bảng `department` trên quan hệ department_path.path_id = department.department_id để lấy tên của path
		 Nối bảng `department_path` và bảng `department` trên quan hệ department_path.department_id = department.department_id để lấy thêm
		 	các thông tin khác của phòng ban (department)
		 Ví dụ:
		 Để tạo nên đường dẫn phân cấp phòng ban: 
		 		path name:  /Grand/Parent/Child
		 		path id:    /25/28/35
		 		path level: /0/1/2
		 thì cần 3 bản ghi trong bảng department_path:
		 
		 path_id | department_id | level
		 -----------------------------
		 35      | 35          | 2
		 28      | 35          | 1
		 25      | 35          | 0
		 
		 tham khảo: https://bojanz.wordpress.com/2014/04/25/storing-hierarchical-data-materialized-path/
		 */
		$sql = " 
			SELECT 
				cd.parent_id,
				cp.department_id,
			    GROUP_CONCAT(c.name ORDER BY cp.level SEPARATOR ' > ') AS name,
			    cd.sort_order
			FROM `department_path` AS cp
			LEFT JOIN `department` AS c ON cp.path_id = c.department_id
			LEFT JOIN `department` AS cd ON cp.department_id = cd.department_id
			WHERE cd.name LIKE '%{$filter_name}%'
			GROUP BY cp.department_id
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
 * Đếm tổng số phòng ban
 * 
 * @return number if successfully queried
 * @return 0 if there are no records
 * @return NULL if there is error with query (Ex: SELECT COUNT(*) FROM departmentXXX WHERE 3 < 1)
 */
function departmentGetTotal()
{
		
		$sql = "SELECT COUNT(*) FROM `department`";
		
		$rs = db_one($sql);
			
		if ( !is_null($rs) ) 
		{
				return $rs;
		}

		return false;
}
	
/**
 * @return Mảng kết hợp biểu diễn thông tin của một phòng ban
 */
function departmentGetById($department_id)
{
		$department_id = (int)$department_id;
		$sql = " 
			SELECT DISTINCT *, 
			 (
			  SELECT GROUP_CONCAT(cd1.name ORDER BY `level` SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') 
			  FROM `department_path` cp 
			  LEFT JOIN `department` cd1 ON (cp.path_id = cd1.department_id AND cp.department_id != cp.path_id) 
			  WHERE cp.department_id = c.department_id
			  GROUP BY cp.department_id
			 ) AS path 
			FROM `department` c
			WHERE c.department_id = {$department_id}
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
 * @param unknown $department_id
 * @return array();|boolean Mảng kết hợp thông tin của một phòng ban
 */
function departmentGetByIdForPublic($department_id) 
{
	$sql = " 
		SELECT DISTINCT * FROM `department` 
		WHERE `department_id` = '" . (int)$department_id . "' AND `status` = '1'
    ";
	
	$rs =  db_row($sql);
	
	if ( is_array($rs) && !empty($rs) ) 
	{
		return $rs;
	}

	return false;
}

/**
 * @return một mảng kết hợp các phòng ban con
 * @param number $parent_id
 */
function departmentGetAllForPublic($parent_id = 0)
{
	$sql = " 
			SELECT * FROM `department`
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

function departmentGetAllByParent($parent_id = 0)
{
	$sql = " 
		SELECT * FROM `department`
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

function departmentGetAllByParentWithLimit($parent_id = 0, $limit=5)
{
	$sql = " 
		SELECT * FROM `department`
		WHERE `parent_id` = '{$parent_id}' 
			 AND `status` = '1' 
		ORDER BY `sort_order`, LCASE(name)
	";

	$rs = db_q($sql);

    if ( !is_array($rs) || empty($rs) )
        return NULL;

    // Nhiều giao diện có menu rất hẹp, không đủ chỗ cho tất cả các mục
	// vì vậy phải giới hạn và đặt ra độ ưu tiên (trật tự sắp xếp giữa các menu)
	// thì mới đủ
	if ($limit < count($rs)) 
    {
		return array_slice($rs, 0, $limit);
	}

	return $rs;

} // en

function departmentGetAllByParentWithStartAndLimit($parent_id = 0, $start=0, $limit=5)
{
	$sql = " 
		SELECT * FROM `department`
		WHERE `parent_id` = '{$parent_id}' 
			 AND `status` = '1' 
		ORDER BY `sort_order`, LCASE(name)
        LIMIT {$start}, {$limit}
	";

	$rs = db_q($sql);

    if ( !is_array($rs) || empty($rs) )
        return NULL;

	return $rs;

} // en

/* Những phòng ban được đưa lên menu phải có: parent_id=0, status=1, top=1 */
function departmentGetAllForMenuHomePage($limit = 10)
{
	$departmentsMenu = array();

	$departments = departmentGetAllByParent(0);

	foreach ($departments as $department) 
	{
				if ($department['top']) 
				{
					// Level 2
					$children_data = array();
	
					$children = $departments = departmentGetAllByParent($department['department_id']);
	
					foreach ($children as $child) 
					{
	
						$children_data[] = array(
							'name'  => $child['name'] . ' ('. departmentCountUser($child['department_id']) . ')',
							'href'  => '/user-department.php?path=' . $department['department_id'] . '_' . $child['department_id']
						);
					}
	
					// Level 1
					$departmentsMenu[] = array(
						'name'     => $department['name'],
						'children' => $children_data,
						'column'   => $department['column'] ? $department['column'] : 1,
						'href'     => '/user-department.php?path=' . $department['department_id']
					);
				}
	}
	
	// Nhiều giao diện có menu rất hẹp, không đủ chỗ cho tất cả các mục
	// vì vậy phải giới hạn và đặt ra độ ưu tiên (trật tự sắp xếp giữa các menu)
	// thì mới đủ
	if ($limit < count($departmentsMenu)) {
		return array_slice($departmentsMenu, 0, $limit);
	}
	
	return $departmentsMenu;
}

/**
 * Trả về một mảng các Phòng Ban Phẩm Nổi Bật
 * @return string[][]|unknown[][]|void[][]
 */
function departmentFeatureds()
{
	$sql = "
		SELECT DISTINCT *
		FROM `department` c
		WHERE c.status = 1 AND c.featured = 1
	";
	
	$rs = db_q($sql);
	
	$departments = array();
	
	foreach ($rs as $department)
	{
		if ($department['image']) {
			$image = img_resize($department['image'], 370, 240);
		} else {
			$image = img_resize('placeholder.png', 370, 240);
		}
		
		$departments[] = array(
				'department_id'  => $department['department_id'],
				'thumb'       => $image,
				'name'        => $department['name'],
				'description' => utf8_substr(strip_tags(html_entity_decode($department['description'], ENT_QUOTES, 'UTF-8')), 0, settings('config_product_description_length')) . '..',
				'href'        => "/user-department.php?path=" . $department['department_id'],
				'width'       => 370,
				'height'      => 240,
		);
	}
	
	$departments = array_slice($departments,0,3);// limit  = 3
	
	return $departments;
}// end function

/**
 * @description Đếm xem có bao nhiêu nhân viên trong phòng ban
 * @return int
 */
function departmentCountUser($dep_id)
{
    $sql = "SELECT COUNT(*) FROM `user` WHERE `department_id`='{$dep_id}'";
		
	return (int)db_one($sql);
}

/**
 * @description Kiểm tra xem có nhân viên nào trong phòng ban không 
 * @return true Nếu có nhân viên
 * @retrun false Nếu không có nhân viên

 * @todo Count cho tốc độ chậm, không nhanh bằng cách sau đây:
     $sql = "SELECT EXISTS(SELECT * FROM `user` WHERE `department_id`=18)"
 */
function departmentHasUser($dep_id)
{
    //$count = departmentCountUser($dep_id);
		
	//return (bool)$count;

    $sql = "SELECT EXISTS(SELECT * FROM `user` WHERE `department_id`={$dep_id})";

    return (bool)db_one($sql);
}

