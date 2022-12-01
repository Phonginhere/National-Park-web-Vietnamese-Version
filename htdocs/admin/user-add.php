<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang thêm mới nhân viên quản trị (user)
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.user.php';
include_once 'user-validate.php';

check_login(); // Quản trị viên phải đăng nhập.


// Nếu user gửi form lên
// toàn bộ dữ liệu thêm mới được lưu trong biến mảng $_POST
// Nếu dữ liệu gửi lên từ Form không hợp lệ thì kịch bản 'user-form.php' sẽ được gọi
// và giá trị gây lỗi, không hợp lệ đó sẽ được hiển thị lại trên các thành phần nhập liệu
// như input, textarea để người dùng nhìn lại.
// Nói cách khác, nếu dữ liệu trên Form không hợp lệ thì toàn bộ biến mảng $_POST
// sẽ được xử lý bởi kịch bản 'user-form.php'.
//
// Còn nếu dữ liệu Form hợp lệ thì mảng $_POST sẽ được chuyển qua cho 'table.user.php' xử lý
if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateAdd() && validateForm())  
{ 
	// Thêm mới user
	userAdd($_POST);
	
	// Thông báo thêm mới thành công
	$_SESSION['SUCCESS_TEXT'] = 'Bạn đã thêm mới user thành công !';
		
	// Điều hướng tới trang danh sách
	header ("location: /admin/user.php");
	die();
} 

$form_title = 'Thêm Mới Nhân Viên';
$web_title = 'Thêm User';
include_once 'user-form.php';