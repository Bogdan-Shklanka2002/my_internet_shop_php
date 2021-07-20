<?php

namespace backend\controllers;

use \yii\web\Controller;
use yii\filters\AccessControl;
use backend\models\PromotionForm;
use Yii;
use yii\web\UploadedFile;
use common\models\Promotion;
use yii\data\ActiveDataProvider;

class PromotionController extends Controller
{
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
    public function actionIndex()
    {    
        $dataProvider = new ActiveDataProvider([
            'query' => Promotion::find()
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionCreate()
    {
        $model = new PromotionForm();

        if($model->load(Yii::$app->request->post())){
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            
            
            if($urlImage = $model->upload()){
                $promotion = new Promotion();
                $promotion->name = $model->name;
                $promotion->description = $model->description;
                $promotion->url_image = $urlImage;
                if($promotion->save()){
                    Yii::$app->session->addFlash('success', 'Акція збережена');
                } else{
                    Yii::$app->session->addFlash('error', 'Помилка збереження акції');

                }

                return $this->redirect(['/promotion/index']);
            }
        } 

        return $this->render('create', ['model' => $model]);
    } 
    public function actionView($id){
        $model = Promotion::findOne(['id' => $id]);

        return $this->render('view', ['model' => $model]);


    }

    public function actionUpdate($id){

    }
    public function actionDelete($id)
    {
        $promotion = Promotion::findOne(['id' => $id]);
        $urlImage = $promotion->url_image;
        if($promotion->delete()){
            unlink($urlImage);
            Yii::$app->session->addFlash('success', 'Акція видалена');
        } else{
            Yii::$app->session->addFlash('error', 'Помилка видалення акції');
        }
        return $this->redirect(['/promotion/index']);
    }

}
