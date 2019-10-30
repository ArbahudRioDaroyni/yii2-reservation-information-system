<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\HotelPayment */

$this->title = 'Create Hotel Payment';
$this->params['breadcrumbs'][] = ['label' => 'Hotel Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotel-payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
