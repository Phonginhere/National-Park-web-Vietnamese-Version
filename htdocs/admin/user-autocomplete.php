<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang gửi dữ liệu json của nhân viên cho truy vấn ajax
 */
include_once '../configs.php';
include_once '../lib/table/table.user.php';

$json = array();

	$filter_name = isset($_REQUEST['filter_name']) ? $_REQUEST['filter_name'] : '';
	$filter_data = array(
		'filter_name' => $filter_name,
		'sort'        => 'name',
		'order'       => 'ASC',
		'start'       => 0,
		'limit'       => 10
	);
	
	$results = userGetAll($filter_data);
	
	// Làm cho dữ liệu json hợp lệ để có thể phân tích được
	// (parsable !)
	foreach ($results as $result) {
		$json[] = array(
			'user_id' => $result['user_id'],
			'fullname'        => strip_tags(html_entity_decode($result['fullname'], ENT_QUOTES, 'UTF-8'))
		);
	}

$sort_order = array();

foreach ($json as $key => $value) {
	$sort_order[$key] = $value['fullname'];
}

array_multisort($sort_order, SORT_ASC, $json);

/*
 * Be careful with script called before this autocomplete.php,
 * if you put echo '<br>' somewhere, then the url:
 	http://localhost:82/admin/user-autocomplete.php?filter_name=c
 flushes to browser:
 	<br>[{"user_id":"33","name":"Cameras"},{"user_id":"25","name":"Components"}]
 causing parse error of json.
 */
header("Content-Type: application/json;charset=UTF-8");
echo json_encode($json);