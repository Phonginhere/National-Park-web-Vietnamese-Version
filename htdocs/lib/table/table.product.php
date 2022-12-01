<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Các hàm quản lý sản phẩm
 */

// Thư viện hàm
include_once 'tool.image.php';
	
/**
 * @param array $data Mảng dữ liệu sản phẩm
 * @return int Mã sản phẩm
 * 
 * @abstractThêm mới sản phẩm
 */
function productAdd($data)
{
			$model           = db_escape($data['model']);
			$manufacturer_id = (int)$data['manufacturer_id'];
			$price           = (float)$data['price'];
			$status          = (int)$data['status'];
			$best_seller     = (int)$data['best_seller'];
			$featured        = (int)$data['featured'];
			$sort_order      = (int)$data['sort_order'];
			
			$name             = db_escape($data['name']);
			$description      = db_escape($data['description']);
			$tag              = db_escape($data['tag']);
			
			$sql = " 
				INSERT INTO `product`
				SET model = '{$model}',
					manufacturer_id = '{$manufacturer_id}',
					price = '{$price}',
					status = '{$status}',
					best_seller = '{$best_seller}',
					featured = '{$featured}',
					sort_order = '{$sort_order}',
					date_added = NOW(),
                    date_modified = NOW(),
					name = '{$name}', 
					description = '{$description}',
					tag = '{$tag}' 
			";
			//echo $sql;die();
			db_q($sql);
			
			// get newly inserted id
			$product_id = (int)db_lastId();
			
			// Ảnh đại diện / Product Image Thumbnail
			if (isset($data['image'])) {
				$img = db_escape($data['image']);
				db_q("UPDATE `product` SET `image` = '{$img}' WHERE `product_id` = '{$product_id}'");
			}
			
			// Cách mà PHP xử lý một mảng các thẻ input phía giao diện html gửi lên
			// https://stackoverflow.com/questions/1010941/html-input-arrays
			// <input name="product_image[0][image]" value="apple" />
			// <input name="product_image[0][sort_order]" value="1" />
			
            // <input name="product_image[1][image]" value="pear" />
			// <input name="product_image[1][sort_order]" value="3" />
			
			// <input name="product_image[2][image]" value="bannana" />
			// <input name="product_image[2][sort_order]" value="5" />
			
			// Khi mảng các thẻ <input> đó gửi lên thì PHP sẽ hứng : $_POST['product_image']
			// và biến $_POST này được truyền như là đối số cho tham số $data của hàm này productAdd($data)
			
			// Bộ sưu tập ảnh của riêng sản phẩm này (Product Image Collection/Gallery)
			if (isset($data['product_image'])) 
			{
				foreach ($data['product_image'] as $product_image) 
				{
					$image = db_escape($product_image['image']);
					$sort_order = (int)$product_image['sort_order'];
					
					// Nếu ảnh này đã được liên kết với sản phẩm rồi thì thôi, bỏ qua
					// và chuyển sang ảnh tiếp theo của sản phẩm.
					if(in_array($image, productImages($product_id)))
						continue;
					
					
					db_q("
						INSERT INTO `product_image` 
						SET `product_id` = '{$product_id}', 
						    `image` = '{$image}', 
						    `sort_order` = {$sort_order}");
				}
			}
			
			// Loại sản phẩm (Product Category)
			if (isset($data['product_category'])) 
			{
				foreach ($data['product_category'] as $category_id) 
				{
					db_q("
						INSERT INTO `product_to_category` 
						SET `product_id` = '{$product_id}', 
						`category_id` = '{$category_id}'"
					);
				}
			}
			
			return $product_id;

} // kết thúc hàm productAdd($data)
	
/**
 * @param int $product_id Mã sản phẩm
 * @param array $data Mảng dữ liệu sản phẩm
 * @return int Mã sản phẩm bị chỉnh sửa
 * 
 * @abstract Hàm sửa thông tin sản phẩm
 */
function productEdit($product_id, $data)
{
			// Tinh chỉnh dữ liệu trước khi cập nhật
			$model           = db_escape($data['model']);
			$manufacturer_id = (int)$data['manufacturer_id'];
			$price           = (float)$data['price'];
			$status          = (int)$data['status'];
			$best_seller     = (int)$data['best_seller'];
			$featured        = (int)$data['featured'];
			$sort_order      = (int)$data['sort_order'];
			$name             = db_escape($data['name']);
			$description      = db_escape($data['description']);
			$tag              = db_escape($data['tag']);
			
			$sql = " 
				UPDATE product
				SET model = '{$model}',
					manufacturer_id = '{$manufacturer_id}',
					price = '{$price}',
					status = '{$status}',
					best_seller = '{$best_seller}',
					featured = '{$featured}',
					sort_order = '{$sort_order}',
					date_modified = NOW(),
					name = '{$name}', 
					description = '{$description}',
					tag = '{$tag}' 
			WHERE product_id = '{$product_id}'";
			
			db_q($sql);
			
			// Ảnh đại diện / Product Image Thumbnail
			if (isset($data['image'])) {
				$image = db_escape($data['image']);
				
				$sql = "UPDATE `product` SET `image` = '{$image}' WHERE `product_id` = '{$product_id}'";
				db_q($sql);
			}
			
			// Bộ sưu tập ảnh sản phẩm này / Product Image Collection
			db_q("DELETE FROM `product_image` WHERE `product_id` = '{$product_id}'");

			if (isset($data['product_image'])) 
			{
				foreach ($data['product_image'] as $product_image) 
				{
					$image = db_escape($product_image['image']);
					$sort_order = (int)$product_image['sort_order']; // (int) để tránh lỗi Incorrect integer value: '' for column 'sort_order' at row 1
					
					// Nếu ảnh này đã được liên kết với sản phẩm rồi thì thôi, bỏ qua
					// và chuyển sang ảnh tiếp theo của sản phẩm.
					if(in_array($image, productImages($product_id)))
						continue;
					
					
					db_q("
						INSERT INTO `product_image` 
						SET `product_id` = '{$product_id}',
						    `image` = '{$image}', 
						    `sort_order` = '{$sort_order}'");
				}
			}
			
			// Những loại sản phẩm liên quan / Product To Category
			db_q("DELETE FROM `product_to_category` WHERE `product_id` = '{$product_id}'");

			if (isset($data['product_category'])) {
				foreach ($data['product_category'] as $category_id) {
					db_q("INSERT INTO `product_to_category` SET `product_id` = '{$product_id}', `category_id` = '{$category_id}'");
				}
			}
			
			return $product_id;
}
	
/**
 * Sao chép thông tin sản phẩm sang một bản ghi mới.
 * Tiện cho việc thêm mới một sản phẩm có nhiều thông tin trùng với một sản phẩm đã có sẵn.
 * 
 * @return an indexed array of associative arrays
 */
function productCopy($product_id)
{
		// Lấy ra dữ liệu của bản ghi gốc
		$sql = " 
			SELECT DISTINCT * 
			FROM `product`
			WHERE `product_id` = '{$product_id}'
		";
		$rs = db_row($sql);
		
		
		if ( is_array($rs) && !empty($rs) ) 
		{
				$data = array();

				$data = $rs;
				
				// Tinh chỉnh một vài điểm
				$data['status'] = '0';
	
				$data = array_merge($data, array('product_image' => productGetImages($product_id)));
				$data = array_merge($data, array('product_category' => productCategories($product_id)));
				
				// Tiến hành copy (thêm mới bản ghi với nội dung giống bản ghi gốc)
				productAdd($data);
		}

			return true;
}	// end function
	
/**
 * Xóa sản phẩm dựa trên mã
 * 
 * @return product_id if successfully deleted
 * @return false if failed to delete
 */
function productDelete($product_id)
{
	// Đếm xem có bao nhiêu đơn hàng đặt sản phẩm này
	$count = (int)db_one("SELECT COUNT(product_id) FROM `order_details` WHERE `product_id`='{$product_id}'");
	$_SESSION['ERROR_TEXT'] = null;
	
	// Nếu như có đơn hàng đặt sản phẩm này thì không thể xóa nó đi khỏi
	// bảng `product` được !!!
	if ($count > 0) 
	{
		$_SESSION['ERROR_TEXT'] = "Không thể xóa sản phẩm id={$product_id} vì tồn tại trong đơn hàng!";
		return false;
	}
	
	// Xóa dữ liệu ở các bảng liên quan
	db_q("DELETE FROM `product_image` WHERE `product_id` = '{$product_id}'");
	db_q("DELETE FROM `product_to_category` WHERE `product_id` = '{$product_id}'");
			
	// sau đó xóa bản ghi cần xóa.
	db_q("DELETE FROM `product` WHERE `product_id` = '{$product_id}'");
	
	return $product_id;
} // end function
	
/**
 * @deprecated
 * @param int $product_id
 */
function productGetById($product_id)
{
	return productById($product_id);
}

/**
 * @param int $product_id Mã sản phẩm
 * @return array Mảng kết hợp chứa dữ liệu sản phẩm lấy ra từ bảng `product`
 * @abstract Lấy ra thông tin một sản phẩm dựa trên mã
 */
function productById($product_id)
{
		$sql = " 
			SELECT DISTINCT *
			FROM `product` AS p 
			WHERE p.product_id = {$product_id}  
		";
		
		$rs = db_row($sql);
		
		if ( is_array($rs) && !empty($rs) ) 
		{
				return $rs;
		}

		return false;
} // end function
	
/**
 * @deprecated
 * @param int $product_id
 */
function productGetCategories($product_id){
	return productCategories($product_id);
}

/**
 * @param $product_id Mã sản phẩm
 * @return array Một mảng đánh chỉ số, mỗi phần tử là một mã loại
 * 
 * @abstract Lấy ra các loại sản phẩm mà sản phẩm này thuộc về
 */
function productCategories($product_id)
{
		$product_category_data = array();
		
		$sql = " 
			SELECT *
			FROM `product_to_category`
			WHERE product_id = {$product_id}
		";

		$rs = db_q($sql);
		if ( is_array($rs) && !empty($rs) ) 
		{
				foreach ($rs as $result) {
					$product_category_data[] = $result['category_id'];
				}
		
				return $product_category_data;
		}

		return false;
} // end function
	
	
/**
 * Lấy ra các ảnh của một sản phẩm
 * @returns an indexed array of associative arrays
 */
function productGetImages($product_id)
{
		$sql = " 
			SELECT *
			FROM `product_image`
			WHERE product_id = {$product_id}
			ORDER BY sort_order ASC
		";
		
		$rs = db_q($sql);
		if ( is_array($rs) && !empty($rs) )
		{
			return $rs;
		}

		return false;
} // end function
	

//function productGetRelatedProducts($product_id)

/**
 * @param $product_id mã sản phẩm
 * @return an associative array
 * @abstract Lấy ra dữ liệu chi tiết(dạng thô) của một sản phẩm (có tính cả các thông tin nằm trong các bảng khác).
 *           Hàm này chạy nhanh hơn hàm productInfo() do nó không phải xử lý ảnh nhiều.
 *           ĐỪNG bắt hàm này phải xử lý ảnh, nếu không nó sẽ gây chậm giống như hàm productInfo().
 *           Xử lý ảnh (thumb, popup, images) là việc của chương trình khách. 
 */

function productDetails($product_id)
{
		$sql = " 
			SELECT DISTINCT *, 
				p.name AS name, 
				p.image, 
				m.name AS manufacturer, 
				p.sort_order 
		    FROM product p
		    LEFT JOIN manufacturer m ON (p.manufacturer_id = m.manufacturer_id) 
			WHERE p.product_id = '$product_id' AND p.status = '1'
		";
		$rs = db_row($sql);

		return $rs;
}// end function

/**
 * @param int $product_id Mã sản phẩm
 * @return array Mảng kết hợp chứa thông tin sản phẩm lấy ra từ các bảng `product`, `manufacturer`
 * @abstract Lấy ra thông tin một sản phẩm dựa trên mã. Chú ý là chỉ nên gọi hàm này ở trang product-info.php
 *           Đừng gọi hàm này khi duyệt một mảng các sản phẩm vì nó sẽ gây chậm hệ thống, do bản 
 *           thân hàm này có rất nhiều đoạn mã xử lý dữ liệu thô bên trong (xử lý ảnh)
 */
function productInfo($product_id)
{
	// Câu truy vấn
	$sql = "
	 SELECT DISTINCT *,
	  p.name AS name,
	  p.image,
	  m.name AS manufacturer,
	  p.sort_order
	 FROM product AS p
	 LEFT JOIN manufacturer m ON (p.manufacturer_id = m.manufacturer_id)
	 WHERE p.product_id = '$product_id' AND p.status = '1'
	";
	
	// Thực thi truy vấn
	$rs = db_row($sql);
	
	// Nếu kết quả truy vấn là mảng không rỗng
	if ( is_array($rs) && !empty($rs) )
	{
		// Ảnh sản phẩm
		if (is_file(DIR_IMAGE . $rs['image'])) // Nếu sản phẩm này có ảnh 
		{
			$image = img_resize($rs['image'], $setting['width'], $setting['height']);
		} 
		else	// Nếu sản phẩm này không có ảnh thì lấy ảnh chờ để thay thế 
		{
			$image = img_resize('placeholder.png', $setting['width'], $setting['height']);
		}
		
		// Hình đại diện sản phẩm trên gallery ảnh sản phẩm (xem /product-info.php)
		if (is_file(DIR_IMAGE . $rs['image']))
		{
			$thumb = img_resize($rs['image'], settings('config_image_thumb_width'), settings('config_image_thumb_height'));
		}
		else
		{
			$thumb = img_resize('placeholder.png', settings('config_image_thumb_width'), settings('config_image_thumb_height'));
		}
		
		// Hình ảnh phóng to (zoom-in) sản phẩm trên gallery ảnh sản phẩm (xem /product-info.php)
		if (is_file(DIR_IMAGE . $rs['image']))
		{
			$popup = img_resize($rs['image'], settings('config_image_popup_width'), settings('config_image_popup_height'));
		}
		else
		{
			$popup = img_resize('placeholder.png', settings('config_image_popup_width'), settings('config_image_popup_height'));
		}
		
		// Các ảnh sản phẩm
		$product_images = array();
		
		$results = productGetImages($product_id);
		
		foreach ($results as $result)
		{
			if (is_file(DIR_IMAGE . $result['image']))
			{
				$product_images[] = array(
						'popup' => img_resize($result['image'], settings('config_image_popup_width'), settings('config_image_popup_height')),
						'thumb' => img_resize($result['image'], settings('config_image_additional_width'), settings('config_image_additional_height'))
				);
			}
			else
			{
				$product_images[] = array(
						'popup' => img_resize('placeholder.png', settings('config_image_popup_width'), settings('config_image_popup_height')),
						'thumb' => img_resize('placeholder.png', settings('config_image_additional_width'), settings('config_image_additional_height'))
				);
			}
		
		
		}
		
		return array(
				'product_id'        => $rs['product_id'],
				'name'              => $rs['name'],
				'description'       => html_entity_decode($rs['description'], ENT_QUOTES, 'UTF-8'),
				'description_short' => utf8_substr(strip_tags(html_entity_decode($rs['description'], ENT_QUOTES, 'UTF-8')), 0, settings('config_product_description_length')) . '..',
				'tag'               => $rs['tag'],
				'model'             => $rs['model'],
				'thumb'		        => $thumb,
				'image'             => $image,
		        'popup'             => $popup,
				'product_images'    => $product_images,
				'href'              => "/product-info.php?product_id={$rs['product_id']}",
				'link'              => "/product-info.php?product_id={$rs['product_id']}",
				'manufacturer_id'   => $rs['manufacturer_id'],
				'manufacturer'      => $rs['manufacturer'],
				'manufacturer_href' => '/manufacturer-info.php?manufacturer_id=' . $rs['manufacturer_id'],
				'price'             => number_format($rs['price'],0,'.',',').' ₫',
				'rating'            => settings('config_review_status') ? $rs['rating'] : false,
				'sort_order'        => $rs['sort_order'],
				'status'            => $rs['status'],
				'availability'      => ((int)$rs['status'] == 1) ? 'Còn hàng' : 'Hết hàng',
				'date_added'        => $rs['date_added'],
				'date_modified'     => $rs['date_modified']
		);
	}
		
	return $rs;
}


/**
 * @param int $product_id Mã sản phẩm
 * @return array Mảng chỉ số. Mỗi phần tử là một mảng kết hợp biểu diễn sản phẩm liên quan.
 * @abstract Lấy ra các sản phẩm liên quan đến sản phẩm này.
 *           ĐỪNG gọi hàm productInfo($product_id) ở đây vì nó sẽ gây chậm !!!
 */
function productsRelated($product_id)
{
	// Khởi tạo danh sách các sản phẩm liên quan
	$relateds = array();
		
	// Lấy ra dữ liệu thô trong db của các sản phẩm liên quan
	$sql = " 
		SELECT * 
		FROM product_related pr 
		LEFT JOIN product p ON (pr.related_id = p.product_id) 
		WHERE pr.product_id = '{$product_id}'
			AND p.status = '1' 
	";
	$rs = db_q($sql);
		
	if ( is_array($rs) && !empty($rs) )
	{
		foreach ($rs as $result) 
		{
			
			if ($result['image'])
			{
				$image = img_resize($result['image'], settings('config_image_related_width'), settings('config_image_related_height'));
			}
			else
			{
				$image = img_resize('placeholder.png', settings('config_image_related_width'), settings('config_image_related_height'));
			}
			
			$relateds[] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, settings('config_product_description_length')) . '..',
					'price'       => number_format($result['price'],0,'.',',').' ₫',
					'href'        => "/product-info.php?product_id={$result['product_id']}"
			);
			
		}

	}

	return $relateds;
} // end getProductRelated($product_id)

/**
 * @param array $data Mảng các tiêu chí
 * @return string
 *
 * @abstract Đếm tổng số sản phẩm dựa theo một tập các tiêu chí nhất định.
 *           Đồng bộ với hàm getProducts()
 *           Ví dụ:
 SELECT COUNT(DISTINCT p.product_id) AS total
 FROM `product` AS p
 WHERE p.name LIKE '%%' AND p.model LIKE '%%' AND p.price LIKE '%%' ;
 *
 */
function productGetTotal($data=array())
{
	$filter_name = "%".db_escape($data['filter_name']) . "%";
	$filter_model = "%".db_escape($data['filter_model']) . "%";
	$filter_price = "%".db_escape($data['filter_price']) . "%";

	$sql = "
	 SELECT COUNT(DISTINCT `product_id`) AS total
	 FROM `product` AS p
	 WHERE `name` LIKE '{$filter_name}'
	  AND `model` LIKE '{$filter_model}'
	  AND `price` LIKE '{$filter_price}'
	";

	if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
		$sql .= " AND `status` = '" . (int)$data['filter_status'] . "'";
	}
	
	// Khi đếm tổng số sản phẩm thì không cần quan tâm đến thứ tự sắp xếp

	$rs = db_one($sql);
	if ( !is_null($rs) )
	{
		return $rs;
	}

	return false;
} // end productGetTotal()

/**
 * Lấy ra tất cả các sản phẩm dựa trên một tập các tiêu chí nhất định,
 * đồng bộ với hàm: getTotalProducts()
 *
 * Ví dụ:
 SELECT * FROM `product`
 WHERE `name` LIKE '%%'
 AND `model` LIKE '%%' AND `price` LIKE '%%'
 ORDER BY `name` ASC
 LIMIT 0,20;

 * @param array $data Mảng các tiêu chí truy vấn sản phẩm
 * @return an indexed array of associative arrays

 */
function productGetAll($data = array())
{
	$filter_name = "%".db_escape($data['filter_name']) . "%";
	$filter_model = "%".db_escape($data['filter_model']) . "%";
	$filter_price = "%".db_escape($data['filter_price']) . "%";

	$sql = "
	SELECT *
	FROM `product` AS p
	WHERE `name` LIKE '{$filter_name}'
	 AND `model` LIKE '{$filter_model}'
	 AND `price` LIKE '{$filter_price}'
	";

	if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
		$sql .= " AND `status` = '" . (int)$data['filter_status'] . "'";
	}

	//$sql .= " GROUP BY p.product_id";

	$sort_data = array(
			'p.product_id',
			'p.name',
			'p.model',
			'p.price',
			'p.status',
			'p.sort_order'
	);

	if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
		$sql .= " ORDER BY " . $data['sort'];
	} else {
		$sql .= " ORDER BY `name`";
	}

	if (isset($data['order']) && ($data['order'] == 'DESC')) {
		$sql .= " DESC";
	} else {
		$sql .= " ASC";
	}

	// Nhúng thông tin phân trang vào trong $sql
	if (isset($data['start']) || isset($data['limit'])) {
		if ($data['start'] < 0) {
			$data['start'] = 0;
		}

		if ($data['limit'] < 1) {
			$data['limit'] = settings('config_limit_admin');
		}

		$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
	}

	$rs = db_q($sql);
	if ( is_array($rs) && !empty($rs) )
	{
		return $rs;
	}

	return false;

} // end function

/**
 * Đếm tổng số sản phẩm dựa theo tiêu chí tìm kiếm.
 * 
 * @todo Đồng nhất hàm này với hàm productGetAllForSearch()
 */
function productGetTotalForSearch($data = array())
{
	$sql = " 
		SELECT COUNT(DISTINCT p.product_id) AS total
		FROM `product` p
		WHERE p.status = '1'
	";
			
			
	if (!empty($data['filter_name']) || !empty($data['filter_tag'])) 
	{
		$sql .= " AND (";
	
		if (!empty($data['filter_name'])) 
		{
					$implode = array();
					
					// Bẻ nhỏ các từ khóa trong chuỗi kí tự tìm kiếm
					$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));
					
					// so sánh mỗi từ đó với tên sản phẩm
					foreach ($words as $word) {
						$implode[] = "p.name LIKE '%" . db_escape($word) . "%'";
					}
	
					if ($implode) {
						$sql .= " " . implode(" AND ", $implode) . "";
					}
					
					// Nếu như tìm kiếm cả trong phần mô tả sản phẩm
// 					if (!empty($data['filter_description'])) {
// 						$sql .= " OR p.description LIKE '%" . db_escape($data['filter_name']) . "%'";
// 					}
					
					$sql .= " OR ";
					
					// Nâng cấp tìm trong cả mô tả sản phẩm: bẻ nhỏ từ khóa tìm kiếm
					$implode_desc = array();
					foreach ($words as $word) 
					{
						$implode[] = "p.description LIKE '%" . db_escape($word) . "%'";
					}
					
					if ($implode_desc) 
					{
						$sql .= " " . implode(" AND ", $implode_desc) . "";
					}
					
		}
	
		if (!empty($data['filter_name']) && !empty($data['filter_tag'])) 
		{
					$sql .= " OR ";
		}
	
		if (!empty($data['filter_tag'])) 
		{
					$sql .= "p.tag LIKE '%" . db_escape(utf8_strtolower($data['filter_tag'])) . "%'";
		}
	
		if (!empty($data['filter_name'])) 
		{
					$sql .= " OR LCASE(p.model) = '" . db_escape(utf8_strtolower($data['filter_name'])) . "'";
		}
	
		$sql .= ")";
	}
			
	$rs = db_one($sql);
	
	return $rs;
}	

/**
 * Lấy ra tất cả các sản phẩm phù hợp với tiêu chí tìm kiếm.
 * Phải tìm kiếm sao cho ngay cả khi người dùng gõ nhiều từ khóa vào Search Box thì vẫn ra.
 * Thuật toán: bẻ vụn từ khóa tìm kiếm ra thành nhiều từ rồi lần lượt so sánh nó với `name`, `description`, `model`
 * Tìm theo tên, mô tả, tag (từ khóa)
 * 
 * Đồng nhất hàm này với hàm productGetTotalForSearch()
ví dụ: search: mobile new
SELECT * 
FROM `product` p 
WHERE p.status = '1' AND ( 
      p.name LIKE '%mobile%' AND 
      p.name LIKE '%new%' OR 
      p.description LIKE '%mobile%' AND 
      p.description LIKE '%new%' OR 
      p.tag LIKE '%mobile new%' OR 
      LCASE(p.model) = 'mobile new') 
ORDER BY p.sort_order ASC, LCASE(p.name) 
ASC LIMIT 0,15﻿
 */
function productGetAllForSearch($data = array())
{
	$sql = " 
		SELECT *
		FROM `product` p
		WHERE p.status = '1' 
	";
			
			
	if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
		$sql .= " AND (";
	
		if (!empty($data['filter_name'])) {
					$implode = array();
					
					// Bẻ nhỏ các từ khóa trong chuỗi kí tự tìm kiếm
					$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));
					
					// so sánh mỗi từ đó với tên sản phẩm
					foreach ($words as $word) {
						$implode[] = "p.name LIKE '%" . db_escape($word) . "%'";
					}
	
					if ($implode) {
						$sql .= " " . implode(" AND ", $implode) . "";
					}
					
					// Nếu như tìm kiếm cả trong phần mô tả sản phẩm
					if (!empty($data['filter_description'])) 
					{
						// $sql .= " OR p.description LIKE '%" . db_escape($data['filter_name']) . "%'"; // cách làm cũ
						
						$sql .= " OR ";
						// Nâng cấp tìm trong cả mô tả sản phẩm: bẻ nhỏ từ khóa tìm kiếm
						$implode_desc = array();
						foreach ($words as $word)
						{
							$implode_desc[] = "p.description LIKE '%" . db_escape($word) . "%'";
						}
						
						if ($implode_desc)
						{
							$sql .= " " . implode(" AND ", $implode_desc) . "";
						}
					}

		}
	
		if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
					$sql .= " OR ";
		}
	
		if (!empty($data['filter_tag'])) {
					$sql .= "p.tag LIKE '%" . db_escape(utf8_strtolower($data['filter_tag'])) . "%'";
		}
	
		if (!empty($data['filter_name'])) {
					$sql .= " OR LCASE(p.model) = '" . db_escape(utf8_strtolower($data['filter_name'])) . "'";
		}
	
		$sql .= ")";
	}
	
	// Trật tự sắp xếp
	$sort_data = array(
			'p.name',
			'p.model',
			'p.price',
			'p.sort_order',
			'p.date_added'
	);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'p.name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} elseif ($data['sort'] == 'p.price') {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY p.sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(p.name) DESC";
		} else {
			$sql .= " ASC, LCASE(p.name) ASC";
		}
	
	// Phân trang
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
			//echo $sql; // testing only !!!
	$rs = db_q($sql);
	
	return $rs;
}	

/**
 * Đếm tất cả các sản phẩm thuộc về cùng một nhà sản xuất.
 * @param array $data
 */
function productGetTotalForManufacturer($data = array())
{
	$sql = " 
		SELECT COUNT(DISTINCT p.product_id) AS total
		FROM `product` p
		WHERE p.status = '1' 
		
	";
			
	if (!empty($data['filter_manufacturer_id'])) 
	{
		$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
	}
	
	$rs = db_one($sql);
	
	return $rs;
}

/**
 * Lấy ra tất cả các sản phẩm thuộc về cùng một nhà sản xuất.
 * @param array $data
 * @return array();
 */
function productGetAllForManufacturer($data = array())
{
	$sql = " 
		SELECT *
		FROM `product` p
		WHERE p.status = '1' 
	";
	
	if (!empty($data['filter_manufacturer_id'])) 
	{
		$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
	}

    // Nếu phía giao diện yêu cầu lọc sản phẩm theo khoảng giá
    if (!empty($data['price_min']) && !empty($data['price_max'])) 
	{
		$sql .= " AND p.price BETWEEN " . (int)$data['price_min'] . " AND ".(int)$data['price_max'];
	}
			
	// Trật tự sắp xếp
	$sort_data = array(
			'p.name',
			'p.model',
			'p.price',
			'p.sort_order',
			'p.date_added'
	);

	if (isset($data['sort']) && in_array($data['sort'], $sort_data)) 
	{
			if ($data['sort'] == 'p.name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} elseif ($data['sort'] == 'p.price') {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
	} else {
			$sql .= " ORDER BY p.sort_order";
	}

	if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(p.name) DESC";
	} else {
			$sql .= " ASC, LCASE(p.name) ASC";
	}
	
	// Phân trang
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
			
	$rs = db_q($sql);
	
	return $rs;
}	

/**
 @description Tính tổng số sản phẩm thuộc về loại sản phẩm này
 
 @param $category_id int Id loại sản phẩm
 @return int tổng số sản phẩm
 */
function productGetTotalForCategory($category_id)
{
	$sql = " 
		SELECT COUNT(DISTINCT p.product_id) AS total
		FROM `product_to_category` AS p2c
		LEFT JOIN `product` AS p ON (p2c.product_id = p.product_id)
		WHERE p.status = '1' 
				AND p2c.category_id = '{$category_id}'
    ";
			
	return (int)db_one($sql);
	
}

/**
 @description Lấy ra toàn bộ các bản ghi sản phẩm (có phân trang) của loại sản phẩm truyền vào
 @return array Mảng chỉ số, mỗi phần tử là mảng kết hợp biểu diễn một bản ghi sản phẩm
 $filter_data = array(
				'filter_category_id' => $category_id,
				'filter_filter'      => $filter,
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);
 */
function productGetAllForCategory($data = array()) 
{
	$category_id = (int)$data['filter_category_id'];
	$sql = " 
		SELECT *
		FROM `product_to_category` AS p2c
		LEFT JOIN `product` AS p ON (p2c.product_id = p.product_id)
		WHERE p.status = '1' 
			AND p2c.category_id = '{$category_id}'
		GROUP BY p.product_id
	";

	$sort_data = array(
		'p.name',
		'p.model',
		'p.price',
		'p.sort_order',
		'p.date_added'
	);
	
	// Sắp xếp theo cột nào ?
	if (isset($data['sort']) && in_array($data['sort'], $sort_data)) 
	{
			if ($data['sort'] == 'p.name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} elseif ($data['sort'] == 'p.price') {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
	} else {
			$sql .= " ORDER BY p.sort_order";
	}

	// Sắp xếp tăng hay giảm ?
	if (isset($data['order']) && ($data['order'] == 'DESC')) 
	{
			$sql .= " DESC, LCASE(p.name) DESC";
	} else {
			$sql .= " ASC, LCASE(p.name) ASC";
	}
	
	// Phân trang
	if (isset($data['start']) || isset($data['limit'])) 
	{
		if ($data['start'] < 0) 
		{
			$data['start'] = 0;
		}

		if ($data['limit'] < 1) 
		{
			$data['limit'] = 20;
		}

		$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
	}
	
	return db_q($sql);
}


/**
 * 
 * @return array Mảng chỉ số. Mỗi phần tử là một mảng kết hợp biểu diễn sản phẩm nổi bật.
 * @abstract Lấy ra danh sách các sản phẩm nổi bật. Danh sách này được ấn định một cách
 			tùy ý từ màn hình quản trị.
 			ĐỪNG dùng hàm productInfo() ở đây vì nó sẽ gây chậm, do hàm này có nhiều
 			tác vụ con bên trong. hàm productDetails() chạy nhanh hơn.
 */
function productFeatureds()
{
	
	$sql = "
		SELECT DISTINCT *,
		 p.name AS name,
		 p.image,
         p.sort_order,
		 m.name AS manufacturer
		FROM product p
		LEFT JOIN manufacturer m ON (p.manufacturer_id = m.manufacturer_id)
		WHERE p.status = '1' AND p.featured = '1'
	";
	
	// Lấy ra danh sách các sản phẩm nổi bật
	// và giới hạn số lượng hiển thị trên html.
	$rs = db_q($sql);

	$featuredProducts = array();

	foreach ($rs as $product) 
	{
			
				//if ($product_info) {
					if (is_file(DIR_IMAGE . $product['image'])) {
						$image = img_resize($product['image'], 200, 200);
					} else {
						$image = img_resize('placeholder.png', 200, 200);
					}
	
					$price = number_format($product['price'],0,'.',',').' ₫';
	
	
					if (settings('config_review_status')) {
						$rating = $product['rating'];
					} else {
						$rating = false;
					}
	
					$featuredProducts[] = array(
						'product_id'  => $product['product_id'],
						'thumb'       => $image,
						'name'        => $product['name'],
						'description' => utf8_substr(strip_tags(html_entity_decode($product['description'], ENT_QUOTES, 'UTF-8')), 0, settings('config_product_description_length')) . '..',
						'price'       => $price,
						'href'        => "/product-info.php?product_id=" . $product['product_id'],
						'href_man'    => '/manufacturer-info.php?manufacturer_id=' . $product['manufacturer_id'],
						'manufacturer_href'    => '/manufacturer-info.php?manufacturer_id=' . $product['manufacturer_id'],
						'manufacturer' => $product['manufacturer'],
						'manufacturer_id' => $product['manufacturer_id'],
						'model' => $product['model']
					);
				//}
	}
	$featuredProducts = array_slice($featuredProducts, 0, settings('products_featured_limit'));
	
	return $featuredProducts;
}// end function


/**
 *
 * @return array Mảng chỉ số. Mỗi phần tử là một mảng kết hợp biểu diễn sản phẩm bán chạy.
 * @abstract Lấy ra danh sách các sản phẩm nổi bật. Danh sách này được ấn định một cách
 tùy ý từ màn hình quản trị.
 ĐỪNG dùng hàm productInfo() ở đây vì nó sẽ gây chậm, do hàm này có nhiều
 tác vụ con bên trong. hàm productDetails() chạy nhanh hơn.
 */
function productBestSellers()
{
    
    $sql = "
		SELECT DISTINCT *,
		 p.name AS name,
		 p.image,
         p.sort_order,
		 m.name AS manufacturer
		FROM product p
		LEFT JOIN manufacturer m ON (p.manufacturer_id = m.manufacturer_id)
		WHERE p.status = '1' AND p.best_seller = '1'
	";
    
    // Lấy ra danh sách các sản phẩm bán chạy
    // và giới hạn số lượng hiển thị trên html.
    $rs = db_q($sql);
    
    $bestSellerProducts = array();
    
    foreach ($rs as $product)
    {
        
        //if ($product_info) {
        if (is_file(DIR_IMAGE . $product['image'])) {
            $image = img_resize($product['image'], 200, 200);
        } else {
            $image = img_resize('placeholder.png', 200, 200);
        }
        
        $price = number_format($product['price'],0,'.',',').' ₫';
        
        
        if (settings('config_review_status')) {
            $rating = $product['rating'];
        } else {
            $rating = false;
        }
        
        $bestSellerProducts[] = array(
            'product_id'  => $product['product_id'],
            'thumb'       => $image,
            'name'        => $product['name'],
            'description' => utf8_substr(strip_tags(html_entity_decode($product['description'], ENT_QUOTES, 'UTF-8')), 0, settings('config_product_description_length')) . '..',
            'price'       => $price,
            'href'        => "/product-info.php?product_id=" . $product['product_id'],
            'href_man'    => '/manufacturer-info.php?manufacturer_id=' . $product['manufacturer_id'],
            'manufacturer_href'    => '/manufacturer-info.php?manufacturer_id=' . $product['manufacturer_id'],
            'manufacturer' => $product['manufacturer'],
            'manufacturer_id' => $product['manufacturer_id'],
            'model' => $product['model']
        );
        //}
    }
    $bestSellerProducts = array_slice($bestSellerProducts, 0, settings('products_best_seller_limit'));
    
    return $bestSellerProducts;
}// end function


/*
 Lấy ra danh sách các đường dẫn ảnh của một sản phẩm
 @return indexed array
 */
function productImages($product_id)
{
	// Nhặt ra các bản ghi trong bảng
	$temp = db_q("SELECT `image` FROM `product_image` WHERE `product_id`='{$product_id}'");
	
	// sau đó copy các đường dẫn ảnh vào trong một mảng:
	$images = array();
	
	if(is_array($temp) && !empty($temp))
	{
		foreach($temp as $img)
		{
			$images[] = $img['image'];
		}
	}
	
	return $images;
		
	
}// end function