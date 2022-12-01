<?php 
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang 'Lời Chứng Thực'
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.testimonial.php';

$filter = isset($_REQUEST['filter']) ? $_REQUEST['filter'] : '';
$sort   = isset($_REQUEST['sort'])   ? $_REQUEST['sort']   : 'name';
$order  = isset($_REQUEST['order'])  ? $_REQUEST['order']  : 'ASC';
$page   = isset($_REQUEST['page'])   ? $_REQUEST['page']   : 1;
$limit  = isset($_REQUEST['limit'])  ? $_REQUEST['limit']  : settings('config_product_limit');

$filter_data = array(
	'filter_filter'      => $filter,
	'sort'               => $sort,
	'order'              => $order,
	'start'              => ($page - 1) * $limit,
	'limit'              => $limit
);

$testimonials = array();
$testimonial_total = testimonialGetTotal($filter_data);
$results = testimonialGetAll($filter_data);

foreach ($results as $result) 
{
	if (is_file(DIR_IMAGE . $result['image'])) 
	{
		$image = img_resize($result['image'], settings('config_image_product_width'), settings('config_image_product_height'));
	} 
	else 
	{
		$image = img_resize('placeholder.png', settings('config_image_product_width'), settings('config_image_product_height'));
	}


	$testimonials[] = array(
		'testimonial_id'  => $result['testimonial_id'],
		'thumb'       => $image,
		'name'        => $result['name'],
        'job'        => $result['job'],
        'title'        => $result['title'],
        'content' => $result['content']
		//'conent' => utf8_substr(strip_tags(html_entity_decode($result['content'], ENT_QUOTES, 'UTF-8')), 0, settings('config_product_description_length')) . '..',
		//'href'        => '/testimonial-info.php?id=' . $result['testimonial_id'] . $url  
	);
}

// Nội dung riêng của trang...
$web_title = "Lời Chứng Thực";
$web_content = "view/view-testimonial.php";
// ...được đặt vào bố cục chung của toàn site.
include_once $web_layout;

