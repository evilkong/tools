<?php
/**
 * Created by u0mo5.
 * User: u0mo5
 * Date: 2015/9/30
 * Time: 13:36
 */
namespace U0mo5\Tools;
class Files
{

    /**
     * 功能：递归创建文件夹
     * 参数：$param 文件路径
     */
    public static function mkdirsByPath($param){
        if(! file_exists($param)) {
            self::mkdirsByPath(dirname($param));
            @mkdir($param);
        }
        return realpath($param);
    }

    /**
     * 功能：删除非空目录
     */
    public static function deldir($dir)
    {
        $dh=opendir($dir);
        while ($file=readdir($dh)) {
            if($file!="." && $file!="..") {
                $fullpath=$dir."/".$file;
                if(!is_dir($fullpath)) {
                    unlink($fullpath);
                } else {
                    self::deldir($fullpath);
                }
            }
        }
        closedir($dh);
        if(rmdir($dir)) {
            return true;
        } else {
            return false;
        }
    }

    //生成文件
    public static function makefile($dir,$filename,$content='')
    {
        if(!$dir || !$filename){
            return '目录或文件名参数不正确！';
        }

        if (!file_put_contents($dir.$filename, $content)) {
            return '文件保存失败，请检查文件权限！';
        }

        return '';
    }


}