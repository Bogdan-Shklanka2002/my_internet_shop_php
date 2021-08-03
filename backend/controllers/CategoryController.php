<?php

namespace backend\controllers;

use \yii\web\Controller;
use yii\filters\AccessControl;
use backend\models\CategoryForm;
use Yii;
use yii\web\UploadedFile;
use common\models\Category;
use service\CategoryService;
use yii\data\ActiveDataProvider;

class CategoryController extends Controller
{

    public CategoryService $category_service;
     /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        // 'actions' => ['*'],
                        'allow' => true,
                        'roles' => ['admin', 'owner', 'seo_manager', 'content_manager'],
                    ],
                ],
            ]  
        ];

    }

    public function __construct($id, $module, CategoryService $category_service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->category_service = $category_service;
    }

    public function actionIndex()
    {   
        $category = Category::findOne(['id' => 1]) ;

        $dataProvider = new ActiveDataProvider([
            'query' => Category::find()
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionCreate()
    {
        $model = new CategoryForm();

        if($model->load(Yii::$app->request->post())){
                if($this->category_service->saveDB($model)){
                    Yii::$app->session->addFlash('success', 'Категорія добавлена');
                } else{
                    Yii::$app->session->addFlash('error', 'Помилка добавлення категорії');

                }

                return $this->redirect(['/sub-category/index']);
        } 

        return $this->render('create', ['model' => $model]);
    } 

    public function actionUpdate($id){
        $category = Category::findOne(['id' => $id]);
        $model = new CategoryForm();
        $model->id = $category->id;
        if($model->load(Yii::$app->request->post())){
            if($this->category_service->saveDB($model)){
                Yii::$app->session->addFlash('success', 'Категорія збережена');
            } else{
                Yii::$app->session->addFlash('error', 'Помилка збереження категорії');
            }
            return $this->redirect(['/category/index']);
        } 
        $model->name = $category->name;
        $model->description = $category->description;
        return $this->render('create', ['model' => $model]);
    }
    public function actionDelete($id)
    {
        $category = Category::findOne(['id' => $id]);
        if($category->delete()){
            Yii::$app->session->addFlash('success', 'Категорія видалена');
        } else{
            Yii::$app->session->addFlash('error', 'Помилка видалення категорії');
        }
        return $this->redirect(['/category/index']);
    }

}
