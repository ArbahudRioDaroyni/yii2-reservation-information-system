<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TowingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Towings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="towing-index">

    <!-- <h1>Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Create Towing', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'list_vehicle_type_id',
            'price',
            'list_calculation_id',
            'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>