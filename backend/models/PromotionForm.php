<?php 

namespace backend\models;

use PDO;
use yii\base\Model;
use yii\web\UploadedFile;

class PromotionForm extends Model
{
    public $name;
    public $description;
    public $imageFile;

    public function rules(){
        return[
            [['name', 'description'], 'string', 'message' => 'Невірний тип'],
            [['name', 'description'], 'required', 'message' => 'Значення обов\'язкове'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'phd, jpg', 'message' => 'Необхідно завантажити файл певного розширення'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Назва акції',
            'description' => 'Опис акції',
        ];
    }

    public function upload(){
        if($this->validate('name, description')){
            $urlImage = $this->imagePath();
            $this->imageFile->saveAs($urlImage);
            return $urlImage;
        }
    }

    public function imagePath()
    {
        if(!file_exists('../../uploads/')){
            mkdir('../../uploads/');
        }
        return '../../uploads/' . md5(microtime(). rand(0, 10000000000)) . '.' . $this->imageFile->extension;
    }
}