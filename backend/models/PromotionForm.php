<?php 

namespace backend\models;

use PDO;
use yii\base\Model;
use yii\web\UploadedFile;

class PromotionForm extends Model
{
    public $id;
    public $name;
    public $description;
    public $imageFile;
    public $date_start;
    public $date_end;

    public function rules(){
        return[
            [['id', 'name', 'description','date_start', 'date_end'], 'string', 'message' => 'Невірний тип'],
            [['name', 'description'], 'required', 'message' => 'Значення обов\'язкове'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'phd, jpg', 'message' => 'Необхідно завантажити файл певного розширення'],

            [['date_start'], 'required', 'when' => function($model) {
                if(empty($model->date_end) || $model->date_end == ''){
                    return false;
                } else {
                    return true;
                }
            }, 'whenClient' => 'function(){
                return !$("#promotionform-date_end").val() == "";
            }'],
            [['date_start', 'date_end'], 'validateDate'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Назва акції',
            'description' => 'Опис акції',
            'imageFile' => 'Картинка акції',
            'date_start' => 'Початок акції',
            'date_end' => 'Кінець акції',
        ];
    }

    public function upload(){
        if($this->validate()){
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

    public function validateDate()
    {
        if($this->date_start !== "" && $this->date_end !== "" && $this->date_start >= $this->date_end){
            $this->addError('date_start', 'Невірно введено дату');
            $this->addError('date_end', 'Невірно введено дату');
        }
    }
}