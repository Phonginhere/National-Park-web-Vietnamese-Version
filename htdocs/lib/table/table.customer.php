<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 * 
 * Các hàm quản lý khách hàng
 */
	
	/**
	 * @description Tải thông tin của khách hàng theo id
	 * @return mảng kết hợp
	 */
	function customerLoad($cus_id)
	{
		// Lấy dữ liệu từ db
		$rs = db_row("SELECT * FROM `customer` WHERE customer_id = '{$cus_id}'");
		
		// nếu có dữ liệu thì trả về mảng kết hợp
		if ( is_array($rs) && !empty($rs) ) 
		{
			return $rs;
		}
		
		return false;
	}
	
	/**
	 * @description Tải thông tin khách hàng theo email đăng nhập
	 * @return mảng kết hợp
	 */
	function customerLoadByEmail($email)
	{
		// Lấy dữ liệu từ db
		$rs = db_row("SELECT * FROM customer WHERE email = '{$email}'");
		
		// nếu có dữ liệu thì trả về mảng kết hợp
		if ( is_array($rs) && !empty($rs) ) 
		{
			return $rs;
		}
		
		return false;
	}
	
	/**
	 * @return
	 * -1: khách hàng không tồn tại
	 * -2: mật khẩu không chính xác
	 * -3: khách hàng chưa được kích hoạt
	 * -4: khách hàng hết hạn sử dụng.
	 * 
	 * @dependencies /lib/thirdparty/antnee/passwordLib.php > password_verify()
	 * @description Xác thực danh tính của khách hàng
	 */
	function customerVerifyLogin($sEmail, $sPassword )
	{
		// Nếu tên đăng nhập trống rỗng
    	if ( $sEmail == '' ) return -1;

    	// Nếu mật khẩu trống rỗng
    	if ( $sPassword == '' ) return -2;
    	
    	// Tải thông tin user theo tên đăng nhập
		$rs = customerLoadByEmail($sEmail);
    	
	    if ( is_array($rs) && !empty($rs)) //is_array:Tìm xem một biến có phải là một mảng hay không

	    {
	    		// Nếu password của user này là hợp lệ
				if (password_verify($sPassword, $rs['password']))
				{
					// Kiểm tra ngày hết hạn của user này
//					if ($rs['due_date'] < date('Y-m-d') )
//	            		return -4;
	            	// Kiểm tra trạng thái của user này (kích hoạt/active hay là bị tắt/inactive)
	          		if ($rs['status'] != 1 )
	            		return -3;
	            		
					return $rs['customer_id'];
				}
				else
					return -2;	
		}
		else
			return -1;
	}
	
	/**
	 * @return 1 nếu như khách hàng tồn tại.
	 * @return 0 nếu như khách hàng không tồn tại.
	 */
	//function verifyCustomer($sEmail)
	function customerVerifyByEmail($sEmail)
	{
		// Tên đăng nhập không được trống
    	if ( $sEmail == '' ) return 0;
    	
    	// Tải thông tin user theo tên đăng nhập
		$rs = customerLoadByEmail($sEmail);
			
		if ( is_array($rs) && !empty($rs)) 
		{
			return 1;
		}
		else
			return 0;
		
	}
	
	function customerAdd($data)
	{
		
		// @todo Tinh chỉnh dữ liệu thô
		$fullname = db_escape($data['fullname']); 
		$email     = db_escape($data['email']);
		$telephone = db_escape($data['telephone']);
		$address   = db_escape($data['address']);
		$password  = password_hash($data['password'],PASSWORD_BCRYPT);
		$status    = 1; //(int)$data['status'];     
		
		// @todo Nhúng dữ liệu vào câu sql
		$sql = " 
			INSERT INTO `customer`
			SET	fullname = '{$fullname}',
				email = '{$email}', 
				telephone = '{$telephone}', 
				address = '{$address}', 
				password = '{$password}', 
				status = '{$status}',
				date_added = NOW()
		";
		
		// Chèn mới bản ghi
		db_q($sql);
			
		// Lấy lại id của bản ghi vừa chèn vào
		$customer_id = (int)db_lastId();
			
		return $customer_id;
		
	}
	
	function customerEdit($customer_id, $data)
	{
		// @todo Tinh chỉnh dữ liệu thô
		// @todo Tinh chỉnh dữ liệu thô
		$fullname = db_escape($data['fullname']);
		$email     = db_escape($data['email']);
		$image     = db_escape($data['image']);
		$telephone = db_escape($data['telephone']);
		$address   = db_escape($data['address']);
		$password  = password_hash($data['password'],PASSWORD_BCRYPT);
		$status    = (int)$data['status'];
		
		// Nhúng dữ liệu vào câu sql
		$sql = " 
			UPDATE `customer`
			SET	fullname = '{$fullname}',
				email = '{$email}', 
				telephone = '{$telephone}', 
				address = '{$address}', 
				password = '{$password}', 
				status = '{$status}'
			WHERE customer_id = {$customer_id}
		";
		
		// Cập nhật dữ liệu bản ghi user
		$rs = db_q($sql);
			
		// Nếu như mật khẩu cũng được sửa thì cập nhật riêng.
		if ($data['password']) 
		{
				$password = password_hash($data['password'],PASSWORD_BCRYPT);
				db_q("UPDATE `customer` SET password = '{$password}' WHERE customer_id = '{$customer_id}'");
		}
			
		return $customer_id;
	} // end editUser
	
	function customerGetById($cus_id)
	{
		// Lấy dữ liệu từ db
		$rs = db_row("SELECT * FROM `customer` WHERE customer_id = '{$cus_id}'");
		
		// nếu có dữ liệu thì trả về mảng kết hợp
		if ( is_array($rs) && !empty($rs) ) 
		{
			return $rs;
		}
		
		return false;
	}
	
	function customerDelete($customer_id)
	{
		// Xóa dữ liệu ở các bảng liên quan
		db_q("DELETE FROM comment WHERE customer_id = '{$customer_id}'");
		
		// @todo xóa đi các bản ghi có liên quan đến
		// khách hàng này trước
		
		$sql = " DELETE FROM `customer` WHERE `customer_id` = '{$customer_id}'";
		
		db_q($sql);
	} // deleteUser()

/**
 * @description Đếm tổng số khách hàng
 * @return int
 */
function customerGetTotal()
{
		$sql = " SELECT COUNT(*) FROM `customer`";
	
		$rs = db_one($sql);
		if ( !is_null($rs) ) {
			return (int)$rs;
		}
	
		return false;
}

/**
 * @description Truy vấn dữ liệu của toàn bộ các khách hàng
 * @returns an indexed array of associative arrays
 */
function customerGetAll($data = array())
{
	$start = 0;
	$limit = settings('config_limit_admin');

	$sort_data = array(
			'email',
			'status',
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
		FROM `customer`
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