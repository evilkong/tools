<?php
/**
 * Created by u0mo5.
 * User: u0mo5
 * Date: 2015/9/30
 * Time: 13:36
 */
namespace U0mo5\Tools\Strings;
class String
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
//from topthink
    /**
     * 检查字符串中是否包含某些字符串
     * @param string       $haystack
     * @param string|array $needles
     * @return bool
     */
    public static function contains($haystack, $needles)
    {
        foreach ((array)$needles as $needle) {
            if ($needle != '' && mb_strpos($haystack, $needle) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * 检查字符串是否以某些字符串结尾
     *
     * @param  string       $haystack
     * @param  string|array $needles
     * @return bool
     */
    public static function endsWith($haystack, $needles)
    {
        foreach ((array)$needles as $needle) {
            if ((string)$needle === static::substr($haystack, -static::length($needle))) {
                return true;
            }
        }

        return false;
    }

    /**
     * 检查字符串是否以某些字符串开头
     *
     * @param  string       $haystack
     * @param  string|array $needles
     * @return bool
     */
    public static function startsWith($haystack, $needles)
    {
        foreach ((array)$needles as $needle) {
            if ($needle != '' && mb_strpos($haystack, $needle) === 0) {
                return true;
            }
        }

        return false;
    }


    /**
     * 获取指定长度的随机字母数字组合的字符串
     *
     * @param  int $length
     * @return string
     */
    public static function randomSN($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return static::substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }


    /**
     * 字符串转小写
     *
     * @param  string $value
     * @return string
     */
    public static function lower($value)
    {
        return mb_strtolower($value, 'UTF-8');
    }

    /**
     * 字符串转大写
     *
     * @param  string $value
     * @return string
     */
    public static function upper($value)
    {
        return mb_strtoupper($value, 'UTF-8');
    }

    /**
     * 获取字符串的长度
     *
     * @param  string $value
     * @return int
     */
    public static function length($value)
    {
        return mb_strlen($value);
    }

    /**
     * 截取字符串
     *
     * @param  string   $string
     * @param  int      $start
     * @param  int|null $length
     * @return string
     */
    public static function substr($string, $start, $length = null)
    {
        return mb_substr($string, $start, $length, 'UTF-8');
    }

    /**
     * 实现多种字符编码方式
     * @param $input 需要编码的字符串
     * @param $_output_charset 输出的编码格式
     * @param $_input_charset 输入的编码格式
     * @return string $output 编码后的字符串
     */
    public static function charsetEncode($input,$_output_charset ,$_input_charset) {
        $output = "";
        if(!isset($_output_charset) )$_output_charset  = $_input_charset;
        if($_input_charset == $_output_charset || $input ==null ) {
            $output = $input;
        } elseif (function_exists("mb_convert_encoding")) {
            $output = mb_convert_encoding($input,$_output_charset,$_input_charset);
        } elseif(function_exists("iconv")) {
            $output = iconv($_input_charset,$_output_charset,$input);
        } else die("sorry, you have no libs support for charset change.");
        return $output;
    }
    /**
     * 实现多种字符解码方式
     * @param $input 需要解码的字符串
     * @param $_output_charset 输出的解码格式
     * @param $_input_charset 输入的解码格式
     * @return string $output 解码后的字符串
     */
    public static function charsetDecode($input,$_input_charset ,$_output_charset) {
        $output = "";
        if(!isset($_input_charset) )$_input_charset  = $_input_charset ;
        if($_input_charset == $_output_charset || $input ==null ) {
            $output = $input;
        } elseif (function_exists("mb_convert_encoding")) {
            $output = mb_convert_encoding($input,$_output_charset,$_input_charset);
        } elseif(function_exists("iconv")) {
            $output = iconv($_input_charset,$_output_charset,$input);
        } else die("sorry, you have no libs support for charset changes.");
        return $output;
    }



}