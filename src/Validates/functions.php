<?php




// 验证是否为空
 function nullstr($str){
    if(trim($str) != "") return true;
    return false;
}

// 验证邮件格式
 function email($str){
    if(preg_match("/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/", $str)) return true;
    else return false;
}

 function is_email($email)
{
    $check = 0;
    if(filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        $check = 1;
    }
    return $check;
}


// 验证身份证
 function idcode($str){
    if(preg_match("/^\d{14}(\d{1}|\d{4}|(\d{3}[xX]))$/", $str)) return true;
    else return false;
}

// 验证http地址
 function http($str){
    if(preg_match("/[a-zA-Z]+:\/\/[^\s]*/", $str)) return true;
    else return false;
}

//匹配QQ号(QQ号从10000开始)
 function qq($str){
    if(preg_match("/^[1-9][0-9]{4,}$/", $str)) return true;
    else return false;
}

//匹配中国邮政编码
 function postcode($str){
    if(preg_match("/^[1-9]\d{5}$/", $str)) return true;
    else return false;
}

//匹配ip地址
 function ip($str){
    if(preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/", $str)) return true;
    else return false;
}

// 匹配电话格式
 function telephone($str){
    if(preg_match("/^\d{3}-\d{8}$|^\d{4}-\d{7}$/", $str)) return true;
    else return false;
}

// 匹配手机格式
 function mobile($str){
    if(preg_match("/^(13[0-9]|15[0-9]|18[0-9])\d{8}$/", $str)) return true;
    else return false;
}

// 匹配26个英文字母
 function en_word($str){
    if(preg_match("/^[A-Za-z]+$/", $str)) return true;
    else return false;
}

// 匹配只有中文
 function cn_word($str){
    if(preg_match("/^[\x80-\xff]+$/", $str)) return true;
    else return false;
}

// 验证账户(字母开头，由字母数字下划线组成，4-20字节)
 function user_account($str){
    if(preg_match("/^[a-zA-Z][a-zA-Z0-9_]{3,19}$/", $str)) return true;
    else return false;
}

// 验证数字
 function number($str){
    if(preg_match("/^[0-9]+$/", $str)) return true;
    else return false;
}