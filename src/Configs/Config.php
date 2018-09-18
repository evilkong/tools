<?php

/**
 * Created by u0mo5.
 * User: u0mo5
 * Date: 2015/9/30
 * Time: 13:36
 * T\Algos\Arr::getCol($array, $field);
 */
namespace U0mo5\Tools\Configs;

class Config
{
    /*
    *config   配置管理
    */

    /**
     * 加载配置文件 支持格式转换 仅支持一级配置
     * @param string $file 配置文件名
     * @param string $parse 配置解析方法 有些格式需要用户自己解析
     * @return array
     */
    public static  function load_config($file, $parse=CONF_PARSE)
    {
        $ext  = pathinfo($file, PATHINFO_EXTENSION);
        switch ($ext) {
        case 'php':
            return include $file;
        case 'ini':
            return parse_ini_file($file);
        case 'yaml':
            return yaml_parse_file($file);
        case 'xml':
            return (array)simplexml_load_file($file);
        case 'json':
            return json_decode(file_get_contents($file), true);
        default:
            if (function_exists($parse)) {
                return $parse($file);
            } else {
                E(L('_NOT_SUPPORT_').':'.$ext);
            }
    }
    }
}