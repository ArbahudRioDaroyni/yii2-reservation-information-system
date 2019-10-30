<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\HotelRoomType */

$this->title = 'Update Hotel Room Type: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hotel Room Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hotel-room-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>