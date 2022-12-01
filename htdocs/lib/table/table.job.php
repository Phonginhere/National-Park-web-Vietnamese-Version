<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Các hàm quản lý nghề nghiệp
 */

function jobAdd($data)
{
	// Tinh chỉnh dữ liệu thô
	$title = db_escape($data['title']);
	$code  = db_escape($data['code']);
    $min_salary  = (float)$data['min_salary'];
    $max_salary  = (float)$data['max_salary'];
		
	// Nhúng dữ liệu vào câu sql
	$sql = " 
		INSERT INTO `job`
		SET `title` = '{$title}',
			`code` = '{$code}',
            `min_salary`  = '{$min_salary}',
            `max_salary`  = '{$max_salary}',
			`date_added` = NOW(),
			`date_modified` = NOW()
	";
		
	// Thêm mới bản ghi
	db_q($sql);
			
	// Lấy lại id của bản ghi vừa chèn vào
	$job_id = (int)db_lastId();
			
	return $job_id;
		
}	// kết thúc hàm thêm mới 'Nghề Nghiệp'

function jobEdit($job_id, $data)
{
	// Tinh chỉnh dữ liệu thô
	$title = db_escape($data['title']);
	$code  = db_escape($data['code']);
    $min_salary  = (float)$data['min_salary'];
    $max_salary  = (float)$data['max_salary'];
		
	// Nhúng dữ liệu vào câu sql
	$sql = " 
	    UPDATE `job`
		SET `title` = '{$title}',
			`code` = '{$code}',
            `min_salary`  = '{$min_salary}',
            `max_salary`  = '{$max_salary}',
			`date_added` = NOW(),
			`date_modified` = NOW()
		WHERE `job_id` = {$job_id}
	";
		
	// Cập nhật dữ liệu bản ghi user
	$rs = db_q($sql);
			
	return $job_id;
		
} // kết thúc hàm sửa

function jobDelete($job_id)
{
	$sql = " DELETE FROM `job` WHERE `job_id` = '{$job_id}'";
		
	db_q($sql);
	
} // kết thúc hàm xóa

function jobGetById($job_id)
{
	// Lấy dữ liệu từ db
	$rs = db_row("SELECT * FROM `job` WHERE job_id = '{$job_id}'");
		
	// nếu có dữ liệu thì trả về mảng kết hợp
	if ( is_array($rs) && !empty($rs) ) 
	{
		return $rs;
	}
		
	return false;
}

/**
 * @description Đếm tổng số nghề nghiệp
 * @param $data Các tiêu chí tìm kiếm nếu có
 * @return int
 */
function jobGetTotal($data=array())
{
		$sql = " SELECT COUNT(*) FROM `job`";
	
		$rs = db_one($sql);
		if ( !is_null($rs) ) {
			return (int)$rs;
		}
	
		return 0;
}

/**
 * @description Truy vấn dữ liệu của toàn bộ các phản hồi khách hàng
 * @param $data Các tiêu chí tìm kiếm nếu có, cần đồng bộ với hàm đếm GetTotal()
 * @returns Trả về một mảng đánh chỉ số, mỗi phần tử mảng lại là một mảng kết hợp
            chứa dữ liệu của một bản ghi.
 */
function jobGetAll($data = array())
{

    // Tiêu chí, điều kiện tìm kiếm / lọc
    // Phục vụ tìm kiếm Ajax (ví dụ chọn chức danh công việc cho nhân viên)
	$filter_name = "%".db_escape($data['filter_name']) . "%";
		
    // Danh sách các cột được phép sắp xếp
    // Nên đồng bộ với phía giao diện: form input names, url parameters
	$sort_data = array(
        'title',
		'code',
		'date_added'
	);

    // Mặc định, sắp xếp theo cột
    $sort = "title";

    // Nếu phía giao diện yêu cầu (chỉ định) cột sắp xếp và nó tồn tại trong danh sách cho phép
    // thì cập nhật lại:
	if (isset($data['sort']) && in_array($data['sort'], $sort_data)) 
		$sort = $data['sort'];

    // Mặc định, sắp xếp theo thứ tự tăng dần
    $order = "ASC";

    // Nếu phía giao diện yêu cầu (chỉ định) chiều sắp xếp giảm dần thì cập nhật lại
	if (isset($data['order']) && ($data['order'] == "DESC")) 
		$order = "DESC";

    // Mặc định, phân trang theo các tham số 
	$start = 0;
	$limit = settings('config_limit_admin');

    // Nếu phía giao diện yêu cầu (chỉ định) phân trang theo một bộ tham số khác:
	if (isset($data['start']) && (int)$data['start'] >= 0)
		$start = (int)$data['start'];
			
	if (isset($data['limit']) && (int)$data['limit'] >= 1)
		$limit = (int)$data['limit'];

	$sql = "
		SELECT *
		FROM `job`
        WHERE `title` LIKE '{$filter_name}'
		ORDER BY {$sort} {$order}
		LIMIT {$start},{$limit}
	";

	$rs = db_q($sql);
			
	if ( is_array($rs) && !empty($rs) )
	{
		return $rs;
	}

	return false;
	
} // kết thúc hàm jobGetAll()