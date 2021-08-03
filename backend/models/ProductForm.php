<?php 

namespace backend\models;

use PDO;
use yii\base\Model;
use yii\web\UploadedFile;

class ProductForm extends Model
{
    public $id;
    public $name;
    public $description;
    public $count;
    public $price;
    public $category_id;
    public $sub_category_id;
    public $images;

    public function rules(){
        return[
            [['id', 'name', 'description'], 'string'],

            [['name', 'description', 'category_id', 'sub_category_id'], 'required'],
            [['category_id', 'sub_category_id', 'count'] , 'integer'],
            [['price'], 'number'],
            [['images'], 'file', 'skipOnEmpty' => false, 'extensions' => 'phd, jpg', 'maxFiles' => 10],

            
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Назва товару',
            'description' => 'Опис товару',
            'count' => 'Кількість товару',
            'price' => 'Ціна товару',
            'category_id' => 'Категорія',
            'sub_category_id' => 'Підкатегорія',
        ];
    }

    public function upload(){
        if($this->validate()){
            $result = [];
            foreach ($this->images as $image){
                $urlImage = $this->imagePath($image);
                $image->saveAs($urlImage);
                $result[] = $urlImage;

            }
            return $result;
        }
        return false;
    }

    public function imagePath($image)
    {
        if(!file_exists('../../uploads/')){
            mkdir('../../uploads/');
        }
        if(!file_exists('../../uploads/products/')){
            mkdir('../../uploads/products');
        }
        return '../../uploads/products/' . md5(microtime(). rand(0, 10000000000)) . '.' . $image->extension;
    }

   
}