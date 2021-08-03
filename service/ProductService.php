<?php

namespace service;

use common\models\Product;

class ProductService
{
    public function saveDB($model, $images_path){

        if($model->id){
            $product = Product::findOne(['id' => $model->id]);
            $images = json_encode($product->url_images);
            echo $images; 
            die();
            // foreach ($images as $image){

            // }
            // if($urlImage != $promotion->url_image ){
            //     if(file_exists($promotion->url_image)){
            //         unlink($promotion->url_image);
            //     }
            // }
        } else{
            $product = new Product();
        }
        $product->name = $model->name;
        $product->description = $model->description;
        $product->count = $model->count;
        $product->price = $model->price;
        $product->category_id = $model->category_id;
        $product->sub_category_id = $model->sub_category_id;
        $product->url_images = json_encode($images_path);
        var_dump($images_path);
        echo $product->url_images; 
        die();
        return $product->save();
    }
}