<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang gửi dữ liệu json sản phẩm cho truy vấn ajax
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.product.php';

$json = array();

if (isset($_GET['filter_name']) || isset($_GET['filter_model'])) 
{ 
			
	if (isset($_GET['filter_name'])) 
	{
		$filter_name = $_GET['filter_name'];
	} 
	else 
	{
		$filter_name = '';
	}

	if (isset($_GET['filter_model'])) 
	{
		$filter_model = $_GET['filter_model'];
	} 
	else 
	{
		$filter_model = '';
	}

	if (isset($_GET['limit'])) 
	{
		$limit = $_GET['limit'];
	} 
	else 
	{
		$limit = 5;
	}

	$filter_data = array(
		'filter_name'  => $filter_name,
		'filter_model' => $filter_model,
		'start'        => 0,
		'limit'        => $limit
	);
			
	$results = productGetAll($filter_data);

	foreach ($results as $result) 
	{
		$json[] = array(
			'product_id' => $result['product_id'],
			'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
			'model'      => $result['model'],
			'price'      => $result['price']
		);
	}
}

header("Content-Type: application/json;charset=UTF-8");
echo json_encode($json);
