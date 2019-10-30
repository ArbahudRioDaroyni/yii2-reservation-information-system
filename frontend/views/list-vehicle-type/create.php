<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ListVehicleType */

$this->title = 'Create List Vehicle Type';
$this->params['breadcrumbs'][] = ['label' => 'List Vehicle Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list-vehicle-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
