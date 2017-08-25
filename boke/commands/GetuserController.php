<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use app\models\NewUserOpenid;
use app\models\Tool;
/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class GetuserController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionGetusermsg(){
        $date = date('Ymd H:i:s');
        $allnewuser = NewUserOpenid::find()->where('status = 0')->all();
        $count = count($allnewuser);
        $success = 0;
        foreach($allnewuser as $anuk=>$anuv){
            $isGet = Tool::SaveWxUserInfo($anuv->openid);
            if($isGet){
                $success++;
                NewUserOpenid::updateAll(['status'=>1],'openid="'.$anuv->openid.'"');
                echo $count.' total abort '.$date.' this is '.($anuk+1).' get success'."\n";
            }else{
                echo $count.' total abort '.$date.' this is '.($anuk+1).' get failed'."\n";
            }
        }
        echo $date.' '.$count.' total '.$success.' success'."\n";
    }

    public function actionUpdateusermsg(){
        $allopenid = Tool::getAllUser();
        $count = count($allopenid);
        $success=0;
        foreach($allopenid as $aok=>$aov){
            $update = Tool::SaveWxUserInfo($aov);
            if($update){
                $success++;
                echo $count.' userinfo '.($aok+1).' update success'."\n";
            }else{
                echo $count.' userinfo '.($aok+1).' update failed'."\n";
            }
        }
        echo date('Ymd H:i:s').' '.$count.' userinfo '.$success." success \n";
    }
}
