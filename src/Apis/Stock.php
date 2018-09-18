<?php
/**
 * Created by u0mo5.
 * User: u0mo5
 * Date: 2015/9/30
 * Time: 13:36
 * T\Apis\Stock::show("sh601933","min");
 */
namespace U0mo5\Tools\Apis;
class Stock{


    //sinaGif 接口
    public static function sinaGif($code,$type){
        $url="";
        if($type=="day"){

            $url="http://image.sinajs.cn/newchart/daily/n/{$code}.gif";
        }
        if($type=="min"){

            $url="http://image.sinajs.cn/newchart/min/n/{$code}.gif";
        }
        if($type=="week"){

            $url="http://image.sinajs.cn/newchart/weekly/n/{$code}.gif";
        }
        if($type=="month"){

            $url="http://image.sinajs.cn/newchart/monthly/n/{$code}.gif";
        }
        
        return $url;
    }


    public static function sinaJson($code,$type){
        $url="";

        if($type=="min"){

            $url="http://hq.sinajs.cn/list={$code}";
        }

        
        return $url;
    }


//默认url
    public static function callback($code,$type="",$method="sinaGif"){
        
        $out=self::$method($code,$type);
        
        return $out;
    }
//直接显示
    public static function show($code,$type,$callback="callback"){

        $url=self::$callback($code,$type,$callback);
        
        header('Content-Type: image/gif');
        header("Location: $url");
        exit;
    }

    //默认url
    public static function json($code,$type,$callback="sinaJson")
    {
        $url=self::$callback($code,$type,$callback);
        $data = file_get_contents($url);

        echo ($data);
    }






}