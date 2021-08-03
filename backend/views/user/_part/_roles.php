<?php
    use kartik\select2\Select2;
?>

<div class='row'>
    <div class="col-md-6">
        <?=$form->field($model, 'roles')->widget(Select2::classname(), [
            'data' => $roles_array,
            'options' => ['placeholder' => 'Виберіть ...'],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true,
            ],
        ]);?>
    </div>
</div>