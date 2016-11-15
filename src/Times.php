<?php
/**
 * Created by u0mo5.
 * User: u0mo5
 * Date: 2015/9/30
 * Time: 13:36
 */
namespace U0mo5\Tools;
class Times
{

    //获得当前毫秒级时间戳
    public static function getMillisecond() {
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
    }
    //获得时间
    public static function get_datetime(){
        return  date ( 'Y-m-d H:i:s' ) ;
    }


}