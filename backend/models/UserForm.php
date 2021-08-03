<?php 

namespace backend\models;

use PDO;
use yii\base\Model;
use yii\web\UploadedFile;

class UserForm extends Model
{
    public $username;
    public $email;
    public $first_name;
    public $second_name;
    public $last_name;
    public $roles;
    public $status;


    public function rules(){
        return[
            [['first_name', 'second_name', 'last_name'], 'string', 'message' => 'Невірний тип'],
            [['status'], 'integer'],
            [['first_name', 'last_name', 'status'], 'required', 'message' => 'Значення обов\'язкове'],
            [['roles'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Нік',
            'first_name' => 'Ім\'я',
            'second_name' => 'По батькові',
            'last_name' => 'Прізвище',
            'email' => 'Електронна адресса',
            'status' => 'Статус користувача',
            'roles' => 'Ролі користувача',
        ];
    }
}