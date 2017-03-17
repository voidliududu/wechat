<?php
/**
 * Created by PhpStorm.
 * User: liududu
 * Date: 17-3-16
 * Time: 下午10:17
 */
/*
 * response text by client(object) and msg
 * */
function responseText($client,$msg){
    $toUserName      = $client->FromUserName;
    $FromUserName    = $client->ToUserName;
    $time            = time();
    $msgType         = 'text';
    $tpl = " <xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                   </xml>";
    $Message = sprintf($tpl,$toUserName,$FromUserName,$time,$msgType,$msg);
    echo $Message;
}
/*
 * select the type of functions from user's input and specifiy the intend of users
 * */
function fliter($request)
{
    $patten = array(
        'cet4' => "^cet4\s\d{15}\s\w{2}$",
    );
    foreach ($patten as $key => $value) {
        if (preg_grep($value, $request)) {
            return $key;
        }
    }
    return "default";
}
/*
 *TODO @Throw curl exception timeout
 *
 * */
function CurlHelper($method,$url,array $para){
    $ch = curl_init();
    if($method == 'POST'){
        $curl_options = array(
            CURLOPT_TIMEOUT => 5,
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $para,
            CURLOPT_RETURNTRANSFER => true
        );
    }else{
        foreach( $para as $key => $value ){
            $url_para[] = $key.'='.$value;
        }
        $url_para = implode("&",$url_para);
        $raw_url = $url.'?'.$url_para;
        $curl_options = array(
            CURLOPT_TIMEOUT => 5,
            CURLOPT_URL => $raw_url,
            CURLOPT_RETURNTRANSFER => true
        );
    }
    curl_setopt_array($ch,$curl_options);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}