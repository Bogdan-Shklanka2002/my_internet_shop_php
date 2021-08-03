<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

    $this->title = 'Додати підкатегорію';

    $this->params['breadcrumbs'][] = ['label' => 'Підкатегорії', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-default">
    <div class="panel-heading"><?=$this->title?></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <?php
                    $form = ActiveForm::begin([
                        'options' => [
                            'enctype' => 'multipart/form-data'
                        ]
                    ]);
                    echo $form->field($model, 'name')->textInput();
                    echo $form->field($model, 'description')->textArea(['row' => '5']);
                    // echo $form->field($model,)
                ?>
            </div>

            <div class="col-md-6">
                    <?=$form->field($model, 'category_id')->widget(Select2::classname(), [
                        'data' => $categories_array,
                        'options' => [
                            'placeholder' => 'Виберіть ...',
                            'id' => 'category',
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'multiple' => false,
                        ],
                    ])->label('Категорія');?>
                </div>
            <div class="col-md-12 form-group">
                <?= Html::submitButton('ЗБЕРЕГТИ', ['class' => "btn btn-primary"]);?>
            </div>
            <?php
                ActiveForm::end();
            ?>
        </div>
    </div>
</div>


