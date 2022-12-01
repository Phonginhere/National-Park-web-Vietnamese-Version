<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Màn hình theo dõi thông tin chung của hệ thống
 */
include_once '../configs.php';
include_once '../lib/table/table.order.php';

check_login();

// Nội dung riêng của trang...
$web_title = "Quản Trị";
$web_content = $_SERVER["DOCUMENT_ROOT"]."/ui/admin/view/view-dashboard.php";
$active_page_admin = ACTIVE_PAGE_ADMIN_DASHBOARD;

check_file_layout($web_layout_admin, $web_content);

// do something with the file
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;