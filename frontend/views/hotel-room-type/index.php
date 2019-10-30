<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\HotelRoomTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hotel Room Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotel-room-type-index">

    <!-- <h1>Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Create Hotel Room Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'type',
            'price',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
