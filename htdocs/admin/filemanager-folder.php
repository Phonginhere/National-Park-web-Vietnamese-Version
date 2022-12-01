<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang quản lý folder
 */
// cấu hình hệ thống
include_once '../configs.php';


		$json = array();

		// @todo Check user has permission
//		if (!$this->user->hasPermission('modify', 'common/filemanager')) {
//			$json['error'] = tr('error_permission');
//		}

		// Make sure we have the correct directory
		if (isset($_GET['directory'])) {
			$directory = rtrim(DIR_IMAGE . 'catalog/' . str_replace(array('../', '..\\', '..'), '', $_GET['directory']), '/');
		} else {
			$directory = DIR_IMAGE . 'catalog';
		}

		// Check its a directory
		if (!is_dir($directory)) {
			$json['error'] = 'Thư mục đã tồn tại';
		}

		if (!$json) {
			// Sanitize the folder name
			$folder = str_replace(array('../', '..\\', '..'), '', basename(html_entity_decode($_POST['folder'], ENT_QUOTES, 'UTF-8')));

			// Validate the filename length
			if ((utf8_strlen($folder) < 2) || (utf8_strlen($folder) > 255)) {
				$json['error'] = 'Cảnh báo: tên folder phải nằm giữa từ 2 đến 255!';
			}

			// Check if directory already exists or not
			if (is_dir($directory . '/' . $folder)) {
				$json['error'] = 'File hoặc thư mục đã tồn tại rồi';
			}
		}

		if (!$json) {
			mkdir($directory . '/' . $folder, 0777);

			$json['success'] = 'Đã tạo thư mục thành công';
		}

		header("Content-Type: application/json;charset=UTF-8");
		echo json_encode($json);
