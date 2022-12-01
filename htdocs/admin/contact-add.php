<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang thêm mới liên hệ khách hàng.
 * Nhân viên hệ thống sẽ được phép thêm mới liên hệ khách hàng
 * cho những trường hợp không có khả năng liên hệ trực tuyến với html form
 * trên trang chủ.
 

 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.contact.php';
include_once 'contact-validate.php';

check_login(); // quản trị viên phải đăng nhập !

// Nếu user gửi form lên
// toàn bộ dữ liệu chỉnh sửa được lưu trong biến mảng $_POST
// nếu username và password để trống thì giá trị cũ được giữ nguyên !!!
//if ($_SERVER['REQUEST_METHOD'] == "POST" && validateEdit() && validateForm()) {
if ($_SERVER['REQUEST_METHOD'] == "POST") 
{

    //var_dump($_POST['date']); echo '<br />'; var_dump($_POST['time']);//string(10) "2020-07-12" // string(5) "09:22"
    //die();

	// Thêm mới liên hệ khách hàng
	contactAdd($_POST);
	
	// Thông báo thêm mới thành công
	$_SESSION['SUCCESS_TEXT'] = 'Đã hoàn tất việc thêm mới liên hệ khách hàng !';

	// Điều hướng tới trang danh sách liên hệ khách hàng
	header("location: /admin/contact.php");
	die();
}

$form_title = 'Thêm Mới Liên Hệ Khách Hàng';
$web_title = 'Liên Hệ Khách Hàng';
include_once 'contact-form.php';