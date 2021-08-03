<?php

namespace service;

use common\models\Promotion;

class PromotionService
{
    public function saveDB($model, $urlImage){

        if($model->id){
            $promotion = Promotion::findOne(['id' => $model->id]);
            if($urlImage != $promotion->url_image ){
                if(file_exists($promotion->url_image)){
                    unlink($promotion->url_image);
                }
            }
        } else{
            $promotion = new Promotion();
        }
        $promotion->name = $model->name;
        $promotion->description = $model->description;
        $promotion->url_image = $urlImage;
        $promotion->date_start = $model->date_end;
        $promotion->date_end = $model->date_start;
        return $promotion->save();
    }
}