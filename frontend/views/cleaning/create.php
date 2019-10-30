<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cleaning */

$this->title = 'Create Cleaning';
$this->params['breadcrumbs'][] = ['label' => 'Cleanings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cleaning-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'image' => $image,
    ]) ?>

</div>
