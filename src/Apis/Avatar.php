<?php
/**
 * Created by u0mo5.
 * User: u0mo5
 * Date: 2015/9/30
 * Time: 13:36
 * T\Apis\Qrcode::show('http://bookfuns.com');
 */
namespace U0mo5\Tools\Apis;
class Avatar{

//qq 接口
    public static function qq($var){

        $url="http://q.qlogo.cn/headimg_dl?bs=qq&dst_uin={$var}&src_uin=www.bookfuns.com&fid=blog&spec=100";
        return $url;
    }

//默认url
    public static function callback($qq=""){
        $url="http://q.qlogo.cn/headimg_dl?bs=qq&dst_uin={$var}&src_uin=www.bookfuns.com&fid=blog&spec=100";
        return $url;
    }
//直接显示
    public static function show($qq,$callback="callback"){
        $url=self::$callback($qq);
        ob_clean();
        header("Location:".$url);

    }
    public static function get($qq,$callback="callback"){
        $url=self::$callback($qq);
        return ( $url);

    }



}