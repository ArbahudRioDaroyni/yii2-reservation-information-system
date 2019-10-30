<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Towing */

$this->title = 'Create Towing';
$this->params['breadcrumbs'][] = ['label' => 'Towings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="towing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
