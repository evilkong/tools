<?php
/*
 *
 * 
 */

namespace U0mo5\Tools\Maps;

class Map
{
    /**
     * 求两个已知经纬度之间的距离,单位为km
     * @param lng1,lng2 经度
     * @param lat1,lat2 纬度
     * @return float 距离，单位为km
     **/
    public static  function getDistance($lat1, $lng1, $lat2, $lng2)
    {
        if (!$lat1 || !$lng1 || !$lat2 || !$lng2) {
            return '';
        }
        //将角度转为狐度
    $radLat1 = deg2rad($lat1);//deg2rad()函数将角度转换为弧度
    $radLat2 = deg2rad($lat2);
        $radLng1 = deg2rad($lng1);
        $radLng2 = deg2rad($lng2);
        $a = $radLat1 - $radLat2;
        $b = $radLng1 - $radLng2;
        $s = 2*asin(sqrt(pow(sin($a/2), 2)+cos($radLat1)*cos($radLat2)*pow(sin($b/2), 2))) * 6378.137;
        return round($s, 1);
    }
}