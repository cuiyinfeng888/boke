<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Category;
use yii\data\Pagination;
class CategoryController extends Controller
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
                        'actions' => ['index','edit','add'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
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
         $request = Yii::$app->request;
        $isshow = $request->get('isshow','');
        $keyword = $request->get('keyword','');
        $model = Category::find();
        if($isshow){
            $model = $model->where('isshow = :show',[':show'=>($isshow-1)]);
        }
        if($keyword){
            $model = $model->andWhere('cate_name like :key',[':key'=>'%'.$keyword.'%']);
        }
        $count = $model->count();
        $pager = new Pagination(['totalCount' => $count, 'pageSize' =>10]);
        $list = $model->orderBy('sort asc,create_time desc')->offset($pager->offset)->limit($pager->limit)->asArray()->all();

        $params = ['isshow'=>$isshow,'keyword'=>$keyword,'pager'=>$pager,'list'=>$list,'count'=>$count];
       return $this->render('index',$params);
    }

    public function actionAdd(){
        if(Yii::$app->request->isPost){
                $post = Yii::$app->request->post();
                $model = new Category();
                $model->cate_name = $post['cate_name'];
                $model->sort = intval($post['sort']);
                $model->isshow = intval($post['isshow']);
                $model->q_sort = $post['q_sort'];
                $model->create_time = date('Y-m-d H:i:s');
               if($model->save()){
                   return $this->renderPartial('/conf/success',['msg'=>'分类添加成功','url'=>'/category/index','time'=>Yii::$app->params['time']]);
               }else{
                   return $this->renderPartial('/conf/success',['msg'=>'分类添加失败','url'=>'/category/add','time'=>Yii::$app->params['time']]);
               }
        }else{
            return $this->render('add');
        }

    }

    public function actionEdit(){
        $id = Yii::$app->request->get('id');
        if(!$id) return;
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $model =Category::findOne($id);
            $model->cate_name = $post['cate_name'];
            $model->sort = intval($post['sort']);
            $model->isshow = intval($post['isshow']);
            $model->q_sort = $post['q_sort'];
            if($model->save()){
                return $this->renderPartial('/conf/success',['msg'=>'分类修改成功','url'=>'/category/index','time'=>Yii::$app->params['time']]);
            }else{
                return $this->renderPartial('/conf/failed',['msg'=>'分类修改失败','url'=>'/category/edit?='.$id,'time'=>Yii::$app->params['time']]);
            }
        }else{
             $cate = Category::find()->where('id = :id',[':id'=>$id])->asArray()->one();
            return $this->render('edit',$cate);
        }

    }
    public function actionDel(){
        $id = Yii::$app->request->get('id');
        if(!$id) return;
        $model = Category::findOne($id);
        if(empty($model)) return;
        $del = $model->delete();
        if($del){
            return $this->renderPartial('/conf/success',['msg'=>'分类删除成功','url'=>'/category/index','time'=>Yii::$app->params['time']]);
        }else{
            return $this->renderPartial('/conf/success',['msg'=>'分类删除失败','url'=>'/category/index','time'=>Yii::$app->params['time']]);
        }
    }

    public function actionTest(){
        $params = [];
       return $this->renderPartial('/conf/failed',$params);
    }


}
