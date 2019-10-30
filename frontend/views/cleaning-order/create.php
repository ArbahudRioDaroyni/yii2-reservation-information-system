<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CleaningOrder */

$this->title = 'Create Cleaning Order';
$this->params['breadcrumbs'][] = ['label' => 'Cleaning Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cleaning-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
