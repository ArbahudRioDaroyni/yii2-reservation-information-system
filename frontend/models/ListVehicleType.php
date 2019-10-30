<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "list_vehicle_type".
 *
 * @property int $id
 * @property string $name
 * @property string $number_plate
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Towing[] $towings
 */
class ListVehicleType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'list_vehicle_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['number_plate'], 'string', 'max' => 12],
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
            'number_plate' => 'Number Plate',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTowings()
    {
        return $this->hasMany(Towing::className(), ['list_vehicle_type_id' => 'id']);
    }

    static public function getListName()
    {
        return ArrayHelper::map(ListVehicleType::find()->all(), 'id', 'name');
    }
}
