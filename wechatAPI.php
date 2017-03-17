<?php
/**
 * Created by PhpStorm.
 * User: liududu
 * Date: 17-3-16
 * Time: 下午10:22
 */
function get_access_token(){
    $appId = '';
    $appSecret = '';
    $url = 'https://api.wechat.com?';
    $ch = curl_init();
    curl_setopt_array($ch,array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => 1
    ));
    $res = curl_exec($ch);
    $arr = json_decode($res,1);
    return $arr;
}