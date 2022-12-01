<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang xác thực tính hợp lệ của dữ liệu tài khoản khách hàng
 */
// cấu hình hệ thống
include_once 'configs.php';

/*
 Kiểm duyệt dữ liệu form. Nếu dữ liệu gửi lên không thỏa mãn
 các yêu cầu / tiêu chí đề ra thì gửi các thông báo lỗi sang
 View để người dùng biết và tuân theo.
 */
function validateForm()
{
	// testing only
	// $_SESSION['ERROR_TEXT'] = 'Thông tin không hợp lệ !';	
	// return false;
	
	// Kiểm duyệt độ dài họ tên
	if ((utf8_strlen(trim($_POST['fullname'])) < 1) || (utf8_strlen(trim($_POST['fullname'])) > 32)) 
	{
		$_SESSION['ERROR_TEXT'] = 'Tên phải có độ dài từ 1 kí tự trở lên và không quá 32 kí tự';
		return false;
	}

	// @todo tìm regex khác phù hợp hơn để đánh giá email.
	if ((utf8_strlen($_POST['email']) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $_POST['email'])) {
		$_SESSION['ERROR_TEXT'] = 'Email phải hợp lệ và có độ dài không quá 96 kí tự !';
		return false;
    }

	if ((utf8_strlen(trim($_POST['telephone'])) < 10) || (utf8_strlen(trim($_POST['telephone'])) > 32)) 
	{
		$_SESSION['ERROR_TEXT'] = 'Điện thoại phải có độ dài từ 10 kí tự trở lên và không quá 32 kí tự';
		return false;
	}
	
	if (trim($_POST['address']) == "") 
	{
		$_SESSION['ERROR_TEXT'] = 'Địa chỉ không được trống !';
		return false;
	}
	

	
	// Độ dài mật khẩu
	if ((utf8_strlen($_POST['password']) < 4) || (utf8_strlen($_POST['password']) > 20)) 
	{
			$_SESSION['ERROR_TEXT'] = 'Mật khẩu không được dưới 4 kí tự và không quá 20 kí tự';
			return false;
	}

	// Xác nhận mật khẩu
	if ($_POST['password'] != $_POST['confirm_password']) 
	{
			$_SESSION['ERROR_TEXT'] = 'Xác nhận mật khẩu không đúng';
			return false;
	}
	
	return true;
}

function validateImageUpload()
{
	// Thư mục chứa ảnh khách hàng
	$directory = DIR_IMAGE . 'catalog/profiles/customers';
	
	// Kiểm tra xem thư mục đó có tồn tại:
	if (!is_dir($directory))
	{
		//$error_image_upload = 'Thư mục không tồn tại';
		$_SESSION['ERROR_TEXT'] = "Không có thư mục chứa ảnh trên máy chủ  hệ thống !";
		return false;
	}
	
	if (!empty($_FILES['image_file']['name']) && is_file($_FILES['image_file']['tmp_name']))
	{
		// Sanitize the filename
		$filename = basename(html_entity_decode($_FILES['image_file']['name'], ENT_QUOTES, 'UTF-8'));
	
		// Validate the filename length
		if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 255))
		{
			//$error_image_upload = 'Tên file phải có độ dài từ 3 đến 255 ký tự.';
			//$error_image_upload = 'Thư mục không tồn tại';
			$_SESSION['ERROR_TEXT'] = 'Tên file phải có độ dài từ 3 đến 255 ký tự.';
			return false;
		}
	
		// Allowed file extension types
		$allowed = array(
				'jpg',
				'jpeg',
				'gif',
				'png',
				'ico'
		);
	
		if (!in_array(utf8_strtolower(utf8_substr(strrchr($filename, '.'), 1)), $allowed))
		{
			//$error_image_upload = 'Không đúng kiểu file ảnh !';
			$_SESSION['ERROR_TEXT'] = 'Không đúng kiểu file ảnh !';
			return false;
		}
	
		// Allowed file mime types
		$allowed = array(
				'image/jpeg',
				'image/pjpeg',
				'image/png',
				'image/x-png',
				'image/gif',
				'image/x-icon'
		);
	
		if (!in_array($_FILES['file']['type'], $allowed))
		{
			//$error_image_upload = 'Không đúng kiểu file ảnh !';
			$_SESSION['ERROR_TEXT'] = 'Không đúng kiểu file ảnh !';
			return false;
		}
	
		// Check to see if any PHP files are trying to be uploaded
		$content = file_get_contents($_FILES['image_file']['tmp_name']);
	
		if (preg_match('/\<\?php/i', $content))
		{
			//$error_image_upload = 'Không được phép tải lên file mã nguồn !';
			$_SESSION['ERROR_TEXT'] = 'Không được phép tải lên file mã nguồn !';
			return false;
		}
	
		// Return any upload error
		if ($_FILES['image_file']['error'] != UPLOAD_ERR_OK)
		{
			//$error_image_upload = 'Lỗi tài file:' . $_FILES['image_file']['error'];
			$_SESSION['ERROR_TEXT'] = 'Lỗi tài file:' . $_FILES['image_file']['error'];
			return false;
		}
	}
	
		
	// @todo: Kiểm tra nếu đã tồn tại một file với tên như thế rồi thì
	// mã hóa tên file mới, bằng một chuỗi 32 kí tự chẳng hạn, học từ thằng processmaker.
	$target = date('Y-m-d-H-i-s').$filename;
	move_uploaded_file($_FILES['image_file']['tmp_name'], $directory . '/' . $target);
	
	return true;
}

function validateDelete()
{
	return true;
}

function validateCopy()
{
	return true;
}