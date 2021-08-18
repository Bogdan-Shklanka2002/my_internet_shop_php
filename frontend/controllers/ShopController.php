<?php

namespace frontend\controllers;

use common\models\Product;
use common\models\Promotion;
use common\models\Category;
use common\models\SubCategory;
use yii;
use yii\web\Controller;

class ShopController extends Controller
{
    public function actionIndex()
    {
        // echo Yii::getAlias('@app');
        // var_dump(func_get_args());
        // echo '<h1>Category</h1>';


        $promotions = Promotion::find()->all();
        $images_array = [];
        foreach($promotions as $promotion){
            $images_array[] = $promotion->url_image;
        }

        $products = Product::find()->all();
        $products_array = [];
        foreach($products as $product){
            $images = json_decode($product->url_images, true);
            $initial_prev = [];
            if($images){
                foreach($images as $image){
                    $initial_prev[] = '../' . $image;
                }
            }
            $products_array[] = [
                'id' => $product->id,
                'title' => $product->name,
                'description' => $product->description,
                'count' => $product->count,
                'price' => $product->price,
                'category' => Category::find()->where(['id' => $product->category_id])->one(),
                'sub_category' => SubCategory::find()->where(['id' => $product->sub_category_id])->one(),
                'image' => $initial_prev[0],
            ];
        }
        return $this->render('index',['images_array' => $images_array, 'products_array' => $products_array]);
    }
}