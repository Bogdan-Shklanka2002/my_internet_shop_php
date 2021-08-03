<?php

namespace backend\controllers;

use \yii\web\Controller;
use yii\filters\AccessControl;
use backend\models\CategoryForm;
use backend\models\ProductForm;
use Yii;
use yii\web\UploadedFile;
use common\models\Product;
use common\models\Category;
use service\ProductService;
// use service\PromotionService;
use yii\data\ActiveDataProvider;

class ProductController extends Controller
{

 
    private ProductService $product_service;

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

    public function __construct($id, $module, ProductService $product_service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->product_service = $product_service;
    }
    
    public function actionIndex()
    {   
        //$product = Product::find()->all() ;
        $product = new ActiveDataProvider([
            'query' => Product::find()
        ]);
        return $this->render('index', ['model' => $product]);

        // + добавити вивід категорі по індекму і підкатегорії
        // $dataProvider = new ActiveDataProvider([
        //     'query' => Category::find()
        // ]);
        // return $this->render('index', ['dataProvider' => $dataProvider]);
    }
    public function actionCreate()
    {
        $model = new ProductForm();

        if($model->load(Yii::$app->request->post())){
            $model->images = UploadedFile::getInstances($model, 'images');
            if($images_path = $model->upload()){
                if($this->product_service->saveDB($model, $images_path)){
                    Yii::$app->session->addFlash('success', 'Товар створено');

                } else{
                    Yii::$app->session->addFlash('error', 'Помилка створення товару');
                }
                return $this->redirect(['/product/index']);
            }
            // echo \Yii::getAlias('@app');
            // die();
        }
        
        $categories = Category::find()->all();
        $categories_array = [];
        foreach($categories as $category){
            $categories_array[$category->id] = $category->name;
        }


        return $this->render('create', 
        [
            'model' => $model ,
            'categories_array' => $categories_array,
            'initial_prev'=> [], 
            'image_conf' => [], 
            'product_id' => ''
        ]);


    }

    public function actionUpdate($id){
        $product = Product::findOne(['id' => $id]);
        
        $model = new ProductForm();
        $model->id = $id;
        if($model->load(Yii::$app->request->post())){

            $model->images = UploadedFile::getInstances($model, 'images');
            
            if($images_path = $model->upload()){
                if($this->product_service->saveDB($model, $images_path)){
                    Yii::$app->session->addFlash('success', 'Акція збережена');

                } else{
                    Yii::$app->session->addFlash('error', 'Помилка збереження акції');
                }

                return $this->redirect(['/promotion/index']);
            }
        } 

        $model->name = $product->name;
        $model->description = $product->description;
        $model->count = $product->count;
        $model->price = $product->price;
        $model->category_id = $product->category_id;
        $model->sub_category_id = $product->sub_category_id;


        $initial_prev = [];
        $image_conf = [];
        $images = json_decode($product->url_images, true);

        if($images){
            foreach($images as $image){
               
               
                $initial_prev[] = '../' . $image;
                $name_file = explode('/', $image);
                $image_conf = [
                    [
                        'key' => $name_file[count($name_file)-1],
                    ]
                ];
            }
        }
        // foreach($images as $image){
        //     $initial_prev[] = str_replace("\\", "", $image); 
            
           
        //     $image_conf = [
        //         [
        //             'key' => $name_file[count($name_file)-1],
        //         ]
        //     ];  
        // }
        $categories = Category::find()->all();
        $categories_array = [];
        foreach($categories as $category){
            $categories_array[$category->id] = $category->name;
        }

        
        return $this->render('create', 
        [
            'model' => $model ,
            'categories_array' => $categories_array,
            'initial_prev'=> $initial_prev, 
            'image_conf' => $image_conf, 
            'product_id' => $product->id
        ]);
        

    }

   

}
