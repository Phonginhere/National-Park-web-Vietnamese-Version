<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang danh mục các nhà sản xuất
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.manufacturer.php';
include_once 'lib/table/table.product.php';
include_once 'lib/tool.image.php';

$manufacturers = array();

$results = manufacturerGetAll();

foreach ($results as $result) 
{
	if (is_numeric(utf8_substr($result['name'], 0, 1))) 
	{
		$key = '0 - 9';
	} 
	else 
	{
		$key = utf8_substr(utf8_strtoupper($result['name']), 0, 1);
	}

	if (!isset($manufacturers[$key])) 
	{
		$manufacturers[$key]['name'] = $key;
	}

	$manufacturers[$key]['manufacturer'][] = array(
		'name' => $result['name'],
		'href' => '/manufacturer-info.php?manufacturer_id=' . $result['manufacturer_id']
	);
}

// Nội dung riêng của trang...
$web_title = "Thương Hiệu";
$web_content = "view/view-manufacturer-list.php";

// ...được đặt vào bố cục chung của toàn site.
include_once $web_layout;
	