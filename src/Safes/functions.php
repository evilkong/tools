<?php



/**
 * 签名验证函数
 * @param $param   需要加密的字符串
 * @param $sign     第三方已经机密好的用来比对的字串
 * @return bool
 */
function ValidateSign($param, $sign)
{
    if (md5($param) == $sign) {
        return true;
    } else {
        return false;
    }
}
