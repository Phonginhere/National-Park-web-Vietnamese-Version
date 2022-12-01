<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang phiếu giao hàng
 */
// Cấu hình hệ thống
include_once '../configs.php';
// Thư viện hàm
include_once '../lib/table/table.order.php';

$order = orderDetailsWithFormat($_GET['order_id']);

include_once "../ui/admin/view/view-order-invoice.php";
