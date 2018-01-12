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
class Office{



//infinity tab 接口
    public static function office_365($url=""){

        $url="https://view.officeapps.live.com/op/view.aspx?src={$url}";
        return $url;
    }

//默认url
    public static function callback($url=""){
        return self::office_365($url);
    }
//直接显示
    public static function show($url,$callback="callback"){
        $url=self::$callback($url);
        header('Content-Type: image/JPEG');
        header("Location: $url");
        exit;
    }




}