<?php

namespace app\models;


use Yii;
use app\models\WxToken;
use app\models\WxUser;
class Tool
{

    //获取关注者的信息
   public static function getWxUserInfo($openid){
        $url = 'https://api.weixin.qq.com/cgi-bin/user/info';
        $params =[
            'access_token'=>self::getAccessToken(),
            'openid'=>$openid,
            'lang'=>'zh_CN'
        ];
       $curldata = self::httpCurl($url,$params);
       $userinfo = json_decode($curldata,true);
       return $userinfo;
   }

    //获取微信调用接口的凭证
    public static function getAccessToken(){
        $token = '';
       $isExist = WxToken::find()->select('access_token')->where('gettime+expires_in>'.time())->orderBy('gettime desc')->one();
       if($isExist){
           $token =  $isExist->access_token;
       }else{
           $url='https://api.weixin.qq.com/cgi-bin/token';
           $params = [
               'grant_type'=>'client_credential',
               'appid'=>Yii::$app->params['appid'],
               'secret'=>Yii::$app->params['appsecret'],
           ];
           $curldata = self::httpCurl($url,$params);
           if(!empty($curldata)){
               $curldata = json_decode($curldata);
               $token = $curldata->access_token;
               $model = new WxToken();
               $model->access_token = $curldata->access_token;
               $model->gettime = strval(time());
               $model->expires_in =intval($curldata->expires_in-5*60);
               $res = $model->save();
           }

       }
        return $token;
    }
    //存取或更新微信关注者的信息
    public static function SaveWxUserInfo($openid){
          $userInfoFields =  ['subscribe', 'openid','sex','language','city', 'province' ,
                              'country','headimgurl','subscribe_time','unionid','remark','groupid',
                             ];
          $userInfo = self::getWxUserInfo($openid);
         if($userInfo['subscribe']===0){
             NewUserOpenid::deleteAll(['openid'=>$openid]);
             return '';
         };
          $isExist = WxUser::find()->where('openid = :o',[':o'=>$openid])->one();
         if($isExist){
             $model = $isExist;
         }else{
             $model = new WxUser();
         }
         foreach($userInfoFields as $uifv){
             if(isset($userInfo[$uifv])){
                 $model->$uifv = $userInfo[$uifv];
             }
         }
        $model->nickname = preg_replace_callback('/[\xf0-\xf7].{3}/', function($r) { return '@A' . base64_encode($r[0]);},$userInfo['nickname']);
        $model->tagid_list = json_encode($userInfo['tagid_list']);
        $model->last_update_time =strval(time());
        return $model->save();
    }
    //获取所有的用户数目
    public static function getAllUserCount(){
        $token = self::getAccessToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/user/get';
        $params = ['access_token'=>$token,'next_openid'=>''];
        $allusermsg = self::httpCurl($url,$params);
        return json_decode($allusermsg)->total;
    }
//    获取以用户信息，有分页
   public static function getPageUserMsg($next_openid=null){
       $token = self::getAccessToken();
       $url = 'https://api.weixin.qq.com/cgi-bin/user/get';
       $params = ['access_token'=>$token,'next_openid'=>$next_openid];
       $allusermsg = self::httpCurl($url,$params);
       return  json_decode($allusermsg,1);
   }
    //获取所有的用户openid列表
    public static function getAllUser(){
        $count = self::getAllUserCount();
//        if($count<10000){
//            $allusermsg = self::getPageUserMsg('');
//            return  $allusermsg['openid'];
//        }
        $alluserarr = [];
        $page = ceil($count/10000);
        $openid = '';
        for($i=0;$i<$page;$i++){
            $pageuser = self::getPageUserMsg($openid);
            $alluserarr = array_merge($alluserarr,$pageuser['data']['openid']);
            $openid = $pageuser['next_openid'];
        }
        return $alluserarr;
    }
   //调接口用的curl方法
    public static function httpCurl($url, $params = array(), $method = "get", $header = array()) {
        $ch = curl_init();
        if (is_array($params)) {
            $query = http_build_query($params);
        } else {
            $query = $params;
        }
        if ($method == 'get') {
            if (strpos($url, '?') !== false) {
                $url .= "&" . $query;
            } else {
                $url .= "?" . $query;
            }
        } else {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
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
        //   获取素材列表
        /*$type 素材的类型 image，voice,video,news 四种
         *$offset 从全部素材的该偏移位置开始返回，0表示从第一个素材 返回
         * $count 返回素材的数量，取值在1到20之间
         * curl 发送的数据为json格式
         * */
    public static function getWxMaterial($type,$offset=0,$count=20){
        $token = self::getAccessToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token='.$token;
        $params = ['type'=>$type,'offset'=>$offset,'count'=>$count];
        $material = self::httpCurl($url,json_encode($params),'post');
        $material = json_decode($material,true);
        if(isset($material['item'])){
            return $material['item'];
        }else{
            return $material['errmsg'];
        }

    }
    //获取素材数目
    /*
     * $type 素材的类型 image，voice,video,news 四种
     * $type 默认为空 为空时返回所有的素材类型 传值后相应的素材数目
     * */
    public static function getMaterialCount($type=null){
        $token = self::getAccessToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token='.$token;
        $res =self::httpCurl($url,'');
        $countarr = json_decode($res,true);
        if(!$type){
            return $countarr;
        }else{
            return $countarr[$type.'_count'];
        }

    }

    public static function getAllWxMaterial($type){
        $count = self::getMaterialCount($type);
        $page = ceil($count/20);
        $material=  [];
        for($i=0;$i<$page;$i++){
            $offset = $i*20;
            $_mater = self::getWxMaterial($type,$offset,20);
            if(is_array($_mater)){
                $material = array_merge($material,$_mater);
            }
        }
        return $material;
    }
}
