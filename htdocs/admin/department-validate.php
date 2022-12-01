<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Các hàm xác thực tính hợp lệ của dữ liệu loại sản phẩm gửi lên từ form
 */
include_once '../configs.php';
include_once '../lib/table/table.department.php';

/**
 * @todo implement completely
 * if validation failed, you should assign error message to session variable
 */
function validateForm()
{
	if (empty($_POST['name']) || trim($_POST['name']) == "")
	{
		$_SESSION['ERROR_TEXT'] = 'Bạn vui lòng nhập tên phòng ban !';
		return false;
	}
	
	return true;
}

function validateDelete()
{
    foreach ($_POST['selected'] as $department_id) 
    {
		if (departmentHasUser($department_id))
        {
            $_SESSION['ERROR_TEXT'] = "Lỗi-Không xóa phòng ban (mã {$department_id}) được vì có nhân viên trong đó. <br> Bạn vui lòng chuyển hết nhân viên sang phòng ban khác rồi mới xóa !";
		    return false;
        }
	}

    return true;
}

function validateRepair()
{
	return true;
}