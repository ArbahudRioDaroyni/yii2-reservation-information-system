<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cleaning */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cleanings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cleaning-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'price',
            [
                'label' => 'Foto',
                'value' => function ($data) {
                    $image = \frontend\models\CleaningImage::find()->where(['cleaning_id' => $data->id])->all();
                    $temp = '';
                    $inc = 1;
                    foreach ($image as $value) {
                        $temp .= "<p>{$value['path']}</p>";
                        $inc++;
                    };
                    return $temp;
                },
                'format' => 'html'
            ],
            // 'created_at',
            // 'updated_at',
        ],
    ]) ?>

</div>
