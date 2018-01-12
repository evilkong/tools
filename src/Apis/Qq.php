<?php
/**
 * Created by u0mo5.
 * User: u0mo5
 * Date: 2015/9/30
 * Time: 13:36
 * T\Apis\Qrcode::show('http://bookfuns.com');
 */
namespace U0mo5\Tools\Apis;
class Qq{

//pengyou 接口
    public static function pengyou($qq){

        $url="http://r.pengyou.com/fcg-bin/cgi_get_portrait.fcg?uins=".$qq;
        $data=file_get_contents($url);
        return $json=json_decode($data);
    }
    //显示头像
    public static function avatar($qq){

        $url="http://q.qlogo.cn/headimg_dl?bs=qq&dst_uin={$qq}&src_uin=www.bookfuns.com&fid=blog&spec=100";
        ob_clean();
        header("Location:".$url);
    }
//默认url
    public static function callback($qq=""){
        $data=file_get_contents($qq);
        return json_decode($data);
    }
//直接显示
    public static function show($qq,$callback="callback"){
        $url=self::$callback($qq);
        var_dump( $url);

    }
    public static function get($qq,$callback="callback"){
        $url=self::$callback($qq);
        return ( $url);

    }



}