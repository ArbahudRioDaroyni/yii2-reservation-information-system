<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ListVehicleTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List Vehicle Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list-vehicle-type-index">

    <!-- <h1>Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Create List Vehicle Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'number_plate',
            'created_at',
            'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
