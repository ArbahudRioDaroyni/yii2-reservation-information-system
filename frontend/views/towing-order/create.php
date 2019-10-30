<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TowingOrder */

$this->title = 'Create Towing Order';
$this->params['breadcrumbs'][] = ['label' => 'Towing Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="towing-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
