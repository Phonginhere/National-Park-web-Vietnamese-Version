<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 Thư viện hàm xác thực tính hợp lệ của dữ liệu. Được dùng trong các tình huống như
 đăng kí tài khoản, đăng nhập v.v...
 */


include_once 'thirdparty/opencart/helper/utf8.php';	// Thư viện hàm xử lý chuỗi unicode

const FULLNAME_MIN_LENGTH = 1;
const FULLNAME_MAX_LENGTH = 32;
const EMAIL_MAX_LENGTH = 96;
const TELEPHONE_MIN_LENGTH = 10;
const TELEPHONE_MAX_LENGTH = 32;
const PASSWORD_MIN_LENGTH = 4;
const PASSWORD_MAX_LENGTH = 20;

/*
 Xác thực tính hợp lệ của tên
 @todo parameterize the error text
 */
function validateFullname($fullname)
{
	// Kiểm duyệt độ dài họ tên
	if ((utf8_strlen(trim($fullname)) < FULLNAME_MIN_LENGTH) || (utf8_strlen(trim($fullname)) > FULLNAME_MAX_LENGTH))
	{
		$_SESSION['ERROR_TEXT'] = 'Tên phải có độ dài từ 1 kí tự trở lên và không quá 32 kí tự';
		return false;
	}
	
	return true;
}

/*
 Xác định tính hợp lệ của email
 */
function validateEmail($email)
{	
	// @todo tìm regex khác phù hợp hơn để đánh giá email.
	if ((utf8_strlen($email) > EMAIL_MAX_LENGTH) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {
		$_SESSION['ERROR_TEXT'] = 'Email phải hợp lệ và có độ dài không quá 96 kí tự !';
		return false;
	}
	
	return true;
}

/*
 Xác định tính hợp lệ của mật khẩu
 @todo parameterize the error text
 @todo nâng cao chính sách bảo mật bằng cách tăng cường sự chặt chẽ trong quy tắc gõ mật khẩu
 */
function validatePassword($password)
{
	// Độ dài mật khẩu
	if ((utf8_strlen($password) < PASSWORD_MIN_LENGTH) || (utf8_strlen($password) > PASSWORD_MAX_LENGTH)) 
	{
			$_SESSION['ERROR_TEXT'] = 'Mật khẩu không được dưới 4 kí tự và không quá 20 kí tự';
			return false;
	}

	return true;
}

/*
 Xác định tính hợp lệ của xác nhận mật khẩu
 @todo parameterize the error text
 @todo nâng cao chính sách bảo mật bằng cách tăng cường sự chặt chẽ trong quy tắc gõ mật khẩu
 */
function validateConfirmPassword($password, $confirm_password)
{
	// Xác nhận mật khẩu
	if ($password != $confirm_password) 
	{
			$_SESSION['ERROR_TEXT'] = 'Xác nhận mật khẩu không đúng';
			return false;
	}

	return true;
}

/*
 Xác thực tính hợp lệ của telephone
 @todo parameterize the error text
 */
function validateTelephone($telephone)
{
	if ((utf8_strlen(trim($telephone)) < TELEPHONE_MIN_LENGTH) || (utf8_strlen(trim($telephone)) > TELEPHONE_MAX_LENGTH))
	{
		$_SESSION['ERROR_TEXT'] = 'Điện thoại phải có độ dài từ 10 kí tự trở lên và không quá 32 kí tự';
		return false;
	}
}

/*
 Xác thực tính hợp lệ của địa chỉ
 @todo parameterize the error text
 */
function validateAddress($address)
{
	if (trim($address) == "") 
	{
		$_SESSION['ERROR_TEXT'] = 'Địa chỉ không được trống !';
		return false;
	}
}

