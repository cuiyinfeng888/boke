<?php

namespace app\models;


use Yii;
use app\models\WxToken;
use app\models\WxUser;
class WxXml
{
 //获取返回给用户的text类型消息的xml
    /*
     * $userObj  包含了toUserName和FromUserName的对象
     * $msg 发送的信息
 */
    public static function getWxTextXml($userobj,$msg='我好像不明白你在说什么'){
        $xml ="<xml>
            <ToUserName><![CDATA[{$userobj->FromUserName}]]></ToUserName>
            <FromUserName><![CDATA[{$userobj->ToUserName}]]></FromUserName>
            <CreateTime>{time()}</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[$msg]]></Content>
            </xml>";
        return $xml;
    }

    //获取返回给用户的voice类型消息的xml
    /*
     * $userObj  包含了toUserName和FromUserName的对象
     * $media_id 发送的素材id
 */
    public static function getWxVoiceXml($userobj,$media_id){
        $xml ="<xml>
            <ToUserName><![CDATA[{$userobj->FromUserName}]]></ToUserName>
            <FromUserName><![CDATA[{$userobj->ToUserName}]]></FromUserName>
            <CreateTime>{time()}</CreateTime>
            <MsgType><![CDATA[voice]]></MsgType>
            <Voice>
            <MediaId><![CDATA[$media_id]]></MediaId>
            </Voice>
            </xml>";
        return $xml;
    }

    //获取返回给用户的image类型消息的xml
    /*
     * $userObj  包含了toUserName和FromUserName的对象
     * $media_id 发送的素材id
 */
    public static function getWxImageXml($userobj,$media_id){
        $xml ="<xml>
            <ToUserName><![CDATA[{$userobj->FromUserName}]]></ToUserName>
            <FromUserName><![CDATA[{$userobj->ToUserName}]]></FromUserName>
            <CreateTime>{time()}</CreateTime>
            <MsgType><![CDATA[image]]></MsgType>
            <Image>
            <MediaId><![CDATA[$media_id]]></MediaId>
            </Image>
            </xml>";
        return $xml;
    }


}
