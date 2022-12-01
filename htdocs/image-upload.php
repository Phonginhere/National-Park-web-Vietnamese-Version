<?php
// Cấu hình hệ thống
include_once 'configs.php';

// Thư mục chứa ảnh khách hàng
// Tạm thời chưa cần phải có ảnh profile của khách hàng 2018.04.10
$directory = DIR_IMAGE . 'catalog/profiles/customers';

// Kiểm tra xem thư mục đó có tồn tại:
if (!is_dir($directory)) 
{
	$error_image_upload = 'Thư mục không tồn tại';
}

if (!empty($_FILES['image_file']['name']) && is_file($_FILES['image_file']['tmp_name'])) 
{
	// Sanitize the filename
	$filename = basename(html_entity_decode($_FILES['image_file']['name'], ENT_QUOTES, 'UTF-8'));

	// Validate the filename length
	if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 255)) 
	{
		$error_image_upload = 'Tên file phải có độ dài từ 3 đến 255 ký tự.';
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
		$error_image_upload = 'Không đúng kiểu file ảnh !';
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
		$error_image_upload = 'Không đúng kiểu file ảnh !';
	}

	// Check to see if any PHP files are trying to be uploaded
	$content = file_get_contents($_FILES['image_file']['tmp_name']);

	if (preg_match('/\<\?php/i', $content)) 
	{
		$error_image_upload = 'Không được phép tải lên file mã nguồn !';
	}

	// Return any upload error
	if ($_FILES['image_file']['error'] != UPLOAD_ERR_OK) 
	{
		$error_image_upload = 'Lỗi tài file:' . $_FILES['image_file']['error'];
	}
}

			
// @todo: Kiểm tra nếu đã tồn tại một file với tên như thế rồi thì
// mã hóa tên file mới, bằng một chuỗi 32 kí tự chẳng hạn, học từ thằng processmaker.
move_uploaded_file($_FILES['image_file']['tmp_name'], $directory . '/' . date('Y-m-d-H-i-s').$filename);
