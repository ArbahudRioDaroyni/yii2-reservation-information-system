<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MassageOrder */

$this->title = 'Update Massage Order: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Massage Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="massage-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
