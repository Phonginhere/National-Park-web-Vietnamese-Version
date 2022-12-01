<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang xác thực tính hợp lệ của dữ liệu giỏ hàng
 */
// Cấu hình hệ thống
include_once 'configs.php';

function validateCheckout()
{
	if ((utf8_strlen(trim($_POST['fullname'])) < 1) || (utf8_strlen(trim($_POST['fullname'])) > 32)) 
	{
		$_SESSION['ERROR_TEXT'] = 'Tên phải dài từ 1 đến 32 kí tự';
		return false;
	}

	if ((utf8_strlen($_POST['email']) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $_POST['email'])) 
	{
		$_SESSION['ERROR_TEXT'] = 'Email phải hợp lệ';
		return false;
	}

	if ((utf8_strlen($_POST['telephone']) < 3) || (utf8_strlen($_POST['telephone']) > 32)) 
	{ 
		$_SESSION['ERROR_TEXT'] = 'Điện thoại chỉ dài từ 3 đến 32 kí tự';
		return false;
	}

	if ((utf8_strlen(trim($_POST['address'])) < 3) || (utf8_strlen(trim($_POST['address'])) > 128)) 
	{
		$_SESSION['ERROR_TEXT'] = 'Địa chỉ phải dài từ 3 đến 128 kí tự';
		return false;
	}

	return true;
}

function validateForm()
{
	return true;
}

function validateDelete()
{
	return true;
}

function validateRepair()
{
	return true;
}