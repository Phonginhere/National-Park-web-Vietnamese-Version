<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Trang xóa file/folder
 */
// Cấu hình hệ thống
include_once '../configs.php';

		$json = array();

		// @todo Check user has permission
//		if (!$this->user->hasPermission('modify', 'common/filemanager')) {
//			$json['error'] = tr('error_permission');
//		}

		if (isset($_POST['path'])) {
			$paths = $_POST['path'];
		} else {
			$paths = array();
		}

		// Loop through each path to run validations
		foreach ($paths as $path) {
			$path = rtrim(DIR_IMAGE . str_replace(array('../', '..\\', '..'), '', $path), '/');

			// Check path exsists
			if ($path == DIR_IMAGE . 'catalog') {
				$json['error'] = 'Bạn không thể xóa thư mục này';

				break;
			}
		}

		if (!$json) {
			// Loop through each path
			foreach ($paths as $path) {
				$path = rtrim(DIR_IMAGE . str_replace(array('../', '..\\', '..'), '', $path), '/');

				// If path is just a file delete it
				if (is_file($path)) {
					unlink($path);

				// If path is a directory beging deleting each file and sub folder
				} elseif (is_dir($path)) {
					$files = array();

					// Make path into an array
					$path = array($path . '*');

					// While the path array is still populated keep looping through
					while (count($path) != 0) {
						$next = array_shift($path);

						foreach (glob($next) as $file) {
							// If directory add to path array
							if (is_dir($file)) {
								$path[] = $file . '/*';
							}

							// Add the file to the files to be deleted array
							$files[] = $file;
						}
					}

					// Reverse sort the file array
					rsort($files);

					foreach ($files as $file) {
						// If file just delete
						if (is_file($file)) {
							unlink($file);

						// If directory use the remove directory function
						} elseif (is_dir($file)) {
							rmdir($file);
						}
					}
				}
			}

			$json['success'] = 'Đã xóa thành công !';
		}

		header("Content-Type: application/json;charset=UTF-8");
		echo json_encode($json);
