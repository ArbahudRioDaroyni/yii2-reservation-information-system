<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CustomerProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customer Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-profile-index">

    <!-- <h1>Html::encode($this->title) ?></h1> -->

    <p>
        <?php // Html::a('Create Customer Profile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'first_name',
            'last_name',
            'phone_number',
            'email:email',
            //'date_of_birth',
            //'address',
            //'gender',
            //'user_id',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
