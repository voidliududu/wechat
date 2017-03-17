<?php
/*
 * this is the main function for this project
 * all the function is called by this function
 *
 * */
function check_signature(){
  $nonce     = $_GET['nonce'];
  $token     = 'hello';
  $timestamp = $_GET['timestamp'];
  $signature = $_GET['signature'];
  $echostr   = $_GET['echostr'];
  $arr = array($nonce,$token,$timestamp);
  sort($arr);
  $str = sha1(implode($arr));
  if($str == $signature && $echostr){
    echo $echostr;
  }else{
    response();
  }
}
//
function response()
{
    //$data = $GLOBALS['HTTP_RAW_POST_DATA'];
    $data = file_get_contents('php://input');
    $client = simplexml_load_string($data);

    if (strtolower($client->MsgType) == "event") {
        if ($client->Event == 'subscribe') {
            $toUserName      = $client->FromUserName;
            $FromUserName    = $client->ToUserName;
            $time            = time();
            $msgType         = 'text';
            $content         = "hello world";
            $tpl = " <xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                   </xml>";
            $info = sprintf($tpl,$toUserName,$FromUserName,$time,$msgType,$content);
            echo $info;
        }


    }else{
        if(strtolower($client->MsgType) == 'text'){
        $request = trim($client->Content);
        $flag = fliter($request);
        switch($flag){
            case 'cet4':
                $msg = cet4($request);
                break;
        }
        responseText($client,$msg);
        }
    }
}

  /*  <xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>12345678</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[你好]]></Content>
</xml>*/


function cet4($request){
    $info = explode(' ',$request);
    if($info[0] == 'cet4') {
        $query = array(
            'zkzh' => $info[1],
            'xm' => $info[2]
        );
        $url = 'http://www.chsi.com.cn/cet/query';
        $content = CurlHelper('GET',$url,$query);
    $totalPatten = '(?<=<span\sclass="colorRed">)\d+?(?=</span>)';
    $listenPatten = '(?<=<span class="color999">听<span class=\'space_long\'>&nbsp;</span>力：</span>
                    </th>
                    <td>)\d+?(?=</td>)';
    $readPatten = '(?<=<span class="color999">阅<span class=\'space_long\'>&nbsp;</span>读：</span>
                    </th>
                    <td>)\d+?(?=</td>)';
    $writingPatten = '(?<=<span class="color999">写作和翻译：</span>
                    </th>
                    <td>)\d+?(?= </td>)';
    preg_match_all($totalPatten,$content,$total);
    preg_match_all($listenPatten,$content,$listen);
    preg_match_all($writingPatten,$content,$writing);
    preg_match_all($readPatten,$content,$read);
    return 'total:'.$total.'$listen:'.$listen.'writing:'.$writing.'read:'.$read;

    }
}



/*<table border="0" align="center" cellpadding="0" cellspacing="6" class="cetTable">
                <tr>
                    <th width='90'>姓<span class='space'>&nbsp;</span>名：</th>
                    <td colspan="2">刘都都
                    </td>
                </tr>
                <tr>
                    <th>学<span class='space'>&nbsp;</span>校：</th>
                    <td colspan="2">中南大学
                    </td>
                </tr>
                <tr>
                    <th>考试级别：</th>
                    <td colspan="2">英语四级
                    </td>
                </tr>
                <tr>
                    <th colspan="3" class='td_title'>
笔试成绩
                    </th>
                </tr>
                <tr>
                    <th>准考证号：</th>
                    <td colspan="2">430021162127726
                    </td>
                </tr>
                <tr>
                    <th>总<span class='space'>&nbsp;</span>分：</th>
                    <td  colspan="2" class="fontBold" >
        <span class="colorRed">

459

        </span>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <th width='86'>
                        <span class="color999">听<span class='space_long'>&nbsp;</span>力：</span>
                    </th>
                    <td>

120

                    </td>
                </tr>
                <tr>
                    <td></td>
                    <th>
                        <span class="color999">阅<span class='space_long'>&nbsp;</span>读：</span>
                    </th>
                    <td>

168

                    </td>
                </tr>
                <tr>
                    <td></td>
                    <th>
                        <span class="color999">写作和翻译：</span>
                    </th>
                    <td>



171

                    </td>
                </tr>
*/