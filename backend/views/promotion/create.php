<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use kartik\icons\FontAwesomeAsset;
use yii\helpers\Url;

FontAwesomeAsset::register($this);
// AppAsset::register()
?> 

<div class="row">
    <div class="col-md-12">
        <h3>Додати акцію</h3>
    </div>
</div>

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
            ?>
            <div class="row">
                <div class="col-md-6">
                
                <?= $form->field($model, 'date_start')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Start date ...'],
                'pluginOptions' => [
                'autoclose'=>true
                ]
                ]);?>
                </div>
                <div class="col-md-6">
                
                <?= $form->field($model, 'date_end')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'End date ...'],
                'pluginOptions' => [
                'autoclose'=>true
                ]
                ]);?>
                </div>
            </div>
            <?php
            echo $form->field($model, 'imageFile')->widget(FileInput::classname(),[
                    // 'name' => 'attachment_49[]',
                    'options'=>[
                        'accept' => 'image/*',
                        'multiple'=>false
                    ],
                    'pluginOptions' => [
                        'initialPreview'=>$initial_prev,
                        'initialPreviewAsData'=>true,
                        'showCaption' => false,
                        'showRemove' => true,
                        'showUpload' => false,
                        'removeClass' => 'btn btn-default pull-right',
                        'browseClass' => 'btn btn-primary pull-right',
                        'removeLabel' => 'Видалити',
                        'browseLabel' => 'Завантажити',
                        // 'initialCaption'=>"The Moon and the Earth",
                        'initialPreviewConfig' => $image_conf,
                        // 'overwriteInitial'=>false,
                        'maxFileSize'=> 2800,
                        'deleteUrl' => Url::to(['/select-data/file-delete-promotion?id=' . $promotion_id]),
                    ]
                ]);
        ?>
        <div class="form-group">
            <?= Html::submitButton('ЗБЕРЕГТИ', ['class' => "btn btn-primary"]);?>
        </div>
        <?php
            ActiveForm::end();
        ?>
    </div>
</div>
