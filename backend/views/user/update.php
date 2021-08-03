<?php

use yii\widgets\ActiveForm;
use kartik\select2;
use yii\helpers\Html;
$this->title = 'Оновлення користувача';



$this->params['breadcrumbs'][] = ['label' => 'Персонал', 'url' => ['/user/index']];
$this->params['breadcrumbs'][] = $this->title;



    $js = <<<JS
        $('#userform-status').change(function(){
            alert('Ви змінили статус користувача');
        })
    JS;
    $this->registerJs($js);


?>
<div class="panel panel-default">
    <div class="panel-heading"><span id='span-text'><?=$this->title?></span></div>
    <div class="panel-body">
        <?php 
            $form = ActiveForm::begin();
        ?>
         <div class='row'>
            <div class="col-md-6">
                <?= $form->field($model, 'email')->textInput(['readonly' => 'readonly']);?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'username')->textInput(['readonly' => 'readonly']);?>
            </div>
        </div>
        <div class='row'>
            <div class="col-md-4">
                <?= $form->field($model, 'last_name')->textInput();;?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'first_name')->textInput();;?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'second_name')->textInput();;?>
            </div>
        </div>

       
 
        <div class='row'>
            <div class="col-md-6">
                <?= $this->render('_part/_roles', ['form' => $form, 'model' => $model, 'roles_array' => $roles_array]);?>
            </div>
            <div class="col-md-6">
                <?= $this->render('_part/_status', ['form' => $form, 'model' => $model]);?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success']);?>
        </div>
    <?php
        ActiveForm::end();
    ?>
    </div>
</div>