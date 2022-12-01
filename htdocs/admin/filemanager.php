<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang quản lý file
 */
/**
 * Chú ý: giao diện file manager có thư mục gốc là
 * 	DIR_IMAGE . 'catalog';
 * Ví dụ:
 * 	C:\Xampp\htdocs\dws\image\catalog
 * 
 * Được gọi bởi common-admin.js
 */
include_once '../configs.php';
include_once '../lib/tool.image.php';

if (isset($_GET['filter_name'])) {
	$filter_name = rtrim(str_replace(array('../', '..\\', '..', '*'), '', $_GET['filter_name']), '/');
} else {
	$filter_name = null;
}

// Make sure we have the correct directory
if (isset($_GET['directory'])) {
	$directory = rtrim(DIR_IMAGE . 'catalog/' . str_replace(array('../', '..\\', '..'), '', $_GET['directory']), '/');
} else {
	$directory = DIR_IMAGE . 'catalog';
}

if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}

$manager_images = array(); // from $data['images']

// Get directories
$directories = glob($directory . '/' . $filter_name . '*', GLOB_ONLYDIR);

if (!$directories) {
	$directories = array();
}

// Get files
$files = glob($directory . '/' . $filter_name . '*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}', GLOB_BRACE);

if (!$files) {
	$files = array();
}

// Merge directories and files
$images = array_merge($directories, $files);

// Get total number of files and directories
$image_total = count($images);

// Split the array based on current page number and max number of items per page of 10
$images = array_splice($images, ($page - 1) * 16, 16);

foreach ($images as $image) {
			$name = str_split(basename($image), 14);

			if (is_dir($image)) {
				$url = '';

				if (isset($_GET['target'])) {
					$url .= '&target=' . $_GET['target'];
				}

				if (isset($_GET['thumb'])) {
					$url .= '&thumb=' . $_GET['thumb'];
				}

				$manager_images[] = array(
					'thumb' => '',
					'name'  => implode(' ', $name),
					'type'  => 'directory',
					'path'  => utf8_substr($image, utf8_strlen(DIR_IMAGE)),
					'href'  => '/admin/filemanager.php?directory=' . urlencode(utf8_substr($image, utf8_strlen(DIR_IMAGE . 'catalog/'))) . $url
				);
			} elseif (is_file($image)) {
				// bị gọi bởi: common.js > $(document).delegate('button[data-toggle=\'image\']', 'click', function() {
				$manager_images[] = array(
					'thumb' => img_resize(utf8_substr($image, utf8_strlen(DIR_IMAGE)), 100, 100),
					'name'  => implode(' ', $name),
					'type'  => 'image',
					'path'  => utf8_substr($image, utf8_strlen(DIR_IMAGE)),
					'href'  => URL_IMAGE. utf8_substr($image, utf8_strlen(DIR_IMAGE))
				);
			}
}


if (isset($_GET['directory'])) {
	$manager_directory = urlencode($_GET['directory']);
} else {
	$manager_directory = '';
}

if (isset($_GET['filter_name'])) {
	$manager_filter_name = $_GET['filter_name'];
} else {
	$manager_filter_name = '';
}

// Return the target ID for the file manager to set the value
if (isset($_GET['target'])) {
	$manager_target = $_GET['target'];
} else {
	$manager_target = '';
}

// Return the thumbnail for the file manager to show a thumbnail
if (isset($_GET['thumb'])) {
	$manager_thumb = $_GET['thumb'];
} else {
	$manager_thumb = '';
}

// Parent
$url = '?';

if (isset($_GET['directory'])) {
			$pos = strrpos($_GET['directory'], '/');

			if ($pos) {
				$url .= '&directory=' . urlencode(substr($_GET['directory'], 0, $pos));
			}
}

if (isset($_GET['target'])) {
			$url .= '&target=' . $_GET['target'];
}

if (isset($_GET['thumb'])) {
			$url .= '&thumb=' . $_GET['thumb'];
}

$manager_parent = "/admin/filemanager.php" . $url;

// Refresh
$url = '?';

		if (isset($_GET['directory'])) {
			$url .= '&directory=' . urlencode($_GET['directory']);
		}

		if (isset($_GET['target'])) {
			$url .= '&target=' . $_GET['target'];
		}

		if (isset($_GET['thumb'])) {
			$url .= '&thumb=' . $_GET['thumb'];
		}

$manager_refresh = "/admin/filemanager.php" . $url;

// Paging
$url = '/admin/filemanager.php?';

		if (isset($_GET['directory'])) {
			$url .= '&directory=' . urlencode(html_entity_decode($_GET['directory'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($_GET['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($_GET['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($_GET['target'])) {
			$url .= '&target=' . $_GET['target'];
		}

if (isset($_GET['thumb'])) {
			$url .= '&thumb=' . $_GET['thumb'];
}

$limit = 16; //LIMIT_FILE_MANAGER; // @todo: use something like: settings('config_limit_admin')
paginate($image_total, $page,$limit, $url);

include_once $_SERVER["DOCUMENT_ROOT"]."/ui/admin/view/view-filemanager.php";