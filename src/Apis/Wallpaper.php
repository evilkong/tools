<?php
/**
 * Created by u0mo5.
 * User: u0mo5
 * Date: 2015/9/30
 * Time: 13:36
 */
namespace U0mo5\Tools\Apis;
class Wallpaper{


//bing接口
    public static function bing($url=""){
        if($_GET['idx']==null){
            $str=file_get_contents('http://cn.bing.com/HPImageArchive.aspx?idx=0&n=1');

        }

        $str=file_get_contents('http://cn.bing.com/HPImageArchive.aspx?idx='.$_GET['idx'].'&n=1');
        if(preg_match("/<url>(.+?)<\/url>/ies",$str,$matches)){
            $imgurl='http://cn.bing.com'.$matches[1];
        }

        return $imgurl;
    }
//infinity tab 接口
    public static function infinity($url=""){
        $rand=rand(1,4000);
        $url="http://img.infinitynewtab.com/wallpaper/{$rand}.jpg";
        return $url;
    }
//lovebizhi 接口
    public static function lovebizhi($url=""){
        $url='http://api.lovebizhi.com/macos_v4.php?a=category&spdy=1&tid=2&order=hot&color_id=3&device=105&uuid=436e4ddc389027ba3aef863a27f6e6f9&mode=0&retina=0&client_id=1008&device_id=31547324&model_id=105&size_id=0&channel_id=70001&screen_width=1920&screen_height=1200&bizhi_width=1920&bizhi_height=1200&version_code=19&language=zh-Hans&jailbreak=0&mac=&p={pid}';
        $data=file_get_contents($url);
        $json=json_decode($data);

//   print_r ($json->data[1]->image);exit;
        return $imgurl=$json->data[1]->image->original;
    }
//默认url
    public static function callback($url=""){
        return $url;
    }
//直接显示
    public static function show($url,$callback="callback"){
        $url=self::$callback($url);
        header('Content-Type: image/JPEG');
        header("Location: $url");
        exit;
    }




}