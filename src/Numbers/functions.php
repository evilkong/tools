<?php
/**
 * 去两位小数，如果末尾是0，隐藏
 */
function format_float($float,$num=2){
//        $float = 19.00;
    $x=sprintf("%.{$num}f", $float);
    return floatval($x);
}