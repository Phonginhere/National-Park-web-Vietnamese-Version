<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 * 
 * Trang xác thực tài khoản khách hàng
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.customer.php';
 
// Nhận các thông tin gửi lên từ form đăng nhập 
// strtolower là chuyển đổi mọi kí tự thành chữ thường, 
//Hàm trim () loại bỏ khoảng trắng và các ký tự được xác định trước khác từ cả hai phía của chuỗi.
//$_POST được sử dụng để thu thập dữ liệu biểu mẫu sau khi gửi biểu mẫu HTML với method = "post"

$email = strtolower(trim($_POST['email']));
$password = trim($_POST['password']);
	
// Xác thực danh tính của khách hàng
$customer_id = customerVerifyLogin($email,$password); 
// @todo Clear session files older than 72 hours
	
// Các tình huống username không hợp lệ.
switch ($customer_id) 
{
	case -1:
    	$errLabel = 'Khách hàng không tồn tại';
        break;
    case -2:
        $errLabel = 'Mật khẩu không đúng';
        break;
	case -3:
		$errLabel = 'Khách hàng chưa được kích hoạt'; //The user is inactive
        break;
    case -4:
        $errLabel = 'Khách hàng đã hết hạn sử dụng'; //The Due date is finished
        break;
}
    
if ( !isset($customer_id) ) 
{
	$customer_id = -1;
    $errLabel = 'Khách hàng không tồn tại';
}
    
// Nếu đăng nhập thất bại
if (!isset($customer_id) || $customer_id < 0) 
{ 
		//Khi kết thúc một phiên (đăng nhập sai) bạn sẽ tạo ra 1 phiên làm việc mới không liên qua gì tới phiên cũ nữa.
		if (isset($_SESSION['CUS_FAILED_LOGINS'])) 
		{	// set in login.php
        	$_SESSION['CUS_FAILED_LOGINS']++;
        }
        
        // Hiện lại thông tin trên form để khách đỡ phải nhập lại
        $_SESSION['FAILED_EMAIL'] = $email;
        $_SESSION['FAILED_PASSWORD'] = $password;
		
		// Gửi thông báo lỗi sang tầng giao diện html
		$_SESSION["ERROR_TEXT"] = $errLabel;
		
		// Điều hướng quay trở lại form đăng nhập  
		header("location: /login.php");
        die;
}
	
	// Các khách hàng đăng nhập thành công  
	// cần đồng bộ với logout.php
	
	$_SESSION['CUS_LOGGED']  = $customer_id;
    
    customer_info_reset(); 
    
    // Sau khi đã xác thực danh tính khách hàng
    // thì điều hướng về trang chủ...
    if (empty($_POST['ru'])) {
        $redirected_url = "home-blog.php";
    }else{
        // ...hoặc điều hướng tới trang được yêu cầu ngay trước lúc đăng nhập...
    	$redirected_url = $_POST['ru'];
    }
    
	header ("location: $redirected_url");
