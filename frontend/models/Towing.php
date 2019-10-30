<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "towing".
 *
 * @property int $id
 * @property int $list_vehicle_type_id
 * @property int $price
 * @property int $list_calculation_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ListCalculation $listCalculation
 * @property ListVehicleType $listVehicleType
 * @property TowingOrder[] $towingOrders
 */
class Towing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'towing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['list_vehicle_type_id', 'price', 'list_calculation_id'], 'required'],
            [['list_vehicle_type_id', 'price', 'list_calculation_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['list_calculation_id'], 'exist', 'skipOnError' => true, 'targetClass' => ListCalculation::className(), 'targetAttribute' => ['list_calculation_id' => 'id']],
            [['list_vehicle_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ListVehicleType::className(), 'targetAttribute' => ['list_vehicle_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'list_vehicle_type_id' => 'List Vehicle Type ID',
            'price' => 'Price',
            'list_calculation_id' => 'List Calculation ID',
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
    public function getListVehicleType()
    {
        return $this->hasOne(ListVehicleType::className(), ['id' => 'list_vehicle_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTowingOrders()
    {
        return $this->hasMany(TowingOrder::className(), ['towing_id' => 'id']);
    }

    public function getListName()
    {
        return ArrayHelper::map(Towing::find()->all(), 'id', 'listVehicleType.name');
    }
}
