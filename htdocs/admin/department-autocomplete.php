<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang gửi dữ liệu json của loại sản phẩm cho truy vấn ajax
 */
include_once '../configs.php';
include_once '../lib/table/table.department.php';

$json = array();

	$filter_name = isset($_REQUEST['filter_name']) ? $_REQUEST['filter_name'] : '';
	$filter_data = array(
		'filter_name' => $filter_name,
		'sort'        => 'name',
		'order'       => 'ASC',
		'start'       => 0,
		'limit'       => 10
	);
	
	$results = departmentGetAll($filter_data);
	
	// Làm cho dữ liệu json hợp lệ để có thể phân tích được
	// (parsable !)
	foreach ($results as $result) {
		$json[] = array(
			'department_id' => $result['department_id'],
			'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
		);
	}

$sort_order = array();

foreach ($json as $key => $value) {
	$sort_order[$key] = $value['name'];
}

array_multisort($sort_order, SORT_ASC, $json);

/*
 * Be careful with script called before this autocomplete.php,
 * if you put echo '<br>' somewhere, then the url:
 	http://localhost:82/admin/catalog/department/autocomplete.php?filter_name=c
 flushes to browser:
 	<br>[{"department_id":"33","name":"Cameras"},{"department_id":"25","name":"Components"}]
 causing parse error of json.
 */
header("Content-Type: application/json;charset=UTF-8");
echo json_encode($json);