<?php
/**
 * Created by PhpStorm.
 * User: u0mo5
 * Date: 2017/4/20
 * Time: 10:11
 */


//--------------------
// 基本数据结构算法
//--------------------
//二分查找（数组里查找某个元素）
function bin_sch($array,  $low, $high, $k){
    if ( $low <= $high){
        $mid =  intval(($low+$high)/2 );
        if ($array[$mid] ==  $k){
            return $mid;
        }elseif ( $k < $array[$mid]){
            return  bin_sch($array, $low,  $mid-1, $k);
        }else{
            return  bin_sch($array, $mid+ 1, $high, $k);
        }
    }
    return -1;
}
//顺序查找（数组里查找某个元素）
function  seq_sch($array, $n,  $k){
    $array[$n] =  $k;
    for($i=0;  $i<$n; $i++){
        if( $array[$i]==$k){
            break;
        }
    }
    if ($i<$n){
        return  $i;
    }else{
        return -1;
    }
}
//线性表的删除（数组中实现）
function delete_array_element($array , $i)
{
    $len =  count($array);
    for ($j= $i; $j<$len; $j ++){
        $array[$j] = $array [$j+1];
    }
    array_pop ($array);
    return $array ;
}
//冒泡排序（数组排序）
function bubble_sort( $array)
{
    $count = count( $array);
    if ($count <= 0 ) return false;
    for($i=0 ; $i<$count; $i ++){
        for($j=$count-1 ; $j>$i; $j--){
            if ($array[$j] < $array [$j-1]){
                $tmp = $array[$j];
                $array[$j] = $array[ $j-1];
                $array [$j-1] = $tmp;
            }
        }
    }
    return $array;
}
//快速排序（数组排序）
function quick_sort($array ) {
    if (count($array) <= 1) return  $array;
    $key = $array [0];
    $left_arr  = array();
    $right_arr = array();
    for ($i= 1; $i<count($array ); $i++){
        if ($array[ $i] <= $key)
            $left_arr [] = $array[$i];
        else
            $right_arr[] = $array[$i ];
    }
    $left_arr = quick_sort($left_arr );
    $right_arr = quick_sort( $right_arr);
    return array_merge($left_arr , array($key), $right_arr);
}
