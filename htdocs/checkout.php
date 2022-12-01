<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang thanh toán
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.zone.php';
include_once 'lib/table/table.order.php';
include_once 'lib/table/table.customer.php';
include_once 'cart-session.php';
include_once 'lib/tool.image.php';
include_once 'checkout-validate.php';

// Nếu người dùng submit form và dữ liệu trên form là hợp lệ
if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateCheckout())  
{ 
	
	// Thêm mới đơn hàng vào cơ sở dữ liệu
	include_once 'order-save.php';
	
	// Nội dung riêng của trang:
	$web_content = "view/view-checkout-success.php";

	// được đặt vào bố cục chung của toàn site:
	include_once $web_layout;	
	die();
	
}

// Kiểm tra xem trong giỏ có hàng không 
// nếu không thì điều hướng sang checkout/cart.php
// @todo nên gửi thông báo sang bên view để họ biết tình trạng.

if( !cartHasProducts())
{
	header ("location: /cart.php");
	die();
}

$customer = array();
if (isset($_SESSION['CUS_LOGGED']))
	$customer = customerGetById($_SESSION['CUS_LOGGED']);
		
$web_logged = null; 

if (isset($_SESSION['account'])) 
{
	$web_account = $_SESSION['account'];
} 
else 
{
	$web_account = '';
}

// Các trường thông tin trên form khách hàng ///////////////////////////////
		
if (isset($_POST['fullname'])) 
{
	$guest_fullname = $_POST['fullname'];
}
else if (isset($_SESSION['CUS_LOGGED']))
{
	$guest_fullname = $customer['fullname'];
} 
else 
{
	$guest_fullname = '';
}

if (isset($_POST['email'])) {
	$guest_email = $_POST['email'];
} 
else if (isset($_SESSION['CUS_LOGGED']))
{
	$guest_email = $customer['email'];
}
else 
{
	$guest_email = '';
}

if (isset($_POST['telephone'])) 
{
	$guest_telephone = $_POST['telephone'];
} 
else if (isset($_SESSION['CUS_LOGGED']))
{
	$guest_telephone = $customer['telephone'];
}
else 
{
	$guest_telephone = '';
}

if (isset($_POST['address'])) {
	$guest_address = $_POST['address'];
} 
else if (isset($_SESSION['CUS_LOGGED']))
{
	$guest_address = $customer['address'];
}
else {
	$guest_address = '';
}

if (isset($_POST['postcode'])) {
	$guest_postcode = $_POST['postcode'];
} 
else if (isset($_SESSION['CUS_LOGGED']))
{
	$guest_postcode = $customer['postcode'];
}
else {
	$guest_postcode = '';
}

if (isset($_POST['city'])) {
	$guest_city = $_POST['city'];
} 
else if (isset($_SESSION['CUS_LOGGED']))
{
	$guest_city = $customer['city'];
}
else {
	$guest_city = '';
}

if (isset($_POST['comment'])) {
	$guest_comment = $_POST['comment'];
} else {
	$guest_comment = '';
}
// Nội dung riêng của trang...
$web_title = "Thanh Toán";
$web_content = "view/view-checkout.php";

// ...được đặt vào bố cục chung của toàn site:
include_once $web_layout;	
