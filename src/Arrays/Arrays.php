<?php
namespace U0mo5\Tools\Arrays;
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

    /**
     * 功能：两个数组并集
     */
    public static function array_and($array1=array(), $array2=array())
    {
        //$res = array();   //结果数组
        $res = $array1;   //直接将数组1赋值给结果数组

        $arr2 = array_diff($array2,$array1);

        $res = array_merge($res , $arr2);

        return is_array($res) ? $res : array();
    }

    /**
     * 获取数组 主键  转换成以主键为索引数组
     * 1=>row(id=>1,.....)
     */
    public static function array_add_index($arr,$key){
        $out=array();
        foreach ($arr as $v){
            $out[($v[$key])]=$v;
        }
        return $out;
    }

//from topthink
    public static function isAssoc(array $array)
    {
        $keys = array_keys($array);

        return array_keys($keys) !== $keys;
    }

    public static function sortRecursive($array)
    {
        foreach ($array as &$value) {
            if (is_array($value)) {
                $value = static::sortRecursive($value);
            }
        }

        if (static::isAssoc($array)) {
            ksort($array);
        } else {
            sort($array);
        }

        return $array;
    }



}