<?php
namespace U0mo5\Tools;
class Arrays {
	
	/**
	 * 获取数组中的某一列
	 *
	 * @param array $array
	 * @param string $field
	 * @return array
	 */
	public static function getCol($array, $field) {
		if (!is_array($array) || count($array) < 1) {
			return array();
		}
		$temp = array();
		foreach ($array as $key => $value) {
			if (array_key_exists($field, $value)) {
				$temp[] = $value[$field];
			}
		}
		return $temp;
	}
	
	/**
	 * 移除一维数组中的空值
	 * @param array $array
	 * @return array
	 */
	public static function removeNull($array){
		if (!is_array($array) || count($array) < 1) {
			return array();
		}
		foreach ($array as $key => $value){
			if($value == ''){
				unset($array[$key]);
			}
		}
		return $array;
	}
}