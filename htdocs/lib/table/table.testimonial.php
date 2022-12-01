<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 * 
 * Các hàm quản lý lời chứng thực khách hàng
 */

/**
 * @returns Trả về khóa chính của bản ghi được thêm mới
 */
function testimonialAdd($data)
	{
		// Tinh chỉnh dữ liệu thô
		$name    = db_escape($data['input_name']);
		$job     = db_escape($data['input_job']); 
        $image   = db_escape($data['input_image']);
		$title   = db_escape($data['input_title']);
        $content = db_escape($data['input_content']);
		$status     = (int)$data['input_status'];
        $sort_order = (int)$data['input_sort_order'];

        $age = (int)$data['input_age'];
        $address = db_escape($data['input_address']);
		
		// Nhúng dữ liệu vào câu sql
		$sql = " 
			INSERT INTO `testimonial`
			SET name = '{$name}',
				job = '{$job}',
				image = '{$image}', 
                title = '{$title}', 
                content = '{$content}',
				status = '{$status}', 
                sort_order = '{$sort_order}', 
                age = '{$age}',
                address = '{$address}',
				date_added = NOW(),
                date_modified = NOW()
		";
		
		// Chèn mới bản ghi
		db_q($sql);
			
		// Lấy lại id của bản ghi vừa chèn vào
		$testimonial_id = (int)db_lastId();
			
		return $testimonial_id;
		
}	// kết thúc hàm thêm mới bản ghi

/**
 * @returns Trả về khóa chính của bản ghi cần sửa
 */
function testimonialEdit($id, $data)
{
		// Tinh chỉnh dữ liệu thô
		$name    = db_escape($data['input_name']);
		$job     = db_escape($data['input_job']); 
        $image   = db_escape($data['input_image']);
		$title   = db_escape($data['input_title']);
        $content = db_escape($data['input_content']);
		$status     = (int)$data['input_status'];
        $sort_order = (int)$data['input_sort_order'];

        $age = (int)$data['input_age'];
        $address = db_escape($data['input_address']);
		
		// Nhúng dữ liệu vào câu sql
		$sql = " 
			UPDATE `testimonial`
			SET name = '{$name}',
				job = '{$job}',
				image = '{$image}', 
                title = '{$title}', 
                content = '{$content}',
				status = '{$status}', 
                sort_order = '{$sort_order}',
                age = '{$age}',
                address = '{$address}', 
                date_modified = NOW()
			WHERE testimonial_id = {$id}
		";
		
		// Cập nhật dữ liệu bản ghi user
		$rs = db_q($sql);
			
		return $id;

} // kết thúc hàm sửa bản ghi

/**
 * @description Lấy ra dữ liệu của một dòng bản ghi dựa trên khóa chính
 * @return Trả về mảng kết hợp
 */
function testimonialGetById($id)
{
		$sql = " 
			SELECT * 
			FROM `testimonial` AS t
			WHERE t.testimonial_id = '{$id}'
		";
		
		$rs = db_row($sql);
		if ( is_array($rs) && !empty($rs) ) 
		{
			return $rs;
		}

		return false;
} 

 /**
 * @description Đếm tổng số lời chứng thực
 * @return int
 */
function testimonialGetTotal($data = array())
{
		$sql = " SELECT COUNT(*) FROM `testimonial`";
	
		$rs = db_one($sql);
		if ( !is_null($rs) ) {
			return (int)$rs;
		}
	
		return 0;
}

/**
 * @description Truy vấn dữ liệu của toàn bộ những lời chứng thực
 * @returns an indexed array of associative arrays
 */
function testimonialGetAll($data = array())
{
	$start = 0;
	$limit = settings('config_limit_admin');

	$sort_data = array(
			'name',
            'job',
			'title',
			'date_added'
	);

	if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
		$sort = $data['sort'];
	} else {
		$sort = "name";
	}

	if (isset($data['order']) && ($data['order'] == 'DESC')) {
		$order = "DESC";
	} else {
		$order = "ASC";
	}

	if (isset($data['start']) && (int)$data['start'] >= 0)
		$start = (int)$data['start'];
			
	if (isset($data['limit']) && (int)$data['limit'] >= 1)
		$limit = (int)$data['limit'];

	$sql = "
		SELECT *
		FROM `testimonial`
		ORDER BY {$sort} {$order}
		LIMIT {$start},{$limit}
	";

	$rs = db_q($sql);
			
	if ( is_array($rs) && !empty($rs) )
	{
		return $rs;
	}

	return false;
} // end getUsers($data = array())


/** 
 * @return void
 */
function testimonialDelete($id)
{
		$sql = " DELETE FROM `testimonial` WHERE testimonial_id = '{$id}'";
		
		db_q($sql);

} // kết thúc hàm xóa
