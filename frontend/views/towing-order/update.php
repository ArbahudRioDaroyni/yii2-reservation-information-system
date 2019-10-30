<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TowingOrder */

$this->title = 'Update Towing Order: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Towing Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="towing-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
