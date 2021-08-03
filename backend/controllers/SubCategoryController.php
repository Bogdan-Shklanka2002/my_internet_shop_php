<?php

namespace backend\controllers;

use Yii;
use \yii\web\Controller;
use yii\filters\AccessControl;
use backend\models\SubCategoryForm;
use common\models\SubCategory;
use common\models\Category;
use service\CategoryService;
use yii\data\ActiveDataProvider;
use service\SubCategoryService;

class SubCategoryController extends Controller
{

    public SubCategoryService $sub_category_service;
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
    public function __construct($id, $module, SubCategoryService $sub_category_service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->sub_category_service = $sub_category_service;
    }

    public function actionIndex()
    {    
        $dataProvider = new ActiveDataProvider([
            'query' => SubCategory::find()
        ]);


        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionCreate(){
        $model = new SubCategoryForm();

        if($model->load(Yii::$app->request->post())){
                if($this->sub_category_service->saveDB($model)){
                    Yii::$app->session->addFlash('success', 'Підкатегорія добавлена');
                } else{
                    Yii::$app->session->addFlash('error', 'Помилка добавлення підкатегорії');
                }
                return $this->redirect(['/sub-category/index']);
        } 

        $categories_array = CategoryService::getCategories();

        return $this->render('create', 
        [
            'model' => $model, 
            'categories_array' => $categories_array,
        ]);
    }

    public function actionUpdate($id){
        $sub_category = SubCategory::findOne(['id' => $id]);
        $model = new SubCategoryForm();
        $model->id = $sub_category->id;
        
        if($model->load(Yii::$app->request->post())){
            if($this->sub_category_service->saveDB($model)){
                Yii::$app->session->addFlash('success', 'Підкатегорія збережена');
            } else{
                Yii::$app->session->addFlash('error', 'Помилка збереження підкатегорії');
            }
            return $this->redirect(['/sub-category/index']);
        } 

        $model->name = $sub_category->name;
        $model->description = $sub_category->description;
        $model->category_id = $sub_category->category_id;
        $categories_array = CategoryService::getCategories();
        
        return $this->render('create', 
        [
            'model' => $model, 
            'categories_array' => $categories_array,
        ]);

    }

    public function actionDelete($id)
    {
        $sub_category = SubCategory::findOne(['id' => $id]);
        if($sub_category->delete()){
            Yii::$app->session->addFlash('success', 'Підкатегорія видалена');
        } else{
            Yii::$app->session->addFlash('error', 'Помилка видалення підкатегорії');
        }
        return $this->redirect(['/sub-category/index']);
    }

    
}

