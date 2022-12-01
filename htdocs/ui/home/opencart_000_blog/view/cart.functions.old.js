// deprecated since 2017.03.30
// xMen decided to have common-override.js for each design separately
// so the student user can easily modify

//THƯ VIỆN JAVASCRIPT CHUNG NHẤT CHO TẤT CẢ CÁC MẪU THIẾT KẾ LAYOUT opencart
//    Ví dụ: các tác tụ liên quan đến giỏ hàng (cart): add, remove, update, compare, whishlist v.v...
//    
//    - Mở phần sau đây ra để thấy là mình còn thiếu nhiều thư viện JavaScript:
//	view-source:https://livedemo00.template-help.com/opencart_50479/
// file common.js này được gọi trước common.js của riêng thiết kế.
// 
// Phần chung nhất cho tất cả các themes OpenCart
// Tìm kiếm sản phẩm
// Hàm này được gọi ở nhiều mẫu thiết kế khác nhau
// Xem common.js trong các thiết kế này.
// ví dụ: /web/themes/home/opencart/50677/layout_files/common.js
// Có nhiều cách lấy giá trị từ khóa bên trong hộp tìm kiếm: tùy vào thiết kế cụ thể.
//var value = $('header input[name=\'search\']').val();
//var value = $('#header input[name=\'search\']').val();
function search() 
{
	// Trang tìm kiếm giấu trong layout.php
	url = '/search.php';

	// Từ khóa mà người dùng gõ vào hộp tìm kiếm...
	var value = $('input[name=\'search\']').val();
	
	// ...được bổ sung vào đuôi url tìm kiếm như là một 
	// tham số truy vấn
	// ví dụ: http://localhost:82/web/product/search.php?search=iphone
	if (value) {
		url += '?search=' + encodeURIComponent(value);
	}

	// Điều hướng cửa sổ trình duyệt sang trang tìm kiếm
	window.location = url;
}

// ví dụ mẫu:
//$(document).ready(function() {
		
	/* Search */
	// Nếu như user bấm vào nút tìm kiếm thì điều hướng sang trang tìm kiếm với từ khóa
	// gắn vào url như là một tham số truy vấn.
	// Chú ý: khi tích hợp file nào vào layout mới.
	// phải kiểm tra xem javascript của layout đó dành cho nút search như thế nào ?
	// Phải tắt cái của họ đi và dùng cái của minh.
//	$('#search input[name=\'search\']').parent().find('button').on('click', search);
//  $('.button-search').bind('click', search); // template no50677 

	// Nếu như user bấm vào nút enter (mã ASCII là 13)
	// thì click vào nút search một cách tự động (theo phong cách programatically)
	// Đừng dùng bind(), mà hãy dùng cái mới on() để ràng buộc.
	// ví dụ:
	// $('#header input[name=\'search\']').bind('keydown', function(e) {
	// 
//	$('#search input[name=\'search\']').on('keydown', function(e) { 
//		if (e.keyCode == 13) {
//			//$('header input[name=\'search\']').parent().find('button').trigger('click');
//			search();
//		}
//	});

//});

// Các hàm xử lý giỏ hàng
//
// Các mẫu UI thông báo thêm vào giỏ thành công:
//  dòng màu xanh: 
//	<div class="alert alert-success"><i class="fa fa-check-circle"></i> json success<button type="button" class="close" data-dismiss="alert">&times;</button></div>
// hàm cart.add() là hàm cần viết đè lại ở từng mẫu thiết kế.
// hàm cart.update(), cart.remove() là các hàm được chia sẻ chung giữa các mẫu thiết kế.
// các hàm liên quan đến whishlist, compare cũng vậy.
// @todo: điều tra xem từ bản opencart bao nhiêu
// thì họ dùng hàm function addToCart(product_id, quantity) chứ ko dùng OOP.
//
// Cách làm của OpenCart Template 45570 khá hay: đặt kịch bản bấm nút xử lý nút giỏ hàng ở một chỗ
// script.js, bên html chỉ việc gán class: addToCart là xong.
// Dùng OOP thì có cái hay là tên hàm không cần có giới từ 'to', 'from'
function addToCart(product_id, quantity) 
{ 
	$.ajax({
		url: '/cart-add.php',
		type: 'post',
		data: 'product_id=' + product_id + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
		dataType: 'json',
		beforeSend: function() {
			$('#cart > button').button('loading');
		},
		success: function(json) {	
				// Ngay sau khi nhận được thông tin phúc đáp/phản hồi của máy chủ
				// về việc yêu cầu thêm mới giỏ hàng thì:
				
				// gỡ bỏ các hộp thoại cảnh báo, hộp thoại thông báo, hộp thoại lỗi
				// hộp thoại cung cấp thông tin, v.v...
			$('.alert, .text-danger .success, .warning, .attention, .information, .error').remove();

			//$('#cart > button').button('reset');

				// Nếu như máy chủ yêu cầu điều hướng sang trang khác
				// vì cần thêm yêu cầu: màu sản phẩm là gì ? model máy nào ? v.v...
				// khi đó người dùng phải thêm vào nhiều option (lựa chọn) thì hệ thống mới
				// cho thêm mới vào giỏ hàng thực sự.
			if (json['redirect']) {
					// error products are to be redirected ?
					// example: json['error']['recurring'];
					location = json['redirect'];
			}
				
				// Cập nhật lại thông tin về giỏ hàng trên giao diện html
				// sau khi vừa thêm mới sản phẩm
			if (json['success']) {
					// đoạn html này thông báo thêm giỏ hàng thành công.
					// Thêm đoạn mã html vào trước thẻ cha của thẻ con có id="content"
					$('#content').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					
					$('.alert-success').fadeOut(10000);
					
					// cập nhật thông tin số sản phẩm trong giỏ hàng
					$('#cart-total').html(json['total']);
					
					// cuộn lên đầu trang
					$('html, body').animate({ scrollTop: 0 }, 'slow');

					// tải lại nội dung html của giỏ hàng bằng ajax load
					// chỉ lấy phần nội dung bên trong phần tử html có id="cart" 
					// sau đó đắp phần html đó vào bên trong phần tử id="cart" của trang hiện tại.
					
					$('#cart').load('/cart-ajax.php#cart > *');					
					
					
			}
		},
		error: function(){
			alert('Lỗi!-Không thêm sản phẩm vào giỏ hàng được! Kiểm tra đường dẫn ajax và thử lại.');
		}
	}); // end jquery ajax request
}

function cartAdd(product_id, quantity) { addToCart(product_id, quantity); }

function updateCart(key, quantity) 
{
		$.ajax({
			url: '/cart-edit.php',
			type: 'post',
			data: 'key=' + key + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
			dataType: 'json',
			beforeSend: function() {
				$('#cart > button').button('loading');
			},
			success: function(json) {
				//$('#cart > button').button('reset');

				$('#cart-total').html(json['total']);

				if ( window.location.pathname == '/cart.php')
				{ 
					// Nếu như đường dẫn hiện tại đang là: http://localhost:82/dwp/checkout/cart.php
					// thì điều hướng sang chính nó để refresh lại giỏ hàng
					// ví dụ: user vừa xóa khỏi giỏ hàng một item.
					location = '/cart.php';
				} 
				else 
				{
					// tải lại nội dung html của giỏ hàng bằng ajax load
					// chỉ lấy phần nội dung bên trong phần tử html có id="cart" 
					// sau đó đắp phần html đó vào bên trong phần tử id="cart" của trang hiện tại.
					
					$('#cart').load('/cart-ajax.php#cart > *');
				}
			}
		});
}

function cartUpdate(key, quantity) {updateCart(key, quantity);}

function removeFromCart(key) 
{ 
		$.ajax({
			url: '/cart-remove.php', 
			type: 'post',
			data: 'key=' + key,
			dataType: 'json',
			beforeSend: function() {
				$('#cart > button').button('loading');
			},
			success: function(json) { 
				//$('#cart > button').button('reset');

				$('#cart-total').html(json['total']);

				if ( window.location.pathname == '/cart.php')
				{ 
					// Nếu như đường dẫn hiện tại đang là: http://localhost:82/dwp/checkout/cart.php
					// thì điều hướng sang chính nó để refresh lại giỏ hàng
					// ví dụ: user vừa xóa khỏi giỏ hàng một item.
					location = '/cart.php';
				} 
				else 
				{
					// tải lại nội dung html của giỏ hàng bằng ajax load
					// chỉ lấy phần nội dung bên trong phần tử html có id="cart" 
					// sau đó đắp phần html đó vào bên trong phần tử id="cart" của trang hiện tại.
					
					$('#cart').load(urlCartInfo+' #cart > *');
				}
			},
			error: function(){
				alert('error!');
			}
		});
}

function cartRemove(key) {removeFromCart(key);}

$(document).ready(function(){
	// bản thiết kế lưu về:
	// 	https://demo.opencart.com/
	// lại không sổ xuống menu
	// nên phải bổ sung kịch bản này.
	// rõ ràng là khi tra cứu các hàm của jQuery
	// ta phải tra cứu cả các hàm của plugins cài cắm vào nó nữa.
	// 
	// ràng buộc này bị gỡ bỏ khỏi nút
	// do hàm bootstrap sau đây được gọi trong cart.add():
	// 		$('#cart > button').button('reset');
	// $('#cart > button').on('click', function(){
	//$('#cart').on('click', function(){
		//$('#cart').addClass('open');
		//$('#cart > button').addClass('fuck-it-off'); // testing only
	//});
	
	// menu tiền tệ, menu tài khoản, đăng kí, đăng nhập...trong layout.php
	$(".dropdown-toggle").dropdown();
});
