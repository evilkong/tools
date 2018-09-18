<?php
/*
 *
 * 
 */

namespace U0mo5\Tools\Maps;

class Map
{
    /**
     * 去两位小数，如果末尾是0，隐藏
     */
    public static  function format_float($float, $num=2)
    {
//        $float = 19.00;
        $x=sprintf("%.{$num}f", $float);
        return floatval($x);
    }
}