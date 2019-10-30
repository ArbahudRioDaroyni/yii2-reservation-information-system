<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\HotelOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hotel-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'start_date')->input('date') ?>

    <?= $form->field($model, 'finish_date')->input('date') ?>

    <?= $form->field($model, 'hotel_id')->dropDownList(
            frontend\models\Hotel::getListName()
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
