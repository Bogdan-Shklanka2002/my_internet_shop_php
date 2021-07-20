
<h1></h1>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>

<div class="row">
    <div class="col-md-12">
        <h3 class="pull-right">Перегляд <?=$model->name?></h3>
    </div>
    <div class="col-md-8">
        <h3>Фотографія акції</h3>
        <?=$model->url_image?>
        <img src='../../../uploads/b001b9a88c38cd49e34e7d8323a02f31.jpg' alt="" style='width: 100%;height: 500px;'>
    </div>
    <div class="col-md-4">
        <h3>Опис</h3>
        <?=$model->description?>
    </div>
</div>

<div class='row'>
    <div class="col-md-12">
        <?=Html::a(
            'Назад', 
            Url::toRoute('promotion/index'),
            [
                'class' => 'btn btn-success pull-right',
                'id' => 'promotion-create'
            ]
        )

        ?>
    </div>
</div>


