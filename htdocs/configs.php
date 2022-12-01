<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 File:    configs.php
 Tóm tắt: Cấu hình hệ thống.
 Mô tả:   Cấu hình các thông tin:
 - máy chủ cơ sở dữ liệu, 
 - thư mục chứa mã nguồn ứng dụng, 
 - thư mục chứa các file layout của trang chủ/trang quản trị/trang đăng nhập quản trị,
 
 Nên dùng lệnh include_once() thay vì các lệnh khác như include(), require(), require_once()
 bởi vì lệnh này chỉ gọi thư viện một lần, và nếu có lỗi thì nó cũng chỉ cảnh báo
 và script vẫn chạy tiếp. Hơn nữa lệnh này gần với #include của C.
 
 XAMPP Control Panel v3.2.1
 PHP 5.5.6
 
 Cả Windows & Linux đều hỗ trợ dấu phân cách thư mục '/'
 nên ko cần lo lắng về việc chuyển đổi qua lại. Ví dụ:
 	C:\xampp\php\ext = C:/xampp/php/ext
 
 http://code.stephenmorley.org/articles/xampp-version-history-apache-mysql-php/
 https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/
 
 */

// Thiết lập chế độ hiển thị lỗi.
// 0: tắt đi mọi báo lỗi
// E_ALL: hiển thị mọi lỗi
// E_ERROR | E_WARNING | E_PARSE: Hiển thị các lỗi lúc chạy
// E_ERROR = 1
error_reporting(1);
// Khởi tạo phiên kết nối client (máy khách) <-> server (máy chủ)
session_start();

define('DB_HOST', 'localhost'); //'127.0.0.1'
define('DB_NAME', 'web_epj1_blog_parks');  
define('DB_USER', 'root');			
define('DB_PASS', '');			    

// Kho Giao Diện: 
// @xem adminlogin/flat_005 để biết cách cấu hình hình nền cho trang
// @xem adminlogin/flat_006 để biết cách hiện ảnh của user vừa thoát.
//$home_themes = 'opencart_45570';
//$home_themes = 'opencart_000_blog';
$home_themes = 'wpkixx';
// fashion: 002, 006
$admin_themes = 'flat_000_blog'; // rất nhiều admin theme đang bị lỗi bootstrap
$adminlogin_themes = 'flat_005';

// Đường dẫn tuyệt đối đến thư mục ảnh của toàn bộ hệ thống
// Ví dụ: C:/xampp/htdocs/web/image
// Kho Ảnh
define('FOLDER_IMAGE', 'images-epj1-blog-parks');
define('DIR_IMAGE', $_SERVER["DOCUMENT_ROOT"]."/".FOLDER_IMAGE."/");
define('URL_IMAGE', "/" . FOLDER_IMAGE."/");



// Các biến toàn cục (global variables) được truy cập bởi mọi trang php
global $settings;
global $db;
global $web_title; // tựa đề của trang
global $web_head; // css, javascript thêm vào của một trang cụ thể
global $web_content; // nội dung riêng của từng trang
global $web_pagination_controls; // phân trang
global $web_pagination_results;
global $active_page_admin; // trang hiện thời gắn liền với menu bị nhấp chuột.

// Tải các hàm toàn cục (global functions) để xử lý các tác vụ chung
// như truy vấn cơ sở dữ liệu, phân trang, giỏ hàng, dữ liệu phiên v.v...)
// các hàm này được gọi bởi hầu hết các trang php 
include_once 'lib/db.php';
include_once 'lib/global.php';
include_once 'lib/tool.image.php';
include_once 'lib/active-page.php';
// Tải các thư viện php của bên thứ 3, thư viện hệ thống v.v...
include_once 'lib/thirdparty/antnee/passwordLib.php'; // mã hóa (mật khẩu)
include_once 'lib/thirdparty/opencart/helper/utf8.php'; // xử lý chuỗi ký tự Unicode

// Tải các thư viện chung nhất được sử dụng thường xuyên bởi hầu hết các
// trang trong hệ thống: danh mục sản phẩm, giỏ hàng, các hàm xử lý ảnh,
// phòng ban, tin bài
include_once 'lib/table/table.category.php';
include_once 'lib/table/table.department.php';
include_once 'lib/table/table.post_category.php';
include_once 'cart-session.php';

// Kết nối cơ sở dữ liệu.
db_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Tải thông tin cài đặt hệ thống
load_settings();

// Mặc định ban đầu layout của từng trang chưa có nội dung.
// Tránh để $web_content bị null vì các file bố cục giao diện: layout*.php
// sẽ bị ngắt ở lệnh: include_once( $web_content )
$web_head = '';
$web_title = web_name();
$web_content = $_SERVER["DOCUMENT_ROOT"]."/ui/home/view-content.php";
$web_layout = "ui/home/{$home_themes}/layout.php";
$web_layout_admin = "ui/admin/{$admin_themes}/layout-admin.php";
$web_layout_adminlogin = "ui/adminlogin/{$adminlogin_themes}/layout-adminlogin.php";
check_file_layout($web_layout, $web_content);

// Báo lỗi nếu người dùng gõ vào địa chỉ url không hợp lệ
// hoặc họ truy cập vào tài nguyên không được phép.
// Khi đó người dùng bị điều hướng sang địa chỉ:
//		http://localhost:82/configs.php?failed=1
if (isset($_GET['failed']) && $_GET['failed']) 
{
	include_once 'error.php';
}

