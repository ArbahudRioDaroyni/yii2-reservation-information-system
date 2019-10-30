<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ListVehicleType */

$this->title = 'Update List Vehicle Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'List Vehicle Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="list-vehicle-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
