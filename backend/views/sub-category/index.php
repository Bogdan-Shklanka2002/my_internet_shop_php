<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;


?>


<div class='row'>
    <div class="col-md-12">
        <?=Html::a(
            'ДОДАТИ ПІДКАТЕГОРІЮ', 
            Url::toRoute('sub-category/create'),
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
                [
                    'label' => "Назва",
                    'attribute' => 'name',
                ],
                [
                    'label' => "Опис",
                    'attribute' => 'description',
                ],
                
                [
                    'label' => "Категорія",
                    'attribute' => 'category.name',
                ],
                ['class' => 'yii\grid\ActionColumn', 'template' =>'{update} {delete}',
                    'options' => [
                        'style' => 'width: 20%',
                    ],
                    'buttons' => [
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

