<?php
/**
 * Copyright A1908G1-Phong-CMinh-Nhi
 *
 * Các hàm quản lý cài đặt hệ thống
 */

function settingEdit($data)
{
	foreach ($data as $key => $value)
	{
		
		$k = db_escape($key);
		$v = db_escape($value);
					
		$sql = "UPDATE `setting` SET `value` = '{$v}' WHERE `key` = '{$k}'";
		
		db_q($sql);
				
	}
			
}	// end editSetting($code, $data, $store_id = 0)($data)
