<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class='row'>
    <div class="col-md-12">
        <?= Html::a(
            'Добавити товар',
            Url::toRoute(['/product/create']),
            [
                'class' => 'btn btn-success pull-right',
            ]
        )?>
    </div>
</div>

<!-- public $name;
    public $description;
    public $count;
    public $price;
    public $category_id;
    public $sub_category_id;
    public $images; -->
<div class='row'>
    <div class="col-md-12">
       <?=
            GridView::widget([
                'dataProvider' => $model,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'label' => 'Назва',
                        'attribute' => 'name',
                    ],
                    [
                        'label' => 'Опис',
                        'attribute' => 'description',
                    ],
                    [
                        'label' => 'Кількість',
                        'attribute' => 'count',
                    ],
                    [
                        'label' => 'Ціна',
                        'attribute' => 'price',
                    ],
                    [
                        'label' => 'Категорія',
                        'attribute' => 'category.name',
                    ],
                    [
                        'label' => 'Підкатегорія',
                        'attribute' => 'subCategory.name',
                    ],
                    ['class' => 'yii\grid\ActionColumn', 'template' =>'{view} {update} {delete}',
                    'options' => [
                        'style' => 'width: 20%',
                    ],
                    'buttons' => [
                        'view' => function($url, $model, $key){
                            return Html::a('Переглянути', ['view', 'id' => $model->id],['class' => 'btn btn-primary'] );
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