<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>



<div class="row">
    <div class="col-md-12">
        <h3>Додати категорію</h3>
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
        <div class="form-group">
            <?= Html::submitButton('ЗБЕРЕГТИ', ['class' => "btn btn-primary"]);?>
        </div>
        <?php
            ActiveForm::end();
        ?>
    </div>
</div>
