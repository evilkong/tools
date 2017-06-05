<?php
/**
 * Created by u0mo5.
 * User: u0mo5
 * Date: 2015/9/30
 * Time: 13:36
 * T\Apis\Wallpaper::show('', 'lovebizhi');
 * T\Apis\Wallpaper::show('http://cn.bing.com/az/hprichbg/rb/SaguaroLights_ZH-CN11691459871_1366x768.jpg');
 */
namespace U0mo5\Tools\Apis;
class Favico{



//dnspod 接口
    public static function dnspod($url=""){

        $url="http://statics.dnspod.cn/proxy_favicon/_/favicon?domain={$url}";
        return $url;
    }

//默认url
    public static function callback($url=""){
        return self::dnspod($url);
    }
//直接显示
    public static function show($url,$callback="callback"){
        $url=self::$callback($url);
        header('Content-Type: image/JPEG');
        header("Location: $url");
        exit;
    }




}