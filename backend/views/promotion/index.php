<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>


<div class='row'>
    <div class="col-md-12">
        <?=Html::a(
            'ДОДАТИ АКЦІЮ', 
            Url::toRoute('promotion/create'),
            [
                'class' => 'btn btn-success pull-right',
                'id' => 'promotion-create'
            ]
        )

        ?>
    </div>
</div>
<div class='row'>
    <div class="col-md-12">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                'description',
                'date_start',
                'date_end',
                ['class' => 'yii\grid\ActionColumn', 'template' =>'{view} {update} {delete}',
                    'options' => [
                        'style' => 'width: 20%',
                    ],
                    'buttons' => [
                        'view' => function($url, $model, $key){
                            return Html::a(
                                'Переглянути',
                                ['view', 'id' => $model->id], 
                                ['class' => 'btn btn-primary'],
                            );
                        },
                        'update' => function($url, $model, $key){
                            return Html::a('Редагувати', ['update', 'id' => $model->id],['class' => 'btn btn-success'] );
                        },
                        'delete' => function($url, $model, $key){
                            return Html::a('Видалити' , ['delete', 'id' => $model->id], ['class' => 'btn btn-danger']);
                        }
                    ]
                ],

            ]
        ]);
        ?>
    </div>
</div>

