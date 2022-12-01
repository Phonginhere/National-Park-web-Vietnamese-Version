<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang quản lý tải file
 */
/* Controller for Bootstrap File Manager */
// cấu hình hệ thống
include_once '../configs.php';

$json = array();

// Check user has permission
//		if (!$this->user->hasPermission('modify', 'common/filemanager')) {
//			$json['error'] = tr('error_permission');
//		}

// Make sure we have the correct directory
if (isset($_GET['directory'])) 
{
	$directory = rtrim(DIR_IMAGE . 'catalog/' . str_replace(array('../', '..\\', '..'), '', $_GET['directory']), '/');
} 
else 
{
	$directory = DIR_IMAGE . 'catalog';
}

// Check its a directory
if (!is_dir($directory)) 
{
	$json['error'] = 'Thư mục không tồn tại';
}

if (!$json) 
{
	if (!empty($_FILES['file']['name']) && is_file($_FILES['file']['tmp_name'])) 
	{
		// Sanitize the filename
		//$filename = basename(html_entity_decode($_FILES['file']['name'], ENT_QUOTES, 'UTF-8'));
				
		// File tải lên được đổi sang tên mới
		// tên này là một chuỗi định danh duy nhất, 
		// sinh ra từ các hàm mã hóa và hàm ngẫu nhiên.
		$filename = md5(mt_rand()).'.'.end(explode('.', $_FILES['file']['name']));

		// Validate the filename length
		if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 255)) 
		{
			$json['error'] = 'Tên file phải có độ dài từ 3 đến 255 ký tự.';
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
			$json['error'] = 'Không đúng kiểu file ảnh !';
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
			$json['error'] = 'Không đúng kiểu file ảnh !';
		}

		// Check to see if any PHP files are trying to be uploaded
		$content = file_get_contents($_FILES['file']['tmp_name']);

		if (preg_match('/\<\?php/i', $content)) 
		{
			$json['error'] = 'Không đúng kiểu file ảnh !';
		}

		// Return any upload error
		if ($_FILES['file']['error'] != UPLOAD_ERR_OK) 
		{
			$json['error'] = 'Lỗi tài file:' . $_FILES['file']['error'];
		}
	} 
	else 
	{
		$json['error'] = 'Lỗi tải file !';
	}
}

if (!$json) 
{
	move_uploaded_file($_FILES['file']['tmp_name'], $directory . '/' . $filename);

	$json['success'] = 'File đã được tải lên thành công';
}
		
//$json['error'] = $json['error'].$filename; // testing only.
			
header("Content-Type: application/json;charset=UTF-8");
echo json_encode($json);
