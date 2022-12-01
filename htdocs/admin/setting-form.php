<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Form thông tin cài đặt hệ thống
 */
// Cấu hình hệ thống
include_once '../configs.php';
// Thư viện hàm
include_once '../lib/tool.image.php';

$url_action = "/admin/setting-edit.php";
$url_cancel = "/admin/setting-edit.php";	// @todo does not sound okay, right ?

/*			START-THONG TIN CHUNG          */
if (isset($_POST['config_name'])) {
	$config_name = $_POST['config_name'];
} else {
	$config_name = settings('config_name');
}

if (isset($_POST['config_owner'])) {
	$config_owner = $_POST['config_owner'];
} else {
	$config_owner = settings('config_owner');
}

if (isset($_POST['config_address'])) {
	$config_address = $_POST['config_address'];
} else {
	$config_address = settings('config_address');
}

if (isset($_POST['html_google_map_embed'])) {
	$html_google_map_embed = $_POST['html_google_map_embed'];
} else {
	$html_google_map_embed = settings('html_google_map_embed');
}

if (isset($_POST['config_email'])) {
	$config_email = $_POST['config_email'];
} else {
	$config_email = settings('config_email');
}

if (isset($_POST['config_telephone'])) {
	$config_telephone = $_POST['config_telephone'];
} else {
	$config_telephone = settings('config_telephone');
}

if (isset($_POST['config_image'])) {
	$config_image = $_POST['config_image'];
} else {
	$config_image = settings('config_image');
}

if (isset($_POST['config_image']) && is_file(DIR_IMAGE . $_POST['config_image'])) {
     $thumb = img_resize($_POST['config_image'], 100, 100);
} elseif (settings('config_image') && is_file(DIR_IMAGE . settings('config_image'))) {
     $thumb = img_resize(settings('config_image'), 100, 100);
} else {
     $thumb = img_resize('no_image.png', 100, 100);
}

$placeholder = img_resize('no_image.png', 100, 100);

if (isset($_POST['config_open'])) {
	$config_open = $_POST['config_open'];
} else {
	$config_open = settings('config_open');
}

if (isset($_POST['config_comment'])) {
	$config_comment = $_POST['config_comment'];
} else {
	$config_comment = settings('config_comment');
}

/*			START-THÔNG TIN CỬA HÀNG          */
//$locations = $location->getLocations();
//
//if (isset($_POST['config_location'])) {
//     $config_location = $_POST['config_location'];
//} elseif (settings('config_location')) {
//     $config_location = settings('config_location');
//} else {
//     $config_location = array();
//}

if (isset($_POST['config_url'])) {
	$config_url = $_POST['config_url'];
} else {
	$config_url = settings('config_url');
}

if (isset($_POST['config_meta_title'])) {
	$config_meta_title = $_POST['config_meta_title'];
} else {
	$config_meta_title = settings('config_meta_title');
}

if (isset($_POST['config_meta_description'])) {
	$config_meta_description = $_POST['config_meta_description'];
} else {
	$config_meta_description = settings('config_meta_description');
}

if (isset($_POST['config_meta_keyword'])) {
	$config_meta_keyword = $_POST['config_meta_keyword'];
} else {
	$config_meta_keyword = settings('config_meta_keyword');
}

//if (isset($_POST['config_layout_id'])) {
//	$config_layout_id = $_POST['config_layout_id'];
//} else {
//	$config_layout_id = settings('config_layout_id');
//}
//
//$layouts = $layout->getLayouts();

if (isset($_POST['config_template'])) {
	$config_template = $_POST['config_template'];
} else {
	$config_template = settings('config_template');
}

$templates = array();

$directories = glob(PATH_TEMPLATES . SKIN . '/catalog/view/theme/*', GLOB_ONLYDIR);
foreach ($directories as $directory) {
	$templates[] = basename($directory);
}

/*			START-THONG TIN TÙY CHỌN          */

if (isset($_POST['config_product_limit'])) {
	$config_product_limit = $_POST['config_product_limit'];
} else {
	$config_product_limit = settings('config_product_limit');
}

// Giới hạn số sản phẩm nổi bật
if (isset($_POST['products_featured_limit'])) {
	$products_featured_limit = $_POST['products_featured_limit'];
} else {
	$products_featured_limit = settings('products_featured_limit');
}

// Giới hạn số sản phẩm bán chạy
if (isset($_POST['products_best_seller_limit'])) {
	$products_best_seller_limit = $_POST['products_best_seller_limit'];
} else {
	$products_best_seller_limit = settings('products_best_seller_limit');
}

if (isset($_POST['config_product_description_length'])) {
	$config_product_description_length = $_POST['config_product_description_length'];
} else {
	$config_product_description_length = settings('config_product_description_length');
}

if (isset($_POST['config_limit_admin'])) {
	$config_limit_admin = $_POST['config_limit_admin'];
} else {
	$config_limit_admin = settings('config_limit_admin');
}

if (isset($_POST['config_product_count'])) {
	$config_product_count = $_POST['config_product_count'];
} else {
	$config_product_count = settings('config_product_count');
}

if (isset($_POST['config_review_status'])) {
	$config_review_status = $_POST['config_review_status'];
} else {
	$config_review_status = settings('config_review_status');
}

if (isset($_POST['config_review_guest'])) {
	$config_review_guest = $_POST['config_review_guest'];
} else {
	$config_review_guest = settings('config_review_guest');
}

if (isset($_POST['config_review_mail'])) {
	$config_review_mail = $_POST['config_review_mail'];
} else {
	$config_review_mail = settings('config_review_mail');
}

if (isset($_POST['config_voucher_min'])) {
	$config_voucher_min = $_POST['config_voucher_min'];
} else {
	$config_voucher_min = settings('config_voucher_min');
}

if (isset($_POST['config_voucher_max'])) {
	$config_voucher_max = $_POST['config_voucher_max'];
} else {
	$config_voucher_max = settings('config_voucher_max');
}

if (isset($_POST['config_checkout_guest'])) {
	$config_checkout_guest = $_POST['config_checkout_guest'];
} else {
	$config_checkout_guest = settings('config_checkout_guest');
}

if (isset($_POST['config_checkout_id'])) {
	$config_checkout_id = $_POST['config_checkout_id'];
} else {
	$config_checkout_id = settings('config_checkout_id');
}

if (isset($_POST['config_invoice_prefix'])) {
     $config_invoice_prefix = $_POST['config_invoice_prefix'];
} elseif (settings('config_invoice_prefix')) {
     $config_invoice_prefix = settings('config_invoice_prefix');
} else {
     $config_invoice_prefix = 'INV-' . date('Y') . '-00';
}


if (isset($_POST['config_processing_status'])) {
     $config_processing_status = $_POST['config_processing_status'];
} elseif (settings('config_processing_status')) {
     $config_processing_status = settings('config_processing_status');
} else {
     $config_processing_status = array();
}

if (isset($_POST['config_complete_status'])) {
     $config_complete_status = $_POST['config_complete_status'];
} elseif (settings('config_complete_status')) {
     $config_complete_status = settings('config_complete_status');
} else {
     $config_complete_status = array();
}

/*		THÔNG TIN ẢNH 				*/
if (isset($_POST['config_logo'])) {
	$config_logo = $_POST['config_logo'];
} else {
	$config_logo = settings('config_logo');
}

if (isset($_POST['config_logo']) && is_file(DIR_IMAGE . $_POST['config_logo'])) {
     $logo = img_resize($_POST['config_logo'], 100, 100);
} elseif (settings('config_logo') && is_file(DIR_IMAGE . settings('config_logo'))) {
     $logo = img_resize(settings('config_logo'), 100, 100);
} else {
     $logo = img_resize('no_image.png', 100, 100);
}

if (isset($_POST['config_icon'])) {
	$config_icon = $_POST['config_icon'];
} else {
	$config_icon = settings('config_icon');
}

if (isset($_POST['config_icon']) && is_file(DIR_IMAGE . $_POST['config_icon'])) {
	$icon = img_resize($_POST['config_logo'], 100, 100);
} elseif (settings('config_icon') && is_file(DIR_IMAGE . settings('config_icon'))) {
	$icon = img_resize(settings('config_icon'), 100, 100);
} else {
	$icon = img_resize('no_image.png', 100, 100);
}

if (isset($_POST['config_image_category_width'])) {
	$config_image_category_width = $_POST['config_image_category_width'];
} else {
	$config_image_category_width = settings('config_image_category_width');
}

if (isset($_POST['config_image_category_height'])) {
	$config_image_category_height = $_POST['config_image_category_height'];
} else {
	$config_image_category_height = settings('config_image_category_height');
}

if (isset($_POST['config_image_thumb_width'])) {
	$config_image_thumb_width = $_POST['config_image_thumb_width'];
} else {
	$config_image_thumb_width = settings('config_image_thumb_width');
}

if (isset($_POST['config_image_thumb_height'])) {
	$config_image_thumb_height = $_POST['config_image_thumb_height'];
} else {
	$config_image_thumb_height = settings('config_image_thumb_height');
}

if (isset($_POST['config_image_popup_width'])) {
	$config_image_popup_width = $_POST['config_image_popup_width'];
} else {
	$config_image_popup_width = settings('config_image_popup_width');
}

if (isset($_POST['config_image_popup_height'])) {
	$config_image_popup_height = $_POST['config_image_popup_height'];
} else {
	$config_image_popup_height = settings('config_image_popup_height');
}

if (isset($_POST['config_image_product_width'])) {
	$config_image_product_width = $_POST['config_image_product_width'];
} else {
	$config_image_product_width = settings('config_image_product_width');
}

if (isset($_POST['config_image_product_height'])) {
	$config_image_product_height = $_POST['config_image_product_height'];
} else {
	$config_image_product_height = settings('config_image_product_height');
}

if (isset($_POST['config_image_additional_width'])) {
	$config_image_additional_width = $_POST['config_image_additional_width'];
} else {
	$config_image_additional_width = settings('config_image_additional_width');
}

if (isset($_POST['config_image_additional_height'])) {
	$config_image_additional_height = $_POST['config_image_additional_height'];
} else {
	$config_image_additional_height = settings('config_image_additional_height');
}

if (isset($_POST['config_image_related_width'])) {
	$config_image_related_width = $_POST['config_image_related_width'];
} else {
	$config_image_related_width = settings('config_image_related_width');
}

if (isset($_POST['config_image_related_height'])) {
	$config_image_related_height = $_POST['config_image_related_height'];
} else {
	$config_image_related_height = settings('config_image_related_height');
}

if (isset($_POST['config_image_cart_width'])) {
	$config_image_cart_width = $_POST['config_image_cart_width'];
} else {
	$config_image_cart_width = settings('config_image_cart_width');
}

if (isset($_POST['config_image_cart_height'])) {
	$config_image_cart_height = $_POST['config_image_cart_height'];
} else {
	$config_image_cart_height = settings('config_image_cart_height');
}

if (isset($_POST['config_image_location_width'])) {
	$config_image_location_width = $_POST['config_image_location_width'];
} else {
	$config_image_location_width = settings('config_image_location_width');
}
if (isset($_POST['config_image_location_height'])) {
	$config_image_location_height = $_POST['config_image_location_height'];
} else {
	$config_image_location_height = settings('config_image_location_height');
}


// Nội dung riêng của trang:
$web_content = $_SERVER["DOCUMENT_ROOT"]."/ui/admin/view/view-setting-form.php";

check_file_layout($web_layout_admin, $web_content);

// được đặt vào bố cục chung của toàn site:
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;
