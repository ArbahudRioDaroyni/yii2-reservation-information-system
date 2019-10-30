<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Towing */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="towing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'list_vehicle_type_id')->dropDownList([
            frontend\models\ListVehicleType::getListName(),
    ]); ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'list_calculation_id')->dropDownList([
            frontend\models\ListCalculation::getListType(),
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
