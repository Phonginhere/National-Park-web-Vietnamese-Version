<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Các hàm xác thực tính hợp lệ của dữ liệu bài viết
 */
// cấu hình hệ thống
include_once '../configs.php';

function validateForm()
{
	if (empty($_POST['title']) || trim($_POST['title']) == "")
	{
		$_SESSION['ERROR_TEXT'] = 'Bạn vui lòng nhập tên bài viết !';
		return false;
	}
	
	if (empty($_POST['author_id']))
	{
		$_SESSION['ERROR_TEXT'] = 'Bạn vui lòng chọn tác giả cho bài viết !';
		return false;
	}
	
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