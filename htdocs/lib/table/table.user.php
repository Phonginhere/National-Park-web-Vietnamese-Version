<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Các hàm quản lý nhân viên quản trị
 */

	/**
	 * @description Tải thông tin user theo tên đăng nhập
	 * @return mảng kết hợp
	 */
	//function loadByUsername($username)
	function userLoadByUsername($username)
	{
		// Lấy dữ liệu từ db
		$rs = db_row("SELECT * FROM user WHERE username = '{$username}'");
		
		// nếu có dữ liệu thì trả về mảng kết hợp
		if ( is_array($rs) && !empty($rs) ) 
		{
			return $rs;
		}
		
		return false;
	}
	
	/**
	 * @return
	 * -1: user không tồn tại
	 * -2: mật khẩu không chính xác
	 * -3: user chưa được kích hoạt
	 * -4: user hết hạn sử dụng.
	 * 
	 * @dependencies /lib/thirdparty/antnee/passwordLib.php > password_verify()
	 * @description Xác thực danh tính của user. Hệ thống lấy ra toàn bộ thông tin của user
	 *              theo tên đăng nhập (username) gõ vào login form. So sánh mật khẩu đăng nhập 
	 *              và mật khẩu đã bị mã hóa trong cơ sở dữ liệu thông qua hàm xác thực của PHP
	 *              password_verify()
	 */
	//function verifyLogin($sUsername, $sPassword )
	function userVerifyLogin($sUsername, $sPassword )
	{
		// Nếu tên đăng nhập trống rỗng
    	if ( $sUsername == '' ) return -1;

    	// Nếu mật khẩu trống rỗng
    	if ( $sPassword == '' ) return -2;
    	
    	// Tải thông tin user theo tên đăng nhập
		$rs = userLoadByUsername($sUsername);
    	
	    if ( is_array($rs) && !empty($rs)) 
	    {
	    		// Nếu password của user này là hợp lệ
				if (password_verify($sPassword, $rs['password']))
				{
					// Kiểm tra ngày hết hạn của user này
					if ($rs['due_date'] < date('Y-m-d') )
	            		return -4;
	            	// Kiểm tra trạng thái của user này (kích hoạt/active hay là bị tắt/inactive)
	          		if ($rs['status'] != 1 )
	            		return -3;
	            		
					return $rs['user_id'];
				}
				else
					return -2;	
		}
		else
			return -1;
	}
	
	/**
	 * @return 1 nếu như user tồn tại.
	 * @return 0 nếu như user không tồn tại.
	 */
	function userVerifyUsername($sUsername)
	{
		global $db;
		
		// Tên đăng nhập không được trống
    	if ( $sUsername == '' ) 
    		return 0;
    	
    	// Tải thông tin user theo tên đăng nhập
		$rs = userLoadByUsername($sUsername);
			
		if ( is_array($rs) && !empty($rs)) 
		{
			return 1;
		}
		else
			return 0;
		
	} // kết thúc hàm userVerifyUsername()
	
	/**
	 * @returns the newly inserted id (also called last id)
	 * 
	 * @description Thêm mới tài khoản user (nhân viên quản trị). Mật khẩu sẽ được
	 *              mã hóa thông qua hàm băm của php password_hash()
	 */
function userAdd($data)
{
		// Tinh chỉnh dữ liệu thô
		$fullname = db_escape($data['fullname']); 
        $department_id   = (int)$data['department_id']; 
        $job_id   = (int)$data['job_id']; 
        $specialist = (int)$data['specialist'];
		$email    = db_escape($data['email']);
        $phone    = db_escape($data['phone']);
		$image    = db_escape($data['image']); 

        $username = db_escape($data['username']);
		$password = password_hash($data['password'],PASSWORD_BCRYPT);
		
		$sort_order   = (int)$data['sort_order'];
		$status   = (int)$data['status'];
		
		$description = db_escape($data['description']);
		
		// Nhúng dữ liệu vào câu sql
		$sql = " 
			INSERT INTO `user`
			SET username = '{$username}',
				password = '{$password}',
				fullname = '{$fullname}', 
                department_id = '{$department_id}',
                job_id   = '{$job_id}', 
                specialist = '{$specialist}',
				email    = '{$email}', 
                phone    = '{$phone}', 
				image    = '{$image}', 
	            description = '{$description}',
				sort_order   = '{$sort_order}',
				status   = '{$status}', 
				date_added = NOW()
		";
		
		// Chèn mới bản ghi
		db_q($sql);
			
		// Lấy lại id của bản ghi vừa chèn vào
		$user_id = (int)db_lastId();
			
		return $user_id;
		
}	// kết thúc hàm thêm mới userAdd()
	
/**
 * @returns Trả về khóa chính của bản ghi vừa sửa
 */
function userEdit($user_id, $data)
{
		
		// Tinh chỉnh dữ liệu thô
		$fullname = db_escape($data['fullname']); 
        $department_id   = (int)$data['department_id']; 
        $job_id   = (int)$data['job_id']; 
        $specialist = (int)$data['specialist'];
		$email    = db_escape($data['email']);
        $phone    = db_escape($data['phone']);
		$image    = db_escape($data['image']); 

        $username = db_escape($data['username']);
        
        $sort_order   = (int)$data['sort_order'];
		$status   = (int)$data['status'];
		
		$description = db_escape($data['description']);
		
		// Nhúng dữ liệu vào câu sql
		$sql = " 
			UPDATE `user`
			SET username = '{$username}',
				fullname = '{$fullname}', 
                job_id   = '{$job_id}', 
                specialist = '{$specialist}',
                department_id = '{$department_id}',
				email    = '{$email}', 
                phone    = '{$phone}', 
				image    = '{$image}', 
			    description = '{$description}',
				sort_order   = '{$sort_order}',
				status   = '{$status}' 
			WHERE `user_id` = {$user_id}
		";
		
		// Cập nhật dữ liệu bản ghi user
		$rs = db_q($sql);
	
		// Nếu như mật khẩu cũng được sửa thì cập nhật riêng.
		if ($data['password']) 
		{
				$password = password_hash($data['password'],PASSWORD_BCRYPT);
				db_q("UPDATE `user` SET `password` = '{$password}' WHERE `user_id` = '{$user_id}'");
		}
			
		return $user_id;
} // kết thúc hàm sửa userEdit()
	
	/**
	 * @returns mảng kết hợp biểu diễn thông tin user
	 */
function userGetById($user_id)
{
		$sql = " 
			SELECT * 
			FROM `user` u 
			WHERE u.user_id = '{$user_id}'
		";
		
		$rs = db_row($sql);
		if ( is_array($rs) && !empty($rs) ) 
		{
				return $rs;
		}

		return false;
} // getUser
	
	/**
	 * @description Đếm tổng số user
	 * @returns a string
	 */
//	function getTotalUsers()
	function userGetTotal()
	{
		$sql = " SELECT COUNT(*) FROM `user`";

		$rs = db_one($sql);
		if ( !is_null($rs) ) {
			return $rs;
		}

		return false;
	}
	
	/**
	 * @description Truy vấn dữ liệu của toàn bộ các user
	 * @returns an indexed array of associative arrays
	 */
	function userGetAll($data = array())
	{
        // Tiêu chí, điều kiện tìm kiếm / lọc
        // Phục vụ tìm kiếm Ajax (ví dụ chọn chức danh công việc cho nhân viên)
	    $filter_name = "%".db_escape($data['filter_name']) . "%";
        
        // Danh sách các cột được phép sắp xếp
        // Nên đồng bộ với phía giao diện: form input names, url parameters
		$sort_data = array(
			'username',
            'fullname',
			'status',
			'date_added'
		);
		        
        // Mặc định, sắp xếp theo cột
        $sort = "username";

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
			FROM `user`
            WHERE `fullname` LIKE '{$filter_name}'
			ORDER BY {$sort} {$order}
			LIMIT {$start},{$limit}
		";

		$rs = db_q($sql);
		if ( is_array($rs) && !empty($rs) ) 
		{
				return $rs;
		}

		return false;
	} // end userGetAll($data = array())

	/**
	 * @description Truy vấn dữ liệu của toàn bộ các user theo một phòng ban cụ thể
	 * @returns Trả về một mảng chỉ số, mỗi phần tử lại là một mảng kết hợp thể hiện thông tin user
	 */
	function userGetAllByDepartment($dep_id, $data = array())
	{
        // Tiêu chí, điều kiện tìm kiếm / lọc
        // Phục vụ tìm kiếm Ajax (ví dụ chọn chức danh công việc cho nhân viên)
	    $filter_name = "%".db_escape($data['filter_name']) . "%";
        
        // Danh sách các cột được phép sắp xếp
        // Nên đồng bộ với phía giao diện: form input names, url parameters
		$sort_data = array(
			'username',
            'fullname',
			'status',
			'date_added'
		);
		        
        // Mặc định, sắp xếp theo cột
        $sort = "username";

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
			FROM `user`
            WHERE `department_id`='{$dep_id}' AND `fullname` LIKE '{$filter_name}'
			ORDER BY {$sort} {$order}
			LIMIT {$start},{$limit}
		";

		$rs = db_q($sql);
		if ( is_array($rs) && !empty($rs) ) 
		{
				return $rs;
		}

		return false;
	} // end userGetAllByDepartment()
	
	/**
	 * @return void
	 */
	//function deleteUser($user_id)
	function userDelete($user_id)
	{
		// @todo Xóa đi các bản ghi liên quan đến user trước
		
		$sql = " DELETE FROM `user` WHERE user_id = '{$user_id}'";
		
		db_q($sql);
	} // deleteUser()
