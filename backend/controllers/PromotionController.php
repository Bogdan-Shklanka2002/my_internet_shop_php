<?php

namespace backend\controllers;

use \yii\web\Controller;
use yii\filters\AccessControl;
use backend\models\PromotionForm;
use Yii;
use yii\web\UploadedFile;
use common\models\Promotion;
use service\PromotionService;
use yii\data\ActiveDataProvider;

class PromotionController extends Controller
{

    public PromotionService $promotion_service;
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

    public function __construct($id, $module, PromotionService $promotion_service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->promotion_service = $promotion_service;
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
                if($this->promotion_service->saveDB($model, $urlImage)){
                    Yii::$app->session->addFlash('success', 'Акція збережена');

                } else{
                    Yii::$app->session->addFlash('error', 'Помилка збереження акції');
                }

                return $this->redirect(['/promotion/index']);
            }
        } 

        return $this->render('create', ['model' => $model , 'initial_prev'=> [], 'image_conf' => [], 'promotion_id' => '']);
    } 
    public function actionView($id){
        $model = Promotion::findOne(['id' => $id]);



        return $this->render('view', ['model' => $model]);


    }

    public function actionUpdate($id){
        $promotion = Promotion::findOne(['id' => $id]);

        $model = new PromotionForm();
        $model->id = $id;

        if($model->load(Yii::$app->request->post())){

            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            
            
            if($urlImage = $model->upload()){
                if($this->promotion_service->saveDB($model, $urlImage)){
                    Yii::$app->session->addFlash('success', 'Акція збережена');

                } else{
                    Yii::$app->session->addFlash('error', 'Помилка збереження акції');
                }

                return $this->redirect(['/promotion/index']);
            }
        } 

        $model->name = $promotion->name;
        $model->description = $promotion->description;
        $initial_prev = ['../' . $promotion->url_image];
        $name_file = explode('/', $promotion->url_image);

        $image_conf = [
            [
                'key' => $name_file[count($name_file)-1],
            ]
        ];

        return $this->render('create', ['model' => $model, 'initial_prev'=> $initial_prev, 'image_conf' => $image_conf, 'promotion_id' => $promotion->id]);

    }
    public function actionDelete($id)
    {
        $promotion = Promotion::findOne(['id' => $id]);
        $urlImage = $promotion->url_image;
        if($promotion->delete()){
            if(file_exists($urlImage)){
                unlink($urlImage);
            }
            Yii::$app->session->addFlash('success', 'Акція видалена');
        } else{
            Yii::$app->session->addFlash('error', 'Помилка видалення акції');
        }
        return $this->redirect(['/promotion/index']);
    }

}
