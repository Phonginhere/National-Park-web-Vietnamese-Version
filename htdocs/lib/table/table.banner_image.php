<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Các hàm quản lý ảnh banner
 */

/**
 * Hàm thêm mới ảnh banner
 * 
 * @param array $data (Mảng kết hợp chứa dữ liệu của một ảnh banner mới)
 * 
 * @return int Banner Image Identifier (Mã định danh của ảnh banner)
 */
function banner_imageAdd($data) 
{

	// Xử lý dữ liệu thô gửi lên từ form
	$title = db_escape($data['title']);
	$sub_title = db_escape($data['sub_title']);
	$description = db_escape($data['description']);
	$link = db_escape($data['link']);
	$price = (float)$data['price'];
	$sort_order = (int)$data['sort_order'];
	$status = (int)$data['status'];
	
	// Thêm mới bản ghi vào cơ sở dữ liệu
	$sql = "
		INSERT INTO `banner_image` 
	 	SET `title` = '{$title}',
	 	    `sub_title` = '{$sub_title}',
	 	    `description` = '{$description}',
	 	    `link` = '{$link}',
	 	    `price` = '{$price}',
	 	    `sort_order` = '{$sort_order}', 
	 	    `status`='{$status}'
	";
	db_q($sql);

	$banner_id = (int)db_lastId();
	
	// Ảnh đại diện nhà sản xuất
	if (isset($data['image'])) {
		$image = db_escape($data['image']);
		db_q("UPDATE `banner_image` SET `image` = '{$image}' WHERE `banner_id` = '{$banner_id}'");
	}

	return $banner_id;
	
} // kết thúc hàm thêm mới

/**
 * Hàm sửa ảnh banner 
 * 
 * @param int $banner_id (Mã định danh của ảnh banner)
 * @param array $data (Mảng kết hợp chứa dữ liệu cập nhật của ảnh banner)
 *
 * @return void
 */
function banner_imageEdit($banner_id, $data) 
{ 
	// Xử lý dữ liệu thô gửi lên từ form
	$title       = db_escape($data['title']);
	$sub_title   = db_escape($data['sub_title']);
	$description = db_escape($data['description']);
	$link        = db_escape($data['link']);
	$price       = (float)$data['price'];
	$sort_order  = (int)$data['sort_order'];
	$status      = (int)$data['status'];
	
	// Cập nhật bản ghi trong cơ sở dữ liệu
	$sql = "
		UPDATE `banner_image` 
		SET `title` = '{$title}',
	 	    `sub_title` = '{$sub_title}',
	 	    `description` = '{$description}',
	 	    `link` = '{$link}',
	 	    `price` = '{$price}',
	 	    `sort_order` = '{$sort_order}', 
	 	    `status`='{$status}'
		WHERE `banner_id` = '{$banner_id}'		
	";
	
	db_q($sql);

	// Ảnh banner
	if (isset($data['image'])) 
	{
		$image = db_escape($data['image']);
		db_q("UPDATE `banner_image` SET `image` = '{$image}' WHERE `banner_id` = '{$banner_id}'");
			
	}

}

/**
 * Hàm xóa ảnh banner
 * 
 * @param int $banner_id (Mã định danh của ảnh banner)
 * 
 * @return void
 */
function banner_imageDelete($banner_id) 
{
	db_q("DELETE FROM `banner_image` WHERE `banner_id` = '" . (int)$banner_id . "'");
}

/**
 * Hàm lấy ra thông tin của một bản ghi ảnh banner
 * 
 * @param array $data (Mảng kết hợp chứa các tiêu chí lọc và sắp xếp)
 * @param int $banner_id (Mã định danh của ảnh banner)
 *
 * @return array (Mảng kết hợp chứa thông tin của một ảnh banner)
 */
function banner_imageById($banner_id)
{
	$sql = " 
		SELECT DISTINCT * 
		FROM `banner_image` 
		WHERE banner_id = {$banner_id}
	";
	
	$rs = db_row($sql);
	if ( is_array($rs) && !empty($rs) ) 
	{
		return $rs;
	}

	return null;
	
} // kết thúc hàm

/**
 * Hàm đếm tổng số bản ghi trong bảng `banner_image`.
 * Mệnh đề sql trong hàm này cần được đồng bộ với hàm banner_imageGetAll($data = array())
 * 
 * @return int|null
 */
function banner_imageGetTotal($data = array())
{
	$filter_title = "%".db_escape($data['filter_title']) . "%";
	
	$sql = "
	 SELECT COUNT(`banner_id`) AS total
	 FROM `banner_image`
	 WHERE `title` LIKE '{$filter_title}'
	";
	
	$rs = db_one($sql);
		
	if ( !is_null($rs) ) 
	{
		return $rs;
	}

	return null;
}

/**
 * Lấy ra các bản ghi để phân trang.
 * Mệnh đề sql trong hàm này cần được đồng bộ với hàm banner_imageGetTotal($data = array())
 * 
 * @param array $data (Mảng kết hợp chứa các tiêu chí lọc và sắp xếp)
 * 
 * @returns an indexed array of associative arrays
 * @returns false if failed to query
 * @notice sort_data must work closely with html view form, url parameters
 * 
 */
function banner_imageGetAll($data = array())
{
		
		$filter_title = "%".db_escape($data['filter_title']) . "%";
		
		$sql = "
			SELECT *
			FROM `banner_image`
			WHERE `title` LIKE '{$filter_title}'
		";
		
       // @notice sort_data must work closely with html view form, url parameters
		$sort_data = array(
			'banner_id',
			'title',
			'sort_order'	// @check it out
		);
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) 
		{
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY title";
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
		
} // kết thúc hàm

/**
 * Lấy ra các ảnh banner (để chạy trên slide show trang chủ)
 * @todo 1140,380 nên thay bằng setting width, height
 * @return array
 */
function banner_imageActives()
{

	$sql = "SELECT * FROM `banner_image` WHERE `status` = 1";

	$rs = db_q($sql);

	$activeBannerImages = array();

	foreach ($rs as $banner_image)
	{
		if (is_file(DIR_IMAGE . $banner_image['image'])) {
			$image = img_resize($banner_image['image'], 1140, 380);
		} else {
			$image = img_resize('placeholder.png', 1140, 380);
		}
		
		$activeBannerImages[] = array(
		    'banner_id' => $banner_image['banner_id'],
			'image'     => $image, 
			'title'     => $banner_image['title'],
		    'sub_title' => $banner_image['sub_title'],
			'link'      => $banner_image['link'],
		    'price'     => number_format($banner_image['price'],0,'.',',').' ₫',
		    'description' => $banner_image['description']
		);
	}

	return $activeBannerImages;
}// end function