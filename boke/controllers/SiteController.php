<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login','captcha','ajaxlogin'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index','logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'height'=>40
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

       return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        return $this->renderPartial('login');
    }

    public function actionAjaxlogin()
    {
        if(!Yii::$app->request->isAjax) return;
        $post = Yii::$app->request->post();
        $msgstr =['code'=>0,'msg'=>'登陆成功，页面跳转中……'];
        if(strtolower(Yii::$app->session['captcha_cyf'])!=strtolower($post['captcha'])){
            $msgstr =['code'=>1,'msg'=>'验证码有误'];
            echo json_encode($msgstr);
            Yii::$app->end();
        }
        $user = User::findByUsername($post['user'],$post['password']);
        if(!$user){
            $msgstr =['code'=>2,'msg'=>'用户名或者密码错误'];
            echo json_encode($msgstr);
            Yii::$app->end();
        }
        $login = Yii::$app->user->login($user,24*3600);
        if($login){
            echo json_encode($msgstr);
            Yii::$app->end();
        }else{
            $msgstr =['code'=>3,'msg'=>'登录失败'];
            echo json_encode($msgstr);
            Yii::$app->end();
        }


    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('/site/login');
    }
}
