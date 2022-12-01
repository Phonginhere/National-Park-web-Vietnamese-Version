/**
 * THƯ VIỆN JAVASCRIPT CHUNG NHẤT CHO TẤT CẢ CÁC MẪU THIẾT KẾ LAYOUT OpenCart
 * - Giỏ hàng Cart: add, remove, update
 * - So sánh sản phẩm Compare: add, remove
 * - Sản phẩm ưa thích: Whishlist
 * 
 * Mở phần sau đây ra để thấy là mình còn thiếu nhiều thư viện JavaScript:
 * view-source:https://livedemo00.template-help.com/opencart_50479/
 * 
 * file này viết đè nội dung của file common.js nằm trong thư mục template_files của thiết kế gốc.
 * 
 * Mỗi thiết kế layout nên có một tệp common-override.js riêng do tính chất của giao diện khác nhau,
 * mỗi khi cần sửa thì sẽ dễ dàng hơn
 */

/**
 * @return void
 * @abstract Tìm kiếm sản phẩm
 */
function search() 
{
	// Trang tìm kiếm 
	url = '/search.php';

	// Từ khóa mà người dùng gõ vào hộp tìm kiếm...
	var value = $('input[name=\'search\']').val();
	
	// ...được bổ sung vào đuôi url tìm kiếm như là một 
	// tham số truy vấn
	// ví dụ: http://localhost:82/search.php?search=iphone
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
// Nên viết theo phong cách OOP/Object Notation thì hơn là chỉ có hàm không.
// Cách làm của OpenCart Template 45570 khá hay: đặt kịch bản bấm nút xử lý nút giỏ hàng ở một chỗ
// script.js, bên html chỉ việc gán class: addToCart là xong.
var cart = {
	'add': function(product_id, quantity) { 
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

				$('#cart > button').button('reset');

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

						// tải lại nội dung html của giỏ hàng bằng (ajax load) lấy từ nguồn: /cart-ajax.php
						// chỉ lấy phần nội dung bên trong phần tử html có id="cart" 
						// sau đó đắp phần html đó vào bên trong phần tử id="cart" của trang hiện tại.
						$('#cart').load('/cart-ajax.php#cart > *');
						
						
				}
			},
			error: function(){
				alert('Lỗi!-Không thêm sản phẩm vào giỏ hàng được! Kiểm tra đường dẫn ajax và thử lại.');
			}
		});
	},
	'update': function(product_id, quantity) {
		$.ajax({
			url: '/cart-edit.php',
			type: 'post',
			data: 'product_id=' + product_id + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
			dataType: 'json',
			beforeSend: function() {
				$('#cart > button').button('loading');
			},
			success: function(json) {
				//$('#cart > button').button('reset');

				$('#cart-total').html(json['total']);

				if ( window.location.pathname == '/cart.php')
				{ 
					// Nếu như đường dẫn hiện tại đang là: http://localhost:82/cart.php
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
	},
	'remove': function(product_id) { 
		$.ajax({
			url: '/cart-remove.php', 
			type: 'post',
			data: 'product_id=' + product_id,
			dataType: 'json',
			beforeSend: function() {
				$('#cart > button').button('loading');
			},
			success: function(json) { 
				//$('#cart > button').button('reset');

				$('#cart-total').html(json['total']);

				if ( window.location.pathname == '/cart.php')
				{ 
					// Nếu như đường dẫn hiện tại đang là: http://localhost:82/cart.php
					// thì điều hướng sang chính nó để refresh lại giỏ hàng
					// ví dụ: user vừa xóa khỏi giỏ hàng một item.
					location = '/cart.php';
				} 
				else 
				{
					// tải lại nội dung html của giỏ hàng bằng (ajax load) 
					// chỉ lấy phần nội dung bên trong phần tử html có id="cart" 
					// sau đó đắp phần html đó vào bên trong phần tử id="cart" của trang hiện tại.
					$('#cart').load('/cart-ajax.php#cart > *');
				}
			},
			error: function(){
				alert('error!');
			}
		});
	}
} // kết thúc giỏ hàng

// So sánh sản phẩm
var compare = {
	    'add': function(product_id) {
	        $.ajax({
	            url: '/product-compare-add.php',
	            type: 'post',
	            data: 'product_id=' + product_id,
	            dataType: 'json',
	            success: function(json) {
	                $('.alert').remove();
	                if (json['success']) {
	                    $('#content').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
	                    $('#compare-total').html(json['total']);
	                    $('html, body').animate({
	                        scrollTop: 0
	                    }, 'slow');
	                }
	            }
	        });
	    },
	    'remove': function() {}
}// kết thúc so sánh sản phẩm

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
