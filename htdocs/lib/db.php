<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Các hàm kết nối và truy vấn cơ sở dữ liệu MySQL
  Đôi khi cài xampp lên thì mysql_connect() bị chết.
 	http://stackoverflow.com/questions/6390102/what-is-the-difference-between-mysqli-connect-and-mysql-connect
 	http://stackoverflow.com/questions/13825108/undefined-function-mysql-connect
 Nhưng ko nhất thiết phải chuyển sang mysqli_connect().
 
 Mở file sau đây php.ini để xem cấu hình extension:
 
 	extension=php_mysql.dll
	extension=php_mysqli.dll
	
 Mở thư mục: C:\xampp\php\ext
 để xem các file *.dll có tồn tại hay không. 
 */
// Mục tiêu đặt ra là viết một bộ mã thuần túy hướng thủ tục.
// Ko cần phải dùng lớp class.DBi.php nữa bởi vì theo tài liệu
// đặc tả thì việc đóng kết nối mysql được thực thi tự động
// khi script dừng.

// @see
// http://stackoverflow.com/questions/4942596/automatic-db-connection-close-in-php
// http://php.net/manual/en/function.mysql-connect.php#refsect1-function.mysql-connect-notes
// https://code.google.com/p/edb-php-class/

// @todo
// 1. đưa hết mã nguồn xử lý cơ sở dữ liệu từ file class.DBi.php sang
// 2. Test cho nó chạy lại bình thường.
// 3. Chuyển hóa hết thành lập trình hướng thủ tục.
// Nên làm việc này trước khi test lại toàn bộ hệ thống
// vì việc này cần nhiều thời gian hơn.

// thao tác cơ sở dữ liệu,

global $db_connection;

/**
 * Kết nối cơ sở dữ liệu.
 */
function db_connect($host, $user, $pass, $db)
{ 
	global $db_connection;
	
	$db_connection = mysqli_connect($host, $user, $pass) 
		or die(mysqli_connect_error());
	
	// Thiết lập mã hóa utf-8 cho kết nối MySQL
	// để tránh các lỗi liên quan đến mã hóa kí tự đặc biệt (không phải là ASCII)
		// @see http://stackoverflow.com/questions/275411/php-output-showing-little-black-diamonds-with-a-question-mark
	mysqli_set_charset($db_connection,'utf8');
	
	// Select database to be ready for queries
	mysqli_select_db($db_connection,$db) 
		or die(mysqli_error($db_connection));

}

/**
 * Truy vấn bảng kết quả.
 *
 * Thực thi câu truy vấn sql và trả về kết quả dưới dạng
 * mảng chỉ số, mỗi phần tử lại là một mảng kết hợp mà
 * khóa (key) trùng với tên cột.
 *
 * Cũng có thể dùng để thực thi các câu lệnh INSERT, UPDATE.
 */
function db_q($sql)
{
	return db_query($sql);
}

/**
 * Xem hàm db_q($sql)
 */
function db_query($sql)
{
	global $db_connection;
	
	$result = array();
	$q = mysqli_query($db_connection, "$sql")
		or die(mysqli_error($db_connection));
	
	while($row = mysqli_fetch_array($q)){
		$result[] = $row;
	}
	
	return $result;
	
}

/**
 * Truy vấn một bản ghi trong bảng kết quả.
 *
 * Thực thi câu truy vấn sql và trả về kết quả dưới dạng
 * mảng kết hợp mà khóa (key) trùng với tên cột, giá trị
 * trùng với giá trị của ô trong bản ghi.
 *
 */
function db_row($sql)
{
	return db_line($sql);
}

function db_line($sql)
{
	global $db_connection;
	$query = mysqli_query($db_connection,"$sql");
	$line = mysqli_fetch_array( $query );
	return $line;
}

/**
 * Truy vấn ô kết quả.
 *
 * Thường dùng để trả về kết quả của các hàm gộp trong sql
 * như COUNT(), SUM(), AVG(), MIN(), MAX()
 */
function db_one($sql)
{
	global $db_connection;
	
	$query = mysqli_query($db_connection,"$sql");
	$r = mysqli_fetch_array( $query );
	$one = $r[0];
	
	return $one;
}

/**
 * Xử lý các ký tự đặc biệt cho phát biểu sql,
 * nhằm tránh lỗi sql injection, tăng tính bảo mật cho hệ thống.
 */
function db_escape($str)
{
	global $db_connection;
	
	if ($db_connection) {
		return mysqli_real_escape_string($db_connection,$str);
	}
	
	return $str;
}

	

/**
 * Lấy lại id của bản ghi vừa mới chèn vào.
 *
 * Hàm này phải được gọi ngay sau lệnh:
 *
 * 	db_q("INSERT INTO ...");
 */
function db_lastId()
{
	global $db_connection;
	return mysqli_insert_id($db_connection);
}
