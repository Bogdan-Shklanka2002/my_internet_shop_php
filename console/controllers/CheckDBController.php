<?php

namespace console\controllers;

use common\models\User;
use yii\console\Controller;

class CheckDBController extends Controller
{
    public function actionIndex()
    {
        $users = User::find()->where(['status' => 0])->all();
        foreach($users as $user){
            $user->delete();
        }
    }
}