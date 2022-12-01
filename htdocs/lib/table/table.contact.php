<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Các hàm quản lý liên hệ từ khách hàng
 */

function contactAdd($data)
{
	// Tinh chỉnh dữ liệu thô
	$name    = db_escape($data['name']);
	$email   = db_escape($data['email']);
    $phone   = db_escape($data['phone']);
	$subject = db_escape($data['subject']); 
	$message = db_escape($data['message']); 

    $to_dep_id = (int)$data['to_dep_id'];
    $to_emp_id = (int)$data['to_emp_id'];

    // ngày hẹn gặp (bác sĩ, nhân viên, ...), ngày tiếp nhận
    $date = date('Y-m-d h:i:s',strtotime($_POST['date'].' '.$_POST['time']));
	
	$website = db_escape($data['website']);
	$address = db_escape($data['address']);
		
	// Nhúng dữ liệu vào câu sql
	$sql = " 
		INSERT INTO `contact`
		SET name = '{$name}',
			email = '{$email}',
            phone = '{$phone}', 
			subject = '{$subject}', 
			message = '{$message}',
            to_dep_id = '{$to_dep_id}',
            to_emp_id = '{$to_emp_id}',
			website = '{$website}',
			address = '{$address}',
            date = '{$date}',
			date_added = NOW(),
			date_modified = NOW()
	";
		
	// Thêm mới bản ghi
	db_q($sql);
			
	// Lấy lại id của bản ghi vừa chèn vào
	$contact_id = (int)db_lastId();
			
	return $contact_id;
		
}	// kết thúc hàm thêm mới 'Liên Hệ'

function contactEdit($contact_id, $data)
{
		// @todo Tinh chỉnh dữ liệu thô
		$name      = db_escape($data['name']);
		$email     = db_escape($data['email']);
        $phone     = db_escape($data['phone']);
		$subject   = db_escape($data['subject']);
		$message   = db_escape($data['message']);
		
        $to_dep_id = (int)$data['to_dep_id'];
        $to_emp_id = (int)$data['to_emp_id'];

        // ngày hẹn gặp (bác sĩ, nhân viên, ...), ngày tiếp nhận
        $date = date('Y-m-d h:i:s',strtotime($_POST['date'].' '.$_POST['time']));
		
		$website = db_escape($data['website']);
		$address = db_escape($data['address']);
		
		// Nhúng dữ liệu vào câu sql
		$sql = " 
			UPDATE `contact`
			SET	name = '{$name}',
				email = '{$email}', 
                phone = '{$phone}', 
				subject = '{$subject}', 
				message = '{$message}', 
                to_dep_id = '{$to_dep_id}',
                to_emp_id = '{$to_emp_id}',
				website = '{$website}',
			    address = '{$address}',
                date = '{$date}',
				date_modified = NOW()
			WHERE `contact_id` = {$contact_id}
		";
		
		// Cập nhật dữ liệu bản ghi user
		$rs = db_q($sql);
			
		return $contact_id;
		
} // kết thúc hàm sửa

function contactDelete($contact_id)
{
	// @todo xóa đi các bản ghi có liên quan đến
		
	$sql = " DELETE FROM `contact` WHERE `contact_id` = '{$contact_id}'";
		
	db_q($sql);
	
} // kết thúc hàm xóa

function contactGetById($contact_id)
{
	// Lấy dữ liệu từ db
	$rs = db_row("SELECT * FROM `contact` WHERE contact_id = '{$contact_id}'");
		
	// nếu có dữ liệu thì trả về mảng kết hợp
	if ( is_array($rs) && !empty($rs) ) 
	{
		return $rs;
	}
		
	return false;
}

/**
 * @description Đếm tổng số phản hồi từ khách hàng
 * @return int
 */
function contactGetTotal()
{
		$sql = " SELECT COUNT(*) FROM `contact`";
	
		$rs = db_one($sql);
		if ( !is_null($rs) ) {
			return (int)$rs;
		}
	
		return 0;
}

/**
 * @description Truy vấn dữ liệu của toàn bộ các phản hồi khách hàng
 * @returns Trả về một mảng đánh chỉ số, mỗi phần tử mảng lại là một mảng kết hợp
            chứa dữ liệu của một bản ghi.
 */
function contactGetAll($data = array())
{
	$start = 0;
	$limit = settings('config_limit_admin');

	$sort_data = array(
			'email',
			'subject',
			'date_added'
	);

	if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
		$sort = $data['sort'];
	} else {
		$sort = "email";
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
		FROM `contact`
		ORDER BY {$sort} {$order}
		LIMIT {$start},{$limit}
	";

	$rs = db_q($sql);
			
	if ( is_array($rs) && !empty($rs) )
	{
		return $rs;
	}

	return false;
	
} // kết thúc hàm contactGetAll()