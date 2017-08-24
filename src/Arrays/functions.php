<?php


/**
 * 获取数组中的某一列
 *
 * @param array $array
 * @param string $field
 * @return array
 */
function getCol($array, $field) {
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
function removeNull($array){
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
function array_and($array1=array(), $array2=array())
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
function array_add_index($arr,$key){
    $out=array();
    foreach ($arr as $v){
        $out[($v[$key])]=$v;
    }
    return $out;
}

//from topthink
function isAssoc(array $array)
{
    $keys = array_keys($array);

    return array_keys($keys) !== $keys;
}

function sortRecursive($array)
{
    foreach ($array as &$value) {
        if (is_array($value)) {
            $value = sortRecursive($value);
        }
    }

    if (isAssoc($array)) {
        ksort($array);
    } else {
        sort($array);
    }

    return $array;
}

/**
 * 将obj深度转化成array
 *
 * @param  $obj 要转换的数据 可能是数组 也可能是个对象 还可能是一般数据类型
 * @return array || 一般数据类型
 */
function obj2array($obj){
    if (is_array($obj)) {
        foreach($obj as &$value) {
            $value = obj2array($value);
        }
        return $obj;
    } elseif (is_object($obj)) {
        $obj = get_object_vars($obj);
        return obj2array($obj);
    } else {
        return $obj;
    }
}

/**
 * 二维数组按照指定的键值进行排序，
 *
 * @param  $keys 根据键值
 * @param  $type 升序降序
 * @return array $array = array(
 * array('name'=>'手机','brand'=>'诺基亚','price'=>1050),
 * array('name'=>'手表','brand'=>'卡西欧','price'=>960)
 * );$out = array_sort($array,'price');
 */
if (! function_exists('array_sort')) {
    function array_sort($arr, $keys, $type = 'asc'){
        $keysvalue = $new_array = array();
        foreach ($arr as $k => $v) {
            $keysvalue[$k] = $v[$keys];
        }
        if ($type == 'asc') {
            asort($keysvalue);
        } else {
            arsort($keysvalue);
        }
        reset($keysvalue);
        foreach ($keysvalue as $k => $v) {
            $new_array[$k] = $arr[$k];
        }
        return $new_array;
    }
}
/**
 * 遍历数组，对每个元素调用 $callback，假如返回值不为假值，则直接返回该返回值；
 * 假如每次 $callback 都返回假值，最终返回 false
 *
 * @param  $array
 * @param  $callback
 * @return mixed
 */
function array_try($array, $callback){
    if (!$array || !$callback) {
        return false;
    }
    $args = func_get_args();
    array_shift($args);
    array_shift($args);
    if (!$args) {
        $args = array();
    }
    foreach($array as $v) {
        $params = $args;
        array_unshift($params, $v);
        $x = call_user_func_array($callback, $params);
        if ($x) {
            return $x;
        }
    }
    return false;
}
// 求多个数组的并集
function array_union(){
    $argsCount = func_num_args();
    if ($argsCount < 2) {
        return false;
    } else if (2 === $argsCount) {
        list($arr1, $arr2) = func_get_args();

        while ((list($k, $v) = each($arr2))) {
            if (!in_array($v, $arr1)) $arr1[] = $v;
        }
        return $arr1;
    } else { // 三个以上的数组合并
        $arg_list = func_get_args();
        $all = call_user_func_array('array_union', $arg_list);
        return array_union($arg_list[0], $all);
    }
}
// 取出数组中第n项
function array_get_index($arr,$index){
    foreach($arr as $k=>$v){
        $index--;
        if($index<0) return array($k,$v);
    }
}