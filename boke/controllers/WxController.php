<?php

namespace app\controllers;


use Yii;
use yii\web\Controller;
use app\models\Tool;
use app\models\WxXml;
use app\models\WxUser;
use app\models\WxMaterial;
use app\models\NewUserOpenid;
use app\models\Redbag;
use yii\db\Query;
class WxController extends Controller
{

    public  $enableCsrfValidation = false;


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $echostr = $_GET['echostr'];
        echo $echostr;
//      $str =  'cuiyinfeng'."\n";
       file_put_contents('../runtime/a.txt',$echostr,FILE_APPEND);
    }


    public function actionRespond(){
        $content =file_get_contents('php://input');
//        file_put_contents('userword.txt',$content,FILE_APPEND);
        if(!$content) return;
        $content=simplexml_load_string($content);
        switch($content->MsgType){
            case 'event':   $msg = self::event($content);
                              break;
            case  'image':  $msg = self::image($content);
                              break;
                  default :  $msg = self::text($content);
                              break;
        }
        echo $msg;

    }
    public function actionShare(){
        return $this->renderPartial('share');
    }


    public static  function event($content){
           $xml = '';
           if($content->Event=='subscribe'){
               $model = new NewUserOpenid();
               $model->openid =$content->FromUserName;
               $model->gettime =time();
               $model->status =0;
               $model->save();
               $xml ="<xml>
                        <ToUserName><![CDATA[{$content->FromUserName}]]></ToUserName>
                        <FromUserName><![CDATA[{$content->ToUserName}]]></FromUserName>
                        <CreateTime>{time()}</CreateTime>
                        <MsgType><![CDATA[text]]></MsgType>
                        <Content><![CDATA[山无棱，天地合，都不许取关，嘿嘿嘿……]]></Content>
                        </xml>";
           }else if($content->Event=='unsubscribe'){
               WxUser::updateAll(['subscribe'=>0],'openid = "'.$content->FromUserName.'"');
           }
        return $xml;
    }
    public static  function text($content){
        $query = new Query;
        $res = $query
            ->select('b.type,b.backmedia')
            ->from('user_words k')
            ->leftJoin('user_back_words b','b.kid=k.id')
            ->where('k.keywords like "%'.$content->Content.'%"')
            ->orderBy('rand()')
            ->one();
        if(!$res||empty($res['backmedia'])){
            return WxXml::getWxTextXml($content);
        }
        $xml ='';
        switch($res['type']){
            case 'text' : $xml = WxXml::getWxTextXml($content,$res['backmedia']);
                  break;
            case 'voice' :
                $meida_id = WxMaterial::find()->select('media_id')->where('media_type= :t',[':t'=>'voice'])->orderBy('rand()')->one()->media_id;
                $xml = WxXml::getWxVoiceXml($content,$meida_id);
                break;
            case 'image' :
                $meida_id = WxMaterial::find()->select('media_id')->where('media_type= :t',[':t'=>'image'])->orderBy('rand()')->one()->media_id;
                $xml = WxXml::getWxImageXml($content,$meida_id);
                break;
        }
        return $xml;
    }

    public static  function image($content){
        $meida_id = WxMaterial::find()->select('media_id')->where('media_type= :t',[':t'=>'image'])->orderBy('rand()')->one()->media_id;
        $xml = WxXml::getWxImageXml($content,$meida_id);
        return $xml;
    }


    public function actionTest(){
        $data = Tool::getAllWxMaterial('image');
        var_dump($data);
//        $data = Tool::getAccessToken();
//        var_dump($data);
//        echo date('Ymd H:i:s');
//        $query = new Query;
//        $res = $query
//            ->select('b.type,b.backmedia')
//            ->from('user_words k')
//            ->leftJoin('user_back_words b','b.kid=k.id')
//            ->where('k.keywords like "%我爱你%"')
//            ->orderBy('rand()')
//            ->one();
//        var_dump($res);
    }

    public static  function redbag($content){
        if($content->Content!='我要红包'||time()>strtotime('2017-04-11')) return;

        $money = 0;
        $isexist = Redbag::find()->where(['openid'=>$content->FromUserName])->one();
        if(!empty($isexist)) {
            $msg = '您已经参与过红包抽奖了！';
            goto back;
        }
        $rand = mt_rand(1,100);
        if($rand<98){
            $msg = '很遗憾您没有中奖！';
            $model = new Redbag();
            $model->openid=$content->FromUserName;
            $model->money = $money;
            $model->save();
            goto back;
        }
        $moneyarr=[2.22,2.22,2.22,2.22,2.22,2.22,2.22,2.22,2.22,2.22,2.22,2.22,2.22,2.22,2.22,2.22,2.22,2.22,2.22,3.33,3.33,3.33,4.44,5.55,6.66,2.22];
        $count = count($moneyarr)-1;
        $money = $moneyarr[mt_rand(0,$count)];
        $msg = '恭喜您获得'.$money.'元红包,稍后将为您发放！';
        $model = new Redbag();
        $model->openid=$content->FromUserName;
        $model->money = $money;
        $model->save();
        back:

        $xml ="<xml>
            <ToUserName><![CDATA[{$content->FromUserName}]]></ToUserName>
            <FromUserName><![CDATA[{$content->ToUserName}]]></FromUserName>
            <CreateTime>{time()}</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[$msg]]></Content>
            </xml>";
        return $xml;
    }




	public function actionGit(){
		
		echo 1;
	
	}

}
