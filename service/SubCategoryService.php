<?php
namespace service;

use common\models\SubCategory;

class SubCategoryService
{
    public function saveDB($model){
    
        if($model->id){
            $sub_category = SubCategory::findOne(['id' => $model->id]);
        } else{
            $sub_category = new SubCategory();
        }
        $sub_category->name = $model->name;
        $sub_category->description = $model->description;
        $sub_category->category_id = $model->category_id;
        
        return $sub_category->save();
    }
}