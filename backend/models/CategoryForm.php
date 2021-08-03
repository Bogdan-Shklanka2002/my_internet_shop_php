<?php 

namespace backend\models;

use PDO;
use yii\base\Model;

class CategoryForm extends Model
{
    public $id;
    public $name;
    public $description;

    public function rules(){
        return[
            [['name', 'description'], 'string', 'message' => 'Невірний тип'],
            [['name', 'description'], 'required', 'message' => 'Значення обов\'язкове'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Назва категорії',
            'description' => 'Опис категорії',
        ];
    }

}
