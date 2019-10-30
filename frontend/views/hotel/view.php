<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Hotel */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Hotels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="hotel-view">

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
            'name',
            'address:ntext',
            [
                'label' => 'Tipe Kamar',
                'value' => $model->hotelRoomType->type,
            ],
            [
                'label' => 'Harga',
                'value' => $model->hotelRoomType->price,
            ],
            'facility:ntext',
            [
                'label' => 'Per',
                'value' => $model->listCalculation->type,
            ],
            'facility:ntext',
            'term_of_service:ntext',
            [
                'label' => 'Foto',
                'value' => function ($data) {
                    $image = \frontend\models\HotelImage::find()->where(['hotel_id' => $data->id])->all();
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
