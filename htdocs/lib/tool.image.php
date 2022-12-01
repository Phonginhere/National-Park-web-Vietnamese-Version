<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Các hàm xử lý ảnh
 */

include_once 'thirdparty/opencart/image.php';

/*
 Giảm kích thước hình học của ảnh và trả về đường dẫn mới của nó.
 Các ảnh hiển thị (sản phẩm, banner) được cấu hình độ rộng và chiều cao trong bảng settings.
 Nếu kích thước cấu hình khác so với kích thước gốc, thì ảnh gốc sẽ được sao chép một bản
 mới đặt trong thư mục ~/images/cache
 
 @return string Relative url of the image
 */
function img_resize($filename, $width, $height) 
{ 
		if (!is_file(DIR_IMAGE . $filename)) {
			return;
		}

		$extension = pathinfo($filename, PATHINFO_EXTENSION);

		$old_image = $filename;
		$new_image = 'cache/' . utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . $width . 'x' . $height . '.' . $extension;

		if (!is_file(DIR_IMAGE . $new_image) || (filectime(DIR_IMAGE . $old_image) > filectime(DIR_IMAGE . $new_image))) {
			$path = '';

			$directories = explode('/', dirname(str_replace('../', '', $new_image)));

			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;

				if (!is_dir(DIR_IMAGE . $path)) {
					@mkdir(DIR_IMAGE . $path, 0777);
				}
			}

			list($width_orig, $height_orig) = getimagesize(DIR_IMAGE . $old_image);

			if ($width_orig != $width || $height_orig != $height) {
				$image = new Image(DIR_IMAGE . $old_image);
				$image->resize($width, $height);
				$image->save(DIR_IMAGE . $new_image);
			} else {
				copy(DIR_IMAGE . $old_image, DIR_IMAGE . $new_image);
			}
		}

		return URL_IMAGE . $new_image;
}
