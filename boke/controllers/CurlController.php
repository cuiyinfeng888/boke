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
class CurlController extends Controller
{

    public  $enableCsrfValidation = false;

    public function actionIndex()
    {
        $arr = ['name'=>1,'age'=>123];
        echo 'back('.json_encode($arr).')';
    }

}
