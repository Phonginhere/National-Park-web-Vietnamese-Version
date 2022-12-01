<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang xóa loại sản phẩm
 */
include_once '../configs.php';
include_once '../lib/table/table.department.php';
include_once 'department-validate.php';

if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateDelete())  
{
	// Xóa phòng ban
	foreach ($_POST['selected'] as $department_id) 
    {
		departmentDelete($department_id);
	}
	
	// Thông báo xóa thành công
	$_SESSION['SUCCESS_TEXT'] = "Đã hoàn tất việc xóa phòng ban";
       	
	// Điều hướng tới trang danh sách phòng ban
	header ("location: /admin/department.php");
	die();
}

// Trong tình huống có lỗi khi xóa, thì hiển thị lỗi ngay trên trang danh sách
include_once 'department.php';
