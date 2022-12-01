<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang gửi dữ liệu json bài viết cho truy vấn ajax
 * (học từ product)
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.post.php';

$json = array();

//if (isset($_GET['filter_title']) || isset($_GET['filter_model']))
if ( isset($_GET['filter_title']) )
{ 
			
	if (isset($_GET['filter_title'])) 
	{
		$filter_title = $_GET['filter_title'];
	} 
	else 
	{
		$filter_title = '';
	}

    //if (isset($_GET['filter_model']))  {
    //    $filter_model = $_GET['filter_model'];
    //} else {
    //    $filter_model = '';
    //}

	if (isset($_GET['limit'])) 
	{
		$limit = $_GET['limit'];
	} 
	else 
	{
		$limit = settings('config_limit_admin');
	}

	$filter_data = array(
		'filter_title'  => $filter_title,
		'filter_model' => $filter_model,
		'start'        => 0,
		'limit'        => $limit
	);
			
	$results = postGetAll($filter_data);

	foreach ($results as $result) 
	{
		$json[] = array(
			'post_id' => $result['post_id'],
			'title'       => strip_tags(html_entity_decode($result['title'], ENT_QUOTES, 'UTF-8'))
		);
	}
}

header("Content-Type: application/json;charset=UTF-8");
echo json_encode($json);
