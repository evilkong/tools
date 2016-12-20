<?php
/**
 * Created by u0mo5.
 * User: u0mo5
 * Date: 2015/9/30
 * Time: 13:36
 */
namespace U0mo5\Tools\Apis;
class Qrcode{
//利用百度网盘分享的接口  from   baidu pan
    public function gen($url){

        $url =  'http://pan.baidu.com/share/qrcode?w=400&h=400&url='.$url;
        ob_clean();
        header("Location:".$url);
    }





}