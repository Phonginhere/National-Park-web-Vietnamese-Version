<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Các hàm quản lý nhà sản xuất
 */

/**
 * Hàm thêm mới nhà sản xuất
 * 
 * @param array $data (Mảng kết hợp chứa dữ liệu của một nhà sản xuất mới)
 * 
 * @return int Manufacturer Identifier (Mã định danh của nhà sản xuất)
 */
function manufacturerAdd($data) 
{

	// Xử lý dữ liệu thô gửi lên từ form
	$name = db_escape($data['name']);
	$sort_order = (int)$data['sort_order'];
	$featured = (int)$data['featured'];
	
	// Thêm mới bản ghi vào cơ sở dữ liệu
	$sql = "
		INSERT INTO `manufacturer` 
	 	SET `name` = '{$name}', 
	 	    `sort_order` = '{$sort_order}', 
	 	    `featured`='{$featured}'
	";
	db_q($sql);

	$manufacturer_id = (int)db_lastId();
	
	// Ảnh đại diện nhà sản xuất
	if (isset($data['image'])) {
		$image = db_escape($data['image']);
		db_q("UPDATE `manufacturer` SET `image` = '{$image}' WHERE `manufacturer_id` = '{$manufacturer_id}'");
	}

	return $manufacturer_id;
	
} // kết thúc hàm thêm mới

/**
 * Hàm sửa nhà sản xuất 
 * @param int $manufacturer_id (Mã định danh của nhà sản xuất)
 * @param array $data (Mảng kết hợp chứa dữ liệu cập nhật của nhà sản xuất cần sửa)
 *
 * @return void
 */
function manufacturerEdit($manufacturer_id, $data) 
{ 
	$name = db_escape($data['name']);
	$sort_order = (int)$data['sort_order'];
	$featured = (int)$data['featured'];
	$mid = (int)$manufacturer_id;
		
	$sql = "
		UPDATE `manufacturer` 
		SET `name` = '{$name}', 
		    `sort_order` = '{$sort_order}', 
		    `featured`='{$featured}' 
		WHERE `manufacturer_id` = '{$mid}'		
	";
	
	db_q($sql);

	// Ảnh đại diện nhà sản xuất
	if (isset($data['image'])) 
	{
		$image = db_escape($data['image']);
		db_q("UPDATE `manufacturer` SET `image` = '{$image}' WHERE `manufacturer_id` = '{$mid}'");
			
	}

}
	
function manufacturerDelete($manufacturer_id) 
{
	// @todo xóa đi các bản ghi liên quan đến nhà sản xuất này trước.
	
	db_q("DELETE FROM `manufacturer` WHERE `manufacturer_id` = '" . (int)$manufacturer_id . "'");
}
	
function manufacturerGetById($manufacturer_id)
{
	$sql = " 
		SELECT DISTINCT * 
		FROM manufacturer 
		WHERE manufacturer_id = {$manufacturer_id}
	";
	
	$rs = db_row($sql);
	if ( is_array($rs) && !empty($rs) ) 
	{
		return $rs;
	}

	return false;
} // end getManufacturer($manufacturer_id)

/**
 * Đếm tổng số bản ghi
 */
function manufacturerGetTotal()
{
		$sql = "SELECT COUNT(*) AS total FROM manufacturer";
		$rs = db_one($sql);
		
		if ( !is_null($rs) ) 
		{
				return $rs;
		}

		return false;
}
/**
 * Lấy ra các bản ghi để phân trang
 * 
	 * @returns an indexed array of associative arrays
	 * @returns false if failed to query
	 * @notice sort_data must work closely with html view form, url parameters
	 * 
	 * @synchronize with getTotalManufacturers($data)
	 */
function manufacturerGetAll($data = array())
{
		
        // Phục vụ tìm kiếm Ajax (ví dụ chọn nhà sản xuất cho sản phẩm)
		$filter_name = "%".db_escape($data['filter_name']) . "%";
		
		$sql = "
			SELECT *
			FROM `manufacturer`
			WHERE name LIKE '{$filter_name}'
		";
		
       // @notice sort_data must work closely with html view form, url parameters
		$sort_data = array(
			'name',
			'sort_order'	// @check it out
		);
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) 
		{
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) 
		{
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		
		$start = 0;
		$limit = settings('config_limit_admin');
		
		if (isset($data['start']) && (int)$data['start'] > 0)
			$start = (int)$data['start'];
			
		if (isset($data['limit']) && (int)$data['limit'] >= 1)
			$limit = (int)$data['limit'];
			
		$sql .= " LIMIT {$start},{$limit}";
		
		$rs = db_q($sql);
			
		if ( is_array($rs) && !empty($rs) ) 
		{
				return $rs;
		}

		return false;
} // end getManufacturers

function manufacturerFeatureds()
{

	$sql = "
		SELECT * FROM `manufacturer` WHERE `featured` = 1
	";

	// Lấy ra danh sách id các sản phẩm nổi bật
	// và giới hạn số lượng hiển thị trên html.
	$rs = db_q($sql);

	$featuredManufacturer = array();

	foreach ($rs as $manufacturer)
	{
			
		if (is_file(DIR_IMAGE . $manufacturer['image'])) {
			$image = img_resize($manufacturer['image'], 100, 100);
		} else {
			$image = img_resize('placeholder.png', 100, 100);
		}

		$featuredManufacturer[] = array(
				'manufacturer_id'  => $manufacturer['manufacturer_id'],
				'image'       => $image,
				'name'        => $manufacturer['name'],
				'link'        => "/manufacturer-info.php?manufacturer_id=" . $manufacturer['manufacturer_id'],
		);
		//}
	}
	//$featuredManufacturer = array_slice($featuredManufacturer, 0, settings('products_featured_limit'));
//var_dump($featuredManufacturer);
	return $featuredManufacturer;
}// end function