<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Quest;
use yii\data\Pagination;
class QuestController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','edit','add'],
                'rules' => [
                    [
                        'actions' =>['index','edit','add'],
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
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    //文章列表
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $isshow = $request->get('isshow','');
        $keyword = $request->get('keyword','');
        $quest = Quest::find();
        if($isshow){
            $quest = $quest->where('isshow = :show',[':show'=>$isshow-1]);
        }
        if($keyword){
            $quest = $quest->andWhere('title like :title or intro like :intro or content like :content ',[':title'=>'%'.$keyword.'%',':intro'=>'%'.$keyword.'%',':content'=>'%'.$keyword.'%']);
        }
        $count = $quest->count();
        $pager = new Pagination(['totalCount' => $count, 'pageSize' =>10]);
        $list = $quest->orderBy('sort asc,create_time desc')->offset($pager->offset)->limit($pager->limit)->asArray()->all();

        $params = ['isshow'=>$isshow,'keyword'=>$keyword,'pager'=>$pager,'list'=>$list,'count'=>$count];
        return $this->render('index',$params);
    }

//    文章添加
    public function actionAdd()
    {
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $quest = new Quest();
            $quest->title = $post['title'];
            $quest->sort = $post['sort'];
            $quest->isshow = $post['isshow'];
            $quest->intro = $post['intro'];
            $quest->content = $post['content'];
            $quest->create_time = date('Y-m-d h:I:s');
            if($quest->save()){
                return $this->renderPartial('/conf/success',['msg'=>'问题添加成功','url'=>'/quest/index','time'=>Yii::$app->params['time']]);
            }else{
                return $this->renderPartial('/conf/success',['msg'=>'问题添加失败','url'=>'/quest/add','time'=>Yii::$app->params['time']]);
            }
        }
        return $this->render('add');
    }
    //文章修改
    public function actionEdit(){
        $id = Yii::$app->request->get('id','');
        if(!$id) return;
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $quest = Quest::findOne($id);
            $quest->title = $post['title'];
            $quest->sort = $post['sort'];
            $quest->isshow = $post['isshow'];
            $quest->intro = $post['intro'];
            $quest->content = $post['content'];;
            if($quest->save()){
                return $this->renderPartial('/conf/success',['msg'=>'问题修改成功','url'=>'/quest/index','time'=>Yii::$app->params['time']]);
            }else{
                return $this->renderPartial('/conf/success',['msg'=>'问题修改失败','url'=>'/quest/add','time'=>Yii::$app->params['time']]);
            }
        }else{
            $quest = Quest::findOne($id);
            if(empty($quest)) return;
            $params = ['quest'=>$quest,'id'=>$id];
            return $this->render('edit',$params);
        }



    }

}
