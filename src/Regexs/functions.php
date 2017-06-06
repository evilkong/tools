<?php
/**
 * 正则表达式
 */

/**
 * 检查用户名是否符合规定
 *
 * @param STRING $username 要检查的用户名
 * @return TRUE or FALSE
 */
function is_UserName($username, $minLen = 5, $maxLen = 20, $match = "/^[a-zA-Z0-9_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]+$/")
{
    $strlen = strlen($username);
    if (!preg_match($match,$username)
    ) //开源软件:phpfensi.com
    {
        return false;
    }
    return true;
}


/**
 * 密码:6—20位,由字母、数字组成
 * @param $value
 * @param int $minLen
 * @param int $maxLen
 * @return bool|int
 */
function isPWD($value, $minLen = 5, $maxLen = 20, $match = "")
{
    if (!$match) {
        $match = '/^[\\~!@#$%^&*()-_=+|{}\[\],.?\/:;\'\"\d\w]{' . $minLen . ',' . $maxLen . '}$/';
    }
    $v = trim($value);
    if (emptyempty($v))
        return false;
    return preg_match($match, $v);
}

function isEmail($value, $match = '/^[\w\d]+[\wd-.]*@[w\d-.]+\.[\w\d]{2,10}$/i')

{
    $v = trim($value);
    if (emptyempty($v))
        return false;
    return preg_match($match, $v);
}

//字符串长度区间合法验证
 function is_Length($str, $min=NULL, $max=NULL)
{
    preg_match_all("/./u", $str, $matches);
    $len = count($matches[0]);
    if(is_null($min) && !empty($max) && $len < $max){
        return false;
    }
    if(is_null($max) && !empty($min) && $len > $min){
        return false;
    }
    if ($len < $min || $len > $max) {
        return false;
    }
    return true;
}
//字符串是否是中文
function is_Chinese($value,$match="/^[\x80-\xff]{6,30}$/"){
    return preg_match($match,$value);
}

//手机号
function is_Mobile($value,$match="/13\d{9}|15\d{9}|18\d{9}|17\d{9}|14\d{9}/"){
    //正则表达式
    if (strlen($value) == "11") {
        //上面部分判断长度是不是11位
        /*接下来的正则表达式("/131,132,133,135,136,139开头随后跟着任意的8为数字 '|'(或者的意思)
         * 151,152,153,156,158.159开头的跟着任意的8为数字
         * 或者是188开头的再跟着任意的8为数字,匹配其中的任意一组就通过了
         * /")*/
        return preg_match($match, $value);
    } else {
        return false;
    }
}