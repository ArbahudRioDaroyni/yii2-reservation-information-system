<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ListCalculation */

$this->title = 'Create List Calculation';
$this->params['breadcrumbs'][] = ['label' => 'List Calculations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list-calculation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
