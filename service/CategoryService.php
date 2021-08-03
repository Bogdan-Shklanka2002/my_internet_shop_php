<?php
namespace service;

use common\models\Category;

class CategoryService
{
    public function saveDB($model){
    
        if($model->id){
            $category = Category::findOne(['id' => $model->id]);
        } else{
            $category = new Category();
        }
        $category->name = $model->name;
        $category->description = $model->description;
        
        return $category->save();
    }

    public static function getCategories(){
        $categories = Category::find()->all();
        $categories_array = [];
        foreach($categories as $category){
            $categories_array[$category->id] = $category->name;
        }
        return $categories_array;
    }
}