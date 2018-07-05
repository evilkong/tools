<?php
/**
 * Created by u0mo5.
 * User: u0mo5
 * Date: 2015/9/30
 * Time: 13:36
 * T\Apis\Qrcode::show('http://bookfuns.com');.
 */

namespace U0mo5\Tools\Apis;

class Ip
{
    //sina 接口
    public static function sina($ip)
    {
        $url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip='.$ip;
        $data = file_get_contents($url);

        return $json = json_decode($data);
    }

    //sina 接口
    public static function taobao($ip)
    {
        $url = 'http://ip.taobao.com/service/getIpInfo.php?ip='.$ip;
        $data = file_get_contents($url);

        return $json = json_decode($data);
    }

    //默认url
    public static function callback($url = '')
    {
        $data = file_get_contents($url);

        return json_decode($data);
    }

    //直接显示
    public static function show($ip, $callback = 'callback')
    {
        $url = self::$callback($ip);
        var_dump($url);
    }

    public static function get($ip, $callback = 'callback')
    {
        $url = self::$callback($ip);

        return  $url;
    }
}
