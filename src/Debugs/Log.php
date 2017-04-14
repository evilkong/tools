<?php
/**
 * Created by u0mo5.
 * User: u0mo5
 * Date: 2015/9/30
 * Time: 13:36
 *
 * T\Debugs::debug_out(array("12"=>12,"name"=>array("1","ok")));
 */
namespace U0mo5\Tools\Debugs;
class Log{



    /**
     * 写日志，方便测试（看网站需求，也可以改成把记录存入数据库）
     * 注意：服务器需要开通fopen配置
     * @param $word 要写入日志里的文本内容 默认值：空值
     */
    function log_out($var='') {
        if (is_array($var)) {
            $var=json_encode($var);
        } else if (is_object($var)) {
            $var=json_encode($var);
        } else if (is_resource($var)) {
            $var=(string)$var;
        } else {
            $var=json_encode($var);
        }

        $fp = fopen("log.txt","a");
        flock($fp, LOCK_EX) ;
        fwrite($fp,"执行日期：".strftime("%Y%m%d%H%M%S",time())."\n".$var."\n");
        flock($fp, LOCK_UN);
        fclose($fp);
    }








}