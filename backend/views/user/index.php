<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

?>


<div class='row'>
    <div class="col-md-12">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'username',
                'first_name', 
                'second_name', 
                'last_name', 
                'email', 
                [
                    'label' => 'Статус',
                    'value' => function($model){
                        switch(ArrayHelper::getValue($model, 'status', 'Nan')){
                            case 0: 
                                return 'Видалений'; 
                            break;
                            case 9: 
                                return 'Неактивний';
                            break;
                            case 10:
                                return 'Активний';
                            break;
                            default:
                                return ArrayHelper::getValue($model, 'status', null);
                        }
                    }
                ],
                [
                    'label' => "Роль",
                    'format' => 'html',
                    'value' => function($model){
                        $auth = Yii::$app->authManager;
                        $roles = $auth->getRolesByUser(ArrayHelper::getValue($model, 'id', null));
                        $result = '';
                        foreach($roles as $key => $value){
                            switch($key){
                                case 'admin':
                                    $result .= 'Адміністратор' . '<br>';
                                break; 
                                case 'owner':
                                    $result .= 'Власник' . '<br>';
                                break; 
                                case 'user':
                                    $result .= 'Користувач' . '<br>';
                                break;
                                case 'seo-manager':
                                    $result .= 'SEO-менеджер' . '<br>';
                                break;
                                case 'content-manager':
                                    $result .= 'Контент-менеджер' . '<br>';
                                break;
                                default :
                                    $result .= $key . '<br>';
                                break;
                                 
                            }
                        }
                        return $result;
                    }
                ],
                ['class' => 'yii\grid\ActionColumn', 'template' =>'{update} {delete}',
                    'options' => [
                        'style' => 'width: 20%',
                    ],
                    'buttons' => [
                        'update' => function($url, $model, $key){
                            return Html::a('Редагувати', ['update', 'id' => ArrayHelper::getValue($model, 'id')],['class' => 'btn btn-success'] );
                        },
                        'delete' => function($url, $model, $key){
                            if(ArrayHelper::getValue($model, 'status') != 0){
                                return Html::a('Видалити' , ['delete', 'id' => ArrayHelper::getValue($model, 'id')], ['class' => 'btn btn-danger']);
                            } else{
                                return Html::a('Відновити' , ['recovery', 'id' => ArrayHelper::getValue($model, 'id')], ['class' => 'btn btn-primary']);
                            }
                        }
                    ]
                ],

            ]
        ]);
        ?>
    </div>
</div>

