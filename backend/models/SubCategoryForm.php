<?php 

namespace backend\models;

use PDO;
use yii\base\Model;

class SubCategoryForm extends Model
{
    public $id;
    public $name;
    public $description;
    public $category_id;

    public function rules(){
        return[
            [['name', 'description'], 'string', 'message' => 'Невірний тип'],
            [['name', 'description', 'category_id'], 'required', 'message' => 'Значення обов\'язкове'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Назва категорії',
            'description' => 'Опис категорії',
            'category_id' => 'Категорія',
        ];
    }

}
