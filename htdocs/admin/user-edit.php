<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang sửa nhân viên quản trị
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.user.php';
include_once 'user-validate.php';

check_login();

// Nếu user gửi form lên
// toàn bộ dữ liệu chỉnh sửa được lưu trong biến mảng $_POST
// nếu username và password để trống thì giá trị cũ được giữ nguyên !!!
// Nếu user gửi form lên
// toàn bộ dữ liệu thêm mới được lưu trong biến mảng $_POST
// Nếu dữ liệu gửi lên từ Form không hợp lệ thì kịch bản 'user-form.php' sẽ được gọi
// và giá trị gây lỗi, không hợp lệ đó sẽ được hiển thị lại trên các thành phần nhập liệu
// như input, textarea để người dùng nhìn lại.
// Nói cách khác, nếu dữ liệu trên Form không hợp lệ thì toàn bộ biến mảng $_POST
// sẽ được xử lý bởi kịch bản 'user-form.php'.
//
// Còn nếu dữ liệu Form hợp lệ thì mảng $_POST sẽ được chuyển qua cho 'table.user.php' xử lý
if ($_SERVER['REQUEST_METHOD'] == "POST" && validateEdit() && validateForm()) 
{
	// Sửa user
	userEdit($_GET['user_id'], $_POST);
    
	
	//user_info_reset(); // đề phòng trường hợp user admin sửa thông tin của chính mình

	// Thông báo sửa thành công
	$_SESSION['SUCCESS_TEXT'] = 'Đã hoàn tất việc sửa thông tin nhân viên hệ thống !';

	// Điều hướng tới trang danh mục 
	header("location: /admin/user.php");
}

$form_title = 'Sửa Nhân Viên';
$web_title = 'Sửa Nhân Viên';
include_once 'user-form.php';