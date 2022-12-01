<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 * 
 * Các hàm quản lý dữ liệu giỏ hàng
 */
// cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/tool.image.php';

/** Dữ liệu giỏ hàng được lưu trong mảng $_SESSION['cart'].
Mỗi phần tử mảng có cấu trúc:
    Mã Sản Phẩm => Số Lượng
    
 Ví dụ:
 $_SESSION['cart'] = array(2) 
 { 
 	[38]=> int(2) 
 	[24]=> int(1) 
 }
 
 */

// Khởi tạo mảng dữ liệu giỏ hàng
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) 
{
	$_SESSION['cart'] = array();
}

/**
 * Hàm thêm sản phẩm vào giỏ hàng
 * 
 * @param int $product_id (Mã sản phẩm)
 * @param int $quantity (Số lượng thêm vào giỏ hàng)
 * @return void
 */
function cartAdd($product_id, $quantity = 1) 
{

	if ((int)$quantity && ((int)$quantity > 0)) 
	{
		if (!isset($_SESSION['cart'][$product_id])) // Sản phẩm chưa có trong giỏ hàng ...
		{
	        $_SESSION['cart'][$product_id] = (int)$quantity; // ... thì thêm mới
	        
		} 
		else                                                    // Sản phẩm đã có trong giỏ hàng 
		{
            $_SESSION['cart'][$product_id] += (int)$quantity;   // ...thì tăng số lượng
		}
	}
}

/**
 * Hàm cập nhật giỏ hàng.
 * @param int $product_id (Mã Sản Phẩm))
 * @param int $quantity (Số Lượng)
 */
function cartUpdate($product_id, $quantity) 
{
    // Nếu trong giỏ hàng có sản phẩm này thì mới tiến hành cập nhật lại số lượng
	if ((int)$quantity && ((int)$quantity > 0) && isset($_SESSION['cart'][$product_id])) 
	{
	    $_SESSION['cart'][$product_id] = (int)$quantity;
	} 
}

/**
 * Hàm gỡ bỏ sản phẩm khỏi giỏ hàng.
 * @param int $product_id (Mã Sản Phẩm))
 * @param int $quantity (Số Lượng)
 */
function cartRemove($product_id) 
{
    unset($_SESSION['cart'][$product_id]);
}

/**
 * Xóa sạch sản phẩm khỏi giỏ hàng
 * Được gọi ngay sau khi khách hàng thanh toán
 */
function cartClear() 
{
	$_SESSION['cart'] = array();
}

// Lấy ra tất cả các sản phẩm trong giỏ hàng
function cartGetProducts() 
{
    $cart_data = array();
	
	foreach ($_SESSION['cart'] as $product_id => $quantity) 
	{

	   // Truy vấn thông tin sản phẩm theo mã
	   $sql = " 
            SELECT * FROM product AS p 
	        WHERE p.product_id = '{$product_id}' AND p.status = '1'
	   ";
	   $product_info = db_row($sql);
				
	   // Nếu truy vấn thành công
	   if (is_array($product_info) && !empty($product_info)) 
	   {
                
            $cart_data[$product_id] = array(
			     'product_id'      => $product_info['product_id'],
				 'name'            => $product_info['name'],
				 'model'           => $product_info['model'],
				 'image'           => $product_info['image'],
				 'quantity'        => $quantity,
			     'price'           => $product_info['price'],
			     'total'           => (int)$product_info['price'] * $quantity
		    );
	   } 
	   else // Nếu sản phẩm này không có trong cơ sở dữ liệu...
	   {
	        // ... thì phải gỡ bỏ mã định danh của nó khỏi giỏ hàng
		    cartRemove($product_id);
	   }
	}

	return $cart_data;
} // end getProducts()


/**
 Định dạng dữ liệu sản phẩm trong giỏ hàng trước khi được hiển thị bên view html.
 khác so với hàm cartGetProducts() chỉ lấy dữ liệu thô.
 Mục đích là để đồng bộ mã nguồn (tránh dư thừa) ở các file 
 cart.php, checkout.php
 */
function cartGetProductsWithFormat()
{
	$products = array();
	
	foreach (cartGetProducts() as $product) 
	{
		// Ảnh đại diện sản phẩm
		if ($product['image']) 
		{
			$image = img_resize($product['image'], settings('config_image_cart_width'), settings('config_image_cart_height'));
		} else 
		{
			$image = '';
		}
		
		// Giá sản phẩm được định dạng với dấu phảy ngăn cách phần nghìn
		// và đơn vị việt nam đồng
		$price = number_format($product['price'],0,'.',',').' ₫';
	
		// Tổng giá trị của số sản phẩm
		$total = number_format($product['total'], 2, '.', ',').' ₫';
					
					
		$products[] = array(
		    'product_id' => $product['product_id'],
			'thumb'     => $image,
			'name'      => $product['name'],
			'model'     => $product['model'],
			'quantity'  => $product['quantity'],
			'price'     => $price,
			'total'     => $total,
			'href'      => '/product-info.php?product_id='.$product['product_id'] 
		);
	}
	
	return $products;
}
	

/**
 * Tính tổng giá trị đơn hàng
 */	
function cartGetTotal() 
{
	$total = 0;
		
	foreach (cartGetProducts() as $product) 
	{
		$total += $product['price'] * $product['quantity'];
	}

	return $total;
}

/**
 * Định dạng tổng giá trị đơn hàng với ngăn cách phần nghìn và đơn vị tiền tệ
 * ví dụ: total = 2000000 ---> total with format = 2,000,000 ₫
 */
function cartGetTotalWithFormat()
{
	return number_format(cartGetTotal(),0,'.',',').' ₫';
}

/**
 * Trả về đoạn text hiển thị số sản phẩm trong giỏ hàng và tổng giá trị của chúng.
 * ví dụ: 3 sản phẩm - 14,000,000 ₫
 */
function cartGetTextCountAndTotal()
{
	return sprintf( "%s sản phẩm - %s", cartCountProducts(), cartGetTotalWithFormat());
}
	
/**
 * Đếm tổng số sản phẩm trong giỏ hàng.
 * Chú Ý: không thể dùng lệnh: count($_SESSION['cart']);
 * bởi vì mỗi sản phẩm có thể xuất hiện nhiều lần trong giỏ hàng.
 * 
 * @return int
 */
function cartCountProducts() 
{
	$product_total = 0;

	$products = cartGetProducts();

	foreach ($products as $product) 
	{
		$product_total += $product['quantity'];
	}

	return $product_total;
}
	
/**
 * Kiểm tra xem trong giỏ hàng có sản phẩm không
 * @return int
 */
function cartHasProducts() 
{
	return count($_SESSION['cart']);
}
