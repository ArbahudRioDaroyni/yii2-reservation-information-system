<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "massage".
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property int $list_calculation_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ListCalculation $listCalculation
 * @property MassageImage[] $massageImages
 * @property MassageOrder[] $massageOrders
 */
class Massage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'massage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'list_calculation_id'], 'required'],
            [['price', 'list_calculation_id'], 'integer'],
            [['description', 'created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['list_calculation_id'], 'exist', 'skipOnError' => true, 'targetClass' => ListCalculation::className(), 'targetAttribute' => ['list_calculation_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'list_calculation_id' => 'Per',
            'description' => 'Deskripsi',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListCalculation()
    {
        return $this->hasOne(ListCalculation::className(), ['id' => 'list_calculation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMassageImages()
    {
        return $this->hasMany(MassageImage::className(), ['massage_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMassageOrders()
    {
        return $this->hasMany(MassageOrder::className(), ['massage_id' => 'id']);
    }

    public function getListName()
    {
        return ArrayHelper::map(Massage::find()->all(), 'id', 'name');
    }
}
