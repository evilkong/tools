<?php
/**
 * Created by u0mo5.
 * User: u0mo5
 * Date: 2015/9/30
 * Time: 13:36
 * T\Webs\Js::go_url("http://www.baidu.com");
 */
namespace U0mo5\Tools\Webs;
class Js{



// 输出js
    function exec_js($js){
        echo "<script language='JavaScript'>\n" . $js . "</script>\n";
    }
// 禁止缓存
    function no_cache(){
        header("Pragma:no-cache\r\n");
        header("Cache-Control:no-cache\r\n");
        header("Expires:0\r\n");
    }
// 生成javascript转向
    function go_url($url, $msg = ''){
        header("Content-type: text/html; charset=utf-8\r\n");
        echo "<script type='text/javascript'>\n";
        echo "window.location.href='$url';";
        echo "</script>\n";
        exit;
    }







}