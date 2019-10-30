<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MassageOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Massage Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="massage-order-index">

    <!-- <h1>Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Create Massage Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'code',
            'massage_id',
            'name',
            'address',
            //'phone_number',
            //'email:email',
            //'start_at',
            //'customer_profile_id',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
