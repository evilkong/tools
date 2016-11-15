<?php
/**
 * Created by u0mo5.
 * User: u0mo5
 * Date: 2015/9/30
 * Time: 13:36
 */
namespace U0mo5\Tools;
class Nets{


    //发送https的post获取内容 send
    //$data = curlPost('https://api.lwl12.com/hitokoto/main/get', array('p'=>'hello'));
    //echo ($data);
    public static function curlPost($url, $data, $timeout = 30)
    {
        $ssl = substr($url, 0, 8) == "https://" ? TRUE : FALSE;
        $ch = curl_init();
        $opt = array(
            CURLOPT_URL     => $url,
            CURLOPT_POST    => 1,
            CURLOPT_HEADER  => 0,
            CURLOPT_POSTFIELDS      => (array)$data,
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_TIMEOUT         => $timeout,
        );
        if ($ssl)
        {
            $opt[CURLOPT_SSL_VERIFYHOST] = 1;
            $opt[CURLOPT_SSL_VERIFYPEER] = FALSE;
        }
        curl_setopt_array($ch, $opt);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }



}