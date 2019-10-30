<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\CustomerProfile */

$this->title = $model->first_name . ' ' . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Customer Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="customer-profile-view">

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
            // 'id',
            'first_name',
            'last_name',
            'phone_number',
            'email:email',
            'date_of_birth',
            'address',
            [
                'label' => 'gender',
                'value' => function ($data) {
                    if ($data->gender == 0) {
                        return 'Laki-laki';
                    } else {
                        return 'Perempuan';
                    }
                },
            ],
            [
                'label' => 'Username',
                'value' => $model->user->username,
            ],
            // 'created_at',
            // 'updated_at',
        ],
    ]) ?>

</div>
