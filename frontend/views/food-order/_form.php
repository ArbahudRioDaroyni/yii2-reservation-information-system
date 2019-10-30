<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FoodOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="food-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'food_id')->dropDownList(
            frontend\models\Food::getListName()
    ); ?>

    <?= $form->field($model, 'total_calculation')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'delivery_address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
