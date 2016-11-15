<?php
/**
 * Created by u0mo5.
 * User: u0mo5
 * Date: 2015/9/30
 * Time: 13:36
 */
namespace U0mo5\Tools;
class Excels
{

    /**
     * 导出功能
     * param fileName 导出文件名
     * param dataStr  数据字符串
     */
        public static  function export($fileName , $dataStr){
        header("Content-Type: application/vnd.ms-excel; charset=utf-8");
        Header("Accept-Ranges: bytes");
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Disposition: attachment; filename="'.$fileName);
        header("Content-Transfer-Encoding: binary ");
        echo $dataStr;
        exit;
    }


}