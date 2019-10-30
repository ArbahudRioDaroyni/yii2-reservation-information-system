<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MassageOrder */

$this->title = 'Create Massage Order';
$this->params['breadcrumbs'][] = ['label' => 'Massage Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="massage-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
