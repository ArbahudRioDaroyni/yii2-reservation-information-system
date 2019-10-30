<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\HotelPaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hotel Payments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotel-payment-index">

    <!-- <h1>Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Create Hotel Payment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'invoice',
            'payment_code',
            // 'date_of_issued',
            // 'date_due',
            // 'tax',
            'total_price',
            'down_payment',
            //'amount_due',
            //'payment_method',
            //'status',
            //'order_hotel_id',
            'list_type_order_id',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
