<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\HotelPayment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hotel Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="hotel-payment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'invoice',
            'payment_code',
            'date_of_issued',
            'date_due',
            'tax',
            'total_price',
            'down_payment',
            'total_payment',
            'amount_due',
            'payment_method',
            'status',
            'order_id',
            'list_type_order_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
