<?php
/**
 * Created by u0mo5.
 * User: u0mo5
 * Date: 2015/9/30
 * Time: 13:36
 */
namespace U0mo5\Tools;
class Strings
{

    /**
     * 生成随机字符串
     * @param string $lenth 长度
     * @return string 字符串
     */
    public static function create_randomstr($lenth = 6) {
        return self::random($lenth, '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ');
    }

//生成随机字符串
    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    /**
     * 产生随机字符串
     *
     * @param    int        $length  输出长度
     * @param    string     $chars   可选的 ，默认为 0123456789
     * @return   string     字符串
     */
    public static function random($length, $chars = '0123456789') {
        $hash = '';
        $max = strlen($chars) - 1;
        for($i = 0; $i < $length; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
        return $hash;
    }

    /*
     Utf-8、gb2312都支持的汉字截取函数
     cut_str(字符串, 截取长度, 开始长度, 编码);
     编码默认为 utf-8
     开始长度默认为 0

$str = "如来神掌";
echo cut_str($str, 1, 0).'**'.cut_str($str, 1, -1);
//输出：如**掌

     
    */
    public static function cutStr($string, $sublen, $start = 0, $code = 'UTF-8'){
        if($code == 'UTF-8'){
            $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
            preg_match_all($pa, $string, $t_string);

            if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";
            return join('', array_slice($t_string[0], $start, $sublen));
        }else{
            $start = $start*2;
            $sublen = $sublen*2;
            $strlen = strlen($string);
            $tmpstr = '';

            for($i=0; $i<$strlen; $i++){
                if($i>=$start && $i<($start+$sublen)){
                    if(ord(substr($string, $i, 1))>129){
                        $tmpstr.= substr($string, $i, 2);
                    }else{
                        $tmpstr.= substr($string, $i, 1);
                    }
                }
                if(ord(substr($string, $i, 1))>129) $i++;
            }
            if(strlen($tmpstr)<$strlen ) $tmpstr.= "...";
            return $tmpstr;
        }
    }


    //PHP替换标签字符
    public static function stringParser($string,$replacer){
        $result = str_replace(array_keys($replacer), array_values($replacer),$string);
        return $result;
    }

    /**
     * 查询字符是否存在于某字符串
     *
     * @param $haystack 字符串
     * @param $needle 要查找的字符
     * @return bool
     */
    public static function str_exists($haystack, $needle)
    {
        return !(strpos($haystack, $needle) === FALSE);
    }

    /**
     * 格式化字符串
     * @param string $str
     * @return string
     */
    public static  function formatStr($str) {
        $arr = array(' ', '	', '&', '@', '#', '%',  '\'', '"', '\\', '/', '.', ',', '$', '^', '*', '(', ')', '[', ']', '{', '}', '|', '~', '`', '?', '!', ';', ':', '-', '_', '+', '=');
        foreach ($arr as $v) {
            $str = str_replace($v, '', $str);
        }
        return $str;
    }


}