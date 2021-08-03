<?php
    use common\models\User;
    use kartik\select2\Select2;
?>

<div class='row'>
    <div class="col-md-6">
        <?=$form->field($model, 'status')->widget(Select2::classname(), [
            'data' => [
                User::STATUS_DELETED => 'Видалений',
                User::STATUS_INACTIVE => 'Не активиний',
                User::STATUS_ACTIVE => 'Активний',
            ],
            'options' => ['placeholder' => 'Виберіть ...'],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => false,
            ],
        ]);?>
    </div>
</div>