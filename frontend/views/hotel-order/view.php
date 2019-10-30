<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\HotelOrder */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hotel Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="hotel-order-view">

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
            'code',
            'start_date',
            'finish_date',
            [
                'label' => 'Total Menginap',
                'value' => $model->total_calculation . ' ' . $model->hotel->listCalculation->type,
            ],
            [
                'label' => 'Hotel',
                'value' => $model->hotel->name . ' - ' . $model->hotel->hotelRoomType->type,
            ],
            [
                'label' => 'Customer',
                'value' => $model->customerProfile->first_name . ' ' . $model->customerProfile->last_name,
            ],
            // 'created_at',
            // 'updated_at',
        ],
    ]) ?>

</div>
