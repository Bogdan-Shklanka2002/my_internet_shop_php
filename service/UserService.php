<?php

namespace service;

use common\models\User;

// public $username;
// public $email;
// public $first_name;
// public $second_name;
// public $last_name;
// public $roles;
// public $status;

class UserService
{
    public function saveDB($model){

        if($model->id){
            $user = User::findOne(['id' => $model->id]);
           
        } else{
            $user = new User();
        }
        $user->first_name = $model->first_name;
        $user->second_name = $model->second_name;
        $user->last_name = $model->last_name;
        $user->roles = $model->roles;
        $user->status = $model->status;
        return $user->save();
    }
}