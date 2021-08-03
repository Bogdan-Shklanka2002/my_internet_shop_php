<?php

namespace frontend\controllers;

use common\models\Promotion;
use yii;
use yii\web\Controller;

class ShopController extends Controller
{
    public function actionCategory()
    {
        // echo Yii::getAlias('@app');
        // var_dump(func_get_args());
        // echo '<h1>Category</h1>';


        $promotions = Promotion::find()->all();
        $images_array = [];
        foreach($promotions as $promotion){
            $images_array[] = $promotion->url_image;
        }
        return $this->render('index',['images_array' => $images_array]);
    }
}