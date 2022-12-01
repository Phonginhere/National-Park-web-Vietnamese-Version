<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Các hàm xác thực tính hợp lệ của dữ liệu nhân viên quản trị
 */
// Cấu hình hệ thống:
include_once '../configs.php';
// Thư viện hàm
include_once "../lib/table/table.user.php";

/*
 Kiểm duyệt dữ liệu form. Nếu dữ liệu gửi lên không thỏa mãn
 các yêu cầu / tiêu chí đề ra thì gửi các thông báo lỗi sang
 View để người dùng biết và tuân theo.
 */
function validateForm()
{
	global $error_username;
	global $error_fullname;
	global $error_password;
	global $error_confirm_password;
	
	// Nếu user không có quyền xóa
	// gửi lỗi sang view
	// $error_permission = 'Không có quyền sửa';
	// return false;
	
	// Kiểm duyệt độ dài tên đăng nhập
	if ((utf8_strlen($_POST['username']) < 3) || (utf8_strlen($_POST['username']) > 20)) 
	{
		$error_username = 'Độ dài tên đăng nhập phải không dưới 3 và không quá 20 kí tự';
		return false;
	}
	
	// Kiểm duyệt xem tên đăng nhập đã tồn tại chưa
	// cho trường hợp tạo mới user
	// nếu đang là edit ($_GET['user_id'] bằng rỗng) thì sẽ không bị bắt lỗi
	if (!isset($_GET['user_id']) && userVerifyUsername(trim($_POST['username'])) ) 
	{
		$error_username = 'Tên đăng nhập '.$_POST['username'].' đã tồn tại';
		return false;
	}
	
	// Kiểm duyệt độ dài họ tên
	if ((utf8_strlen(trim($_POST['fullname'])) < 1) || (utf8_strlen(trim($_POST['fullname'])) > 32)) 
	{
		$error_fullname = 'Tên phải có độ dài từ 1 kí tự trở lên và không quá 32 kí tự';
		return false;
	}

	// Kiểm duyệt mật khẩu (chỉ khi user quyết định thay đổi mật khẩu)
	if ($_POST['password'] || (!isset($_GET['user_id']))) 
	{
		// Độ dài mật khẩu
		if ((utf8_strlen($_POST['password']) < 4) || (utf8_strlen($_POST['password']) > 20)) 
		{
			$error_password = 'Mật khẩu không được dưới 4 kí tự và không quá 20 kí tự';
			return false;
		}

		// Xác nhận mật khẩu
		if ($_POST['password'] != $_POST['confirm_password']) 
		{
			$error_confirm_password = 'Xác nhận mật khẩu không đúng';
			return false;
		}
	}
		
	return true;
}

function validateAdd()
{
	// Chỉ được thêm mới nếu bạn là user=admin
	if ($_SESSION['USR_USERNAME'] != "admin")
	{
		$_SESSION['ERROR_TEXT'] = "Bạn không có quyền thêm mới người dùng trên hệ thống ! (chỉ admin mới có quyền)";
		return false;
	}
		
	
	return true;
}

function validateEdit()
{
	
	// Không được sửa thông tin của người khác nếu bạn không phải admin
	if ($_SESSION['USR_USERNAME'] != "admin")
	{
		$_SESSION['ERROR_TEXT'] = "Bạn không có quyền sửa thông tin người dùng trên hệ thống ! (chỉ admin mới có quyền)";
		return false;
	}
	
	// Nếu bạn là admin, bạn cũng không được phép sửa username của mình
	// trong hệ thống, quản trị viên cao nhất phải có username='admin'
	// (so sánh id của user hiện tại với id xuất hiện trên url, sau đó so sánh tên đăng nhập mới và cũ 'admin')
	if ( $_SESSION['USER_LOGGED'] == $_GET['user_id'] && $_POST['username'] != "admin") 
	{
		$_SESSION['ERROR_TEXT'] = "Bạn không có quyền sửa tên đăng nhập của admin !";
		return false;
	}
	
	if ( (int)$_POST['status'] != 1) 
	{
		$_SESSION['ERROR_TEXT'] = "Trạng thái của admin phải là 'Cho phép'!";
		return false;
	}
	
	return true;
}

function validateDelete()
{
	// Chỉ có user=admin mới được xóa
	if ($_SESSION['USR_USERNAME'] != "admin")
	{
		$_SESSION['ERROR_TEXT'] = "Bạn không có quyền xóa thông tin người dùng trên hệ thống ! (chỉ admin mới có quyền)";
		return false;
	}
	
	// User admin cũng không được phép xóa bản thân mình
	// (Kiểm tra xem user id của admin có xuất hiện trong danh sách bị xóa hay không ???)
	if ( in_array($_SESSION['USER_LOGGED'], $_POST['selected'])) 
	{
		$_SESSION['ERROR_TEXT'] = "Bạn không có quyền xóa tài khoản của admin !";
		return false;
	}
	
	return true;
}

function validateCopy()
{
	return true;
}