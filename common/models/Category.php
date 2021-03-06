<?php
namespace common\models;


use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 */

 class Category extends ActiveRecord
 {
     public static function tableName()
     {
         return 'categories';
     }

     public function rules(){
         return [];
     }
     public function getSubCategories(){
         return $this->hasMany(SubCategory::className(), ['category_id' => 'id']);
     }
 }