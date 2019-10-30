<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Towing */

$this->title = 'Update Towing: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Towings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="towing-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
