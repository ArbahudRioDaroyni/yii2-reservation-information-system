<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\HotelPayment */

$this->title = 'Update Hotel Payment: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hotel Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hotel-payment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
